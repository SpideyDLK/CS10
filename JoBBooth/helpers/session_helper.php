<?php
if(!isset($_SESSION)){
    session_start();
}

function redirect($location){
    header("location: ".$location);
    exit();
}

function printTable($rows){
    if(count($rows)==0){
        echo '<div id="searchResults" align="center"><i>No results</i></div>';
    }
    else{
        echo '<div class="searchResults" id="searchResults">
    <table class="searchResultsTable" id="searchResultsTable">
    <tr>
      <th>Profile Photo</th>
      <th>Organization Name</th>
      <th>Job Position</th>
      <th></th>
    </tr>';
    for($x=0 ; $x<count($rows) ; $x++){
        echo '<tr>
        <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
        <td>'.$rows[$x]->company_name.'</td>
        <td>'.$rows[$x]->job_title.'</td>
        <td><a href="../views/ad_view_cand.php?adNo='.$x.'">View Job</a></td>
      </tr>';
    }
    echo '</table> </div>';

    }
    
}

function printTableRec($rows){
    if(count($rows)==0){
        echo '<div id="searchResults" align="center"><i>No results</i></div>';
    }
    else{
        echo '<div class="searchResults" id="searchResults">
    <table class="searchResultsTable" id="searchResultsTable">
    <tr>
      <th>Agency Reg. No.</th>
      <th>Agency Name</th>
      <th>Email</th>
      <th>Contact No.</th>
      <th>Rating</th>
    </tr>';
    for($x=0 ; $x<count($rows) ; $x++){
        echo '<tr>
        <td>'.$rows[$x]->agency_reg_no.'</td>
        <td>'.$rows[$x]->agency_name.'</td>
        <td>'.$rows[$x]->email.'</td>
        <td>'.$rows[$x]->contact_no.'</td>
        <td>'.$rows[$x]->average_rating.'</td>
        <td><a href="#">Hire</a></td>
      </tr>';
    }
    echo '</table> </div>';

    }
    
}

function viewMyAds($rows){
    if(count($rows)==0){
        echo '<div align="center"><i>No ads to show</i></div>';
    }
    else{
        echo '<div class="myAds">
        <table class="myAdsTable">
            <tr>
              <th>Ref. No.</th>
              <th>Title</th>
              <th></th>
              <th></th>
            </tr>';
        for($x=0 ; $x<count($rows) ; $x++){
        echo '<tr>
        <td>'.$rows[$x]->ref_no.'</td>
        <td>'.$rows[$x]->ad_title.'</td>
        <td><a href="#">Edit</a></td>
        <td><a href="">Unpublish</a></td>
        </tr>';
        
    }
    echo '</table> </div>';
    }
}

function viewIntList($rows){
    if(count($rows)==0){
        echo '<div align="center"><i>No interviewers registered</i></div>';
    }
    else{
        echo '<div class="intList">
        <table class="intListTable">
            <tr>
              <th>Name</th>
              <th>NIC</th>
              <th>Email</th>
              <th>Contact No.</th>
              <th></th>
            </tr>';
        for($x=0 ; $x<count($rows) ; $x++){
        echo '<tr>
        <td>'.$rows[$x]->name.'</td>
        <td>'.$rows[$x]->nic.'</td>
        <td>'.$rows[$x]->email.'</td>
        <td>'.$rows[$x]->contact_no.'</td>
        <td><a  href="#">Remove</a></td>
        </tr>';
    }
    echo '</table> </div>';
    }
}

function loadJobReq($rows){
    if(count($rows)==0){
        echo '<div align="center"><i>No job requests</i></div>';
    }
    else{
        echo '<div class="pendingJobAppContainer">
        <table class="pendingJobApp">
            <tr>
              <th>Profile Photo</th>
              <th>Organization Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Description</th>
              <th></th>
            </tr>';
        for($x=0 ; $x<count($rows) ; $x++){
        echo '<tr>
        <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
        <td>'.$rows[$x]->company_name.'</td>
        <td>'.$rows[$x]->email.'</td>
        <td>'.$rows[$x]->telephone_no.'</td>
        <td>'.$rows[$x]->description.'</td>
        <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
      </tr>';
    }
    echo '</table> </div>';
    }
}

function viewFullAd($adNo,$rows){
    echo '<script>
    function viewFullAdd(){
        document.getElementById("orgName-viewAd").innerHTML = "'.$rows[$adNo]->company_name.'";
        document.getElementById("Desc-viewAd").innerHTML = "'.$rows[$adNo]->description.'";
        document.getElementById("jobPos-viewAd").innerHTML = "'.$rows[$adNo]->job_title.'";
        document.getElementById("salary-viewAd").innerHTML = "'.$rows[$adNo]->rate.' LKR '.$rows[$adNo]->frequency.'";
    }
</script>';
}

function popUp($name = '', $message = '', $class = 'popUp'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }else if(empty($message) && !empty($_SESSION[$name])){
            echo '<div id="popup" class="'.$class.' '.$name.'" >'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
            return true;
        }
    }
}