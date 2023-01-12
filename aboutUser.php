<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$conn = mysqli_connect("localhost", "root", "", "userform");

$firstname = $_POST['firstname '];
$lastname =  $_POST['lastname'];
$country =  $_POST['country'];
$subject =  $_POST['subject'];

if (isset($_POST['subject'])) {
    if ($firstname != 0 and $lastname != 0 and $country != 0 and $subject != 0) {
        $insert_data = "INSERT INTO `aboutUser` (`firstname`, `lastname`, `country`, `subject`) values ('$firstname','$lastname','$country','$subject')";
        $data_check = mysqli_query($conn, $insert_data);
        echo '<script>alert("Details Submitted")</script>';
    } else {
        echo '<script>alert("Fill all Details")</script>';
        header('location: index.php');
    }
}
