<?php

require_once '../models/userModel.php';
require_once '../helpers/session_helper.php';

class userController{
    private $userM;

    public function __construct(){
        $this->userM = new userModel;
    }

    public function login(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'uname'=>trim($_POST['un']),
            'pwd' => trim($_POST['pwd'])
        ];

        if($this->userM->findUser($data['uname'])){
            $userLoggedIn = $this->userM->validatePWD($data['uname'],$data['pwd']);

            if($userLoggedIn){
                $this->createSession($userLoggedIn);
            }
            else{
                popUp("login", "*Incorrect username or password!");
                redirect("../views/home.php");
            }
        }
        else{
            popUp("login", "*Incorrect username or password!");
            redirect("../views/home.php");
        }
    }

    public function createSession($user){
        $_SESSION['username'] = $user->username;
        redirect("../views/loggedin.html");
    }

    public function logout(){
        unset($_SESSION['username']);
        session_destroy();
        redirect("../views/home.php");
    }

}

$init = new userController;

if($_SERVER['REQUEST_METHOD']=='POST'){
    switch($_POST['type']){
        case 'login':
            $init->login();
            break;
        default:
        redirect("../views/home.php");
    }
}
else{
    switch($_GET['q']){
        case 'logout':
            $init->logout();
            break;
        default:
        redirect("../views/home.php");
    }
}

