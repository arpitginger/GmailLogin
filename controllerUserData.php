<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class VerificationCode
{
    public $smtpHost;
    public $smtpPort;
    public $sender;
    public $password;
    public $receiver;
    public $code;
    public $link;

    public function __construct($receiver)
    {
        $this->sender = "arpit.mittal@gingerwebs.com";
        $this->password = "arpit@123";
        $this->receiver = $receiver;
        $this->smtpHost = "smtp.gmail.com";
        $this->smtpPort = 587;
    }
    public function sendMail($code, $link)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Host = $this->smtpHost;
        $mail->Port = $this->smtpPort;
        $mail->IsHTML(true);
        $mail->Username = $this->sender;
        $mail->Password = $this->password;
        $mail->Body = $this->getHTMLMessage($code);
        $mail->Subject = "Your verification code is {$code}";
        $mail->SetFrom($this->sender, "Verification Codes");
        $mail->AddAddress($this->receiver);
        if ($mail->send()) {
            echo "MAIL SENT SUCCESSFULLY";
            // return true;
            $link;
            exit;
        }
        echo "FAILED TO SEND MAIL";
        // return false;
    }

    public function getHTMLMessage($code)
    {
        $this->code = $code;
        $htmlMessage = <<<MSG
        <!DOCTYPE html>
        <html>
         <body>
            <h1>Your verification code is {$this->code}</h1>
            <p>Use this code to verify your account.</p>
         </body>
        </html>        
        MSG;
        return $htmlMessage;
    }
}

require "connection.php";
$email = "";
$name = "";
$errors = array();
$con = new connection();

//if user signup button
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con->connect(), $_POST['username']);
    $email = mysqli_real_escape_string($con->connect(), $_POST['email']);
    $phone = mysqli_real_escape_string($con->connect(), $_POST['phone']);
    $password = mysqli_real_escape_string($con->connect(), $_POST['password']);
    $cpassword = mysqli_real_escape_string($con->connect(), $_POST['confirm']);
    if ($password !== $cpassword) {
        $errors['password'] = '<script>alert("Confirm password not matched!")</script>';
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con->connect(), $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = '<script>alert("Email that you have entered is already exist!")</script>';
    }
    if (count($errors) === 0) {
        $encpass = md5($password);
        $encpass1 = md5($cpassword);
        $code = random_int(11111, 99999);
        $vc = new VerificationCode($email, $code);
        $status = "notverified";
        $insert_data = "INSERT INTO `usertable` (`username`, `email`, `phone`, `password`, `confirm-password`, `code`, `status`)
                        values('$name', '$email','$phone', '$encpass','$encpass1', '$code', '$status')";
        $data_check = mysqli_query($con->connect(), $insert_data);
        if ($data_check) {
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            echo '<script>alert("Registered successfully")</script>';
            $link = header('location: user-otp.php');
            $vc->sendMail($code, $link);
            exit();
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}


//if user click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con->connect(), $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con->connect(), $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con->connect(), $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            echo '<script>alert("Account Verified successfully")</script>';
            header('location: Project2.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// //if user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con->connect(), $_POST['email']);
    $password = mysqli_real_escape_string($con->connect(), $_POST['password']);
    $pass1 = md5($password);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con->connect(), $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if ($pass1 ==  $fetch_pass) {
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                setcookie("login", "1", time() + 900);
                header('location: Project2.php');
            } else {
                setcookie("login", "1");
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        } else {
            // $errors['email'] = "Incorrect email or password!";
            header('location: login.php');
            echo '<script>alert("Incorrect email or password!")</script>';
        }
    } else {
        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
    }
}

// //if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con->connect(), $_POST['user_email']);
    $check_email = "SELECT * FROM usertable WHERE email='$email'";
    $run_sql = mysqli_query($con->connect(), $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = random_int(11111, 99999);
        $vc = new VerificationCode($email, $code);
        $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con->connect(), $insert_code);
        if ($run_query) {
            $info = "We've sent a passwrod reset otp to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
            $link = header('location: reset-code.php');
            $vc->sendMail($code, $link);
            exit();
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// //if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con->connect(), $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con->connect(), $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// //if user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con->connect(), $_POST['password']);
    $cpassword = mysqli_real_escape_string($con->connect(), $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = md5($password);
        $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con->connect(), $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

//if login now button click
if (isset($_POST['validate'])) {
    header('Location: Project2.php');
}
