<?php
//Create authentication

//Start session
session_start();


if(!isset($_SESSION['ADMIN_ID'])) {
    header("location: http://localhost/VotingSystem/sandbox/info.php");
    exit();
}