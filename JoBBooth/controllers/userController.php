<?php

require_once '../models/userModel.php';
require_once '../helpers/session_helper.php';

class userController{
    private $userM;

    public function __construct(){
        $this->userM = new userModel;
    }

    public function orgSignup(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $filtered_phone_no = trim($_POST['orgTele']);
        $filtered_phone_no = preg_replace("/[^0-9]/", '', $filtered_phone_no);
        if (strlen($filtered_phone_no) == 11) $filtered_phone_no = preg_replace("/^94/", '0',$filtered_phone_no);
        
        $data =[
            'name'=>trim($_POST['orgName']),
            'crn' => trim($_POST['crn']),
            'email' => trim($_POST['orgEmail']),
            'tele' => $filtered_phone_no,
            'AL1' => trim($_POST['orgAL1']),
            'AL2' => trim($_POST['orgAL2']),
            'strtName' => trim($_POST['orgStrtName']),
            'city' => trim($_POST['orgCity']),
            'uName' => trim($_POST['orgUname']),
            'pwd' => trim($_POST['orgPwd']),
            'confPwd' => trim($_POST['orgConfPwd']),
            'userRole' => trim('organization')
        ];

        if($this->userM->findCRN($data['crn'],$data['userRole'])){
            popUp("signupRed", "This CRN is already registered!");
            redirect("../views/signup_org.php");
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            popUp("signupRed", "Invalid email!");
            redirect("../views/signup_org.php");
        }

        if(!preg_match("/^[0-9]*$/", $data['tele'])||strlen($data['tele'])!==10){
            popUp("signupRed", "Invalid telephone number!");
            redirect("../views/signup_org.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['uName'])){
            popUp("signupRed", "Invalid username!");
            redirect("../views/signup_org.php");
        }

        if($this->userM->findUser($data['uName'])){
            popUp("signupRed", "Username is already taken!");
            redirect("../views/signup_org.php");
        }
        
        $ifNumber = preg_match('@[0-9]@',$data['pwd']);
        $ifSpecialChar = preg_match('@[^\w]@',$data['pwd']);

        if(strlen($data['pwd']) < 8){
            popUp("signupRed", "Password should contain minimum 8 characters!");
            redirect("../views/signup_org.php");
        }elseif($ifNumber||$ifSpecialChar){
            if($data['pwd'] !== $data['confPwd']){
                popUp("signupRed", "Passwords don't match!");
                redirect("../views/signup_org.php");
            }
        }
        else{
            popUp("signupRed", "Password should contain at least one number or a special character!");
            redirect("../views/signup_org.php");
        }

        
        

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->orgSignup($data)){
            popUp("loginGreen", "Successfully Registered!");
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }

    }

    public function candSignup(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $filtered_phone_no = trim($_POST['candContact']);
        $filtered_phone_no = preg_replace("/[^0-9]/", '', $filtered_phone_no);
        if (strlen($filtered_phone_no) == 11) $filtered_phone_no = preg_replace("/^94/", '0',$filtered_phone_no);
        
        $data =[
            'fname'=>trim($_POST['candFname']),
            'lname' => trim($_POST['candLname']),
            'email' => trim($_POST['candEmail']),
            'contact' => $filtered_phone_no,
            'jobPos' => trim($_POST['jobPos']),
            'eduLevel' => trim($_POST['eduLevel']),
            'uName' => trim($_POST['candUname']),
            'pwd' => trim($_POST['candPwd']),
            'confPwd' => trim($_POST['candConfPwd']),
            'userRole' => trim('candidate')
        ];

        if($this->userM->findEmail($data['email'],$data['userRole'])){
            popUp("signupRed", "This e-mail is already registered!");
            redirect("../views/signup_cand.php");
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            popUp("signupRed", "Invalid email!");
            redirect("../views/signup_cand.php");
        }

        if(!preg_match("/^[0-9]*$/", $data['contact'])||strlen($data['contact'])!==10){
            popUp("signupRed", "Invalid contact number!");
            redirect("../views/signup_cand.php");
        }
        if($data['eduLevel']==''){
            popUp("signupRed", "Please select your level of education!");
            redirect("../views/signup_cand.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['uName'])){
            popUp("signupRed", "Invalid username!");
            redirect("../views/signup_cand.php");
        }

        if($this->userM->findUser($data['uName'])){
            popUp("signupRed", "Username is already taken!");
            redirect("../views/signup_cand.php");
        }
        
        $ifNumber = preg_match('@[0-9]@',$data['pwd']);
        $ifSpecialChar = preg_match('@[^\w]@',$data['pwd']);

        if(strlen($data['pwd']) < 8){
            popUp("signupRed", "Password should contain minimum 8 characters!");
            redirect("../views/signup_cand.php");
        }elseif($ifNumber||$ifSpecialChar){
            if($data['pwd'] !== $data['confPwd']){
                popUp("signupRed", "Passwords don't match!");
                redirect("../views/signup_cand.php");
            }
        }
        else{
            popUp("signupRed", "Password should contain at least one number or a special character!");
            redirect("../views/signup_cand.php");
        }

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->candSignup($data)){
            popUp("loginGreen", "Successfully Registered!");
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }

    }

