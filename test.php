<?php

// This file is part of the Certificate module for Moodle - http://moodle.org/
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
 * Handles uploading files
 *
 * @package    local_course_creation
 * @copyright  Mallamma<mallamma@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2017 or later
 */
require_once('../../config.php');
// require_once('lib.php');
global $DB,$PAGE,$USER,$CFG;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/iiimis/test.php');
$title = get_string('pluginname', 'local_course_creation');
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
echo $OUTPUT->header();
$allrec = $DB->get_records('local_pli_finalmarks');
if(!empty($allrec)){
  foreach ($allrec as $record) {
    $user = $DB->get_record('user1',array('username'=>$record->agent_code));
    if(!empty($user)){
      if($record->agent_code == $user->username){
    //upding records
        $update = new \stdClass;
        $update->id = $record->id;
        $update->userid = $user->id;
        $update->examdatetimestamp = strtotime($record->exam_date);
        $DB->update_record('local_pli_finalmarks',$update);
      }
    }
  }
}
echo $OUTPUT->footer();