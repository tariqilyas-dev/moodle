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

$PAGE->set_url(new moodle_url('/local/file_reader/delete_file1.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('File Reader');


$url = 'http://still-oasis-17398.herokuapp.com/uploads/118.json';
$key = 'muCNhTEogUDNwOGlFHMqwZzGHkjTVRGOQiFxSYRTCCEqbGGkXH';
$data = array("key" => $key);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

$response = curl_exec($ch);
curl_close($ch);

echo "<script type='text/javascript'>alert('File Deleted Successfully')</script>";

echo "<script>window.location.href ='delete_file.php'</script>";
