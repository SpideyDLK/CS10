<?php 

require_once '../models/userModel.php';
require_once '../helpers/session_helper.php';

class userController{
    private $userM;

    public function __construct(){
        $this->userM = new userModel;
    }
    public function checkCandDupEmail(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['candEmail']);
        if($this->userM->findEmail($email)){
            echo "<span style='color:red'>This e-mail is already registered</span>";
            echo "<script>$('#next1').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>E-mail is available</span>";    
            echo "<script>$('#next1').prop('disabled',false);</script>";
        }
    }
    public function checkCandDupUname(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $uname = trim($_POST['candUname']);
        if($this->userM->findUser($uname)){
            echo "<span style='color:red'>This username is already in use</span>";
            echo "<script>$('.signupButton').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>Username is available</span>";    
            echo "<script>$('.signupButton').prop('disabled',false);</script>";
        }
    }
    public function checkOrgDupEmail(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['orgEmail']);
        if($this->userM->findEmail($email)){
            echo "<span style='color:red'>This e-mail is already registered</span>";
            echo "<script>$('#next1').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>E-mail is available</span>";    
            echo "<script>$('#next1').prop('disabled',false);</script>";
        }
    }
    public function checkOrgDupUname(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $uname = trim($_POST['orgUname']);
        if($this->userM->findUser($uname)){
            echo "<span style='color:red'>This username is already in use</span>";
            echo "<script>$('.signupButton').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>Username is available</span>";    
            echo "<script>$('.signupButton').prop('disabled',false);</script>";
        }
    }
    public function checkRecDupEmail(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['agencyEmail']);
        if($this->userM->findEmail($email)){
            echo "<span style='color:red'>This e-mail is already registered</span>";
            echo "<script>$('#next1').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>E-mail is available</span>";    
            echo "<script>$('#next1').prop('disabled',false);</script>";
        }
    }

    public function checkRecDupUname(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $uname = trim($_POST['recUname']);
        if($this->userM->findUser($uname)){
            echo "<span style='color:red'>This username is already in use</span>";
            echo "<script>$('.signupButton').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>Username is available</span>";    
            echo "<script>$('.signupButton').prop('disabled',false);</script>";
        }
    }

    public function checkIntDupEmail(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['intEmail']);
        if($this->userM->findEmail($email)){
            echo "<span style='color:red'>This e-mail is already registered</span>";
            echo "<script>$('#next1').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>E-mail is available</span>";    
            echo "<script>$('#next1').prop('disabled',false);</script>";
        }
    }

    public function checkIntDupUname(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $uname = trim($_POST['intUname']);
        if($this->userM->findUser($uname)){
            echo "<span style='color:red'>This username is already in use</span>";
            echo "<script>$('.signupButton').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>Username is available</span>";    
            echo "<script>$('.signupButton').prop('disabled',false);</script>";
        }
    }
    public function checkAdminUname(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $uname = trim($_POST['uname']);
        if($this->userM->findAdmin($uname)){
            echo "<span style='color:red'>This username is already in use</span>";
            echo "<script>$('.adminSignupButton').prop('disabled',true);</script>";
        }
        else{
            echo "<span style='color:green'>Username is available</span>";    
            echo "<script>$('.adminSignupButton').prop('disabled',false);</script>";
        }
    }

}

$init = new userController;

switch($_GET['q']){
    case 'checkEmail':
        $init->checkCandDupEmail();
        break;
    case 'checkOrgEmail':
        $init->checkOrgDupEmail();
        break;
    case 'checkRecEmail':
        $init->checkRecDupEmail();
        break;
    case 'checkIntEmail':
        $init->checkIntDupEmail();
        break;
    case 'checkUname':
        $init->checkCandDupUname();
        break;
    case 'checkOrgUname':
        $init->checkOrgDupUname();
        break;
    case 'checkRecUname':
        $init->checkRecDupUname();
        break;
    case 'checkIntUname':
        $init->checkIntDupUname();
        break;
    case 'checkAdminUname':
        $init->checkAdminUname();
        break;
}