<?php
date_default_timezone_set('America/Denver');

// Connect to MySQL
include ("dbLoginlocal.php");
//include ("dbLogin.php");


$show_loginfail_modal = false;
if (isset($_GET['logoutfail'])) {
    $show_loginfail_modal = true;
}

// Only process the form if $_POST isn't empty
if (!empty($_POST)) {

    // Get current date and time
    $date = date('Y-m-d H:i:s');

    // Get values from multiselect dropdowns and radio buttons
    if(isset($_POST['tutors']))
    $tutors = implode(',',$_POST['tutors']);

    $satisfied = $_POST['satisfied'];


    // Check if the student is not already logged out
    $result = $mysqli->query("SELECT PID FROM login WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No'");

    if ($result) {
        if ($result->num_rows != 0) {
            // Update data if logged in
            $sql_update = "UPDATE login SET Satisfied = '$satisfied', Tutors = '$tutors', Comments = '{$mysqli->real_escape_string($_POST['comments'])}', Logout_Time = '$date', Is_Logged_Out = 'Done'
            WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}'
            AND Is_Logged_Out = 'No'";
            $update = $mysqli->query($sql_update);
        }
        else {
            header("Location: logout.php?logoutfail=true");
            exit();
        }
    }

    // Close connection
    $mysqli->close();
    header("Location: ./index.php");
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

    <title>Logout</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">

    <!-- Font Awesome core CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

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

        <form class="form-signin" data-toggle="validator" method="post" action="">

            <div class="btn-group btn-group-lg btn-block">
                <a href="login.php" class="btn btn-primary col-sm-6" role="button"><i class="fa fa-sign-in"></i> Login</a>
                <a href="logout.php" class="btn btn-primary col-sm-6" role="button"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
            <br><br>

            <h2 class="form-signin-heading text-center">Logout</h2>

            <div class="form-group has-feedback">
                <input type="number" name="pid" id="pid" class="form-control" data-minlength="6" min="111111" max="999999" placeholder="Scan/Manually Enter PID" inputmode="numeric" pattern="\d*" required autofocus>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" patter="^[A-Za-z.\s_-]+$" required>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
            <br>

            <label class="form-inline">Where you satisfied with the outcome of your visit? </label>
            <div class="btn-group btn-block btn-group-lg" data-toggle="buttons">
                <label class="btn btn-primary active col-sm-6">
                    <input type="radio" name="satisfied" value="Yes" id="Yes" autocomplete="off" checked><span class="glyphicon glyphicon-thumbs-up"></span> Yes
                </label>
                <label class="btn btn-primary col-sm-6">
                    <input type="radio" name="satisfied" value="No" id="No" autocomplete="off"><span class="glyphicon glyphicon-thumbs-down"></span> No
                </label>
            </div>
            <br><br>

            <label class="form-inline">What tutor(s) did you work with today? </label><br>
            <select id="tutors" name="tutors[]" class="selectpicker show-tick" multiple title="Choose one or more..." data-width="auto" required>
                <option value="Alexis Mayber">Alexis Mayber</option>
                <option value="Alyssa Torres">Alyssa Torres</option>
                <option value="Andrew Pacheco">Andrew Pacheco</option>
                <option value="Angela Hensley">Angela Hensley</option>
                <option value="Chris Barnett">Chris Barnett</option>
                <option value="Daniel Conroy">Daniel Conroy</option>
                <option value="David Clair">David Clair</option>
                <option value="Dongliang Lu">Dongliang Lu</option>
                <option value="Govind Joshi">Govind Joshi</option>
                <option value="Jillian Manikoff">Jillian Manikoff</option>
                <option value="Julee Burns">Julee Burns</option>
                <option value="Kelsey Wager">Kelsey Wager</option>
                <option value="Mariana Hosomi">Mariana Hosomi</option>
                <option value="Nick Goodall">Nick Goodall</option>
                <option value="Philip Hopkins">Philip Hopkins</option>
                <option value="N/A">Did not work with a tutor</option>
            </select>
            <br><br>

            <label class="form-inline">Comments? </label><br>
            <textarea id="comments" name="comments" class="form-control" rows="5" placeholder="Add a comment here..."></textarea>
            <br><br>

            <button class="btn btn-lg btn-primary center-block resize-btn" type="submit"><i class="fa fa-sign-out"></i> Logout</button>
            <br><br>

            <a href="./index.php"><img src="img/main-logo.jpg" class="center-block"></img></a>
        </form>

    </div> <!-- /container -->

    <!-- Javascript for Bootstrap components-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>

    <!-- Bootstrap validator for browsers without HTML5 validation support -->
    <script src="js/validator.js"></script>

    <!-- Custom Javascript-->
    <script src="js/custom.js"></script>

    <?php
    include ("footer.php");
    include ("modals.php");
    ?>

    <?php if($show_loginfail_modal):?>
        <script> $('#logoutFailModal').modal('show');</script>
    <?php endif;?>


</body>

</html>
