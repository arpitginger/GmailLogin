<?php
 require_once "controllerUserData.php"; ?>
 <?php
// if($_SESSION['info'] == false){
//     header('Location: login.php');  
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>
    </script>
</head>

<body>

    <div class="main-container">
        <div class="form-container">

            <div class="srouce"><a title="Login Page" href="index.php">Cars & More</a></div>

            <div class="form-body">
                <h2 class="title">Log in with</h2>
                <div class="social-login">
                    <ul>
                        <li class="google"><a href="#">Google</a></li>
                        <li class="fb"><a href="#">Facebook</a></li>
                    </ul>
                </div>

                <div class="_or">or</div>

                <form class="the-form" name="form" id="form" method="post" action="/mysite/controllerUserData.php">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <label for="keepLogin" style="width: 50%;">Keep me login:</label>
                    <input type="checkbox" value="1" name="remember" style="width: 50%;" required>
                    <input type="submit" name="login" value="Login" id="button" onclick="loginvalid()">
                    <center><a href="forgot.php">Forgot Password? Click Here</a></center>
                </form>
            </div>
        </div>

        <div class="form-footer">
            <div>
                <span>Don't have an account?</span>
                <a href="signup.php">Sign Up</a>
            </div>
        </div>
    </div>
</body>

</html>