<?php

require_once '../libraries/db.php';

class userModel{
    private $DB;

    public function __construct(){
        $this->DB = new db;
    }

    public function findUser($username){
        $this->DB->sql('SELECT * FROM users WHERE username = :username');
        $this->DB->bind(':username',$username);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $row;
        }
        else{
            return false;
        }
    }

    public function findCRN($crn,$role){
        $this->DB->sql('SELECT * FROM '.$role.' WHERE company_reg_no = :crn');
        $this->DB->bind(':crn',$crn);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function findEmail($email,$role){
        $this->DB->sql('SELECT * FROM '.$role.' WHERE email = :email');
        $this->DB->bind(':email',$email);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function findFName($uname){
        $row = $this->findUser($uname);

        $userRole = $row->user_role;
        $colName1 = '';
        $colName2 = '';
        switch($userRole){
            case 'Candidate':
                $colName1 = 'cand_username';
                $colName2 = 'first_name';
                break;
            case 'Organization':
                $colName1 = 'org_username';
                $colName2 = 'company_name';
                break;
            case 'Interviewer':
                $colName1 = 'inter_username';
                $colName2 = 'name';
                break;
            case 'Recruiter':
                $colName1 = 'rec_username';
                $colName2 = 'agency_name';
                break;
        }

        $this->DB->sql('SELECT * FROM '.$userRole.' WHERE '.$colName1.' = :uname');
        $this->DB->bind(':uname',$uname);

        $row2 = $this->DB->single();

        return $row2->$colName2;
    }

    public function OrgSignup($data){
        $this->DB->sql('INSERT INTO users (username,password,user_role)
        VALUES (:uname,:pwd,"Organization");
        INSERT INTO organization (org_username,company_name, company_reg_no, address_line1, address_line2, street_name, city, email, telephone_no)
        VALUES (:uname,:compName,:crn,:AL1,:AL2,:strtName,:city,:email,:teleNo)');

        $this->DB->bind(':uname',$data['uName']);
        $this->DB->bind(':compName',$data['name']);
        $this->DB->bind(':crn',$data['crn']);
        $this->DB->bind(':AL1',$data['AL1']);
        $this->DB->bind(':AL2',$data['AL2']);
        $this->DB->bind(':strtName',$data['strtName']);
        $this->DB->bind(':city',$data['city']);
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':teleNo',$data['tele']);
        $this->DB->bind(':pwd',$data['pwd']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function candSignup($data){
        $this->DB->sql('INSERT INTO users (username,password,user_role)
        VALUES (:uname,:pwd,"Candidate");
        INSERT INTO candidate (cand_username,first_name, last_name, email, contact_no, level_of_education)
        VALUES (:uname,:fname,:lname,:email,:contact,:eduLevel);
        INSERT INTO interested_job_position (cand_username,job_position)
        VALUES (:uname,:jobPos);');

        $this->DB->bind(':uname',$data['uName']);
        $this->DB->bind(':fname',$data['fname']);
        $this->DB->bind(':lname',$data['lname']);
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':contact',$data['contact']);
        $this->DB->bind(':eduLevel',$data['eduLevel']);
        $this->DB->bind(':jobPos',$data['jobPos']);
        $this->DB->bind(':pwd',$data['pwd']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function viewMyAds($uname){
        $this->DB->sql('SELECT * FROM advertisement WHERE org_username=:uname');
        $this->DB->bind(':uname',$uname);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function viewIntList($uname){
        $this->DB->sql('SELECT * FROM interviewer WHERE org_username=:uname');
        $this->DB->bind(':uname',$uname);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function intSignup($data){
        $this->DB->sql('INSERT INTO users (username,password,user_role)
        VALUES (:uname,:pwd,"Interviewer");
        INSERT INTO interviewer (inter_username,nic, name, email, contact_no, org_username)
        VALUES (:uname,:nic,:name,:email,:contact,:unameorg);');

        $this->DB->bind(':uname',$data['uName']);
        $this->DB->bind(':name',$data['fname']);
        $this->DB->bind(':nic',$data['nic']);
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':contact',$data['contact']);
        $this->DB->bind(':pwd',$data['pwd']);
        $this->DB->bind(':unameorg',$data['uNameOrg']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function publishAd($data){
        $this->DB->sql('INSERT INTO advertisement (ad_title,job_title,description,frequency,rate,org_username)
        VALUES (:adTitle,:jobTitle,:desc,:freq,:rate,:orgUname)');

        $this->DB->bind(':adTitle',$data['adTitle']);
        $this->DB->bind(':jobTitle',$data['jobTitle']);
        $this->DB->bind(':desc',$data['desc']);
        $this->DB->bind(':freq',$data['freq']);
        $this->DB->bind(':rate',$data['amount']);
        $this->DB->bind(':orgUname',$data['uName']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addJobPos($data){
        $isExecuted = true;
        for($x=0 ; $x < count($data); $x++){
            $this->DB->sql('INSERT INTO interested_job_position VALUES(:uname,:jobPos)');
            $this->DB->bind(':uname',$_SESSION['username']);
            $this->DB->bind(':jobPos',$data[$x]);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        if($isExecuted){
            return true;
        }
        else{
            return false;
        }
        
    }
    public function addSpecialAreaRec($data){
        $isExecuted = true;
        for($x=0 ; $x < count($data); $x++){
            $this->DB->sql('INSERT INTO rec_specialized_in VALUES(:uname,:area)');
            $this->DB->bind(':uname',$_SESSION['username']);
            $this->DB->bind(':area',$data[$x]);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        if($isExecuted){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function searchAd($term){
        $this->DB->sql('SELECT advertisement.*, organization.company_name FROM advertisement 
        INNER JOIN organization ON advertisement.org_username = organization.org_username AND advertisement.ad_title LIKE \'%'.$term.'%\' OR advertisement.description LIKE \'%'.$term.'%\' OR advertisement.job_title LIKE \'%'.$term.'%\'');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function searchRec($term){
        $this->DB->sql('SELECT * FROM recruiter WHERE rec_username IN (SELECT rec_username FROM rec_specialized_in WHERE specialized_in LIKE \'%'.$term.'%\')');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function loadJobReq($uname){
        $this->DB->sql('SELECT hire_rec.* ,organization.company_name, organization.email, organization.telephone_no FROM hire_rec INNER JOIN organization ON hire_rec.org_username = organization.org_username AND hire_rec.rec_username=:uname');
        $this->DB->bind(':uname',$uname);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
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