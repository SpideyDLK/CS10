<?php

require_once '../models/frgtPwdModel.php';
require_once '../helpers/session_helper.php';




class userController{
    private $frgtPwdM;

    public function __construct(){
        $this->frgtPwdM = new frgtPwdModel;
    }


    public function reset_password(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $token = md5(rand());
        $email=trim($_POST['email']);

        if($this->frgtPwdM->findEmailfromusers($email)){
         if($this->frgtPwdM->updatetoken($email,$token)){
        //   $token =  $this->userM->selecttoken($email);
          $to = $email;
          $subject = 'JoBBooth Password Reset Request';
          $from = 'jobboothcs10@gmail.com';
          $message = "<h2>Hello, $email</h2>
          <h3>You are recieving this email because we received a password reset request for this e-mail. If you didn't request for a reset, please ignore this e-mail.</h3>
          <br><br>
          <a href ='http://localhost:1234/JoBBooth/views/change_password.php?token=$token&email=$email'>Click here to reset the password.</a>";
        
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


          $headers .= 'From:JoBBooth' . "\r\n";

          mail($to,$subject,$message,$headers);
         
popUp( "loginGreen","We emailed you a password reset link.");
            redirect("../views/reset_password.php");
         

        }
    }
    else{
        popUp("loginRed","This email isn't registered!");
        redirect("../views/reset_password.php");
    }
}

public function change_password(){
        
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
   
    $data =[
        'email'=>trim($_POST['email']),
        'pwd' => trim($_POST['Pwd']),
        'confPwd' => trim($_POST['ConfPwd']),
        'token' =>trim($_POST['token'])
    ];

  

    $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);
    if($this->frgtPwdM->findtoken($data['email'],$data['token'])){
    if($this->frgtPwdM->change_password($data)){
        $uptoken=md5(rand());
       if($this->frgtPwdM->updatetoken($data['email'],$uptoken)){

        popUp("loginGreen", "Password changed");
        redirect("../views/home.php");}
    

    }
}
else{
    popUp("loginRed", "Invalid token");
    redirect("../views/home.php");

}}





}

$init = new userController;

if($_SERVER['REQUEST_METHOD']=='POST'){
    switch($_POST['type']){
        case 'passwordreset':
            $init->reset_password();
            break;
        case 'changepassword':
            $init->change_password();
            break;
        default:
            redirect("../views/home.php");}

}