
<?php

/**
 * Created by PhpStorm.
 * User: faintedbrain63
 * Date: 10/07/2017
 * Time: 3:03 PM
 */
class Voters
{
    public function INSERT_VOTER($name, $course, $year, $stud_id) {
        global $db;

        //Check to see if the voter exists
        $sql = "SELECT *
                FROM voters
                WHERE name = '$name'
                LIMIT 1";
        if(!$result = $db->prepare($sql)) {
            echo $result->error;
        } else {
            $result = $db->query($sql);
        }

        if($result->fetchArray() > 0) {
            echo "<div class='alert alert-danger'>Sorry the voter you entered already exists in the database.</div>";
        } else {
            //Insert voter
            $sql = "INSERT INTO voters(name, course, year, stud_id)VALUES('$name', '$course', '$year', '$stud_id')";
            if(!$result = $db->prepare($sql)) {
                echo $result->error;
            } 

            if($db->query($sql)) {
                echo "<div class='alert alert-success'>Voter was inserted successfully.</div>";
            }
            $result->reset();
        }
        return $result;
    }

    public function READ_VOTERS() {
        global $db;

        $sql = "SELECT *
                FROM voters
                ORDER BY name ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }

    public function EDIT_VOTER($voter_id) {
        global $db;

        $sql = "SELECT *
                FROM voters
                WHERE id = '$voter_id'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }

    public function UPDATE_VOTER($name, $course, $year, $stud_id, $voter_id) {
        global $db;

        $sql = "UPDATE voters
                SET name = '$name', course = '$course', year = '$year', stud_id = '$stud_id'
                WHERE id = '$voter_id' LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        }

        if($db->query($sql)) {
            echo "<div class='alert alert-success'>Voter was updated successfully.<a href='http://localhost/VotingSystem/admin/add_voters.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
            header("location: http://localhost/VotingSystem/admin/add_voters.php");
            exit();
        }
        $stmt->reset();
        return $stmt;
    }

    public function DELETE_VOTER($voter_id) {
        global $db;

        $sql = "DELETE FROM voters
                WHERE id = '$voter_id' LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }

        if($result) {
            header("location: http://localhost/VotingSystem/admin/add_voters.php");
            exit();
        }
        $result->reset();
        return $result;
    }
}