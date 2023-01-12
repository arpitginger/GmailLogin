<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    </script>
</head>

<body>
    <div class="main-container">
        <div class="form-container">
            <div class="srouce"><a title="Login Page" href="index.php">Cars & More</a></div>
            <div class="form-body">
                <h2 class="title">Admin Login</h2>
                <form  class="the-form" name="form" id="form" method="post" action="admin.php">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email" >
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" >
                    <!-- <label for="password">Verification Code</label>
                    <input type="text" name="code" id="code" placeholder="Enter code here" > -->
                    <input type="submit" name="validate" value="Login" id="button" onclick="loginvalid()">
            </div>
        </div>
    </div>
  
</body>

</html>