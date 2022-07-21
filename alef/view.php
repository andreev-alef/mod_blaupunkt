<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * alef module version information
 *
 * @package mod_alef
 * @copyright  2022 Alef
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require('../../config.php');
require_once($CFG->dirroot . '/mod/alef/lib.php');
//require_once($CFG->dirroot . '/mod/alef/locallib.php');
require_once($CFG->libdir . '/completionlib.php');

$id = optional_param('id', 0, PARAM_INT); // Course Module ID


$p = optional_param('p', 0, PARAM_INT);  // alef instance ID

//$inpopup = optional_param('inpopup', 0, PARAM_BOOL);
//
//if ($p) {
//    if (!$alef = $DB->get_record('alef', array('id' => $p))) {
//        print_error('invalidaccessparameter');
//    }
//    $cm = get_coursemodule_from_instance('alef', $alef->id, $alef->course, false, MUST_EXIST);
//} else {
//    if (!$cm = get_coursemodule_from_id('alef', $id)) {
//        print_error('invalidcoursemodule');
//    }
//    $alef = $DB->get_record('alef', array('id' => $cm->instance), '*', MUST_EXIST);
//}

//$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
//
//require_course_login($course, true, $cm);
//$context = context_module::instance($cm->id);
//require_capability('mod/alef:view', $context);
//
//// Completion and trigger events.
//alef_view($alef, $course, $cm, $context);
//
//$alef->set_url('/mod/alef/view.php', array('id' => $cm->id));
//
//$options = empty($alef->displayoptions) ? array() : unserialize($alef->displayoptions);
//
//if ($inpopup and $alef->display == RESOURCELIB_DISPLAY_POPUP) {
//    $alef->set_aleflayout('popup');
//    $alef->set_title($course->shortname . ': ' . $alef->name);
//    $alef->set_heading($course->fullname);
//} else {
//    $alef->set_title($course->shortname . ': ' . $alef->name);
//    $alef->set_heading($course->fullname);
//    $alef->set_activity_record($alef);
//}
//echo $OUTPUT->header();
//if (!isset($options['printheading']) || !empty($options['printheading'])) {
//    echo $OUTPUT->heading(format_string($alef->name), 2);
//}
//
//// Display any activity information (eg completion requirements / dates).
//$cminfo = cm_info::create($cm);
//$completiondetails = \core_completion\cm_completion_details::get_instance($cminfo, $USER->id);
//$activitydates = \core\activity_dates::get_dates_for_module($cminfo, $USER->id);
//echo $OUTPUT->activity_information($cminfo, $completiondetails, $activitydates);
//
//if (!empty($options['printintro'])) {
//    if (trim(strip_tags($alef->intro))) {
//        echo $OUTPUT->box_start('mod_introbox', 'alefintro');
//        echo format_module_intro('alef', $alef, $cm->id);
//        echo $OUTPUT->box_end();
//    }
//}
//
//$content = file_rewrite_pluginfile_urls($alef->content, 'pluginfile.php', $context->id, 'mod_alef', 'content', $alef->revision);
//$formatoptions = new stdClass;
//$formatoptions->noclean = true;
//$formatoptions->overflowdiv = true;
//$formatoptions->context = $context;
//$content = format_text($content, $alef->contentformat, $formatoptions);
//echo $OUTPUT->box($content, "generalbox center clearfix");
//
//if (!isset($options['printlastmodified']) || !empty($options['printlastmodified'])) {
//    $strlastmodified = get_string("lastmodified");
//    echo html_writer::div("$strlastmodified: " . userdate($alef->timemodified), 'modified');
//}

//echo $OUTPUT->footer();
?>
<?= $id ?>
<hr />
<?= $p ?>