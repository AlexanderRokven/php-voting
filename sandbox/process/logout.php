<?php
//Start session
session_start();

session_destroy();
header("location: http://localhost/VotingSystem/sandbox/index.php");
exit();