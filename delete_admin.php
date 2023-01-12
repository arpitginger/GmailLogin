<?php
include("connection.php");
$con = new connection();

$id = $_GET['id'];

$query = "DELETE FROM usertable WHERE id='$id'";
$data = mysqli_query($con->connect(), $query);

if($data){
    
    echo "<script>alert('Record Deleted')</script>";
    
    header("Location: admin.php"); 

}
else{
    echo "error";
}

?>