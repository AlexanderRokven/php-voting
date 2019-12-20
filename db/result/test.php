<?php
ini_set('display_errors', 1);
echo "Hello";
echo file_exists('/home/alexander/localhost/VotingSystem/db/result/data.sqlite');


// class MyDB extends SQLite3 {
// 	function __construct() {
// 		$this->open('data.sqlite');
// 	}
// }

// $db = new MyDB();
// if (!$db) {
// 	echo "nothin";
// 	echo $db->lastErrorMsg();
// } else {
// 	echo "Opened database succesfully";
// }

// $sql = "SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1";
$db = new SQLite3('data.sqlite');
// $sql = "SELECT * FROM admin";
// "SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1"
$results = $db->query("SELECT * FROM admin WHERE username = 'admin' AND password = 'admin' LIMIT 1");
while ($row = $results->fetchArray()) {
   	var_dump($row);
   	echo $row['id'];
}


if ($results->fetchArray() > 0) {
	echo "\nBigger then 0";
} else {
	echo "Less then 0";
}

require("/home/alexander/localhost/VotingSystem/process/auth.php");

if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!';
}
session_start();
session_regenerate_id();
$_SESSION['ADMIN_ID'] = '1';
session_write_close();

if (!isset($_SESSION['ADMIN_ID'])) {
	echo "ADMIN ID NOT SET";
} else {
	echo "ADMIN ID SET";
}