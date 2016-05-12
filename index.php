<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">

    <title>PROPEL Center</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome core CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

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
        <div class="form-signin row text-center">
            <h1 class="text-center">Welcome to the PROPEL Center</h1>
            <br>
            <div class="form-group btn-group btn-group-lg btn-group-justified main-page-btn">
                <a href="login.php" class="btn btn-primary col-xs-6 col-sm-6" role="button"><i class="fa fa-sign-in"></i> Login</a>
                <a href="logout.php" class="btn btn-primary col-xs-6 col-sm-6" role="button"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
            <br><br>
        </div>
        <img src="img/main-logo.jpg" class="center-block"></img>
    </div> <!-- /container -->

    <!-- Javascript -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>

    <?php
    include ("footer.php");
    ?>

</body>

</html>
