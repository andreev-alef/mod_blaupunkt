<?php
// Добавляем свой модуль в панель модулей
function tool_alef_extend_navigation_course($navigation, $course, $coursecontext) {
    $url = new moodle_url('/admin/tool/alef/index.php');
    $alefnode = navigation_node::create('Development course', $url, navigation_node::TYPE_CUSTOM, 'Dev course', 'alef');
    $navigation->add_node($alefnode);
}
