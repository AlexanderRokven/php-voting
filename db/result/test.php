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