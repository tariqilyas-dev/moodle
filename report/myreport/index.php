<?php
require(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');

// admin_externalpage_setup('reportmyreport');
// $ADMIN->add("reports", new admin_externalpage('reportmyreport', "Foo Admin Component", "$CFG->wwwroot/$CFG->reportmyreport"));

// global $DB;
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('User Report', 'report_myreport'));

// echo "this is my new report template";
$title = get_string('User Report', 'report_myreport');
$pagetitle = $title;
$url = new moodle_url("/report/myreport/index.php");
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);




global $DB;

// $sql = "SELECT * FROM {user} ORDER BY id DESC LIMIT 1";
// $sql = "SELECT * FROM {user} ORDER BY id DESC";
$users = $DB->get_records_sql("SELECT * FROM {user} ORDER BY id DESC");

// $users = $DB->get_records('user');
    // foreach ($users as $user) {
    //      $userstring .= $user->email . '  ||  ' . $user->firstname . ' ' . $user->lastname . '  ||  ' . $user->username . '<br>';
    // }

// echo $OUTPUT->header();
$templatecontext = (object)[
    'userreport' => array_values($users),
];

echo $OUTPUT->render_from_template('report_myreport/index', $templatecontext);
 
// Set up the page.

// $messages = $DB->get_records('local_message');
echo $OUTPUT->footer();