<?php

/**
 * Created by PhpStorm.
 * User: faintedbrain63
 * Date: 03/07/2017
 * Time: 1:41 PM
 */
class Organization
{
    public function INSERT_ORG($organization) {
        global $db;

        //Check if the organization already exists in the database
        $sql = "SELECT *
                FROM organization
                WHERE org = '$organization'
                LIMIT 1";
        
        $result = $db->query($sql);

        if($result->fetchArray() > 0) {
            echo "<div class='alert alert-danger'>Sorry the organization you are trying to insert already exists in the database.</div>";
        } else {
            
            //Successfully inserted
            $sql = "INSERT INTO organization(org)VALUES('$organization')";

            if($db->query($sql)){
                echo "<div class='alert alert-success'>Organization was inserted successfully.</div>";
            }
            //$insertResult->reset();
        }
        //$result->reset();
        //return $result;
    }

    public function READ_ORG() {
        global $db;

        $sql = "SELECT * FROM organization";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $db->query($sql);
        }
        return $result;
    }

    public function EDIT_ORG($org_id) {
        global $db;

        $sql = "SELECT *
                FROM organization
                WHERE id = '$org_id'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }
        $stmt->reset();
        return $result;
    }

    public function UPDATE_ORG($org, $org_id) {
        global $db;

        $sql = "UPDATE organization
                SET org = '$org'
                WHERE id = '$org_id'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        }

        if($db->query($sql)) {
            echo "<div class='alert alert-success'>Update successful <a href='http://localhost/VotingSystem/sandbox/add_org.php'><span class='glyphicon glyphicon-backward'></span> </a></div>";
        }
        $stmt->reset();
        return $stmt;
    }

    public function DELETE_ORG($org_id) {
        global $db;

        //Delete organization
        $sql = "DELETE FROM organization
                WHERE id = '$org_id'
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $result = $db->query($sql);
        }

        if($result) {
            header("location: http://localhost/VotingSystem/sandbox/add_org.php");
            exit();
        }
        $result->reset();
        return $result;
    }
}