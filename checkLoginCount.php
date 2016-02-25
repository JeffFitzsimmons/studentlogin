<?php
require ('dbLoginlocal.php');
//require ('dbLogin.php');

$checkquery = "SELECT Login_Count FROM students WHERE PID = '" .$mysqli->real_escape_string($_POST['pid']). "'";

if ($checkresult = $mysqli->query($checkquery)) {
    while ($checkrow = $checkresult->fetch_assoc()) {
        echo $checkrow["Login_Count"];
    }
}

?>
