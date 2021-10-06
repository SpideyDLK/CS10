<?php
include 'dbconfig.php';
class dao extends dbconfig{
    private $conn; 
    public function __construct() { 
       $dbcon = new parent(); 
 
       $this->conn = $dbcon->connect();
    }

    function select(){
        
        $sql="SELECT * FROM students";
        $result=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)); 
        return $result;
    }

    function selectOptional($name){
        
        $sql="SELECT * FROM students where NAME LIKE '$name'";
        $result=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn)); 
        return $result;
    }
    function insert($index,$name,$age,$tel){

        $sql="INSERT INTO students(INDEX_NO,NAME,AGE,MOBILE_NO) VALUES($index,'$name',$age,$tel)";
        if(mysqli_query($this->conn,$sql)){
            echo "*** [successfully inserted] ***";
        }
    }
    function update($index,$name,$age,$tel){

        $sql="UPDATE students SET NAME='$name',AGE=$age,MOBILE_NO=$tel WHERE INDEX_NO=$index";
        if(mysqli_query($this->conn,$sql)){
            echo "*** [successfully updated] ***";
        }
    }

    function delete($name){
        
        $sql="DELETE FROM students WHERE NAME='$name';";
        if(mysqli_query($this->conn,$sql)){
            echo "*** [successfully deleted] ***";
        }
    }
}
?>