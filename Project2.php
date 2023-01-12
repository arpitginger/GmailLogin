<?php 
if(!isset($_COOKIE["login"]))// $_COOKIE is a variable and login is a cookie name 
	header("location:login.php"); 
?>
<?php 
session_start();

// if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
//     header("Location: Project2.php");
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Home-Cars & More</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Project1.css">
    <link rel="icon" type="image/x-icon" href="logo2.png">
    <script src="project.js"></script>
</head>

<body>
    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                Cars & More
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <a href="">Home</a> 
            <a href="">Services</a>
            <a href="">Latest</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="header">
        <input type = "button1" value = "Push Right" onclick = "moveRight();" />
        <img id="image" src="logo2.png" >
        <input type = "button2" value = "Push Left" onclick = "stop();" />
        <marquee behavior="alternate" scrollamount="3">
            <marquee behavior="alternate" direction="down" scrollamount="5">
                <a onclick="this.style.visibility = 'hidden'">
                    <h1>Cars & More</h1>
                </a>
            </marquee>
        </marquee>

    </div>

    <div class="more" style="font-size:30px;margin-top: 10px;">
        <h2>Latest Models</h2>
    </div>

    <div class="row">
        <div class="column">
            <img id="img" src="car3.jpeg">
            <h2>Volkswagen</h2>
            <img id="img" src="car11.jpeg">
            <h2>Lamborgini</h2>
        </div>
        <div class="column">
            <img id="img" src="car8.jpg">
            <h2>Buggati Chiron</h2>
            <img id="img" src="car7.jpeg">
            <h2>Discovery</h2>

        </div>
        <div class="column">
            <img id="img" src="car1.jpeg">
            <h2>Scorpio</h2>
            <img id="img" src="car10.jpg">
            <h2>Mini Cooper</h2>
        </div>
    </div>
    <div class="more">
        <h2 onclick="">Click to view more.........</h2>
    </div>

    <div class="container">
        <h1><u>About You</u></h1>
        <form method="$_POST"  action="index.php">
            <div class="row">
                <div class="col-25">
                    <label for="fname">First Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lname">Last Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="lname" name="lastname" placeholder="Your last name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="country">Country</label>
                </div>
                <div class="col-75">
                    <select id="country" name="country">
                        <option value="australia">India</option>
                        <option value="canada">Canada</option>
                        <option value="usa">USA</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Subject</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="subject" placeholder="Write something.."
                        style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <div class="footer">
        <h1>Thank You For Visiting Us.</h1>
    </div>
    <div class="footer-basic">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Cars & More © 2022</p>
    </div>
</body>

</html>
<?php 
// }
// else{
//      header("Location: login.php");
//      exit();
// }
 ?>