    public function intSignup(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $filtered_phone_no = trim($_POST['intContact']);
        $filtered_phone_no = preg_replace("/[^0-9]/", '', $filtered_phone_no);
        if (strlen($filtered_phone_no) == 11) $filtered_phone_no = preg_replace("/^94/", '0',$filtered_phone_no);
        
        $data =[
            'fname'=>trim($_POST['intFullName']),
            'nic' => trim($_POST['intNIC']),
            'email' => trim($_POST['intEmail']),
            'contact' => $filtered_phone_no,
            'uName' => trim($_POST['intUname']),
            'pwd' => trim($_POST['intPwd']),
            'confPwd' => trim($_POST['intConfPwd']),
            'userRole' => trim('interviewer'),
            'uNameOrg' => trim($_SESSION['username'])
        ];

        if($this->userM->findEmail($data['email'],$data['userRole'])){
            popUp("signupRed", "This e-mail is already registered!");
            redirect("../views/reg_interviewer.php");
        }

        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            popUp("signupRed", "Invalid email!");
            redirect("../views/reg_interviewer.php");
        }

        if(!preg_match("/^[0-9]*$/", $data['contact'])||strlen($data['contact'])!==10){
            popUp("signupRed", "Invalid contact number!");
            redirect("../views/reg_interviewer.php");
        }

        if(!preg_match("/^[a-zA-Z0-9]*$/", $data['uName'])){
            popUp("signupRed", "Invalid username!");
            redirect("../views/reg_interviewer.php");
        }

        if($this->userM->findUser($data['uName'])){
            popUp("signupRed", "Username is already taken!");
            redirect("../views/reg_interviewer.php");
        }
        
        $ifNumber = preg_match('@[0-9]@',$data['pwd']);
        $ifSpecialChar = preg_match('@[^\w]@',$data['pwd']);

