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

$img = file_get_contents("dot.png");

require_once '../../../include/baseTheme.php';
require_once 'class.lockmanager.php';

$page_title = strip_tags(rawurldecode($_REQUEST['page_title']));
$userid = intval($_REQUEST['uid']);
$wikiId = intval($_REQUEST['wiki_id']);

//prevent other users to execute this code
if ($uid != 0 && $userid == $uid) {
    $lock_manager = new LockManager();

    $lock_manager->nojslock($page_title, $wikiId, $userid);
}

header('Content-Type: image/png');
echo $img;