<?php
include "connection.php";

$con = new connection();

$id = $_GET['id'];
$query = "SELECT * FROM usertable WHERE id='$id'";

$data = mysqli_query($con->connect(), $query);
$total = mysqli_num_rows($data);
$result = mysqli_fetch_assoc($data);

if ($_POST['update']) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $query = "UPDATE usertable SET username='$username', email='$email', phone='$phone' where id='$id'";
    $data = mysqli_query($con->connect(), $query);

    if ($data) {
        echo "<script>alert('Record Updated')</script>";
        header("Location: admin.php");

        echo "data update";
    } else {
        echo "error";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update data </title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="form-body">
            <h2 class="title">Update Data</h2>

            <form name="form" class="the-form" id="form" method="post">

                <label for="username"> User Name</label>
                <input type="text" name="username" id="username" value="<?php echo $result['username']; ?>" required>
                <!-- <div class="error"></div> -->

                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $result['email']; ?>" required>
                <!-- <div class="error"></div> -->

                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" value="<?php echo $result['phone']; ?>" required>
                <!-- <div class="error"></div> -->


                <input type="submit" id="button" value="Update" name="update">

            </form>
        </div>
        <script>

        </script>

</body>

</html>
