<?php
/**
 * Created by PhpStorm.
 * User: Gizmo
 * Date: 7/2/2017
 * Time: 6:40 PM
 */

//This line of code connects to mysql database
// define("HOST_NAME", "localhost");
// define("HOST_USER", "user");
// define("HOST_PASS", "user");
// define("HOST_DB", "voting");

// $db = new mysqli(HOST_NAME, HOST_USER, HOST_PASS, HOST_DB);

//This line of code checks if connection error exists.

// if($db->connect_error) {
//     echo $db->connect_errno . " " . $db->connect_error;
// } else {
//     echo "Connection successful.";
// }

class MyDB extends SQLite3 {
	function __construct() {
		$this->open('/home/alexander/localhost/VotingSystem/db/result/data.sqlite');
	}
}

$db = new MyDB();
if (!$db) {
	echo "nothin";
	echo $db->lastErrorMsg();
} else {
	echo "Opened database succesfully";
}