<?php

/**
 * Created by PhpStorm.
 * User: Gizmo
 * Date: 7/8/2017
 * Time: 5:25 PM
 */
class Nominees
{

    public function INSERT_NOMINEE($org, $pos, $name, $course, $year, $stud_id) {
        global $db;

        //Check to see if the nominee already exists in the database.
        $sql = "SELECT *
                FROM nominees
                WHERE name = '$name'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }

        if($result->fetchArray() > 0) {
            echo "<div class='alert alert-danger'>Sorry the nominee you entered already exist in the database</div>";
        } else {
            //Insert nominee
            $sql = "INSERT INTO nominees(
                    org, pos, name, course, year, stud_id)
                    VALUES
                    ('$org','$pos','$name','$course','$year','$stud_id')";
            if(!$stmt = $db->prepare($sql)) {
                echo $stmt->error;
            } 

            if($db->query($sql)) {
                echo "<div class='alert alert-success'>Nominee was inserted successfully.</div>";
            }
            $stmt->reset();
        }
        return $stmt;
    }

    public function READ_NOMINEE() {
        global $db;

        $sql = "SELECT *
                FROM nominees
                ORDER BY name ASC";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }

    public function EDIT_NOMINEE($nom_id) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE id = '$nom_id'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }

    public function UPDATE_NOMINEE($org, $pos, $name, $course, $year, $stud_id, $nom_id) {
        global $db;

        $sql = "UPDATE nominees
                SET org = '$org', pos = '$pos', name = '$name', course = '$course', year = '$year', stud_id = '$stud_id'
                WHERE id = '$nom_id' LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } 

        if($db->query($sql)) {
            echo "<div class='alert alert-success'>Update successful <a href='http://localhost/VotingSystem/admin/add_nominees.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->reset();
        return $stmt;
    }

    public function DELETE_NOMINEE($nom_id) {
        global $db;

        $sql = "DELETE FROM nominees
                WHERE id = $nom_id
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        if($result) {
            header("location: http://localhost/VotingSystem/admin/add_nominees.php");
            exit();
        }
        $result->reset();
        return $result;
    }

    public function READ_NOM_BY_ORG_POS($org, $pos) {
        global $db;

        $sql = "SELECT *
                FROM nominees
                WHERE nominees.org = '$org'
                AND nominees.pos = '$pos'";
        echo $sql;
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }

    public function COUNT_VOTES($candidate_id) {
        global $db;

        $sql = "SELECT candidate_id
                FROM votes
                WHERE candidate_id = $candidate_id";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $result->reset();
        return $result;
    }
}