<?php


namespace local_file_reader\task;
 
/**
 * An example of a scheduled task.
*/
     global $CFG;
     require_once($CFG->dirroot . '/local/file_reader/lib.php');
     // echo $a;



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
     local_upload_file();

}
}
