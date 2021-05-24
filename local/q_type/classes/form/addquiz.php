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

require_once("$CFG->libdir/formslib.php");

class add extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'quizname', 'Add quiz name'); // Add elements to your form
        $mform->setType('quizname', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('quizname', 'Please enter a quiz name');        //Default value

        $mform->addElement('text', 'question', 'Add quiz question'); // Add elements to your form
        $mform->setType('question', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('question', 'Please enter a quiz question');        //Default value

        $mform->addElement('text', 'option1', 'Add quiz option1'); // Add elements to your form
        $mform->setType('option1', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('option1', 'Please enter a quiz option1');        //Default value

        $mform->addElement('text', 'option2', 'Add quiz option2'); // Add elements to your form
        $mform->setType('option2', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('option2', 'Please enter a quiz option2');        //Default value

        $mform->addElement('text', 'option1', 'Add quiz option3'); // Add elements to your form
        $mform->setType('option3', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('option3', 'Please enter a quiz option3');        //Default value

        $mform->addElement('text', 'option4', 'Add quiz option4'); // Add elements to your form
        $mform->setType('option4', PARAM_NOTAGS); //Set type of element
        $mform->setDefault('option4', 'Please enter a quiz option4');        //Default value
        
        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
