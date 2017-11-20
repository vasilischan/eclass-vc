<?php

/* ========================================================================
 * Open eClass 3.0
 * E-learning and Course Management System
 * ========================================================================
 * Copyright 2003-2014  Greek Universities Network - GUnet
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

$require_current_course = true;
$require_course_admin = true;
require_once '../../include/baseTheme.php';
require_once 'include/lib/fileManageLib.inc.php';
require_once 'archive_functions.php';

$toolName = $langCourseInfo;
$pageName = $langArchiveCourse;
$navigation[] = array('url' => "index.php?course=$course_code", 'name' => $langCourseInfo);

if (!isset($_GET['token']) || !validate_csrf_token($_GET['token'])) csrf_token_error();

doArchive($course_id, $course_code);

$tool_content .= "
    <div class='alert alert-info'>
      <ol>
        <li>$langBUCourseDataOfMainBase $course_code</li>
        <li>$langBackupOfDataBase $course_code</li>
      </ol>
    </div>
    <div class='alert alert-success'>$langBackupSuccesfull</div>" .
    action_bar(array(
        array('title' => $langDownloadIt,
              'url' => $urlAppend . "courses/archive/$course_code/$course_code-" . date('Ymd') . ".zip",
              'icon' => 'fa-download',
              'button-class' => 'btn-success',
              'level' => 'primary-label'),
        array('title' => $langBack,
              'url' => "index.php?course=$course_code",
              'icon' => 'fa-reply',
              'level' => 'primary-label')), false);

draw($tool_content, 2);