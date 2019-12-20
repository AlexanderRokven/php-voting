<?php
echo "Hello";
echo file_exists('/home/alexander/localhost/VotingSystem/db/result/data.sqlite');

$dir = "sqlite://home/alexander/localhost/VotingSystem/db/result/data.sqlite";
echo file_exists($dir);
// $dbh = new PDO($dir) or die("Cannot open the database");
// $query = "SELECT * FROM nominees";
// foreach ($dbh->query($query) as $row) {
// 	echo $row[0];
// }
// $dbh = null;

