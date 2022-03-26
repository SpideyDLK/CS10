<?php
  
require_once '../libraries/db.php';

class frgtPwdModel{
    private $DB;

    public function __construct(){
        $this->DB = new db;
    }

    public function findEmailfromusers($email){
        $this->DB->sql('SELECT * FROM users WHERE email = :email');
        $this->DB->bind(':email',$email);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function findtoken($email,$token){
        $this->DB->sql("SELECT * FROM users WHERE email LIKE :email AND verify_token LIKE :token");
        $this->DB->bind(':email',$email);
        $this->DB->bind(':token',$token);
        

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function updatetoken($email,$token){
         $this->DB->sql("UPDATE users SET verify_token =:token WHERE email =:email LIMIT 1");
         $this->DB->bind(':email',$email);
         $this->DB->bind(':token',$token);
         
         
         if($this->DB->execute()){
             return true;
         }else{
             return false;
         }
      }
    
    public function change_password($data){
         
        $this->DB->sql("UPDATE users SET password = :pwd WHERE email = :email");
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':pwd',$data['pwd']);
        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }

     }

     public function current_password($data){
         
        $this->DB->sql("UPDATE users SET password = :pwd WHERE email = :email");
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':pwd',$data['pwd']);
        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }

     }

}