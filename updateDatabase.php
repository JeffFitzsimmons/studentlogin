<?php

// Get current date and time
$date = date('Y-m-d H:i:s');
$modifedDate = date('Y-m-d H:i:s', strtotime('-23 hours'));


// Get values from multiselect dropdowns
if(isset($_POST['reason']))
$reason = implode(',',$_POST['reason']);

if(isset($_POST['lectureLab']))
$lecture_lab = implode(',',$_POST['lectureLab']);


// Check if student is logged in already
$result = $mysqli->query("SELECT Login_Time FROM Login WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No'");
$check = mysqli_num_rows($result);

//Check if student did not log out more than a day ago
$result_date = $mysqli->query("SELECT Login_Time FROM Login WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No' AND Login_Time >= '$modifedDate'");
$check_date = mysqli_num_rows($result_date);


if ($check == 0 || $check_date == 0) {

    if ($check_date == 0) {
        $sql_fix_logout = "UPDATE Login SET Is_Logged_Out = 'Did not logout' WHERE PID = '{$mysqli->real_escape_string($_POST['pid'])}' AND Is_Logged_Out = 'No'";
        $update_logout = $mysqli->query($sql_fix_logout);
    }

    // Insert data
    $sql = "INSERT INTO Login ( PID, Last_Name, Login_Time, Reason, Classes, Lecture_Lab, Is_Logged_Out )
    VALUES ( '{$mysqli->real_escape_string($_POST['pid'])}', '{$mysqli->real_escape_string($_POST['lastName'])}', '$date', '$reason', '{$mysqli->real_escape_string($_POST['classes'])}', '$lecture_lab', 'No' ) ";
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


// Close connection
$mysqli->close();
header("Location: ./index.php");

?>
