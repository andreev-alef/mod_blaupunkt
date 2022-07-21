<?php
require('../../config.php');

$id = required_param('id', PARAM_INT); // course id

$course = $DB->get_record('course', array('id'=>$id), '*', MUST_EXIST);

require_course_login($course, true);
$PAGE->set_blaupunktlayout('incourse');

// Trigger instances list viewed event.
//$event = \mod_blaupunkt\event\course_module_instance_list_viewed::create(array('context' => context_course::instance($course->id)));
//$event->add_record_snapshot('course', $course);
//$event->trigger();

$strblaupunkt    = get_string('modulename', 'blaupunkt');
$strblaupunkts   = get_string('modulenameplural', 'blaupunkt');
$strname         = get_string('name');
$strintro        = get_string('moduleintro');
$strlastmodified = get_string('lastmodified');

$PAGE->set_url('/mod/blaupunkt/index.php', array('id' => $course->id));
$PAGE->set_title($course->shortname.': '.$strblaupunkts);
$PAGE->set_heading($course->fullname);
$PAGE->navbar->add($strblaupunkts);

//echo 'GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG';
//
//echo $OUTPUT->header();
//echo $OUTPUT->heading($strblaupunkts);
//if (!$blaupunkts = get_all_instances_in_course('blaupunkt', $course)) {
//    notice(get_string('thereareno', 'moodle', $strblaupunkts), "$CFG->wwwroot/course/view.php?id=$course->id");
//    exit;
//}
//
//$usesections = course_format_uses_sections($course->format);
//
//$table = new html_table();
//$table->attributes['class'] = 'generaltable mod_index';
//
//if ($usesections) {
//    $strsectionname = get_string('sectionname', 'format_'.$course->format);
//    $table->head  = array ($strsectionname, $strname, $strintro);
//    $table->align = array ('center', 'left', 'left');
//} else {
//    $table->head  = array ($strlastmodified, $strname, $strintro);
//    $table->align = array ('left', 'left', 'left');
//}
//
//$modinfo = get_fast_modinfo($course);
//$currentsection = '';
//foreach ($blaupunkts as $blaupunkt) {
//    $cm = $modinfo->cms[$blaupunkt->coursemodule];
//    if ($usesections) {
//        $printsection = '';
//        if ($blaupunkt->section !== $currentsection) {
//            if ($blaupunkt->section) {
//                $printsection = get_section_name($course, $blaupunkt->section);
//            }
//            if ($currentsection !== '') {
//                $table->data[] = 'hr';
//            }
//            $currentsection = $blaupunkt->section;
//        }
//    } else {
//        $printsection = '<span class="smallinfo">'.userdate($blaupunkt->timemodified)."</span>";
//    }
//
//    $class = $blaupunkt->visible ? '' : 'class="dimmed"'; // hidden modules are dimmed
//
//    $table->data[] = array (
//        $printsection,
//        "<a $class href=\"view.php?id=$cm->id\">".format_string($blaupunkt->name)."</a>",
//        format_module_intro('blaupunkt', $blaupunkt, $cm->id));
//}
//
//echo html_writer::table($table);
//
//echo $OUTPUT->footer();
