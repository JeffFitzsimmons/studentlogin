<?php
date_default_timezone_set('America/Denver');

// Connect to MySQL
include ("dbLoginlocal.php");
//include ("dbLogin.php");


$check_logged_in = false;
$show_login_modal = false;

if (isset($_GET['loginfail'])) {
    $check_logged_in = true;
}

// Only process the form if $_POST isn't empty
if (!empty($_POST)) {

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Get values from multiselect dropdowns
    if(isset($_POST['reason']))
    $reason = implode(',',$_POST['reason']);

    if(isset($_POST['lectureLab']))
    $lectureLab = implode(',',$_POST['lectureLab']);


    // Check if student is logged in already
    $result = $mysqli->query("SELECT PID FROM Login WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No'");
    $check = mysqli_num_rows($result);

    if ($check == 0) {
        // Insert data
        $sql = "INSERT INTO Login ( PID, Last_Name, Login_Time, Reason, Classes, Lecture_Lab, Is_Logged_Out )
        VALUES ( '{$mysqli->real_escape_string($_POST['pid'])}', '{$mysqli->real_escape_string($_POST['lastName'])}', '$date', '$reason', '{$mysqli->real_escape_string($_POST['classes'])}', '$lectureLab', 'No' ) ";
        $insert = $mysqli->query($sql);

        // Update login count for reward system
        $sql_update = "UPDATE students SET Login_Count = Login_Count + 1
        WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}'
        AND Last_Name = '{$mysqli->real_escape_string($_POST['lastName'])}' ";
        $update = $mysqli->query($sql_update);

    }
    else {
        header("Location: login.php?loginfail=true");
        exit();
    }

    // Get the login count from the students table for modal display que
    $get_login_count = $mysqli->query("SELECT Login_Count FROM students WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}'");

    if ($get_login_count = '20') {
        $show_login_modal = true;
    }

    // Close connection
    $mysqli->close();
    header("Location: ./index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">

    <!-- Custom styles -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">

        <form class="form-signin" method="post" action="">

            <div class="btn-group btn-group-lg btn-block">
                <a href="login.php" class="btn btn-primary col-sm-6" role="button"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                <a href="logout.php" class="btn btn-primary col-sm-6" role="button"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </div>
            <br><br>

            <h2 class="form-signin-heading text-center">Login</h2>
            <label for="username" class="sr-only">Scan or Enter PID</label>
            <input type="number" name="pid" id="pid" class="form-control" min="1" max="999999" placeholder="Scan/Manually Enter PID" required autofocus>
            <label for="lastName" class="sr-only">Last Name</label>
            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
            <br>

            <label class="form-inline">Reason(s) for visit: </label><br>
            <select id="reason"name="reason[]" class="selectpicker show-tick" multiple title="Choose one or more..." required>
                <option value="Individual Tutoring or Studying">Individual Tutoring or Studying</option>
                <option value="Chemistry Quiz">Chemistry Quiz</option>
                <option value="Group Study">Group Study</option>
                <option value="Computer Use">Computer Use</option>
                <option value="Center Based Activity">PROPEL Activity</option>
            </select>
            <br><br>


            <label class="form-inline">What Class(es) are you here for today?</label><br>
            <input type="text" name="classes" id="classes" class="form-control" readonly><br>


            <div class="row">
                <div class="col-sm-12">
                    <div class="panel with-nav-tabs panel-primary">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Biology" data-toggle="tab">Biology</a></li>
                                <li><a href="#Chemistry" data-toggle="tab">Chemistry</a></li>
                                <li><a href="#Engineering" data-toggle="tab">Engineering</a></li>
                                <li><a href="#Physics" data-toggle="tab">Physics</a></li>
                                <li><a href="#Other" data-toggle="tab">Other</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="Biology">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            BIO 100
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 100" value="BIO 100"><label for="BIO 100" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 181
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 181" value="BIO 181"><label for="BIO 181" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 183
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 183" value="BIO 183"><label for="BIO 183" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 223
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 223" value="BIO 223"><label for="BIO 223" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 224
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 224" value="BIO 224"><label for="BIO 224" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 301
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 301" value="BIO 301"><label for="BIO 301" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            BIO 350
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="BIO 350" value="BIO 350"><label for="BIO 350" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            Advanced BIO Class
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Advanced BIO" value="Advanced BIO"><label for="Advanced BIO Class" class="label-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="Chemistry">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            CHEM 111
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CHEM 111" value="CHEM 111"><label for="CHEM 111" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            CHEM 121
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CHEM 121" value="CHEM 121"><label for="CHEM 121" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            CHEM 122
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CHEM 122" value="CHEM 122"><label for="CHEM 122" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            CHEM 301
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CHEM 301" value="CHEM 301"><label for="CHEM 301" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            CHEM 302
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CHEM 302" value="CHEM 302"><label for="CHEM 302" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            Advanced CHEM Class
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Advanced CHEM" value="Advanced CHEM"><label for="Advanced CHEM Class" class="label-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="Engineering">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            EN 101
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="EN 101" value="EN 101"><label for="EN 101" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            EN 103
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="EN 103" value="EN 103"><label for="EN 103" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            EN 107
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="EN 107" value="EN 107"><label for="EN 107" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            CET Class
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="CET Class" value="CET Class"><label for="CET Class" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            Advanced EN Class
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Advanced EN" value="Advanced EN Class"><label for="Advanced EN" class="label-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="Physics">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            PHYS 201
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="PHYS 201" value="PHYS 201"><label for="PHYS 201" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            PHYS 202
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="PHYS 202" value="PHYS 202"><label for="PHYS 202" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            PHYS 221
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="PHYS 221" value="PHYS 221"><label for="PHYS 221" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            PHYS 222
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="PHYS 222" value="PHYS 222"><label for="PHYS 222" class="label-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="Other">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Accuplacer Support
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Accuplacer Support" value="Accuplacer Support"><label for="Accuplacer Support" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            Math Class
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Math Class" value="Math Class"><label for="Math Class" class="label-primary"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            Earth Science
                                            <div class="material-switch pull-right">
                                                <input type="checkbox" id="Earth Science" value="Earth Science"><label for="Earth Science" class="label-primary"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.panel-body -->
                    </div>
                </div>
            </div><!-- /.div-row -->


            <label class="form-inline">Are you here for lecture, lab, or both?</label><br>
            <select id="lectureLab" name="lectureLab[]" class="selectpicker show-tick" multiple title="Choose one or both..." required>
                <option value="Lecture">Lecture</option>
                <option value="Lab">Lab</option>
            </select>
            <br><br>

            <button class="btn btn-lg btn-primary center-block resize-btn" type="submit"><span class="glyphicon glyphicon-log-in"></span> Login</button>
            <br><br>

            <a href="./index.html"><img src="img/main-logo.jpg" class="center-block"></img></a>
        </form>

        <div id="alertModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>You have not logged out. Please logout before logging in again.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="loginCountModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Thanks for logging in! Please go to the front desk to claim your prize.</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div> <!-- /container -->

    <!-- Javascript -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/custom.js"></script>

    <?php if($check_logged_in):?>
        <script> $('#alertModal').modal('show');</script>
    <?php endif;?>

    <?php if($show_login_modal):?>
        <script>$('#loginCountModal').modal('show');</script>
    <?php endif;?>

    <?php
    include ("footer.php");
    ?>

</body>

</html>
