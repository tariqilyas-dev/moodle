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

defined('MOODLE_INTERNAL') || die;

function get_curl($url, $post_fields) {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 120,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_CUSTOMREQUEST => "PUT",
				CURLOPT_POSTFIELDS => $post_fields, 
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				return $response;
			}
		}

// $pagedata = $DB->get_records('page');
$pagedata = $DB->get_records_sql("SELECT * FROM {course_modules} ORDER BY id DESC LIMIT 1");


foreach ($pagedata as $data) {
}
// echo $data->id;
// echo $data->course;exit;
$id = $data->id;
$course = $data->course;

function local_upload_file()
{ 

define('uploadurl', 'http://still-oasis-17398.herokuapp.com/uploads/112.json');
	$parame      = array('key' => 'muCNhTEogUDNwOGlFHMqwZzGHkjTVRGOQiFxSYRTCCEqbGGkXH','upload[course]' => $id,'upload[activity]' => $course); 
	$get_res     = get_curl(uploadurl,$parame); 
	$upload_responseArr = json_decode($get_res, true);
	return $upload_responseArr;
	// print_r($upload_responseArr);
}	


?>