<?php
//Create authentication

//Start session
session_start();

if(!isset($_SESSION['STUD_ID']) || count($_SESSION['STUD_ID']) == 0) {
    header("location: http://localhost/VotingSystem/index.php");
    exit();
}