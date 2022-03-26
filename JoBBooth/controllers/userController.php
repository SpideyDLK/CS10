<?php

require_once '../models/userModel.php';
require_once '../helpers/session_helper.php';

class userController{
    private $userM;

    public function __construct(){
        $this->userM = new userModel;
    }

    public function OrgSignup(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $filtered_phone_no = trim($_POST['orgTele']);
        $filtered_phone_no = preg_replace("/[^0-9]/", '', $filtered_phone_no);
        if (strlen($filtered_phone_no) == 11) $filtered_phone_no = preg_replace("/^94/", '0',$filtered_phone_no);
        
        $data =[
            'name'=>trim($_POST['orgName']),
            'crn' => trim($_POST['crn']),
            'compWeb' => trim($_POST['orgweb']),
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

        
        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->OrgSignup($data)){
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
            'district' => trim($_POST['district']),
            'city' => trim($_POST['city']),
            'email' => trim($_POST['candEmail']),
            'contact' => $filtered_phone_no,
            'eduLevel' => trim($_POST['eduLevel']),
            'uni' => trim($_POST['uniOrInstitute']),
            'degTitle' => trim($_POST['degreeTitle']),
            'workEx' => trim($_POST['workEx']),
            'currComp' => trim($_POST['currComp']),
            'currJob' => trim($_POST['currJob']),
            'uName' => trim($_POST['candUname']),
            'pwd' => trim($_POST['candPwd']),
            'confPwd' => trim($_POST['candConfPwd']),
            'userRole' => trim('candidate')
        ];
        $typeOfLoe = trim($_POST['typeOfLoe']);
        switch($typeOfLoe){
            case "3":
                $typeOfLoe = "cert";
                break;
            case "4":
                $typeOfLoe = "diploma";
                break;
            case "5":
                $typeOfLoe = "undergraduate";
                break;
            case "6":
                $typeOfLoe = "undergraduate";
                break;
            case "7":
                $typeOfLoe = "postgradDip";
                break;
            case "8":
                $typeOfLoe = "masters";
                break;
            case "9":
                $typeOfLoe = "mphilPhd";
                break;
        }
        function ucword($word){
            return strtoupper($word[0]) . substr($word, 1);
        }
        
        function ucwordss($str, $exceptions) {
            // $str = strtolower($str);
            $words = explode(" ", $str);
            $out = [];
            foreach ($words as $word) {
                array_push($out,(!in_array($word, $exceptions)) ? ucword($word)  : $word);
            }
            $str = join(" ",$out);
            return $str;
        }

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        $excep = array("in","is","to","of","and","about","under","if","upto","till");
        $data['currComp'] = ucwordss($data['currComp'],$excep);
        $data['currJob'] = ucwordss($data['currJob'],$excep);
        $data['uni'] = ucwordss($data['uni'],$excep);
        $data['degTitle'] = ucwordss($data['degTitle'],$excep);

        $jobPos = array();
        $skill = array();

        foreach($_POST['jobPos'] as $val){
            array_push($jobPos,$val);
        }
        foreach($_POST['skill'] as $val){
            array_push($skill,$val);
        }

        $jobPos = array_unique($jobPos);
        $skill =  array_unique($skill);
        
        if($_FILES['cvInput']['size']!=0){
            $name = $_FILES['cvInput']['name'];
            $type = $_FILES['cvInput']['type'];
            $size = $_FILES['cvInput']['size'];
            $datafile = file_get_contents($_FILES['cvInput']['tmp_name']); 
        }else{
            $name = NULL;
            $type = NULL;
            $size = NULL;
            $datafile = NULL;
        }
        
        if($this->userM->candSignup($data,$jobPos,$skill,$datafile,$name,$type,$size,$typeOfLoe)){
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

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->intSignup($data)){
            popUp("loginGreen", "Successfully Registered!");
            redirect("../views/interviewers.php");
        }else{
            die("Something went wrong");
        }

    }

