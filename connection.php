<?php 
// $con = mysqli_connect("localhost", "root", "", "userform");

class connection
{
    public $localhost;
    public $username;
    public $password;
    public $database;
public function connect()
    {
        $this->localhost = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "userform";
        $conn = mysqli_connect($this->localhost, $this->username, $this->password, $this->database);
        if ($conn) {
            return $conn;
        } else {
            echo "Connection Failed";
        }
       
    }
}
?>