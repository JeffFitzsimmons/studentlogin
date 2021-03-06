<?php
date_default_timezone_set('America/Denver');

// Connect to MySQL
include ("dbLoginlocal.php");
//include ("dbLogin.php");

$show_loginfail_modal = false;

if (isset($_GET['loginfail'])) {
    $show_loginfail_modal = true;
}

// Only process the form if $_POST isn't empty
if (!empty($_POST)) {
    include ("updateDatabase.php");
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

    <!-- Font Awesome core CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">

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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h2 class="text-center">Login</h2><br>
                        <div class="btn-group btn-group-lg btn-group-justified" >
                            <a href="login.php" class="btn btn-primary col-xs-4 col-sm-4" role="button"><i class="fa fa-sign-in"></i> Login</a>
                            <a href="index.php" class="btn btn-primary col-xs-4 col-sm-4" role="button">Home</a>
                            <a href="logout.php" class="btn btn-primary col-xs-4 col-sm-4" role="button"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div><br><br>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">

                <div class="form-group has-feedback">
                    <label class="form-inline">Student Info: </label><br>
                    <input type="number" name="pid" id="pid" class="form-control" data-minlength="6" min="011111" max="999999" placeholder="Scan/Manually Enter PID" inputmode="numeric" pattern="\d*" required autofocus>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" patter="^[A-Za-z.\s_-]+$" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <br>

                <div class="form-group">
                    <label class="form-inline">Reason(s) for visit: </label><br>
                    <select id="reason"name="reason[]" class="selectpicker show-tick" multiple title="Choose one or more..." required>
                        <option value="Individual Tutoring or Studying">Individual Tutoring or Studying</option>
                        <option value="Chemistry Quiz">Chemistry Quiz</option>
                        <option value="Group Study">Group Study</option>
                        <option value="Computer Use">Computer Use</option>
                        <option value="Center Based Activity">PROPEL Activity</option>
                    </select>
                    <br><br>
                </div>
                <div class="form-group">
                    <label class="form-inline">Are you here for lecture, lab, both, or neither?</label><br>
                    <select id="lectureLab" name="lectureLab[]" class="selectpicker show-tick" multiple title="Choose one or both..." data-max-options="2" required>
                        <option value="Lecture">Lecture</option>
                        <option value="Lab">Lab</option>
                        <option data-divider="true"></option>
                        <option value="N/A" data-subtext="Not here for a class">Not Applicable</option>
                    </select>
                    <br><br>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-6">
                <label class="form-inline">What Class(es) are you here for today?</label>
                <div class="panel with-nav-tabs panel-primary">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Biology" data-toggle="tab"><i class="fa fa-leaf"></i> Biology</a></li>
                            <li><a href="#Chemistry" data-toggle="tab"><i class="fa fa-flask"></i> Chemistry</a></li>
                            <li><a href="#Engineering" data-toggle="tab"><i class="fa fa-cogs"></i> Engineering</a></li>
                            <li><a href="#Physics" data-toggle="tab"><i class="fa fa-cubes"></i> Physics</a></li>
                            <li><a href="#Other" data-toggle="tab"><i class="fa fa-book" aria-hidden="true"></i> Other</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="Biology">
                                <ul class="list-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 100" value="BIO 100"><label for="BIO 100">BIO 100</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 181" value="BIO 181"><label for="BIO 181">BIO 181</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 183" value="BIO 183"><label for="BIO 183">BIO 183</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 223" value="BIO 223"><label for="BIO 223">BIO 223</label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 224" value="BIO 224"><label for="BIO 224">BIO 224</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 301" value="BIO 301"><label for="BIO 301">BIO 301</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="BIO 350" value="BIO 350"><label for="BIO 350">BIO 350</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Advanced BIO" value="Advanced BIO"><label for="Advanced BIO">Advanced BIO Class</label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="Chemistry">
                                <ul class="list-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CHEM 111" value="CHEM 111"><label for="CHEM 111">CHEM 111</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CHEM 121" value="CHEM 121"><label for="CHEM 121">CHEM 121</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CHEM 122" value="CHEM 122"><label for="CHEM 122">CHEM 122</label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CHEM 301" value="CHEM 301"><label for="CHEM 301">CHEM 301</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CHEM 302" value="CHEM 302"><label for="CHEM 302">CHEM 302</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Advanced CHEM" value="Advanced CHEM"><label for="Advanced CHEM">Advanced CHEM Class</label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="Engineering">
                                <ul class="list-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="EN 101" value="EN 101"><label for="EN 101">EN 101</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="EN 103" value="EN 103"><label for="EN 103">EN 103</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="EN 107" value="EN 107"><label for="EN 107">EN 107</label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="CET Class" value="CET Class"><label for="CET Class">CET Class</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Advanced EN" value="Advanced EN Class"><label for="Advanced EN">Advanced EN Class</label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="Physics">
                                <ul class="list-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="PHYS 201" value="PHYS 201"><label for="PHYS 201">PHYS 201</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="PHYS 202" value="PHYS 202"><label for="PHYS 202">PHYS 202</label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="PHYS 221" value="PHYS 221"><label for="PHYS 221">PHYS 221</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="PHYS 222" value="PHYS 222"><label for="PHYS 222">PHYS 222</label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="Other">
                                <ul class="list-group">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Accuplacer Support" value="Accuplacer Support"><label for="Accuplacer Support">Accuplacer Support</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Math Class" value="Math Class"><label for="Math Class">Math Class</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="GRE Prep" value="GRE Prep"><label for="GRE Prep">GRE Prep</label>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="Earth Science" value="Earth Science"><label for="Earth Science">Earth Science</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-info checkbox-circle">
                                                <input type="checkbox" id="OtherNA" value="Other"><label for="OtherNA">Other/Not Applicable</label>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div><!-- /.panel-body -->
                    <div class="form-group form-signin">
                        <button class="btn btn-default" onclick="resetCheckBox()"><i class="fa fa-refresh"></i> Reset Classes</button><br><br>
                        <input type="text" name="classes" id="classes" class="form-control" readonly required><br>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <button class="btn btn-lg btn-primary center-block resize-btn" type="submit" name="submitLogin"><i class="fa fa-sign-in"></i> Login</button>
                <br>
            </div>

            <img src="img/main-logo.jpg" class="center-block logoimg"></img>
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
    include ("modals.php");
    include ("footer.php");
    ?>

    <?php if($show_loginfail_modal):?>
        <script> $('#loginFailModal').modal('show');</script>
    <?php endif;?>

</body>

</html>
