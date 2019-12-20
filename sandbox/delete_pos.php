<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Position
require("classes/Position.php");

?>
    <!DOCTYPE HTML>
    <html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrator Login</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style_admin.css">
    </head>
    <body>

    <!-- Header -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Voting Sytem</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="add_org.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Organization</a></li>
                    <li class="active"><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Position</a></li>
                    <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Nominees</a></li>
                    <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Voters</a></li>
                    <li><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Vote Result</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="process/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>
    <!-- End Header -->



    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php
                if(isset($_GET['id'])) {
                    $pos_id = trim($_GET['id']);

                    echo "<div class='alert alert-danger'>Are you sure you want to delete selected position? <a href='http://localhost/VotingSystem/sandbox/delete_pos.php?del_id=$pos_id'>Yes</a> | <a href='http://localhost/VotingSystem/sandbox/add_pos.php'>No</a></div>";
                }


                if(isset($_GET['del_id'])) {
                    $id_to_del = $_GET['del_id'];

                    $delPos = new Position();
                    $rtnDelPos = $delPos->DELETE_POS($id_to_del);
                }
                ?>
            </div>
        </div>
    </div>






    <!-- Footer -->
    <nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

        <div class="container">
            <div class="navbar-text pull-left">
                Copyright 2017
            </div>
        </div>

    </nav>
    <!-- End Footer -->

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    </body>
    </html>


<?php
//Close database connection
$db->close();