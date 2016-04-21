<?php

// Get current date and time
$date = date('Y-m-d H:i:s');
$modifedDate = date('Y-m-d H:i:s', strtotime('-12 hours'));

// Get values from multiselect dropdowns
if(isset($_POST['reason']))
$reason = implode(',',$_POST['reason']);

if(isset($_POST['lectureLab']))
$lecture_lab = implode(',',$_POST['lectureLab']);

$pid = mysqli_real_escape_string($mysqli, $_POST['pid']);
$lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
$classes = mysqli_real_escape_string($mysqli, $_POST['classes']);

// Check if student is logged in already
$result = mysqli_query($mysqli, "SELECT Login_Time FROM login WHERE PID = '$pid' AND Is_Logged_Out = 'No'");

//Check if student did not log out more than 12 hours ago
$result_date = mysqli_query($mysqli, "SELECT Login_Time FROM login WHERE PID = '$pid' AND Is_Logged_Out = 'No' AND Login_Time >= '$modifedDate'");


if (mysqli_num_rows($result) === 0 || mysqli_num_rows($result_date) === 0) {
    if (mysqli_num_rows($result_date) === 0) {
        $update_logout = mysqli_query($mysqli, "UPDATE login SET Is_Logged_Out = 'Did not logout' WHERE PID = '$pid' AND Is_Logged_Out = 'No'");
    }

    // Insert data and update login count for reward system if student is not Non CSUP Student (PID = 111111)
    if ($pid != "111111") {
        $update = mysqli_query($mysqli, "UPDATE students SET Login_Count = Login_Count + 1 WHERE PID = '$pid' AND Last_Name = '$lastName'");
        $insert = mysqli_query($mysqli, "INSERT INTO login (PID, Last_Name, Login_Time, Reason, Classes, Lecture_Lab, Is_Logged_Out)
        VALUES ('$pid', '$lastName', '$date', '$reason', '$classes', '$lecture_lab', 'No')");
    }
    else {
        $insert = mysqli_query($mysqli, "INSERT INTO login (PID, Last_Name, Login_Time, Reason, Classes, Lecture_Lab, Is_Logged_Out)
        VALUES ('$pid', '$lastName', '$date', '$reason', '$classes', '$lecture_lab', 'Done')");
    }

    // Set Last Name for entries not currently in the students table
    $check_student_last = mysqli_query($mysqli, "SELECT Last_Name FROM students WHERE PID = '$pid'");
    if (mysqli_num_rows($check_student_last) === 0) {
        $insert_last = mysqli_query($mysqli, "INSERT INTO students (PID, Last_Name) VALUES ('$pid', '$lastName' )");
    }

}
else {
    header("Location: login.php?loginfail=true");
    exit();
}


// Close connection
mysqli_close($mysqli);
header("Location: ./index.php");
?>
