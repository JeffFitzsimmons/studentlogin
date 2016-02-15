<?php
date_default_timezone_set('America/Denver');

$show_modal = false;
if (isset($_GET['loginfail'])) {
    $show_modal = true;
}

// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Get values from multiselect dropdowns
    if(isset($_POST['reason']))
    $reason = implode(',',$_POST['reason']);

    if(isset($_POST['classes']))
    $classes = implode(',',$_POST['classes']);

    if(isset($_POST['lectureLab']))
    $lectureLab = implode(',',$_POST['lectureLab']);

    // Connect to MySQL
    include ("dbLogin.php");

    $result = $mysqli->query("SELECT PID FROM Login WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No'");
    $check = mysqli_num_rows($result);

    if ($check == 0) {
        // Insert data
        $sql = "INSERT INTO Login ( PID, Last_Name, Login_Time, Reason, Classes, Lecture_Lab, Is_Logged_Out ) VALUES ( '{$mysqli->real_escape_string($_POST['pid'])}', '{$mysqli->real_escape_string($_POST['lastName'])}', '$date', '$reason', '$classes', '$lectureLab', 'No' ) ";
        $insert = $mysqli->query($sql);
    }
    else {
        header("Location: login.php?loginfail=true");
        exit();
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
    <link href="css/custom.css" rel="stylesheet">

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
                <a href="login.php" class="btn btn-primary col-md-6" role="button"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                <a href="logout.php" class="btn btn-primary col-md-6" role="button"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </div>
            <br><br>

            <h2 class="form-signin-heading text-center">Login</h2>
            <label for="username" class="sr-only">Scan or Enter PID</label>
            <input type="number" name="pid" id="pid" class="form-control" min="000000" max="999999" placeholder="Scan/Manually Enter PID" required autofocus>
            <label for="lastName" class="sr-only">Last Name</label>
            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" required>
            <br>
            <label class="form-inline">Reason for visit: </label>
            <select id="reason"name="reason[]" class="selectpicker show-tick" multiple required="required">
                <option value="Tutoring">Tutoring</option>
                <option value="Computer Use">Computer Use</option>
                <option value="Study">Study</option>
                <option value="Quiz">Quiz</option>
                <option value="Lab">Lab</option>
                <option value="Accuplacer Support">Accuplacer Support</option>
                <option value="Center Based Activity">Center Based Activity</option>
                <option value="Need Somewhere to Go">Need Somewhere to Go</option>
            </select>
            <br><br>

            <label class="form-inline">What Class(es) are you here for today?</label>
            <select id="classes" name="classes[]" class="selectpicker show-tick" multiple required>
                <option value="Biology">Biology</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Civil Engineering Tech">Civil Engineering Tech.</option>
                <option value="Engineering">Engineering</option>
                <option value="Earth Science">Earth Science</option>
                <option value="Math">Math</option>
                <option value="Physics">Physics</option>
                <option value="N/A">No Class in Particular</option>
            </select>
            <br><br>

            <label class="form-inline">Are you here for lecture, lab, or both?</label>
            <select id="lectureLab" name="lectureLab[]" class="selectpicker show-tick" multiple required>
                <option value="Lecture">Lecture</option>
                <option value="Lab">Lab</option>
            </select>
            <br><br>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <br><br>

            <a href="./index.html"><img src="img/main-logo.jpg" class="center-img"></img></a>
        </form>

        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>You have not logged out. Please logout before logging in again.</p>
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

    <?php if($show_modal):?>
        <script> $('#myModal').modal('show');</script>
    <?php endif;?>

</body>

</html>

<?php

?>
