<?php

/**
 * Created by PhpStorm.
 * User: Gizmo
 * Date: 7/2/2017
 * Time: 6:59 PM
 */
class Admin_Login
{
    private $_username;
    private $_password;

    public function __construct($c_username, $c_password) {
        $this->_username = $c_username;
        $this->_password = $c_password;
    }

    public function AdminLogin() {
        global $db;

        //Start session
        session_start();

        //Array to validate errors
        $error_msg_array = array();

        //Error messages
        $error_msg = FALSE;

        if($this->_username == "") {
            $error_msg_array[] = "Please input your username";
            $error_msg = TRUE;
        }

        if($this->_password == "") {
            $error_msg_array[] = "Please input your password";
            $error_msg = TRUE;
        }

        if($error_msg) {
            $_SESSION['ERROR_MSG_ARR'] = $error_msg_array;
            header("location: http://localhost/VotingSystem/admin/index.php");
            exit();
        }

        $sql = "SELECT * FROM admin WHERE username = '$this->_username' AND password = '$this->_password' LIMIT 1";

        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }

        if($result->fetchArray() > 0) {
            //Login successful
            $row = $result->fetchArray();
            
            while ($row = $result->fetchArray()) {
                $_SESSION['ADMIN_ID'] = $row['id'];
                $_SESSION['ADMIN_NAME'] = $row['name'];
            }

            // Check if session path is writable
            if (!is_writable(session_save_path())) {
                echo 'Session path "'.session_save_path().'" is not writable for PHP!';
            }
            //Create session
            session_regenerate_id();
            session_write_close();    
            header("location: http://localhost/VotingSystem/admin/admin_page.php");

        } else {
            //Login failed
            $error_msg_array[] = "The username and password you entered is incorrect.";
            $error_msg = TRUE;

            if($error_msg) {
                $_SESSION['ERROR_MSG_ARR'] = $error_msg_array;
                header("location: http://localhost/VotingSystem/admin/index.php");
                exit();
            }
            $stmt->free_result();
        }
        return $result;
    }
}