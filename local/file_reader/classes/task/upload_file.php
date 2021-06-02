<?php


namespace local_file_reader\task;
 
/**
 * An example of a scheduled task.
*/
   

class upload_file extends \core\task\scheduled_task {
 
    /**
     * Return the task's name as shown in admin screens.
     *
     * @return string
     */

    public function get_name() {
        return get_string('upload_file', 'local_file_reader');
    }
 
    /**
     * Execute the task.
    */

    public function execute() {
     global $CFG;
     require_once($CFG->dirroot . '/local/file_reader/lib.php');
     local_upload_file(); //function to execute
    }

}
