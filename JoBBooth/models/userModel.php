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
    public function findAdmin($username){
        $this->DB->sql('SELECT * FROM admins WHERE username = :username');
        $this->DB->bind(':username',$username);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $row;
        }
        else{
            return false;
        }
    }

    public function checkAccountStatus($uname){
        $this->DB->sql('SELECT * FROM users WHERE username = :username');
        $this->DB->bind(':username',$uname);

        $row = $this->DB->single();

        if($row->account_status == "Suspended"){
            return false;
        }
        else{
            return true;
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
    public function findRegNo($regNo,$role){
        $this->DB->sql('SELECT * FROM '.$role.' WHERE agency_reg_no = :regNo');
        $this->DB->bind(':regNo',$regNo);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function findEmail($email){
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
        $this->DB->sql('INSERT INTO users (username,password,user_role,email)
        VALUES (:uname,:pwd,"Organization",:email);
        INSERT INTO organization (org_username,company_name, company_reg_no, company_website, address_line1, address_line2, street_name, city, email, telephone_no)
        VALUES (:uname,:compName,:crn,:compWeb,:AL1,:AL2,:strtName,:city,:email,:teleNo);');

        $this->DB->bind(':uname',$data['uName']);   
        $this->DB->bind(':compName',$data['name']);
        $this->DB->bind(':crn',$data['crn']);
        $this->DB->bind(':compWeb',$data['compWeb']);
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

    public function signupAdmin($data){
        $this->DB->sql('INSERT INTO admins VALUES (:uname,:pwd)');
        $this->DB->bind(':uname',$data['uname']);
        $this->DB->bind(':pwd',$data['pwd']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function candSignup($data,$jobPos,$skill,$cvFile,$name,$filetype,$size,$type){
        $this->DB->sql('INSERT INTO users (username,password,user_role)
        VALUES (:uname,:pwd,"Candidate");
        INSERT INTO candidate (cand_username,first_name, last_name, district, city, email, contact_no, work_experience, current_company, current_designation, level_of_education, uni_or_institute, deg_cert_or_dip_title)
        VALUES (:uname,:fname,:lname,:district,:city,:email,:contact,:workEx,:currComp,:currJob,:eduLevel,:uni,:degTitle);');

        $this->DB->bind(':uname',$data['uName']);
        $this->DB->bind(':fname',$data['fname']);
        $this->DB->bind(':lname',$data['lname']);
        $this->DB->bind(':district',$data['district']);
        $this->DB->bind(':city',$data['city']);
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':contact',$data['contact']);
        $this->DB->bind(':workEx',$data['workEx']);
        $this->DB->bind(':currComp',$data['currComp']);
        $this->DB->bind(':currJob',$data['currJob']);
        $this->DB->bind(':eduLevel',$data['eduLevel']);
        $this->DB->bind(':uni',$data['uni']);
        $this->DB->bind(':degTitle',$data['degTitle']);
        $this->DB->bind(':pwd',$data['pwd']);
        $isExecuted = true;
        if(!$this->DB->execute()){
            $isExecuted = false;
        }

        if($cvFile){
            $this->DB->sql('INSERT INTO cv_files(cand_username,name,type,size,data) VALUES(:uname,:filename,:filetype,:filesize,:filedata)');
            $this->DB->bind(':uname',$data['uName']);
            $this->DB->bind(':filename',$name);
            $this->DB->bind(':filetype',$filetype);
            $this->DB->bind(':filesize',$size);
            $this->DB->bind(':filedata',$cvFile);
            if(!$this->DB->execute()){
                $isExecuted = false;
            }

        }
        

        if(!empty($data['degTitle'])&&!empty($data['uni'])&&!empty($type)){
            $this->DB->sql('SELECT * FROM unis_and_degrees WHERE uniName = :uni');
            $this->DB->bind(':uni',$data['uni']);

            $row = $this->DB->single();

            if($this->DB->rowCount()==0){
                $this->DB->sql('INSERT INTO unis_and_degrees (uniName,degTitle,type) VALUES(:uni,:degTitle,:type)');
                $this->DB->bind(':uni',$data['uni']);
                $this->DB->bind(':degTitle',$data['degTitle']);
                $this->DB->bind(':type',$type);
                $this->DB->execute();
            }
            else{
                $this->DB->sql('SELECT * FROM unis_and_degrees WHERE uniName = :uni AND degTitle=:degTitle AND type=:type');
                $this->DB->bind(':uni',$data['uni']);
                $this->DB->bind(':degTitle',$data['degTitle']);
                $this->DB->bind(':type',$type);

                $row = $this->DB->single();

                if($this->DB->rowCount()==0){
                    $this->DB->sql('INSERT INTO unis_and_degrees (uniName,degTitle,type) VALUES(:uni,:degTitle,:type)');
                    $this->DB->bind(':uni',$data['uni']);
                    $this->DB->bind(':degTitle',$data['degTitle']);
                    $this->DB->bind(':type',$type);
                    $this->DB->execute();
                }
            }

        }
        
        

        for($x=0 ; $x < count($jobPos); $x++){
            $this->DB->sql('INSERT INTO interested_job_position (cand_username,job_position) VALUES(:uname,:jobPos)');
            $this->DB->bind(':uname',$data['uName']);
            $this->DB->bind(':jobPos',$jobPos[$x]);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        for($x=0 ; $x < count($jobPos); $x++){
            $this->DB->sql('SELECT * FROM job_position_search_count WHERE job_position = :jobPos');
            $this->DB->bind(':jobPos',$jobPos[$x]);

            $row = $this->DB->single();

            if($this->DB->rowCount()==0){
                $this->DB->sql('INSERT INTO job_position_search_count (job_position,search_count) VALUES(:jobPos,0)');
                $this->DB->bind(':jobPos',$jobPos[$x]);
                $this->DB->execute();
            }
        }
        for($x=0 ; $x < count($skill); $x++){
            $this->DB->sql('INSERT INTO professional_skills (cand_username,skills) VALUES(:uname,:skill)');
            $this->DB->bind(':uname',$data['uName']);
            $this->DB->bind(':skill',$skill[$x]);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        for($x=0 ; $x < count($skill); $x++){
            $this->DB->sql('SELECT * FROM skill_search_count WHERE skill = :skill');
            $this->DB->bind(':skill',$skill[$x]);

            $row = $this->DB->single();

            if($this->DB->rowCount()==0){
                $this->DB->sql('INSERT INTO skill_search_count (skill,search_count) VALUES(:skill,0)');
                $this->DB->bind(':skill',$skill[$x]);
                $this->DB->execute();
            }
        }

        if($isExecuted){
            return true;
        }
        else{
            return false;
        }
        
        

        

    }
    // public function addJobPos($data){
    //     $isExecuted = true;
    //     for($x=0 ; $x < count($data); $x++){
    //         $this->DB->sql('INSERT INTO interested_job_position VALUES(:uname,:jobPos)');
    //         $this->DB->bind(':uname',$_SESSION['username']);
    //         $this->DB->bind(':jobPos',$data[$x]);

    //         if(!$this->DB->execute()){
    //             $isExecuted = false;
    //         }
    //     }
    //     if($isExecuted){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
        
    // }

    public function recSignup($data, $area){
        $this->DB->sql('INSERT INTO users (username,password,user_role)
        VALUES (:uname,:pwd,"Recruiter");
        INSERT INTO recruiter (rec_username,agency_reg_no, agency_name, email, contact_no,work_experience)
        VALUES (:uname,:regNo,:aName,:email,:contact,:workexperience);');

        $this->DB->bind(':uname',$data['uName']);
        $this->DB->bind(':regNo',$data['regNo']);
        $this->DB->bind(':aName',$data['name']);
        $this->DB->bind(':workexperience',$data['workexperience']);
        $this->DB->bind(':email',$data['email']);
        $this->DB->bind(':contact',$data['contact']);
        $this->DB->bind(':pwd',$data['pwd']);
        $isExecuted = true;
        if(!$this->DB->execute()){
            $isExecuted = false;
        }

        for($x=0 ; $x < count($area); $x++){
            $this->DB->sql('INSERT INTO rec_specialized_in (rec_username,specialized_in) VALUES(:uname,:speArea)');
            $this->DB->bind(':uname',$data['uName']);
            $this->DB->bind(':speArea',$area[$x]);

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

    public function editProfileCand($name,$type,$data){
        $this->DB->sql('UPDATE users SET profile_photo = :data WHERE username = :uname');

        $this->DB->bind(':data',$data);
        $this->DB->bind(':uname',$_SESSION['username']);
        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function editProCandViewData(){
        $this->DB->sql('SELECT profile_photo from users WHERE username = :uname');
        $this->DB->bind(':uname',$_SESSION['username']);

        $row = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $row;
        }
        else{
            return false;
        }
    }

    // public function viewMyAds($uname){
    //     $this->DB->sql('SELECT * FROM advertisement WHERE org_username=:uname');
    //     $this->DB->bind(':uname',$uname);

    //     $rows = $this->DB->multiple();

    //     if($this->DB->rowCount()>0){
    //         return $rows;
    //     }else{
    //         return false;
    //     }
    // }

    // public function viewIntList($uname){
    //     $this->DB->sql('SELECT * FROM interviewer WHERE org_username=:uname');
    //     $this->DB->bind(':uname',$uname);

    //     $rows = $this->DB->multiple();

    //     if($this->DB->rowCount()>0){
    //         return $rows;
    //     }else{
    //         return false;
    //     }
    // }

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

    public function publishAd($data,$name,$type,$size,$datafile){
        $this->DB->sql('INSERT INTO advertisement (ad_title,job_title,job_type,description,skills,frequency,rate,duration,from_date,org_username)
        VALUES (:adTitle,:jobTitle,:jobType,:desc,:skills,:freq,:rate,:duration,:fromDate,:orgUname)');

        $this->DB->bind(':adTitle',$data['adTitle']);
        $this->DB->bind(':jobTitle',$data['jobPos']);
        $this->DB->bind(':jobType',$data['jobType']);
        $this->DB->bind(':desc',$data['desc']);
        $this->DB->bind(':skills',$data['skills']);
        $this->DB->bind(':freq',$data['freq']);
        $this->DB->bind(':rate',$data['sal']);
        $this->DB->bind(':duration',$data['adDuration']);
        $this->DB->bind(':fromDate',$data['fromDate']);
        $this->DB->bind(':orgUname',$data['orgUname']);
        $isExecuted = true;
        if(!$this->DB->execute()){
            $isExecuted = false;
        }
        else{
            $lastId = $this->DB->lastId();
        }

        if($datafile){
            $this->DB->sql('INSERT INTO ad_flyers VALUES(:ref_no,:orgUname,:fileName,:fileType,:fileSize,:fileData)');
            $this->DB->bind(':ref_no',$lastId);
            $this->DB->bind(':orgUname',$data['orgUname']);
            $this->DB->bind(':fileName',$name);
            $this->DB->bind(':fileType',$type);
            $this->DB->bind(':fileSize',$size);
            $this->DB->bind(':fileData',$datafile);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        if($isExecuted){
            return true;
        }else{
            return false;
        }
    }
    public function editAd($data,$name,$type,$size,$datafile){
        $this->DB->sql('UPDATE advertisement SET ad_title=:adTitle, job_title=:jobTitle, job_type=:jobType,description=:desc,
        skills=:skills,frequency=:freq,rate=:rate,duration=:duration,status="Published" WHERE ref_no = :refNo');

        $this->DB->bind(':adTitle',$data['adTitle']);
        $this->DB->bind(':jobTitle',$data['jobPos']);
        $this->DB->bind(':jobType',$data['jobType']);
        $this->DB->bind(':desc',$data['desc']);
        $this->DB->bind(':skills',$data['skills']);
        $this->DB->bind(':freq',$data['freq']);
        $this->DB->bind(':rate',$data['sal']);
        $this->DB->bind(':duration',$data['adDuration']);
        $this->DB->bind(':refNo',$data['refNo']);
        $isExecuted = true;
        if(!$this->DB->execute()){
            $isExecuted = false;
        }

        if($datafile){
            $this->DB->sql('UPDATE ad_flyers SET name=:fileName,type=:fileType,size=:fileSize,data=:fileData WHERE ref_no = :refNo');
            $this->DB->bind(':fileName',$name);
            $this->DB->bind(':fileType',$type);
            $this->DB->bind(':fileSize',$size);
            $this->DB->bind(':fileData',$datafile);
            $this->DB->bind(':refNo',$data['refNo']);

            if(!$this->DB->execute()){
                $isExecuted = false;
            }
        }
        if($isExecuted){
            return true;
        }else{
            return false;
        }
    }

    public function orgSendJobReqCand($data){
        $this->DB->sql('INSERT INTO org_send_job_req_cand (org_username,cand_username,job_position,salary,salary_freq,job_type,description,date)
        VALUES (:orgUname,:candUname,:jobPos,:salary,:freq,:jobType,:desc,:date)');

        $this->DB->bind(':orgUname',$data['orgUname']);
        $this->DB->bind(':candUname',$data['candUname']);
        $this->DB->bind(':jobPos',$data['jobPos']);
        $this->DB->bind(':salary',$data['salary']);
        $this->DB->bind(':freq',$data['freq']);
        $this->DB->bind(':jobType',$data['jobType']);
        $this->DB->bind(':desc',$data['desc']);
        $this->DB->bind(':date',$data['date']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function scheIntOrg($data){
        $this->DB->sql('INSERT INTO interviews (cand_username,org_username,int_username,date,time,link)
        VALUES(:candUname,:orgUname,:intUname,:date,:time,:link)');
        $this->DB->bind(':orgUname',$data['orgUname']);
        $this->DB->bind(':candUname',$data['candUname']);
        $this->DB->bind(':intUname',$data['intUname']);
        $this->DB->bind(':date',$data['date']);
        $this->DB->bind(':time',$data['time']);
        $this->DB->bind(':link',$data['link']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function rescheIntOrg($data){
        $this->DB->sql('UPDATE interviews SET int_username=:intUname, date=:date,time=:time,link=:link WHERE ref_no = :refNo');
        
        $this->DB->bind(':refNo',$data['refNo']);
        $this->DB->bind(':intUname',$data['intUname']);
        $this->DB->bind(':date',$data['date']);
        $this->DB->bind(':time',$data['time']);
        $this->DB->bind(':link',$data['link']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function rescheIntCand($data){
        $this->DB->sql('INSERT INTO interview_reschedule VALUES(:refNo,:date1,:time1,:date2,:time2,:date3,:time3,:date4,:time4,:date5,:time5)');
        
        $this->DB->bind(':refNo',$data['refNo']);
        $this->DB->bind(':date1',$data['date1']);
        $this->DB->bind(':time1',$data['time1']);
        if(!$data['date2']||!$data['time2']){
            $this->DB->bind(':date2',NULL);
            $this->DB->bind(':time2',NULL);
        }
        else{
            $this->DB->bind(':date2',$data['date2']);
            $this->DB->bind(':time2',$data['time2']);
        }
        if(!$data['date3']||!$data['time3']){
            $this->DB->bind(':date3',NULL);
            $this->DB->bind(':time3',NULL);
        }
        else{
            $this->DB->bind(':date3',$data['date3']);
            $this->DB->bind(':time3',$data['time3']);
        }
        if(!$data['date4']||!$data['time4']){
            $this->DB->bind(':date4',NULL);
            $this->DB->bind(':time4',NULL);
        }
        else{
            $this->DB->bind(':date4',$data['date4']);
            $this->DB->bind(':time4',$data['time4']);
        }
        if(!$data['date5']||!$data['time5']){
            $this->DB->bind(':date5',NULL);
            $this->DB->bind(':time5',NULL);
        }
        else{
            $this->DB->bind(':date5',$data['date5']);
            $this->DB->bind(':time5',$data['time5']);
        }
        

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function applyForJob($data){
        $this->DB->sql('UPDATE advertisement SET no_of_responds=no_of_responds+1 WHERE ref_no=:refNo');
        $this->DB->bind(':refNo',$data['refNo']);

        $this->DB->execute();

        $this->DB->sql('INSERT INTO ad_responses (ref_no,cand_username) VALUES (:refNo,:uname)');
        $this->DB->bind(':uname',$data['uname']);
        $this->DB->bind(':refNo',$data['refNo']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function hireRec($data){
        $this->DB->sql('INSERT INTO org_hire_rec (rec_username,org_username,hire_date,description) VALUES (:recUname,:orgUname,:date,:desc)');
        $this->DB->bind(':recUname',$data['recUname']);
        $this->DB->bind(':orgUname',$data['orgUname']);
        $this->DB->bind(':date',$data['date']);
        $this->DB->bind(':desc',$data['hireRecDesc']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function reportCand($data){
        $this->DB->sql('INSERT INTO account_reports (reporting_user_username,reported_user_username,subject,description,date_reported)
        VALUES (:orgUname,:candUname,:sub,:desc,:date);');

        $this->DB->bind(':orgUname',$data['orgUname']);
        $this->DB->bind(':candUname',$data['candUname']);
        $this->DB->bind(':sub',$data['sub']);
        $this->DB->bind(':desc',$data['desc']);
        $this->DB->bind(':date',$data['date']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function orgCancelJobReqCand($data){
        $this->DB->sql('DELETE FROM org_send_job_req_cand WHERE org_username = :orgUname AND cand_username = :candUname');

        $this->DB->bind(':orgUname',$data['orgUname']);
        $this->DB->bind(':candUname',$data['candUname']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function removeInter($uname){
        $this->DB->sql('DELETE FROM users WHERE username = :uname');

        $this->DB->bind(':uname',$uname);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function candAcceptOrgReq($id){
        $this->DB->sql('UPDATE `org_send_job_req_cand` SET `status` = "Accepted" WHERE `org_send_job_req_cand`.`id` = :id;');
        $this->DB->bind(':id',$id);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function candDeclineOrgReq($id){
        $this->DB->sql('UPDATE `org_send_job_req_cand` SET `status` = "Declined" WHERE `org_send_job_req_cand`.`id` = :id;');
        $this->DB->bind(':id',$id);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function unpublishAd($refNo){
        $this->DB->sql('UPDATE advertisement SET status="Unpublished" WHERE ref_no = :refNo');
        $this->DB->bind(':refNo',$refNo);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function republishAd($refNo,$fromDate){
        $this->DB->sql('UPDATE advertisement SET status="Published", from_date = :fromDate WHERE ref_no = :refNo');
        $this->DB->bind(':refNo',$refNo);
        $this->DB->bind(':fromDate',$fromDate);

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
        INNER JOIN organization ON advertisement.org_username = organization.org_username AND advertisement.ad_title LIKE \'%'.$term.'%\' OR advertisement.description LIKE \'%'.$term.'%\' OR advertisement.job_title LIKE \'%'.$term.'%\' GROUP BY advertisement.ref_no');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    // public function searchCand($term){
    //     $this->DB->sql('SELECT * FROM candidate WHERE cand_username IN (SELECT cand_username FROM interested_job_position WHERE job_position LIKE \'%'.$term.'%\' );');

    //     $rows = $this->DB->multiple();

    //     if($this->DB->rowCount()>0){
    //         return $rows;
    //     }else{
    //         return false;
    //     }
    // }

    // public function searchJobPos(){
    //     $this->DB->sql('SELECT * FROM interested_job_position');

    //     $rows = $this->DB->multiple();

    //     if($this->DB->rowCount()>0){
    //         return $rows;
    //     }else{
    //         return false;
    //     }
    // }

    public function searchSpecArea(){
        $this->DB->sql('SELECT * FROM rec_specialized_in');

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
        $this->DB->sql('SELECT hire_request.* ,organization.company_name, organization.email, organization.telephone_no FROM hire_request INNER JOIN organization ON hire_request.org_username = organization.org_username AND hire_request.rec_username=:uname');
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
    public function validatePWDAdmin($username,$password){
        $row = $this->findAdmin($username);

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