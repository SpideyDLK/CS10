<?php

require_once '../libraries/db.php';

class userModel{
    private $DB;

    public function __construct(){
        $this->DB = new db;
    }

    public function findUser($username){
        $this->DB->sql('SELECT * FROM user WHERE username = :username');
        $this->DB->bind(':username',$username);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $row;
        }
        else{
            return false;
        }
    }

    public function validatePWD($username,$password){
        $row = $this->findUser($username);

        if($row==false){
            return false;
        }

        $hashedPWD = $row->password;
        if(password_verify($password,$hashedPWD)){
            return $row;
        }
        else{
            return false;
        }
    }
}