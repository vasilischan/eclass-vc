<?php
/* ========================================================================
 * Open eClass 3.5
 * E-learning and Course Management System
 * ========================================================================
 * Copyright 2003-2016  Greek Universities Network - GUnet
 * A full copyright notice can be read in "/info/copyright.txt".
 * For a full list of contributors, see "credits.txt".
 *
 * Open eClass is an open platform distributed in the hope that it will
 * be useful (without any warranty), under the terms of the GNU (General
 * Public License) as published by the Free Software Foundation.
 * The full license can be read in "/info/license/license_gpl.txt".
 *
 * Contact address: GUnet Asynchronous eLearning Group,
 *                  Network Operations Center, University of Athens,
 *                  Panepistimiopolis Ilissia, 15784, Athens, Greece
 *                  e-mail: info@openeclass.org
 * ======================================================================== */

$mail_ver_excluded = true;
require_once '../include/baseTheme.php';
$pageName = $langManuals;

$addon = '';

if (!in_array($language, array('el', 'en'))) {
    $language = 'en';
    $addon = " ($langOnlyInEnglish)";
}
$tool_content .= action_bar(array(
                                array('title' => $langBack,
                                      'url' => $urlServer,
                                      'icon' => 'fa-reply',
                                      'level' => 'primary-label',
                                      'button-class' => 'btn-default')
                            ),false);
$tool_content .= "<div class='list-group'>
    <li class='list-group-item list-header'>$langGeneralTutorials</li>
   ". manlink($langFinalDesc, 'detail_descr', $language)
    . manlink($langShortDesc, 'short_descr', $language)
    . manlink($langManT, 'mant', $language)
    . manlink($langManS, 'mans', $language) . "
</div>";

$tool_content .= "<div class='list-group'>
    <li class='list-group-item list-header'>$langTeacherTutorials</li>
   ". manlink($langCreateAccount, 'create_account', $language)
    . manlink($langCourseCreate, 'create_course', $language)
    . manlink($langUserPortfolio, 'portfolio_management', $language)
    . manlink($langAdministratorCourse, 'course_management', $language)
    . manlink($langAdministratorForum, 'forum_management', $language)
    . manlink($langAdministratorGroup, 'group_management', $language) . "
</div>";

$tool_content .= "<div class='list-group'>
   <li class='list-group-item list-header'>$langStudentTutorials</li>
   ". manlink($langRegCourses, 'register_course', $language)
    . manlink($langUserPortfolio, 'personal_portfolio', $language)
    . manlink($langIntroToCourse, 'ecourse', $language)
    . manlink($langForumParticipation, 'forum', $language) . "
</div>";


if (isset($uid) and $uid) {
    draw($tool_content, 1);
} else {
    draw($tool_content, 0);
}

/**
 * @brief create link to manuals
 * @param type $desc
 * @param type $link
 * @param type $language
 * @return type
 */
function manlink($desc, $link, $language) {
    $shortVer = preg_replace('/^(\d\.\d+).*$/', '\1', ECLASS_VERSION);
    $url = 'https://docs.openeclass.org/' . $shortVer;
    return "<a href='$url/$language:$link' target='_blank' class='mainpage list-group-item'>" .icon('fa-globe'). "&nbsp;&nbsp;-&nbsp;&nbsp;$desc</a>";
}
