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

global $DB;

$PAGE->set_url(new moodle_url('/local/quiz_type/showquiz.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Add quiz');

$quiz = $DB->get_records('local_quiz_type');

echo $OUTPUT->header();
$templatecontext = (object)[
    'quiz' => array_values($quiz),
    'editurl' => new moodle_url('/local/quiz_type/addquiz.php'),
];

echo $OUTPUT->render_from_template('local_quiz_type/showquiz', $templatecontext);

echo $OUTPUT->footer();
