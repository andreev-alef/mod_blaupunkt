<?php
/**
 * alef module version information
 *
 * @package mod_alef
 * @copyright  2022 Alef
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
//require_once($CFG->dirroot . '/mod/alef/lib.php');
//require_once($CFG->dirroot . '/mod/alef/locallib.php');
//require_once($CFG->libdir . '/completionlib.php');

$id = optional_param('id', 0, PARAM_INT); // Course Module ID

$p = optional_param('p', 0, PARAM_INT);  // alef instance ID

$inpopup = optional_param('inpopup', 0, PARAM_BOOL);

if ($p) {
    if (!$alef = $DB->get_record('alef', array('id' => $p))) {
        print_error('invalidaccessparameter');
    }
    $cm = get_coursemodule_from_instance('alef', $alef->id, $alef->course, false, MUST_EXIST);
} else {
    echo '<hr /><hr />';
    if (!$cm = get_coursemodule_from_id('alef', $id)) {
        print_error('invalidcoursemodule');
    }
    $alef = $DB->get_record('alef', array('id' => $cm->instance), '*', MUST_EXIST);
}

$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/alef:view', $context);

echo $OUTPUT->header();
if (!isset($options['printheading']) || !empty($options['printheading'])) {
    echo $OUTPUT->heading(format_string($alef->name), 2);
}
//
//// Display any activity information (eg completion requirements / dates).
$cminfo = cm_info::create($cm);
$completiondetails = \core_completion\cm_completion_details::get_instance($cminfo, $USER->id);
$activitydates = \core\activity_dates::get_dates_for_module($cminfo, $USER->id);
echo $OUTPUT->activity_information($cminfo, $completiondetails, $activitydates);

if (!empty($options['printintro'])) {
    if (trim(strip_tags($alef->intro))) {
        echo $OUTPUT->box_start('mod_introbox', 'alefintro');
        echo format_module_intro('alef', $alef, $cm->id);
        echo $OUTPUT->box_end();
    }
}

$content = file_rewrite_pluginfile_urls($alef->content, 'pluginfile.php', $context->id, 'mod_alef', 'content', $alef->revision);
$formatoptions = new stdClass;
$formatoptions->noclean = true;
$formatoptions->overflowdiv = true;
$formatoptions->context = $context;
$content = format_text($content, $alef->contentformat, $formatoptions);
echo $OUTPUT->box($content, "generalbox center clearfix");

if (!isset($options['printlastmodified']) || !empty($options['printlastmodified'])) {
    $strlastmodified = get_string("lastmodified");
    echo html_writer::div("$strlastmodified: " . userdate($alef->timemodified), 'modified');
}

$tables_list = $DB->get_record_sql('SELECT count(TABLE_NAME) FROM information_schema.tables'); // WHERE table_schema = "mdl"');
//$tables_list = $DB->get_record_sql('SELECT table_name FROM information_schema.tables WHERE table_schema = "mdl"');

//$fh = fopen('../../config.php', 'r');
//$s = readfile('../../config.php');
?>
<?= var_dump($tables_list) ?>
<pre>
<?= $OUTPUT->footer() ?>
</pre>