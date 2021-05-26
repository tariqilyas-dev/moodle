<?php
// This file is part of Moodle - http://moodle.org/
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
 * @package    qtype
 * @subpackage multichoice1
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * multichoice1 question type conversion handler
 */
class moodle1_qtype_multichoice1_handler extends moodle1_qtype_handler {

    /**
     * @return array
     */
    public function get_question_subpaths() {
        return array(
            'ANSWERS/ANSWER',
            'multichoice1',
        );
    }

    /**
     * Appends the multichoice1 specific information to the question
     */
    public function process_question(array $data, array $raw) {

        // Convert and write the answers first.
        if (isset($data['answers'])) {
            $this->write_answers($data['answers'], $this->pluginname);
        }

        // Convert and write the multichoice1.
        if (!isset($data['multichoice1'])) {
            // This should never happen, but it can do if the 1.9 site contained
            // corrupt data.
            $data['multichoice1'] = array(array(
                'single'                         => 1,
                'shuffleanswers'                 => 1,
                'correctfeedback'                => '',
                'correctfeedbackformat'          => FORMAT_HTML,
                'partiallycorrectfeedback'       => '',
                'partiallycorrectfeedbackformat' => FORMAT_HTML,
                'incorrectfeedback'              => '',
                'incorrectfeedbackformat'        => FORMAT_HTML,
                'answernumbering'                => 'abc',
            ));
        }
        $this->write_multichoice1($data['multichoice1'], $data['oldquestiontextformat'], $data['id']);
    }

    /**
     * Converts the multichoice1 info and writes it into the question.xml
     *
     * @param array $multichoice1s the grouped structure
     * @param int $oldquestiontextformat - {@see moodle1_question_bank_handler::process_question()}
     * @param int $questionid question id
     */
    protected function write_multichoice1(array $multichoice1s, $oldquestiontextformat, $questionid) {
        global $CFG;

        // The grouped array is supposed to have just one element - let us use foreach anyway
        // just to be sure we do not loose anything.
        foreach ($multichoice1s as $multichoice1) {
            // Append an artificial 'id' attribute (is not included in moodle.xml).
            $multichoice1['id'] = $this->converter->get_nextid();

            // Replay the upgrade step 2009021801.
            $multichoice1['correctfeedbackformat']               = 0;
            $multichoice1['partiallycorrectfeedbackformat']      = 0;
            $multichoice1['incorrectfeedbackformat']             = 0;

            if ($CFG->texteditors !== 'textarea' and $oldquestiontextformat == FORMAT_MOODLE) {
                $multichoice1['correctfeedback']                 = text_to_html($multichoice1['correctfeedback'], false, false, true);
                $multichoice1['correctfeedbackformat']           = FORMAT_HTML;
                $multichoice1['partiallycorrectfeedback']        = text_to_html($multichoice1['partiallycorrectfeedback'], false, false, true);
                $multichoice1['partiallycorrectfeedbackformat']  = FORMAT_HTML;
                $multichoice1['incorrectfeedback']               = text_to_html($multichoice1['incorrectfeedback'], false, false, true);
                $multichoice1['incorrectfeedbackformat']         = FORMAT_HTML;
            } else {
                $multichoice1['correctfeedbackformat']           = $oldquestiontextformat;
                $multichoice1['partiallycorrectfeedbackformat']  = $oldquestiontextformat;
                $multichoice1['incorrectfeedbackformat']         = $oldquestiontextformat;
            }

            $multichoice1['correctfeedback'] = $this->migrate_files(
                    $multichoice1['correctfeedback'], 'question', 'correctfeedback', $questionid);
            $multichoice1['partiallycorrectfeedback'] = $this->migrate_files(
                    $multichoice1['partiallycorrectfeedback'], 'question', 'partiallycorrectfeedback', $questionid);
            $multichoice1['incorrectfeedback'] = $this->migrate_files(
                    $multichoice1['incorrectfeedback'], 'question', 'incorrectfeedback', $questionid);

            $this->write_xml('multichoice1', $multichoice1, array('/multichoice1/id'));
        }
    }
}
