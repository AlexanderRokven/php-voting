<?php

/**
 * Created by PhpStorm.
 * User: Gizmo
 * Date: 7/8/2017
 * Time: 8:17 AM
 */
class Position
{
    public function INSERT_POS($org, $pos) {
        global $db;

        //Check to see if the position is already inserted
        $sql = "SELECT *
                FROM positions
                WHERE org = '$org'
                AND pos = '$pos'
                LIMIT 1";

        $result = $db->query($sql);

        if ($result->fetchArray() > 0) {
            echo "<div class='alert alert-danger'>Sorry the position you entered is already inserted in the database.</div>";
        } else {
            $sql = "INSERT INTO position(org, pos) VALUES ($org, $pos)";

            if ($db->query($sql)) {
                echo "<div class='alert alert-success'>Position was inserted successfully.</div>";
            }
        }
    }

    public function READ_POS() {
        global $db;

        //Read positions in every organization
        $sql = "SELECT *
                FROM positions
                ORDER BY org ASC";

        

        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->execute();
            $result = $db->query($sql);
        }
        $stmt->reset();
        return $result;
    }

    public function EDIT_POS($pos_id) {
        global $db;

        //Edit position
        $sql = "SELECT *
                FROM positions
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }

    public function UPDATE_POS($org, $pos, $pos_id) {
        global $db;

        //Update position
        $sql = "UPDATE positions
                SET org = ?, pos = ?
                WHERE id = ?
                LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("ssi", $org, $pos, $pos_id);
        }

        if($stmt->execute()) {
            echo "<div class='alert alert-success'>Position was updated successfully.<a href='http://localhost/VotingSystem/admin/add_pos.php'><span class='glyphicon glyphicon-backward'></span></a></div>";
        }
        $stmt->free_result();
        return $stmt;
    }

    public function DELETE_POS($pos_id) {
        global $db;

        //Read positions in every organization
        $sql = "DELETE FROM positions
                WHERE id = ? LIMIT 1";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("i", $pos_id);
        }

        if($stmt->execute()) {
            header("location: http://localhost/VotingSystem/admin/add_pos.php");
            exit();
        }
        $stmt->free_result();
        return $stmt;
    }

    public function READ_POS_BY_ORG($org) {
        global $db;

        $sql = "SELECT *
                FROM positions
                WHERE org = ?";
        if(!$stmt = $db->prepare($sql)) {
            echo $stmt->error;
        } else {
            $stmt->bind_param("s", $org);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->free_result();
        return $result;
    }
}