    public function signupAdmin(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'uname' => trim($_POST['uname']),
            'pwd' => trim($_POST['pwd'])
        ];

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);

        if($this->userM->signupAdmin($data)){
            popUp("loginGreen", "Successfully Registered!");
            redirect("../views/login_admin.php");
        }else{
            die("Something went wrong");
        }

    }

    public function adminDeact(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $username = trim($_POST['username']);

        if($this->userM->adminDeact($username)){
            redirect("../views/usersAdmin.php");
        }else{
            die("Something went wrong");
        }
    }
    

    public function adminActive(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $username = trim($_POST['username']);

        if($this->userM->adminActive($username)){
            redirect("../views/usersAdmin.php");
        }else{
            die("Something went wrong");
        }
    }

    public function adminUserUnresolved(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = trim($_POST['id']);

        if($this->userM->adminUserUnresolved($id)){
            redirect("../views/admin_home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function adminUserResolved(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = trim($_POST['id']);

        if($this->userM->adminUserResolved($id)){
            redirect("../views/admin_home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function recSignup(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $filtered_phone_no = trim($_POST['AgencyContact']);
        $filtered_phone_no = preg_replace("/[^0-9]/", '', $filtered_phone_no);
        if (strlen($filtered_phone_no) == 11) $filtered_phone_no = preg_replace("/^94/", '0',$filtered_phone_no);

        $data =[
            'name'=>trim($_POST['agencyName']),
            'regNo' => trim($_POST['agencyRegNo']),
            'email' => trim($_POST['agencyEmail']),
            'contact' => $filtered_phone_no,
            'uName' => trim($_POST['recUname']),
            'workexperience' => trim($_POST['workexperience']),
            'pwd' => trim($_POST['recPwd']),
            'confPwd' => trim($_POST['recConfPwd']),
            'userRole' => trim('recruiter')
        ];

       

        $data['pwd'] = password_hash($data['pwd'], PASSWORD_DEFAULT);


        $area = array();

        foreach($_POST['speArea'] as $val){
            array_push($area,$val);
        }
        

        $area = array_unique($area);

        if($this->userM->recSignup($data,$area)){
            popUp("loginGreen", "Successfully Registered!");
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
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
            popUp("loginGreen", "Job Positions Added Successfully!");
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
            popUp("loginGreen", "Specialization Areas Added Successfully!");
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function publishAd(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'adTitle'=>trim($_POST['adTitle']),
            'jobPos' => trim($_POST['jobPos']),
            'jobType' => trim($_POST['jobType']),
            'sal' => trim($_POST['sal']),
            'freq' => trim($_POST['salFreq']),
            'adDuration' => trim($_POST['adDuration']),
            'desc' => trim($_POST['desc']),
            'skills' => trim($_POST['skills']),
            'fromDate' => date("Y-m-d"),
            'orgUname' => $_SESSION['username']
        ];

        if($_FILES['flyerUpload']['size']!=0){
            $name = $_FILES['flyerUpload']['name'];
            $type = $_FILES['flyerUpload']['type'];
            $size = $_FILES['flyerUpload']['size'];
            $datafile = file_get_contents($_FILES['flyerUpload']['tmp_name']); 
        }else{
            $name = NULL;
            $type = NULL;
            $size = NULL;
            $datafile = NULL;
        }

        if($this->userM->publishAd($data,$name,$type,$size,$datafile)){
            // popUp("loginGreen", "Advertisement Published!");
            redirect("../views/ads.php");
        }else{
            die("Something went wrong");
        }
    }

    public function editAd(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'refNo'=>trim($_POST['refNo']),
            'adTitle'=>trim($_POST['adTitle']),
            'jobPos' => trim($_POST['jobPos']),
            'jobType' => trim($_POST['jobType']),
            'sal' => trim($_POST['sal']),
            'freq' => trim($_POST['salFreq']),
            'adDuration' => trim($_POST['adDuration']),
            'desc' => trim($_POST['desc']),
            'skills' => trim($_POST['skills'])
        ];

        if($_FILES['flyerUpload']['size']!=0){
            $name = $_FILES['flyerUpload']['name'];
            $type = $_FILES['flyerUpload']['type'];
            $size = $_FILES['flyerUpload']['size'];
            $datafile = file_get_contents($_FILES['flyerUpload']['tmp_name']); 
        }else{
            $name = NULL;
            $type = NULL;
            $size = NULL;
            $datafile = NULL;
        }

        if($this->userM->editAd($data,$name,$type,$size,$datafile)){
            redirect("../views/ads.php");
        }else{
            die("Something went wrong");
        }
    }

    public function applyForJob(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'uname' => trim($_POST['candUname']),
            'refNo' => trim($_POST['refNo'])
        ];
        if($this->userM->applyForJob($data)){
            $_SESSION['refNo'] = $data['refNo'];
            redirect("../views/view_ad_cand.php");
        }else{
            die("Something went wrong");
        }

    }

    public function hireRec(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'recUname' => trim($_POST['recUname']),
            'hireRecDesc' => trim($_POST['hireRecDesc']),
            'date' => date("Y-m-d"),
            'orgUname' => $_SESSION['username']
        ];

        if($this->userM->hireRec($data)){
            redirect("../views/hire_rec.php");
        }else{
            die("Something went wrong");
        }

    }


    public function orgSendJobReqCand(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'jobPos'=>trim($_POST['jobPos']),
            'jobType' => trim($_POST['jobType']),
            'salary' => trim($_POST['sal']),
            'freq' => trim($_POST['salFreq']),
            'desc' => trim($_POST['desc']),
            'orgUname' => trim($_SESSION['username']),
            'date' => date("Y-m-d"),
            'candUname' => trim($_POST['candUname'])
        ];

        if($this->userM->orgSendJobReqCand($data)){
            $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/view_cand_org.php");
        }else{
            die("Something went wrong");
        }
    }

    public function reportCand(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'sub'=>trim($_POST['sub']),
            'desc' => trim($_POST['reportDesc']),
            'orgUname' => trim($_SESSION['username']),
            'candUname' => trim($_POST['candUname']),
            'date' => date("Y-m-d")
        ];

        if($this->userM->reportCand($data)){
            $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/view_cand_org.php");
        }else{
            die("Something went wrong");
        }
    }

    public function orgCancelJobReqCand(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'orgUname' => trim($_SESSION['username']),
            'candUname' => trim($_POST['candUname'])
        ];

        if($this->userM->orgCancelJobReqCand($data)){
            $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/view_cand_org.php");
        }else{
            die("Something went wrong");
        }
    }

    public function candCancelJobApp(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'uName' => trim($_SESSION['username']),
            'id' => trim($_POST['id'])
        ];

        if($this->userM->candCancelJobApp($data)){
        
            redirect("../views/cand_Pending_Job_Requests.php");
        }else{
            die("Something went wrong");
        }
    }

    public function removeInter(){
        $uname = trim($_POST['uname']);

        if($this->userM->removeInter($uname)){
            popUp("loginGreen", "Interviewer Removed");
            redirect("../views/interviewers.php");
        }else{
            die("Something went wrong");
        }
        
    }

    public function scheIntOrg(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'date' => trim($_POST['intScheDate']),
            'time' => trim($_POST['intScheTime']),
            'link' => trim($_POST['intLink']),
            'intUname' => trim($_POST['selectInt']),
            'candUname' => trim($_POST['candUname']),
            'orgUname' => trim($_SESSION['username'])
        ];

        if($this->userM->scheIntOrg($data)){
            $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/view_responded_cand_org.php");
        }else{
            die("Something went wrong");
        }
    }
    public function rescheIntOrg(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'refNo' => trim($_POST['refNo']),
            'date' => trim($_POST['intScheDate']),
            'time' => trim($_POST['intScheTime']),
            'link' => trim($_POST['intLink']),
            'intUname' => trim($_POST['selectInt'])
        ];

        if($this->userM->rescheIntOrg($data)){
            // $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/interviewers.php");
        }else{
            die("Something went wrong");
        }
    }
    public function rescheIntCand(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'refNo' => trim($_POST['refNo']),
            'date1' => trim($_POST['date1']),
            'time1' => trim($_POST['time1']),
            'date2' => trim($_POST['date2']),
            'time2' => trim($_POST['time2']),
            'date3' => trim($_POST['date3']),
            'time3' => trim($_POST['time3']),
            'date4' => trim($_POST['date4']),
            'time4' => trim($_POST['time4']),
            'date5' => trim($_POST['date5']),
            'time5' => trim($_POST['time5']),
        ];

        if($this->userM->rescheIntCand($data)){
            // $_SESSION['candUname'] = $data['candUname'];
            popUp("loginGreen", "Request Sent");
            redirect("../views/interviews_cand.php");
        }else{
            die("Something went wrong");
        }
    }

    public function unpublishAd(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $refNo = trim($_POST['refNo']);

        if($this->userM->unpublishAd($refNo)){
            redirect("../views/ads.php");
        }else{
            die("Something went wrong");
        }
    }
    public function republishAd(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $refNo = trim($_POST['refNo']);
        $fromDate = date("Y-m-d");

        if($this->userM->republishAd($refNo,$fromDate)){
            redirect("../views/ads.php");
        }else{
            die("Something went wrong");
        }
    }

    public function searchAd(){
        unset($_SESSION['searchRes']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = trim($_POST['searchTerm']);

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
    // public function searchCand(){
    //     unset($_SESSION['searchRes']);
    //     unset($_SESSION['candJobPos']);
    //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //     $searchTerm = trim($_POST['searchTerm']);

    //     $rows = $this->userM->searchCand($searchTerm);
    //     $rows2 = $this->userM->searchJobPos();

    //     $empty_row = [];
    //     if(!($rows)){
    //         $_SESSION['searchRes'] = $empty_row;
    //         redirect("../views/home.php");
    //     }else{
    //         $_SESSION['searchRes'] = $rows;
    //         $_SESSION['candJobPos'] = $rows2;
    //         redirect("../views/home.php");
    //     }

    // }
    
    public function searchCandRec(){
        unset($_SESSION['searchRes']);
        unset($_SESSION['candJobPos']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = trim($_POST['searchTerm']);

        $rows = $this->userM->searchCand($searchTerm);
        $rows2 = $this->userM->searchJobPos();

        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchRes'] = $empty_row;
            redirect("../views/rec_search_cand.php");
        }else{
            $_SESSION['searchRes'] = $rows;
            $_SESSION['candJobPos'] = $rows2;
            redirect("../views/rec_search_cand.php");
        }

    }

    public function searchRec(){
        unset($_SESSION['searchResRec']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = $_POST['searchTerm'];

        $rows = $this->userM->searchRec($searchTerm);
        $rows2 = $this->userM->searchSpecArea();
        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchResRec'] = $empty_row;
            redirect("../views/hire_rec.php");
        }else{
            $_SESSION['searchResRec'] = $rows;
            $_SESSION['searchResRecSpecAreas'] = $rows2;
            redirect("../views/hire_rec.php");
        }

    }

    // public function viewMyAds(){
    //     $rows = $this->userM->viewMyAds($_SESSION['username']);
    //     $empty_row = [];
    //     if(!($rows)){
    //         $_SESSION['myAds'] = $empty_row;
    //         redirect("../views/ads.php");
    //     }else{
    //         $_SESSION['myAds'] = $rows;
    //         redirect("../views/ads.php");
    //     }
    // }

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

    public function editProfileCand(){
        $name = $_FILES['proPic']['name'];
        $type = $_FILES['proPic']['type'];
        $data = file_get_contents($_FILES['proPic']['tmp_name']);

        if($this->userM->editProfileCand($name,$type,$data)){
            redirect("../views/home.php");
        }else{
            die("Something went wrong");
        }
    }

    public function editProCandViewData(){
        $rows = $this->userM->editProCandViewData();
        $empty_row = [];
        if(!($rows)){
            $_SESSION['proPic'] = $empty_row;
            redirect("../views/cand_edit_pro.php");
        }else{
            $_SESSION['proPic'] = $rows;
            redirect("../views/cand_edit_pro.php");
        }
    }

    public function candAcceptOrgReq(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = trim($_POST['id']);
    
            if($this->userM->candAcceptOrgReq($id)){
                redirect("../views/respond_req_cand.php?id=".$id);
            }else{
                die("Something went wrong");
            }
    }
    public function candDeclineOrgReq(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = trim($_POST['id']);
    
            if($this->userM->candDeclineOrgReq($id)){
                redirect("../views/respond_req_cand.php?id=".$id);
            }else{
                die("Something went wrong");
            }
    }

    public function delCandJobApp(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = trim($_POST['id']);
    
            if($this->userM->delCandJobApp($id)){
                redirect("../views/cand_Pending_Job_Requests.php");
            }else{
                die("Something went wrong");
            }
    }

    // public function viewIntList(){
    //     $rows = $this->userM->viewIntList($_SESSION['username']);
    //     $empty_row = [];
    //     if(!($rows)){
    //         $_SESSION['intList'] = $empty_row;
    //         redirect("../views/view_interviewers_org.php");
    //     }else{
    //         $_SESSION['intList'] = $rows;
    //         redirect("../views/view_interviewers_org.php");
    //     }
    // }

    
    
    public function login(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'uname'=>trim($_POST['un']),
            'pwd' => trim($_POST['pwd'])
        ];

        if($this->userM->checkAccountStatus($data['uname'])){
            
        }
        if($this->userM->findUser($data['uname'])){
            if($this->userM->checkAccountStatus($data['uname'])){
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
                popUp("loginRed", "Your account has been suspended!");
                redirect("../views/home.php");
            }
        }
        else{
            popUp("loginRed", "Incorrect username or password!");
            redirect("../views/home.php");
        }
    }

    public function current_password(){
        
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            // $uname = $_SESSION['uname'];
            $data =[
                'currPass'=>trim($_POST['currPass']),
                'newpwd' => trim($_POST['newPwd']),
                'newconfPwd' => trim($_POST['newConfPwd']),
                'uname' => trim($_SESSION['username'])
            ];
        
          
        
            // $data['currPass'] = password_hash($data['currPass'], PASSWORD_DEFAULT);
            $data['newpwd'] = password_hash($data['newpwd'], PASSWORD_DEFAULT);

            
        
            if($this->userM->findUser($data['uname'])){
                if($this->userM->checkAccountStatus($data['uname'])){
                    $allowChangePass = $this->userM->validatePWD($data['uname'],$data['currPass']);
    
                    if($allowChangePass){
                       
                        if($this->userM->current_password($data)){
                            popUp("loginGreen", "Password has been changed Successfully!");
                            $this->logout();
                        }else{
                            die("Something went wrong");
                        }
                    }
                    else{
                        popUp("loginRed", "Incorrect password!");
                        redirect("../views/pro_settings.php?q=2");
                    }
                }
                else{
                    popUp("loginRed", "Your account has been suspended!");
                    redirect("../views/home.php");
                }
            }
            else{
                popUp("loginRed", "Incorrect username or password!");
                redirect("../views/pro_settings.php");
            }
        }

    public function loginAdmin(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data =[
            'uname'=>trim($_POST['un']),
            'pwd' => trim($_POST['pwd'])
        ];

        if($this->userM->findAdmin($data['uname'])){
            $userLoggedIn = $this->userM->validatePWDAdmin($data['uname'],$data['pwd']);

            if($userLoggedIn){
                $adminNoOfUsers = $this->userM->adminNoOfUsers();
                $_SESSION['adminNoOfUsers'] = $adminNoOfUsers;
                $_SESSION['username'] = $userLoggedIn->username;
                $_SESSION['userRole'] = "Administrator";
                redirect("../views/admin_home.php");
            }
            else{
                popUp("loginRed", "Incorrect username or password!");
                redirect("../views/login_admin.php");
            }
        }
        else{
            popUp("loginRed", "Incorrect username or password!");
            redirect("../views/login_admin.php");
        }
    }

    public function createSession($user,$fName){
        $_SESSION['username'] = $user->username;
        unset($_SESSION['fName']);
        unset($_SESSION['userRole']);
        unset($_SESSION['pp']);
        $_SESSION['fName'] = $fName;
        $_SESSION['userRole'] = $user->user_role;
        $_SESSION['pp'] = $user->profile_photo;
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
        case 'current_password':
            $init->current_password();
            break;
        case 'loginAdmin':
            $init->loginAdmin();
            break;
        case 'signupOrg':
            $init->OrgSignup();
            break;
        case 'signupCand':
            $init->candSignup();
            break;
        case 'signupRec':
            $init->recSignup();
            break;
        case 'addJobPos':
            $init->addJobPos();
            break;
        case 'searchAd':
            $init->searchAd();
            break;
        // case 'searchCand':
        //     $init->searchCand();
        //     break;
        case 'searchCandRec':
            $init->searchCandRec();
            break;
        case 'signupInt':
            $init->intSignup();
            break;
        case 'pubAd':
            $init->publishAd();
            break;
        case 'searchRec':
            $init->searchRec();
            break;
        case 'addSpecialAreaRec':
            $init->addSpecialAreaRec();
            break;
        case 'editProfileCand':
            $init->editProfileCand();
            break;
        case 'orgSendJobReqCand':
            $init->orgSendJobReqCand();
            break;
        case 'orgCancelJobReqCand':
            $init->orgCancelJobReqCand();
            break;
        case 'candCancelJobApp':
            $init->candCancelJobApp();
            break;
        case 'unpublishAd':
            $init->unpublishAd();
            break;
        case 'republishAd':
            $init->republishAd();
            break;
        case 'editAd':
            $init->editAd();
            break;
        case 'reportCand':
            $init->reportCand();
            break;
        case 'signupAdmin':
            $init->signupAdmin();
            break;
        case 'adminDeact':
            $init->adminDeact();
            break;
        case 'adminActive':
            $init->adminActive();
            break;
        case 'adminUserUnresolved':
            $init->adminUserUnresolved();
            break;
        case 'adminUserResolved':
            $init->adminUserResolved();
            break;    
        case 'candAcceptOrgReq':
            $init->candAcceptOrgReq();
            break;
        case 'candDeclineOrgReq':
            $init->candDeclineOrgReq();
            break;
        case 'delCandJobApp':
            $init->delCandJobApp();
            break;
        case 'applyForJob':
            $init->applyForJob();
            break;
        case 'hireRec':
            $init->hireRec();
            break;
        case 'scheIntOrg':
            $init->scheIntOrg();
            break;
        case 'rescheIntOrg':
            $init->rescheIntOrg();
            break;
        case 'rescheIntCand':
            $init->rescheIntCand();
            break;
        case 'removeInter':
            $init->removeInter();
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
        case 'intList':
            $init->viewIntList();
            break;
        case 'loadJobReq':
            $init->loadJobReq();
            break;
        case 'editProCandViewData':
            $init->editProCandViewData();
            break;
        case 'checkCandDupEmail':
            $init->checkCandDupEmail();
            break;
        
        default:
        redirect("../views/home.php");
    }
    
}

