<?php
require ('dbLogin.php');
$query = "SELECT Last_Name FROM students WHERE PID = '" .$mysqli->real_escape_string($_POST['pid']). "' LIMIT 1";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        echo $row["Last_Name"];
    }

}
?>