        if(strlen($data['pwd']) < 8){
            popUp("signupRed", "Password should contain minimum 8 characters!");
            redirect("../views/reg_interviewer.php");
        }elseif($ifNumber||$ifSpecialChar){
            if($data['pwd'] !== $data['confPwd']){
                popUp("signupRed", "Passwords don't match!");
                redirect("../views/reg_interviewer.php");
            }
        }
        else{
            popUp("signupRed", "Password should contain at least one number or a special character!");
            redirect("../views/reg_interviewer.php");
        }

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->intSignup($data)){
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }

    }

    public function login(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'uname'=>trim($_POST['un']),
            'pwd' => trim($_POST['pwd'])
        ];

        if($this->userM->findUser($data['uname'])){
            $userLoggedIn = $this->userM->validatePWD($data['uname'],$data['pwd']);
            $fName = $this->userM->findFName($data['uname']);

            if($userLoggedIn){
                $this->createSession($userLoggedIn,$fName);
            }
            else{
                popUp("loginRed", "Incorrect username or password!");
                redirect("../views/home.php");
            }
        }
        else{
            popUp("loginRed", "Incorrect username or password!");
            redirect("../views/home.php");
        }
    }

    public function addJobPos(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $count = $_POST['count'];
        (int)$count;
        $data = [];
        $data[0] = $_POST['jobPos'];
        for($x = 1 ; $x < $count; $x++){
            $data[$x] = $_POST['jobPos'.$x.''];
        }
        
        if($this->userM->addJobPos($data)){
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }
    }
    public function addSpecialAreaRec(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $count = $_POST['count'];
        (int)$count;
        $data = [];
        $data[0] = $_POST['areaRec'];
        for($x = 1 ; $x < $count; $x++){
            $data[$x] = $_POST['areaRec'.$x.''];
        }
        
        if($this->userM->addSpecialAreaRec($data)){
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function publishAd(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'adTitle'=>trim($_POST['adTitle']),
            'desc' => trim($_POST['descPubAd']),
            'jobTitle' => trim($_POST['jobTitlePubAd']),
            'freq' => trim($_POST['payFreq']),
            'amount' => trim($_POST['amountPubAd']),
            'uName' => trim($_SESSION['username'])
        ];

        if($this->userM->publishAd($data)){
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function searchAd(){
        unset($_SESSION['searchRes']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = $_POST['searchTerm'];

        $rows = $this->userM->searchAd($searchTerm);
        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchRes'] = $empty_row;
            redirect("../views/home.php");
        }else{
            $_SESSION['searchRes'] = $rows;
            redirect("../views/home.php");
        }

    }

    public function searchRec(){
        unset($_SESSION['searchResRec']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = $_POST['searchTerm'];

        $rows = $this->userM->searchRec($searchTerm);
        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchResRec'] = $empty_row;
            redirect("../views/hire_rec.php");
        }else{
            $_SESSION['searchResRec'] = $rows;
            redirect("../views/hire_rec.php");
        }

    }

    public function viewMyAds(){
        $rows = $this->userM->viewMyAds($_SESSION['username']);
        $empty_row = [];
        if(!($rows)){
            $_SESSION['myAds'] = $empty_row;
            redirect("../views/myAds.php");
        }else{
            $_SESSION['myAds'] = $rows;
            redirect("../views/myAds.php");
        }
    }

    public function loadJobReq(){
        $rows = $this->userM->loadJobReq($_SESSION['username']);
        $empty_row = [];
        if(!($rows)){
            $_SESSION['jobReqRec'] = $empty_row;
            redirect("../views/home.php");
        }else{
            $_SESSION['jobReqRec'] = $rows;
            redirect("../views/home.php");
        }
    }

    public function viewIntList(){
        $rows = $this->userM->viewIntList($_SESSION['username']);
        $empty_row = [];
        if(!($rows)){
            $_SESSION['intList'] = $empty_row;
            redirect("../views/view_interviewers_org.php");
        }else{
            $_SESSION['intList'] = $rows;
            redirect("../views/view_interviewers_org.php");
        }
    }

    public function createSession($user,$fName){
        $_SESSION['username'] = $user->username;
        unset($_SESSION['fName']);
        unset($_SESSION['userRole']);
        $_SESSION['fName'] = $fName;
        $_SESSION['userRole'] = $user->user_role;
        switch($_SESSION['userRole']){
            case 'Organization':
                redirect("../views/org_home.php");
                break;
            case 'Candidate':
                redirect("../views/cand_home.php");
                break;
            case 'Interviewer':
                redirect("../views/interviewer_home.php");
                break;
            case 'Recruiter':
                redirect("../views/rec_home.php");
                break;
        }
        
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
        case 'signupOrg':
            $init->orgSignup();
            break;
        case 'signupCand':
            $init->candSignup();
            break;
        case 'addJobPos':
            $init->addJobPos();
            break;
        case 'searchAd':
            $init->searchAd();
            break;
        case 'signupInt':
            $init->intSignup();
            break;
        case 'publishAd':
            $init->publishAd();
            break;
        case 'searchRec':
            $init->searchRec();
            break;
        case 'addSpecialAreaRec':
            $init->addSpecialAreaRec();
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
        case 'myAds':
            $init->viewMyAds();
            break;
        case 'intList':
            $init->viewIntList();
            break;
        case 'loadJobReq':
            $init->loadJobReq();
            break;
        default:
        redirect("../views/home.php");
    }
    
}

