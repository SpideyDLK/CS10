<?php

require_once '../libraries/db.php';

class searchModel{
    private $DB;

    public function __construct(){
        $this->DB = new db;
    }

   public function searchJobPos($searchTerm){
        $this->DB->sql('SELECT DISTINCT job_position FROM job_position_search_count WHERE job_position LIKE :searchTerm');

        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function searchSkill($searchTerm){
        $this->DB->sql('SELECT DISTINCT skill FROM skill_search_count WHERE skill LIKE :searchTerm');

        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function compSuggestions($searchTerm){
        $this->DB->sql('SELECT DISTINCT current_company FROM candidate WHERE current_company LIKE :searchTerm');

        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function desigSuggestions($searchTerm){
        $this->DB->sql('SELECT DISTINCT current_designation FROM candidate WHERE current_designation LIKE :searchTerm');

        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function uniSuggestions($searchTerm){
        $this->DB->sql('SELECT DISTINCT uniName FROM unis_and_degrees WHERE uniName LIKE :searchTerm');

        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function degSuggestions($searchTerm,$uni,$loe){
        $this->DB->sql('SELECT DISTINCT degTitle, uniName FROM unis_and_degrees WHERE uniName = :uni AND type = :loe AND degTitle LIKE :searchTerm ');

        $this->DB->bind(':searchTerm',$searchTerm);
        $this->DB->bind(':uni',$uni);
        $this->DB->bind(':loe',$loe);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }

   public function mostSearchedSkill(){
        $this->DB->sql('SELECT * FROM `skill_search_count` ORDER BY search_count DESC LIMIT 5;');
        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function mostSearchedJobs(){
        $this->DB->sql('SELECT * FROM `job_position_search_count` ORDER BY search_count DESC LIMIT 5;');
        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
   }
   public function searchCand($term){
    $this->DB->sql('SELECT * FROM skill_search_count WHERE skill = :term');
    $this->DB->bind(':term',$term);

    $rows = $this->DB->single();
    if($this->DB->rowCount()>0){
        $this->DB->sql('UPDATE skill_search_count SET search_count = search_count+1 WHERE skill=:term');
        $this->DB->bind(':term',$term);
        $this->DB->execute();
    }

    $this->DB->sql('SELECT * FROM job_position_search_count WHERE job_position = :term');
    $this->DB->bind(':term',$term);

    $rows = $this->DB->single();
    if($this->DB->rowCount()>0){
        $this->DB->sql('UPDATE job_position_search_count SET search_count = search_count+1 WHERE job_position=:term');
        $this->DB->bind(':term',$term);
        $this->DB->execute();
    }

    $this->DB->sql('SELECT * FROM candview WHERE jobPos LIKE :term OR skills LIKE :term');
    $this->DB->bind(':term','%'.$term.'%');

    $rows = $this->DB->multiple();

    if($this->DB->rowCount()>0){
        return $rows;
    }else{
        return false;
    }
    }

    public function searchVacancy($term){
        $this->DB->sql('SELECT * FROM skill_search_count WHERE skill = :term');
        $this->DB->bind(':term',$term);
    
        $rows = $this->DB->single();
        if($this->DB->rowCount()>0){
            $this->DB->sql('UPDATE skill_search_count SET search_count = search_count+1 WHERE skill=:term');
            $this->DB->bind(':term',$term);
            $this->DB->execute();
        }
    
        $this->DB->sql('SELECT * FROM job_position_search_count WHERE job_position = :term');
        $this->DB->bind(':term',$term);
    
        $rows = $this->DB->single();
        if($this->DB->rowCount()>0){
            $this->DB->sql('UPDATE job_position_search_count SET search_count = search_count+1 WHERE job_position=:term');
            $this->DB->bind(':term',$term);
            $this->DB->execute();
        }
    
        $this->DB->sql('SELECT * FROM vacancyview WHERE (job_title LIKE :term OR skills LIKE :term) AND status="Published"');
        $this->DB->bind(':term','%'.$term.'%');
    
        $rows = $this->DB->multiple();
    
        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function getAllUnis(){
        $this->DB->sql('SELECT DISTINCT uniName FROM unis_and_degrees');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function filterRes($searchTerm,$workEx,$loe,$cv,$dis,$city,$uni){
        $sql = "SELECT * FROM candView WHERE (jobPos LIKE :term OR skills LIKE :term) ";
        if($workEx){
            $sql .= "AND work_experience = :workEx ";
        }
        if($loe){
            $sql .= "AND level_of_education = :loe ";
        }
        if($uni){
            $sql .= "AND uni_or_institute = :uni ";
        }
        if($cv==true){
            $sql .= "AND cv_file IS NOT NULL ";
        }
        if($dis){
            $sql .= "AND district = :dis ";
        }
        if($city){
            $sql .= "AND city = :city ";
        }
        
        $this->DB->sql($sql);
        if($workEx){
            $this->DB->bind(':workEx',$workEx);
        }
        if($loe){
            $this->DB->bind(':loe',$loe);
        }
        if($uni){
            $this->DB->bind(':uni',$uni);
        }
        if($dis){
            $this->DB->bind(':dis',$dis);
        }
        if($city){
            $this->DB->bind(':city',$city);
        }
        
        $this->DB->bind(':term','%'.$searchTerm.'%');
        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function filterResVacancy($searchTerm,$jobType,$salFreq,$salary){
        $sql = "SELECT * FROM vacancyview WHERE (job_title LIKE :term OR skills LIKE :term) AND status='Published' ";
        if($jobType){
            $sql .= "AND job_type = :jobType ";
        }
        if($salFreq){
            $sql .= "AND frequency = :freq ";
        }
        if($salary){
            $sql .= "AND rate <= :salary ";
        }
        
        $this->DB->sql($sql);
        if($jobType){
            $this->DB->bind(':jobType',$jobType);
        }
        if($salFreq){
            $this->DB->bind(':freq',$salFreq);
        }
        if($salary){
            $this->DB->bind(':salary',$salary);
        }
        
        $this->DB->bind(':term','%'.$searchTerm.'%');
        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function filterResCand($workEx,$loe,$cv,$dis,$city,$uni){
        $sql = "SELECT * FROM candView ";
        if($workEx){
            $sql .= "AND work_experience = :workEx ";
        }
        if($loe){
            $sql .= "AND level_of_education = :loe ";
        }
        if($uni){
            $sql .= "AND uni_or_institute = :uni ";
        }
        if($cv==true){
            $sql .= "AND cv_file IS NOT NULL ";
        }
        if($dis){
            $sql .= "AND district = :dis ";
        }
        if($city){
            $sql .= "AND city = :city ";
        }
        
        $this->DB->sql($sql);
        if($workEx){
            $this->DB->bind(':workEx',$workEx);
        }
        if($loe){
            $this->DB->bind(':loe',$loe);
        }
        if($uni){
            $this->DB->bind(':uni',$uni);
        }
        if($dis){
            $this->DB->bind(':dis',$dis);
        }
        if($city){
            $this->DB->bind(':city',$city);
        }
        

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }


    public function viewCand($uName){
        $this->DB->sql('SELECT * FROM candview WHERE cand_username = :uname');
        $this->DB->bind(':uname',$uName);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    

    public function viewAd($refNo){
        $this->DB->sql('UPDATE advertisement SET no_of_views=no_of_views+1 WHERE ref_no=:refNo');
        $this->DB->bind(':refNo',$refNo);

        $this->DB->execute();

        $this->DB->sql('SELECT * FROM vacancyview WHERE ref_no = :refNo');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function getCV($uName){
        $this->DB->sql('SELECT * FROM cv_files WHERE cand_username = :uname');
        $this->DB->bind(':uname',$uName);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function getFlyer($refNo){
        $this->DB->sql('SELECT * FROM ad_flyers WHERE ref_no = :refNo');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function jobReqExist($candUname,$orgUname){
        $this->DB->sql('SELECT * FROM org_send_job_req_cand WHERE cand_username = :candUname AND org_username = :orgUname');
        $this->DB->bind(':candUname',$candUname);
        $this->DB->bind(':orgUname',$orgUname);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function alreadyApplied($refNo,$candUname){
        $this->DB->sql('SELECT * FROM ad_responses WHERE cand_username = :candUname AND ref_no = :refNo');
        $this->DB->bind(':candUname',$candUname);
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function jobReqCountAll($uName){
        $this->DB->sql('SELECT COUNT(*) AS count FROM org_send_job_req_cand WHERE org_username=:uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function jobReqCountWithFilter($uName,$status){
        $this->DB->sql('SELECT COUNT(*) AS count FROM org_send_job_req_cand WHERE status=:status AND org_username = :uName');
        $this->DB->bind(':uName',$uName);
        $this->DB->bind(':status',$status);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function allJobReqs($uName){
        $this->DB->sql('SELECT * FROM job_requests_view WHERE org_username=:uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function JobReqsFiltered($uName,$status){
        $this->DB->sql('SELECT * FROM job_requests_view WHERE org_username=:uName AND status=:status');
        $this->DB->bind(':uName',$uName);
        $this->DB->bind(':status',$status);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }


    public function viewMyAds($uName){
        $this->DB->sql('SELECT * FROM advertisement WHERE org_username=:uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function editAd($refNo){
        $this->DB->sql('SELECT * FROM advertisement WHERE ref_no=:refNo');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function listInterviewers($uName){
        $this->DB->sql('SELECT * FROM interviewer WHERE org_username = :uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function CandAllJobReqs($uName){
        $this->DB->sql('SELECT * FROM job_requests_view WHERE cand_username=:uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function viewJobReqCand($id){
        $this->DB->sql('UPDATE org_send_job_req_cand SET status="Viewed" WHERE id=:id AND status = "Pending"');
        $this->DB->bind(':id',$id);

        $this->DB->execute();

        $this->DB->sql('SELECT * FROM job_requests_view WHERE id=:id');
        $this->DB->bind(':id',$id);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function viewAllUsers(){
        $this->DB->sql('SELECT * FROM users');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function getInterviewers($uname){
        $this->DB->sql('SELECT * FROM interviewer WHERE org_username=:uname');
        $this->DB->bind(':uname',$uname);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function viewAllRecs(){
        $this->DB->sql('SELECT * FROM recview');

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function viewFilteredRecs($searchTerm){
        $this->DB->sql('SELECT * FROM recview WHERE specialized_areas LIKE :searchTerm');
        $this->DB->bind(':searchTerm',$searchTerm);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function isHired($recUname,$orgUname){
        $this->DB->sql('SELECT * FROM org_hire_rec WHERE rec_username = :recUname AND org_username = :orgUname');
        $this->DB->bind(':recUname',$recUname);
        $this->DB->bind(':orgUname',$orgUname);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function viewResponses($refNo){
        $this->DB->sql('SELECT * FROM ad_responses_view WHERE ref_no = :refNo');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }

    }

    public function listSchedules($uname){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE org_username = :orgUname ORDER BY date');
        $this->DB->bind(':orgUname',$uname);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    
    public function recReschedInter($refNo){
        $this->DB->sql('SELECT date,time,link FROM  interviews WHERE ref_no=:refNo');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function recViewInter($uName){
        $this->DB->sql('SELECT * FROM interviews WHERE rec_username=:uName');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }

    public function recOrgList($uName){
        $this->DB->sql('SELECT organization.company_name, org_hire_rec.description  FROM organization INNER JOIN org_hire_rec ON organization.org_username = org_hire_rec.org_username WHERE rec_username = :uname ORDER BY hire_date DESC');
        $this->DB->bind(':uname',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function recViewOrgList($uName){
        $this->DB->sql('SELECT organization.company_name, org_hire_rec.description  FROM organization INNER JOIN org_hire_rec ON organization.org_username = org_hire_rec.org_username WHERE rec_username = :uname ORDER BY hire_date DESC');
        $this->DB->bind(':uname',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    
}