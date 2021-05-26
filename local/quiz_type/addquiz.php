<?php
// This file is part of Moodle Course Rollover Plugin
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
 * @package     local_message
 * @author      Kristian
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/quiz_type/classes/form/addquiz.php');

global $DB;

$PAGE->set_url(new moodle_url('/local/quiz_type/addquiz.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Add');


// We want to display our form.
$mform = new edit();



if ($mform->is_cancelled()) {
    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/quiz_type/showquiz.php', 'You cancelled the showquiz form');

} else if ($fromform = $mform->get_data()) {

    // Insert the data into our database table.
    $recordtoinsert = new stdClass();
    $recordtoinsert->quizname 	 = $fromform->quizname;
    $recordtoinsert->question 	 = $fromform->question;
    $recordtoinsert->option1  	 = $fromform->option1;
    $recordtoinsert->option2  	 = $fromform->option2;
    $recordtoinsert->option3  	 = $fromform->option3;
    $recordtoinsert->option4  	 = $fromform->option4;
    $recordtoinsert->trueoption  = $fromform->trueoption;
  
    // echo $recordtoinsert->quizname; echo'<br>';
    // echo $recordtoinsert->question; echo'<br>';
    // echo $recordtoinsert->option1; echo'<br>';
    // echo $recordtoinsert->option2; echo'<br>';
    // echo $recordtoinsert->option3; echo'<br>';
    // echo $recordtoinsert->option4; echo'<br>';
    // echo $recordtoinsert->trueoption; exit;

    $DB->insert_record('local_quiz_type', $recordtoinsert);

    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/quiz_type/showquiz.php', 'You created a quiz with name ' . $fromform->quizname);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();





