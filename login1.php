<?php 
session_start(); 
include "index.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['email']);
	$pass1 = validate($_POST['password']);

	$pass = md5($_POST['password']);
	
	if (empty($uname)) {
		header("Location: login.php?error=Email is required");
	    exit();
	}else if(empty($pass1)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM register WHERE email='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $uname && $row['password'] === $pass) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['id'] = $row['id'];
				setcookie("login","1",time()+3600);
            	header("Location: Project2.php");
		        exit();
            }else{
				setcookie("login","1");
				header("Location: loginphp?error=Incorect Email or password");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect Email or password");
	        exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}
?>