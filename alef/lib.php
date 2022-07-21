<?php
defined('MOODLE_INTERNAL') || die;

// Добавляем свой модуль в панель модулей

function tool_alef_extend_navigation_course($navigation, $course, $coursecontext) {
    $url = new moodle_url('/admin/tool/alef/index.php');
    $alefnode = navigation_node::create('Development course', $url, navigation_node::TYPE_CUSTOM, 'Dev course', 'alef');
    $navigation->add_node($alefnode);
}


//Добавление элемента в курс


/**
 * List of features supported in alef module
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know
 */
//function alef_supports($feature) {
//    switch($feature) {
//        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
//        case FEATURE_GROUPS:                  return false;
//        case FEATURE_GROUPINGS:               return false;
//        case FEATURE_MOD_INTRO:               return true;
//        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
//        case FEATURE_GRADE_HAS_GRADE:         return false;
//        case FEATURE_GRADE_OUTCOMES:          return false;
//        case FEATURE_BACKUP_MOODLE2:          return true;
//        case FEATURE_SHOW_DESCRIPTION:        return true;
//
//        default: return null;
//    }
//}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 * @param $data the data submitted from the reset course.
 * @return array status array
 */
//function alef_reset_userdata($data) {
//
//    // Any changes to the list of dates that needs to be rolled should be same during course restore and course reset.
//    // See MDL-9367.
//
//    return array();
//}

/**
 * List the actions that correspond to a view of this module.
 * This is used by the participation report.
 *
 * Note: This is not used by new logging system. Event with
 *       crud = 'r' and edulevel = LEVEL_PARTICIPATING will
 *       be considered as view action.
 *
 * @return array
 */
function alef_get_view_actions() {
    return array('view','view all');
}

/**
 * List the actions that correspond to a post of this module.
 * This is used by the participation report.
 *
 * Note: This is not used by new logging system. Event with
 *       crud = ('c' || 'u' || 'd') and edulevel = LEVEL_PARTICIPATING
 *       will be considered as post action.
 *
 * @return array
 */
function alef_get_post_actions() {
    return array('update', 'add');
}

/**
 * Add alef instance.
 * @param stdClass $data
 * @param mod_alef_mod_form $mform
 * @return int new alef instance id
 */
function alef_add_instance($data, $mform = null) {
    global $CFG, $DB;
    require_once("$CFG->libdir/resourcelib.php");

    $cmid = $data->coursemodule;

    $data->timemodified = time();
    $displayoptions = array();
    if ($data->display == RESOURCELIB_DISPLAY_POPUP) {
        $displayoptions['popupwidth']  = $data->popupwidth;
        $displayoptions['popupheight'] = $data->popupheight;
    }
    $displayoptions['printheading'] = $data->printheading;
    $displayoptions['printintro']   = $data->printintro;
    $displayoptions['printlastmodified'] = $data->printlastmodified;
    $data->displayoptions = serialize($displayoptions);

    if ($mform) {
        $data->content       = $data->alef['text'];
        $data->contentformat = $data->alef['format'];
    }

    $data->id = $DB->insert_record('alef', $data);

    // we need to use context now, so we need to make sure all needed info is already in db
    $DB->set_field('course_modules', 'instance', $data->id, array('id'=>$cmid));
    $context = context_module::instance($cmid);

    if ($mform and !empty($data->alef['itemid'])) {
        $draftitemid = $data->alef['itemid'];
        $data->content = file_save_draft_area_files($draftitemid, $context->id, 'mod_alef', 'content', 0, alef_get_editor_options($context), $data->content);
        $DB->update_record('alef', $data);
    }

    $completiontimeexpected = !empty($data->completionexpected) ? $data->completionexpected : null;
    \core_completion\api::update_completion_date_event($cmid, 'alef', $data->id, $completiontimeexpected);

    return $data->id;
}

/**
 * Update alef instance.
 * @param object $data
 * @param object $mform
 * @return bool true
 */
function alef_update_instance($data, $mform) {
    global $CFG, $DB;
    require_once("$CFG->libdir/resourcelib.php");

    $cmid        = $data->coursemodule;
    $draftitemid = $data->alef['itemid'];

    $data->timemodified = time();
    $data->id           = $data->instance;
    $data->revision++;

    $displayoptions = array();
    if ($data->display == RESOURCELIB_DISPLAY_POPUP) {
        $displayoptions['popupwidth']  = $data->popupwidth;
        $displayoptions['popupheight'] = $data->popupheight;
    }
    $displayoptions['printheading'] = $data->printheading;
    $displayoptions['printintro']   = $data->printintro;
    $displayoptions['printlastmodified'] = $data->printlastmodified;
    $data->displayoptions = serialize($displayoptions);

    $data->content       = $data->alef['text'];
    $data->contentformat = $data->alef['format'];

    $DB->update_record('alef', $data);

    $context = context_module::instance($cmid);
    if ($draftitemid) {
        $data->content = file_save_draft_area_files($draftitemid, $context->id, 'mod_alef', 'content', 0, alef_get_editor_options($context), $data->content);
        $DB->update_record('alef', $data);
    }

    $completiontimeexpected = !empty($data->completionexpected) ? $data->completionexpected : null;
    \core_completion\api::update_completion_date_event($cmid, 'alef', $data->id, $completiontimeexpected);

    return true;
}

/**
 * Delete alef instance.
 * @param int $id
 * @return bool true
 */
function alef_delete_instance($id) {
    global $DB;

    if (!$alef = $DB->get_record('alef', array('id'=>$id))) {
        return false;
    }

    $cm = get_coursemodule_from_instance('alef', $id);
    \core_completion\api::update_completion_date_event($cm->id, 'alef', $id, null);

    // note: all context files are deleted automatically

    $DB->delete_records('alef', array('id'=>$alef->id));

    return true;
}

//Просмотреть содержимое модуля
function alef_view($alef, $course, $cm, $context) {

    // Trigger course_module_viewed event.
    $params = array(
        'context' => $context,
        'objectid' => $alef->id
    );

    $event = \mod_alef\event\course_module_viewed::create($params);
    $event->add_record_snapshot('course_modules', $cm);
    $event->add_record_snapshot('course', $course);
    $event->add_record_snapshot('alef', $alef);
    $event->trigger();

    // Completion.
    $completion = new completion_info($course);
    $completion->set_module_viewed($cm);
}