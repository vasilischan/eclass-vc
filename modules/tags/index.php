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
$require_help = false;
$guest_allowed = true;


include '../../include/baseTheme.php';
require_once 'include/lib/textLib.inc.php';
require_once 'include/sendMail.inc.php';
require_once 'include/lib/modalboxhelper.class.php';
require_once 'include/lib/multimediahelper.class.php';
require_once 'include/log.class.php';
require_once 'modules/search/indexer.class.php';
// The following is added for statistics purposes
require_once 'include/action.php';

// Special case for static modules
$modules[MODULE_ID_UNITS] = array('title' => $langCourseUnits, 'link' => 'units', 'image' => '');
$modules[MODULE_ID_WEEKS] = array('title' => $langCourseWeeklyFormat, 'link' => 'weeks', 'image' => '');

if (isset($_GET['tag']) && strlen($_GET['tag'])) {   
    $tag = $_GET['tag'];
    $tag_elements = Database::get()->queryArray("SELECT * FROM `tag_element_module`, `tag` WHERE `tag`.`name` = ?s AND `tag`.`id` =  `tag_element_module`.`tag_id` AND `tag_element_module`.`course_id` = ?d ORDER BY module_id", $tag, $course_id);
    $toolName = "$langTag: $tag";
    //check the element type
    $latest_module_id = 0;
    foreach($tag_elements as $tag){
        if($tag->module_id !== $latest_module_id && $latest_module_id){
            $tool_content .= "</div></div>";
        }
        if($tag->module_id !== $latest_module_id){
            $tool_content .= "
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            " . $modules[$tag->module_id]['title'] . "
                        </div>
                        <div class='panel-body'>";            
        }
        if($tag->module_id == MODULE_ID_ANNOUNCE){
            $announce = Database::get()->querySingle("SELECT title, content FROM announcement WHERE id = ?d ", $tag->element_id);
            $link = "<a href='../../modules/announcements/?course=".$course_code."&amp;an_id=".$tag->element_id."'>$announce->title</a><br>";            
        }
        if($tag->module_id == MODULE_ID_ASSIGN){
            $work = Database::get()->querySingle("SELECT title FROM assignment WHERE id = ?d ", $tag->element_id);
            $link = "<a href='../../modules/work/?course=".$course_code."&amp;id=".$tag->element_id."'>$work->title</a><br>";
        }
        if($tag->module_id == MODULE_ID_EXERCISE){
            $exe = Database::get()->querySingle("SELECT title FROM exercise WHERE id = ?d ", $tag->element_id);
            $link = "<a href='../../modules/exercise/admin.php?course=".$course_code."&amp;exerciseId=".$tag->element_id."'>$exe->title</a><br>";
        }
        if($tag->module_id == MODULE_ID_UNITS){
            $unit = Database::get()->querySingle("SELECT title FROM course_units WHERE id = ?d ", $tag->element_id);
            $link = "<a href='../../modules/units/index.php?course=".$course_code."&amp;id=".$tag->element_id."'>$unit->title</a><br>";
        }
        if($tag->module_id == MODULE_ID_WEEKS){
            $unit = Database::get()->querySingle("SELECT * FROM course_weekly_view WHERE id = ?d", $tag->element_id);               
            if(empty($unit->title)) {
                $previous_weeks = Database::get()->querySingle("SELECT COUNT(*) AS week_number FROM course_weekly_view WHERE course_id = ?d AND start_week < ?t", $unit->course_id, $unit->start_week);
                $week_number = $previous_weeks ? ($previous_weeks->week_number + 1) : 1;
                $title = "$week_number$langOr $langsWeek ($langFrom2 ".nice_format($unit->start_week)." $langTill ".nice_format($unit->finish_week).")"; 
            } else {
                $title = q($unit->title) . " ($langFrom2 ".nice_format($unit->start_week)." $langTill ".nice_format($unit->finish_week).")";
            }
            $link = "<a href='../../modules/weeks/index.php?course=".$course_code."&amp;id=".$tag->element_id."'>$title</a><br>";
        }            
        $tool_content .= "
                    <ul>
                        <li>$link</li>
                    </ul>
                ";
        $latest_module_id = $tag->module_id;
    }       
        $tool_content .= "</div></div>";
}
    
    
draw($tool_content, 2, null, $head_content);
