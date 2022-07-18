<?php

//function blaupunkt_add_instance($blaupunkt);
//function blaupunkt_update_instance($blaupunkt);
//function blaupunkt_delete_instance($id);

function tool_blaupunkt_extend_navigation_course($navigation, $course, $coursecontext) {
    $url = new moodle_url('/admin/tool/blaupunkt/index.php');
    ///mod/blaupunkt/index.php 
    $blaupunktnode = navigation_node::create('Development course', $url, navigation_node::TYPE_CUSTOM, 'Dev course', 'blaupunkt');
    $navigation->add_node($blaupunktnode);
}
