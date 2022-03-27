<?php

require_once '../libraries/db.php';

class intModel{
    private $DB;

    public function __construct(){
        $this->DB = new db;
    }

    public function listInterviews($uName){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE int_username = :uName AND status="pending"');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function finishedList($uName){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE int_username = :uName AND status="finished"');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function isFinished($refNo){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE ref_no = :refNo AND status="finished"');
        $this->DB->bind(':refNo',$refNo);

        $rows = $this->DB->single();

        if($this->DB->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function selectedList($uName){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE int_username = :uName AND status="selected"');
        $this->DB->bind(':uName',$uName);

        $rows = $this->DB->multiple();

        if($this->DB->rowCount()>0){
            return $rows;
        }else{
            return false;
        }
    }
    public function select($data){
        $this->DB->sql('UPDATE interviews SET  status=:selected WHERE ref_no = :refNo');
        
        $this->DB->bind(':refNo',$data['refNo']);
        $this->DB->bind(':selected',$data['selected']);
       

        if($this->DB->execute()){
            return true;
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

    public function viewFeedback($uName){
        $this->DB->sql('SELECT * FROM interview_schedule_view WHERE cand_username = :uname');
        $this->DB->bind(':uname',$uName);

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
    public function rescheIntInterviwer($data){
        $this->DB->sql('UPDATE interviews SET  date=:date,time=:time,link=:link WHERE ref_no = :refNo');
        
        $this->DB->bind(':refNo',$data['refNo']);
        $this->DB->bind(':date',$data['date']);
        $this->DB->bind(':time',$data['time']);
        $this->DB->bind(':link',$data['link']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function ratingFeedback($data){
        $this->DB->sql('UPDATE interviews SET  rate=:rate,status=:status,feedback=:feedback WHERE ref_no = :refNo');
        
        $this->DB->bind(':refNo',$data['refNo']);
        $this->DB->bind(':rate',$data['rate']);
        $this->DB->bind(':status',$data['status']);
        $this->DB->bind(':feedback',$data['feedback']);

        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }

  /*  public function rate($data,$intuName){
        $this->DB->sql('INSERT INTO inter_feedback(cand_username,inter_username,rating)
         VALUES (:intuName,:cand_username,:ratedIndex)');

        $this->DB->bind(':intuName',$intuName);
        $this->DB->bind(':cand_username',$data['cand_username']);
        $this->DB->bind(':ratedIndex',$data['ratedIndex']);
       
        if($this->DB->execute()){
            return true;
        }else{
            return false;
        }
    }*/


}