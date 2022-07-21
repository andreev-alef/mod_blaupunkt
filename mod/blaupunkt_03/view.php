<?php

require_once("../../config.php");

$id = optional_param('id', 0, PARAM_INT);    // Course Module ID, or
$l = optional_param('l', 0, PARAM_INT);     // Blau ID



if ($id) {
    $PAGE->set_url('/mod/blaupunkt/index.php', array('id' => $id));
    if (!$cm = get_coursemodule_from_id('blaupunkt', $id, 0, true)) {
        print_error('invalidcoursemodule');
    }

    if (!$course = $DB->get_record("course", array("id" => $cm->course))) {
        print_error('coursemisconf');
    }

    if (!$blaupunkt = $DB->get_record("blaupunkt", array("id" => $cm->instance))) {
        print_error('invalidcoursemodule');
    }
} else {
    $PAGE->set_url('/mod/blaupunkt/index.php', array('l' => $l));
    if (!$blaupunkt = $DB->get_record("blaupunkt", array("id" => $l))) {
        print_error('invalidcoursemodule');
    }
    if (!$course = $DB->get_record("course", array("id" => $blaupunkt->course))) {
        print_error('coursemisconf');
    }
    if (!$cm = get_coursemodule_from_instance("blaupunkt", $blaupunkt->id, $course->id, true)) {
        print_error('invalidcoursemodule');
    }
}

require_login($course, true, $cm);

$url = course_get_url($course, $cm->sectionnum, []);
$url->set_anchor('module-' . $id);
redirect($url);

