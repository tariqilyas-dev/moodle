<?php

defined('MOODLE_INTERNAL') || die();
$tasks = [
    [
        'classname' => 'local_file_reader\task\upload_file',
        'blocking' => 0,
        'minute' => '*/15',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
    ],
];

?>


