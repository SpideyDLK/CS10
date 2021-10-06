<?php
class dbconfig{
    public function connect() {
        $servername = "localhost";
        $database = "mvc";
        $username = "root";
        $password = "";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if($conn){
            echo "<br>";
        }
        return $conn;
    }
}
?>