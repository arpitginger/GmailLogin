<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="usertable.css">
    <title>Users </title>
</head>
<body >
    <?php
    include "connection.php";
    $con = new connection();
    $query = "SELECT * FROM usertable";
    $data = mysqli_query($con->connect(), $query);
    $total = mysqli_num_rows($data);
    ?>
    <center>
        <h2>Displaying All Records</h2>
        <table>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col" colspan="2">Edit</th>

                </tr>
            </thead>

            <?php
            while ($result = mysqli_fetch_assoc($data)) {
                echo " <tr>
            <td align='center'>" . $result['id'] . "</td>
            <td align='center'>" . $result['username'] . "</td>
            <td align='center' >" . $result['email'] . "</td>
            <td align='center'>" . $result['phone'] . "</td>
            <td>
            <a href='update_admin.php?id=$result[id] '><input type='submit'value='update'class='update'></a> 
            &nbsp;&nbsp;    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
             <a href='delete_admin.php?id=$result[id]'><input type='submit'value='Delete'class='delete'onclick='return checkdelete()'></a>
             </td>
            
            </tr>
        ";
            }
            ?>
        </table>
        <footer>
            <a  href="index.php"><input type="submit" value="Log Out" class='update'></a>
        </footer>
    </center>
</body>