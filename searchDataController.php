<?php 

require_once '../models/searchModel.php';
require_once '../helpers/session_helper.php';

class userController{
    private $searchM;

    public function __construct(){
        $this->searchM = new searchModel;
    }

    public function searchCandSuggestions(){
        
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rowsJobPos = $this->searchM->searchJobPos($searchTerm);
        $rowsSkill = $this->searchM->searchSkill($searchTerm);

        if(!($rowsJobPos)&&!($rowsSkill)){
            echo "<p>No matches found</p>";
        }
        else{
            if($rowsJobPos){
                for($x=0 ; $x<count($rowsJobPos) ; $x++){
                    echo "<p>".$rowsJobPos[$x]->job_position." <i>(Job Position)</i></p>";
                }
            }
            if($rowsSkill){
                for($x=0 ; $x<count($rowsSkill) ; $x++){
                    echo "<p>".$rowsSkill[$x]->skill." <i>(Skill)</i></p>";
                }
            }
        }
    }

    public function searchVacancySuggestions(){
        
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rowsJobPos = $this->searchM->searchJobPos($searchTerm);
        $rowsSkill = $this->searchM->searchSkill($searchTerm);

        if(!($rowsJobPos)&&!($rowsSkill)){
            echo "<p>No matches found</p>";
        }
        else{
            if($rowsJobPos){
                for($x=0 ; $x<count($rowsJobPos) ; $x++){
                    echo "<p>".$rowsJobPos[$x]->job_position." <i>(Job Position)</i></p>";
                }
            }
            if($rowsSkill){
                for($x=0 ; $x<count($rowsSkill) ; $x++){
                    echo "<p>".$rowsSkill[$x]->skill." <i>(Skill)</i></p>";
                }
            }
        }
    }

    public function tags1Suggestions(){
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rows = $this->searchM->searchJobPos($searchTerm);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->job_position."</p>";
            }
        }

    }
    public function tags2Suggestions(){
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rows = $this->searchM->searchSkill($searchTerm);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->skill."</p>";
            }
        }

    }
    public function compSuggestions(){
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rows = $this->searchM->compSuggestions($searchTerm);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->current_company."</p>";
            }
        }

    }
    public function desigSuggestions(){
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rows = $this->searchM->desigSuggestions($searchTerm);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->current_designation."</p>";
            }
        }

    }
    public function uniSuggestions(){
        if(isset($_REQUEST["term"])){
            $searchTerm = $_REQUEST["term"] . '%';
        }
        $rows = $this->searchM->uniSuggestions($searchTerm);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->uniName."</p>";
            }
        }

    }
    public function degSuggestions(){
        if(isset($_REQUEST["term"])&&isset($_REQUEST["uni"])&&isset($_REQUEST["loe"])){
            $searchTerm = '%' . $_REQUEST["term"] . '%';
            $uni = $_REQUEST["uni"];
            $loe = $_REQUEST["loe"];
        }
        $rows = $this->searchM->degSuggestions($searchTerm,$uni,$loe);

        if(!($rows)){
            echo "";
        }
        else{
            for($x=0 ; $x<count($rows) ; $x++){
                echo "<p>".$rows[$x]->degTitle."</p>";
            }
        }

    }

    public function mostSearchedSkills(){
        $rows = $this->searchM->mostSearchedSkill();
        if(!($rows)){
            echo "";
        }
        else{
            echo "<p><i class='fas fa-clipboard-list'></i>&nbsp;&nbsp;Most Searched Skills: ";
            for($x=0; $x<count($rows);$x++){
                echo "<button type='button'>".$rows[$x]->skill."</button> ";
            }
            echo "</p>";
        }
    }
    public function mostSearchedJobs(){
        $rows = $this->searchM->mostSearchedJobs();
        if(!($rows)){
            echo "";
        }
        else{
            echo "<p><i class='fas fa-briefcase'></i>&nbsp;Most Searched Job Positions: ";
            for($x=0; $x<count($rows);$x++){
                echo "<button type='button'>".$rows[$x]->job_position."</button> ";
            }
            echo "</p>";
        }
    }

    public function orgSearchingCand(){
            unset($_SESSION['searchRes']);
            unset($_SESSION['searchTerm']);
            unset($_SESSION['allUnis']);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $searchTerm = trim($_POST['searchTerm']);
            $_SESSION['searchTerm'] = $searchTerm;
    
            $rows = $this->searchM->searchCand($searchTerm);
            $rows2 = $this->searchM->getAllUnis();
            $_SESSION['allUnis'] = $rows2;

            $empty_row = [];
            if(!($rows)){
                $_SESSION['searchRes'] = $empty_row;
                redirect("../views/org_searching_cand_results.php");
            }else{
                $_SESSION['searchRes'] = $rows;
                redirect("../views/org_searching_cand_results.php");
            }
    
    }

    public function candSearchingVacancy(){
        unset($_SESSION['searchRes']);
        unset($_SESSION['searchTerm']);
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = trim($_POST['searchTerm']);
        $_SESSION['searchTerm'] = $searchTerm;

        $rows = $this->searchM->searchVacancy($searchTerm);

        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchRes'] = $empty_row;
            redirect("../views/cand_searching_vac_results.php");
        }else{
            $_SESSION['searchRes'] = $rows;
            redirect("../views/cand_searching_vac_results.php");
        }

    }


    public function recSearchingCand(){
        unset($_SESSION['searchRes']);
        unset($_SESSION['searchTerm']);
        unset($_SESSION['allUnis']);
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $searchTerm = trim($_POST['searchTerm']);
        $_SESSION['searchTerm'] = $searchTerm;

        $rows = $this->searchM->searchCand($searchTerm);
        $rows2 = $this->searchM->getAllUnis();
        $_SESSION['allUnis'] = $rows2;

        $empty_row = [];
        if(!($rows)){
            $_SESSION['searchRes'] = $empty_row;
            redirect("../views/rec_searching_cand_results.php");
        }else{
            $_SESSION['searchRes'] = $rows;
            redirect("../views/rec_searching_cand_results.php");
        }

}

    public function filterRes(){
        // if(isset($_REQUEST["workEx"])){
            $workEx = $_REQUEST["workEx"];
            $loe = $_REQUEST["loe"];
            $uni = $_REQUEST["uni"];
            $cv = false;
            $dis = $_REQUEST["dis"];
            $city = $_REQUEST["city"];
            $searchTerm = $_SESSION['searchTerm'];
            if(isset($_REQUEST["cv"])){
               $cv = true;
            }

            $rows = $this->searchM->filterRes($searchTerm,$workEx,$loe,$cv,$dis,$city,$uni);

        if(!($rows)){
            echo "<div class='noResult'><img id='noResult' src='../material/images/no-result.png'></div>";
        }
        else{
            for ($x=0;$x<count($rows);$x++){
                echo '<div class="candSearchResContOrgHome">
                <form method="POST" action="view_cand_org.php" target="_blank">
                    <input type="hidden" name="uName" value="'.$_SESSION['searchRes'][$x]->cand_username.'">
                </form>
                <div class="pp">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows[$x]->profile_photo).'"/>
                <p>'.$rows[$x]->first_name.' '.$rows[$x]->last_name.'</p>
                </div>
                <table class="det">
                  <tr>
                  <td class="title"><i class="fas fa-briefcase"></i> Job Positions </td><td>'.$rows[$x]->jobPos.'</td>
                    </tr>
                  <tr>
                  <td class="title"><i class="fas fa-clipboard-list"></i> Skills </td><td>'.$rows[$x]->skills.'</td>
                  </tr>
                  <tr>
                  <td class="title"><i class="fas fa-user-graduate"></i> Education </td><td>'.$rows[$x]->level_of_education.'</td>
                  </tr>
                  <tr>
                          <td class="title"><i class="fas fa-university"></i> University/Institute </td><td>';
                          if($rows[$x]->uni_or_institute){
                              echo ''.$rows[$x]->uni_or_institute.'</td>';
                          }else{
                            echo '-NA-</td>';
                          }
                          echo '
                          </tr>
                  <tr>
                  <td class="title"><i class="fas fa-map-marker-alt"></i> Location </td><td>'.$rows[$x]->city.', '.$rows[$x]->district.'</tr>
                  <tr>
                  <td class="title"><i class="fas fa-business-time"></i> Working Experience </td><td>'.$rows[$x]->work_experience.'</td>
                  </tr>
                </table>
                </div>
                <script>
                $(".candSearchResContOrgHome").on("click",function(){
                    $(this).children("form").submit();
                });
                </script>
                ';
            }
        }

        // }
    }

    
    public function filterResVacancy(){
        $jobType = $_REQUEST["jobType"];
        $salFreq = $_REQUEST["salFreq"];
        if(isset($_REQUEST["salary"])){
            $salary = $_REQUEST["salary"];
        }
        else{
            $salary = NULL;
        }
        $searchTerm = $_SESSION['searchTerm'];

        $rows = $this->searchM->filterResVacancy($searchTerm,$jobType,$salFreq,$salary);

        if(!($rows)){
            echo "<div class='noResult'><img id='noResult' src='../material/images/no-result.png'></div>";
        }
        else{
            for ($x=0;$x<count($rows);$x++){
                echo '<div class="candSearchResContOrgHome">
                <form method="POST" action="view_cand_org.php" target="_blank">
                <input type="hidden" name="refNo" value="'.$rows[$x]->ref_no.'">
                </form>
                <div class="pp">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows[$x]->profile_photo).'"/>
                <p>'.$rows[$x]->company_name.'</p>
                </div>
                <table class="det">
                  <tr>
                  <td class="title"><i class="fas fa-briefcase"></i> Job Position </td><td>'.$rows[$x]->job_title.'</td>
                    </tr>
                  <tr>
                  <td class="title"><i class="fas fa-tasks"></i> Required Skills </td><td>'.$rows[$x]->skills.'</td>
                    </tr>
                  <tr>
                  <td class="title"><i class="fas fa-briefcase"></i> Job Type </td><td>'.$rows[$x]->job_type.'</td>
                  </tr>
                  <tr>
                  <td class="title"><i class="fas fa-coins"></i> Salary </td><td>'.$rows[$x]->rate.' LKR '.$rows[$x]->frequency.'</td>
                  </tr>
                  
                  
                </table>
                </div>';
            }
        }
    }

    public function filterResCand(){
            $workEx = $_REQUEST["workEx"];
            $loe = $_REQUEST["loe"];
            $uni = $_REQUEST["uni"];
            $cv = false;
            $dis = $_REQUEST["dis"];
            $city = $_REQUEST["city"];
            if(isset($_REQUEST["cv"])){
               $cv = true;
            }

            $rows = $this->searchM->filterResCand($workEx,$loe,$cv,$dis,$city,$uni);

        if(!($rows)){
            echo "<div class='noResult'><img id='noResult' src='../material/images/no-result.png'></div>";
        }
        else{
            for ($x=0;$x<count($rows);$x++){
                echo '<div class="candSearchResContOrgHome">
                <form method="POST" action="view_cand_list_rec.php" target="_blank">
                    <input type="hidden" name="uName" value="'.$rows[$x]->cand_username.'">
                </form>
                <div class="pp">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows[$x]->profile_photo).'"/>
                <p>'.$rows[$x]->first_name.' '.$rows[$x]->last_name.'</p>
                </div>
                <table class="det">
                  <tr>
                  <td class="title"><i class="fas fa-briefcase"></i> Job Positions </td><td>'.$rows[$x]->jobPos.'</td>
                    </tr>
                  <tr>
                  <td class="title"><i class="fas fa-clipboard-list"></i> Skills </td><td>'.$rows[$x]->skills.'</td>
                  </tr>
                  <tr>
                  <td class="title"><i class="fas fa-user-graduate"></i> Education </td><td>'.$rows[$x]->level_of_education.'</td>
                  </tr>
                  <tr>
                          <td class="title"><i class="fas fa-university"></i> University/Institute </td><td>';
                          if($rows[$x]->uni_or_institute){
                              echo ''.$rows[$x]->uni_or_institute.'</td>';
                          }else{
                            echo '-NA-</td>';
                          }
                          echo '
                          </tr>
                  <tr>
                  <td class="title"><i class="fas fa-map-marker-alt"></i> Location </td><td>'.$rows[$x]->city.', '.$rows[$x]->district.'</tr>
                  <tr>
                  <td class="title"><i class="fas fa-business-time"></i> Working Experience </td><td>'.$rows[$x]->work_experience.'</td>
                  </tr>
                </table>
                </div>
                <script>
                $(".candSearchResContOrgHome").on("click",function(){
                    $(this).children("form").submit();
                });
                </script>
                ';
            }
        }

        // }
    }

    public function viewCand(){
        if(isset($_REQUEST["uName"])){
            unset($_SESSION['cvDetails']);
            $uName = $_REQUEST["uName"];
            $rows = $this->searchM->viewCand($uName);
            $cv = $this->searchM->getCV($uName);
            $jobReqExist = $this->searchM->jobReqExist($uName,$_SESSION['username']);

            if($cv){
                $_SESSION['cvDetails'] = $cv;
            }

            if($rows){
                echo '<div class="col1-viewAd">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows->profile_photo).'"/>';
                if($cv){
                    echo '<br>
                    <a id="cvDownBtn"  href="../helpers/downloadCV.php"><i class="fas fa-download"></i> Download CV</a>';
                }

                
        echo '
        <p onclick="openReportForm()" class="reportBtn"><i class="fas fa-flag"></i> Report</p>
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Personal Details</legend>
            <div class="persDet-viewCand" id="persDet-viewCand">
                <table class="viewCand-table">
                <tr>
                <td class="icons"><i class="fas fa-signature"></i></td><td class="title">Name: </td><td>'.$rows->first_name. ' '.$rows->last_name.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">District: </td><td>'.$rows->district.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">City: </td><td>'.$rows->city.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-at"></i></td><td class="title">E-mail: </td><td>'.$rows->email.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-phone"></i></td><td class="title">Contact No.: </td><td>'.$rows->contact_no.'</td>
                </tr>
                </table>
            </div>
            </fieldset>
            
            <fieldset>
                <legend>Professional Details</legend>
            <div>
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-business-time"></i></td><td class="title">Work Experience: </td><td>'.$rows->work_experience.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-building"></i></td><td class="title">Current Company: </td><td>';
                if($rows->current_company){
                    echo ''.$rows->current_company.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Current Designation: </td><td>';
                if($rows->current_designation){
                    echo ''.$rows->current_designation.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
            </table>
            </div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Interested Job Position(s)</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->jobPos.'
                
            </div>
            </fieldset>
            <fieldset>
                <legend>Skills</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->skills.'
                
            </div>
            </fieldset>

            <fieldset>
                <legend>Education</legend>
            <div  id="lvlEdu-viewCand">
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-user-graduate"></i></td><td>'.$rows->level_of_education.'</td>
                </tr>
                ';
                if($rows->level_of_education != "G.C.E. Ordinary Level" && $rows->level_of_education != "G.C.E. Advanced Level"){
                    echo '
                    <tr>
                    <td class="icons"><i class="fas fa-graduation-cap"></i></td><td>'.$rows->deg_cert_or_dip_title.'</td>
                    </tr>
                    <tr>
                    <td class="icons"><i class="fas fa-university"></i></td><td>'.$rows->uni_or_institute.'</td>
                    </tr>';
                }
                echo '
            </table>
            </div>
            </fieldset>';
            if($jobReqExist){
                echo '<button class="cancelReqBtn-viewCand" onclick="openAlert()" type="submit">CANCEL JOB REQUEST</button>';
            }else{
                echo '<button class="sendReqBtn-viewCand" onclick="openForm()" type="submit">SEND JOB REQUEST</button>';
            }
            echo '
        </div>
        
        
        ';
            }
        }
    }

    public function viewCandRec(){
        if(isset($_REQUEST["uName"])){
            unset($_SESSION['cvDetails']);
            $uName = $_REQUEST["uName"];
            $rows = $this->searchM->viewCand($uName);
            $cv = $this->searchM->getCV($uName);
            $jobReqExist = $this->searchM->jobReqExist($uName,$_SESSION['username']);

            if($cv){
                $_SESSION['cvDetails'] = $cv;
            }

            if($rows){
                echo '<div class="col1-viewAd">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows->profile_photo).'"/>';
                if($cv){
                    echo '<br>
                    <a id="cvDownBtn"  href="../helpers/downloadCV.php"><i class="fas fa-download"></i> Download CV</a>';
                }

                
        echo '
        <p onclick="openReportForm()" class="reportBtn"><i class="fas fa-flag"></i> Report</p>
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Personal Details</legend>
            <div class="persDet-viewCand" id="persDet-viewCand">
                <table class="viewCand-table">
                <tr>
                <td class="icons"><i class="fas fa-signature"></i></td><td class="title">Name: </td><td>'.$rows->first_name. ' '.$rows->last_name.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">District: </td><td>'.$rows->district.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">City: </td><td>'.$rows->city.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-at"></i></td><td class="title">E-mail: </td><td>'.$rows->email.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-phone"></i></td><td class="title">Contact No.: </td><td>'.$rows->contact_no.'</td>
                </tr>
                </table>
            </div>
            </fieldset>
            
            <fieldset>
                <legend>Professional Details</legend>
            <div>
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-business-time"></i></td><td class="title">Work Experience: </td><td>'.$rows->work_experience.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-building"></i></td><td class="title">Current Company: </td><td>';
                if($rows->current_company){
                    echo ''.$rows->current_company.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Current Designation: </td><td>';
                if($rows->current_designation){
                    echo ''.$rows->current_designation.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
            </table>
            </div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Interested Job Position(s)</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->jobPos.'
                
            </div>
            </fieldset>
            <fieldset>
                <legend>Skills</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->skills.'
                
            </div>
            </fieldset>

            <fieldset>
                <legend>Education</legend>
            <div  id="lvlEdu-viewCand">
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-user-graduate"></i></td><td>'.$rows->level_of_education.'</td>
                </tr>
                ';
                if($rows->level_of_education != "G.C.E. Ordinary Level" && $rows->level_of_education != "G.C.E. Advanced Level"){
                    echo '
                    <tr>
                    <td class="icons"><i class="fas fa-graduation-cap"></i></td><td>'.$rows->deg_cert_or_dip_title.'</td>
                    </tr>
                    <tr>
                    <td class="icons"><i class="fas fa-university"></i></td><td>'.$rows->uni_or_institute.'</td>
                    </tr>';
                }
                echo '
            </table>
            </div>
            </fieldset>';
           
            echo '
        </div>
   
        ';
            }
        }
    }

    public function viewRespondedCand(){
        if(isset($_REQUEST["uName"])){
            unset($_SESSION['cvDetails']);
            unset($_SESSION['interviewers']);
            $uName = $_REQUEST["uName"];
            $rows = $this->searchM->viewCand($uName);
            $cv = $this->searchM->getCV($uName);
            $interviewers = $this->searchM->getInterviewers($_SESSION['username']);
            
            if($interviewers){
                $_SESSION['interviewers'] = $interviewers;
            }
            
            // $jobReqExist = $this->searchM->jobReqExist($uName,$_SESSION['username']);

            if($cv){
                $_SESSION['cvDetails'] = $cv;
            }

            if($rows){
                echo '<div class="col1-viewAd">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows->profile_photo).'"/>';
                if($cv){
                    echo '<br>
                    <a id="cvDownBtn"  href="../helpers/downloadCV.php"><i class="fas fa-download"></i> Download CV</a>';
                }

                
        echo '
        <p onclick="openReportForm()" class="reportBtn"><i class="fas fa-flag"></i> Report</p>
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Personal Details</legend>
            <div class="persDet-viewCand" id="persDet-viewCand">
                <table class="viewCand-table">
                <tr>
                <td class="icons"><i class="fas fa-signature"></i></td><td class="title">Name: </td><td>'.$rows->first_name. ' '.$rows->last_name.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">District: </td><td>'.$rows->district.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">City: </td><td>'.$rows->city.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-at"></i></td><td class="title">E-mail: </td><td>'.$rows->email.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-phone"></i></td><td class="title">Contact No.: </td><td>'.$rows->contact_no.'</td>
                </tr>
                </table>
            </div>
            </fieldset>
            
            <fieldset>
                <legend>Professional Details</legend>
            <div>
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-business-time"></i></td><td class="title">Work Experience: </td><td>'.$rows->work_experience.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-building"></i></td><td class="title">Current Company: </td><td>';
                if($rows->current_company){
                    echo ''.$rows->current_company.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Current Designation: </td><td>';
                if($rows->current_designation){
                    echo ''.$rows->current_designation.'</td>';
                }
                else{
                    echo '-NA-';
                }
                echo '
                </tr>
            </table>
            </div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Interested Job Position(s)</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->jobPos.'
                
            </div>
            </fieldset>
            <fieldset>
                <legend>Skills</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->skills.'
                
            </div>
            </fieldset>

            <fieldset>
                <legend>Education</legend>
            <div  id="lvlEdu-viewCand">
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-user-graduate"></i></td><td>'.$rows->level_of_education.'</td>
                </tr>
                ';
                if($rows->level_of_education != "G.C.E. Ordinary Level" && $rows->level_of_education != "G.C.E. Advanced Level"){
                    echo '
                    <tr>
                    <td class="icons"><i class="fas fa-graduation-cap"></i></td><td>'.$rows->deg_cert_or_dip_title.'</td>
                    </tr>
                    <tr>
                    <td class="icons"><i class="fas fa-university"></i></td><td>'.$rows->uni_or_institute.'</td>
                    </tr>';
                }
                echo '
            </table>
            </div>
            </fieldset>
            <button class="sendReqBtn-viewCand" onclick="openInterviewForm()" type="submit">Schedule Interview</button>';
            // if($jobReqExist){
            //     echo '<button class="cancelReqBtn-viewCand" onclick="openAlert()" type="submit">CANCEL JOB REQUEST</button>';
            // }else{
            //     echo '<button class="sendReqBtn-viewCand" onclick="openForm()" type="submit">SEND JOB REQUEST</button>';
            // }
            echo '
        </div>
        
        
        ';
            }
        }
    }
    public function viewAd(){
        if(isset($_REQUEST["refNo"])){
            unset($_SESSION['flyerDetails']);
            $refNo = $_REQUEST["refNo"];
            $rows = $this->searchM->viewAd($refNo);
            $flyer = $this->searchM->getFlyer($refNo);
            $alreadyApplied = $this->searchM->alreadyApplied($refNo,$_SESSION['username']);

            if($flyer){
                $_SESSION['flyerDetails'] = $flyer;
            }

            if($rows){
                echo '<div class="col1-viewAd">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows->profile_photo).'"/>';
                if($flyer){
                    echo '<br>
                    <a id="cvDownBtn"  href="../helpers/downloadFlyer.php"><i class="fas fa-download"></i> Download Flyer</a>';
                }

                
        echo '
        
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Job Details</legend>
            <div class="persDet-viewCand" id="persDet-viewCand">
                <table class="viewCand-table">
                <tr>
                <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Job Position: </td><td>'.$rows->job_title.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Job Type: </td><td>'.$rows->job_type.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-coins"></i></td><td class="title">Salary: </td><td>'.$rows->rate.' LKR '.$rows->frequency.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-tasks"></i></td><td class="title">Required Skills: </td><td>'.$rows->skills.'</td>
                </tr>
                </table>
            </div>
            </fieldset>
            
            <fieldset>
                <legend>Organization Details</legend>
            <div>
            <table class="viewCand-table2">
                <tr>
                <td class="icons"><i class="fas fa-signature"></i></td><td class="title">Name: </td><td>'.$rows->company_name.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">Address: </td><td>'.$rows->address_line1.', '.$rows->address_line2.', '.$rows->street_name.', '.$rows->city.'.</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-at"></i></td><td class="title">E-mail: </td><td>'.$rows->email.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-phone"></i></td><td class="title">Contact No.: </td><td>'.$rows->telephone_no.'</td>
                </tr>
                <tr>
                <td class="icons"><i class="fas fa-globe"></i></td><td class="title">Website: </td><td>'.$rows->company_website.'</td>
                </tr>
                
                
            </table>
            </div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Job Description</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->description.'
                
            </div>
            </fieldset>';
            if($rows->org_description){
                echo '<fieldset>
                <legend>Organization Description</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
            '.$rows->org_description.'
                
            </div>
            </fieldset>';
            }
            if($alreadyApplied){
                echo '<button class="sendReqBtn-viewCand" type="submit" disabled>APPLIED</button>';
            }else{
                echo '<form action="../controllers/userController.php" method="post">
                <input type="hidden" name="type" value="applyForJob">
                <input type="hidden" name="refNo" value="'.$rows->ref_no.'">
                <input type="hidden" name="candUname" value="'.$_SESSION['username'].'">
                <button class="sendReqBtn-viewCand" type="submit">APPLY</button>
                </form>';
            }

            
                echo '
            </table>
            </div>
            
            
        </div>
        
        
        ';
            }
        }
    }


    public function jobReqCount(){
        if(isset($_REQUEST['uName'])){
            $uName = $_REQUEST['uName'];
            
        }
        $all = $this->searchM->jobReqCountAll($uName);
        $pending = $this->searchM->jobReqCountWithFilter($uName,"Pending");
        $viewed = $this->searchM->jobReqCountWithFilter($uName,"Viewed");
        $accepted = $this->searchM->jobReqCountWithFilter($uName,"Accepted");
        $declined = $this->searchM->jobReqCountWithFilter($uName,"Declined");

        if($all && $pending && $viewed && $accepted && $declined){
            echo '<button id="all">All ('.$all->count.')</button>
            <button id="pending">Pending ('.$pending->count.')</button>
            <button id="viewed">Viewed ('.$viewed->count.')</button>
            <button id="accepted">Accepted ('.$accepted->count.')</button>
            <button id="declined">Declined ('.$declined->count.')</button>
            
            <script>
            
            $("#all").on("click",function(){
                $.get("../controllers/searchDataController.php?q=allJobReqs", {uName:uName}).done(function(data){
                    tableContainer.html(data);    
                });
            });
            $("#pending").on("click",function(){
                var status = "Pending";
                $.get("../controllers/searchDataController.php?q=JobReqsFiltered", {uName:uName,status:status}).done(function(data){
                    tableContainer.html(data);    
                });
            });
            $("#viewed").on("click",function(){
                var status = "Viewed";
                $.get("../controllers/searchDataController.php?q=JobReqsFiltered", {uName:uName,status:status}).done(function(data){
                    tableContainer.html(data);    
                });
            });
            $("#accepted").on("click",function(){
                var status = "Accepted";
                $.get("../controllers/searchDataController.php?q=JobReqsFiltered", {uName:uName,status:status}).done(function(data){
                    tableContainer.html(data);    
                });
            });
            $("#declined").on("click",function(){
                var status = "Declined";
                $.get("../controllers/searchDataController.php?q=JobReqsFiltered", {uName:uName,status:status}).done(function(data){
                    tableContainer.html(data);    
                });
            });
            
            </script>
            ';
        }
    }

    public function allJobReqs(){
        if(isset($_REQUEST['uName'])){
            $uName = $_REQUEST['uName'];
        }

        $rows = $this->searchM->allJobReqs($uName);
        if($rows){
            echo '<tr>
            <th><i class="fas fa-signature"></i> Candidate\'s Name</th>
            <th><i class="fas fa-briefcase"></i> Job Position</th>
            <th><i class="fas fa-briefcase"></i> Job Type</th>
            <th><i class="fas fa-coins"></i> Salary</th>
            <th><i class="fas fa-eye"></i> Status</th>
          </tr>';
          for($x=0;$x<count($rows);$x++){
              echo '<tr>
              <td>'.$rows[$x]->first_name. ' ' .$rows[$x]->last_name.'</td>
              <td>'.$rows[$x]->job_position.'</td>
              <td>'.$rows[$x]->job_type.'</td>
              <td>'.$rows[$x]->salary. ' LKR ' .$rows[$x]->salary_freq.'</td>
              <td>'.$rows[$x]->status.'</td>
              </tr>';
          }
        }
    }
    public function JobReqsFiltered(){
        if(isset($_REQUEST['uName'])){
            $uName = $_REQUEST['uName'];
        }
        if(isset($_REQUEST['status'])){
            $status = $_REQUEST['status'];
        }

        $rows = $this->searchM->JobReqsFiltered($uName,$status);
        if($rows){
            echo '<tr>
            <th><i class="fas fa-signature"></i> Candidate\'s Name</th>
            <th><i class="fas fa-briefcase"></i> Job Position</th>
            <th><i class="fas fa-briefcase"></i> Job Type</th>
            <th><i class="fas fa-coins"></i> Salary</th>
            <th><i class="fas fa-eye"></i> Status</th>
          </tr>';
          for($x=0;$x<count($rows);$x++){
              echo '<tr>
              <td>'.$rows[$x]->first_name. ' ' .$rows[$x]->last_name.'</td>
              <td>'.$rows[$x]->job_position.'</td>
              <td>'.$rows[$x]->job_type.'</td>
              <td>'.$rows[$x]->salary. ' ' .$rows[$x]->salary_freq.'</td>
              <td>'.$rows[$x]->status.'</td>
              </tr>';
          }
        }
    }
    
    
    public function viewMyAds(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->viewMyAds($uName);

        if($rows){
            echo '<tr>
            <th><i class="fas fa-underline"></i> Ad Title</th>
            <th><i class="fas fa-briefcase"></i> Job Title</th>
            <th><i class="fas fa-calendar-day"></i> Published Date</th>
            <th><i class="fas fa-eye"></i> Views</th>
            <th><i class="fas fa-reply-all"></i> Responses</th>
            <th><i class="far fa-flag"></i> Status</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>';
        
        for($x=0;$x<count($rows);$x++){
            echo '<tr>
            <td>'.$rows[$x]->ad_title.'</td>
            <td>'.$rows[$x]->job_title.'</td>
            <td>'.$rows[$x]->from_date.'</td>
            <td>'.$rows[$x]->no_of_views.'</td>
            <td>'.$rows[$x]->no_of_responds.'</td>
            <td>'.$rows[$x]->status.'</td>
            <td>
            <a target="_blank" href="../views/edit_ad.php?refNo='.$rows[$x]->ref_no.'"><i class="fas fa-edit"></i> Edit</a>
            <td>';
            if($rows[$x]->status=="Published"){
                echo '<form action="../controllers/UserController.php" method="post">
                <input type="hidden" name="type" value="unpublishAd">
                <input type="hidden" name="refNo" value="'.$rows[$x]->ref_no.'">
                <button type="submit"><i class="fas fa-times-circle"></i> Unpublish</button>
                </form>';
            }else{
                echo '<form action="../controllers/UserController.php" method="post">
                <input type="hidden" name="type" value="republishAd">
                <input type="hidden" name="refNo" value="'.$rows[$x]->ref_no.'">
                <button type="submit"><i class="fas fa-check-circle"></i> Re-publish</button>
                </form>';
            }
            echo '
            </td>
            <td><a target="_blank" href="../views/view_responses.php?refNo='.$rows[$x]->ref_no.'"><i class="fas fa-reply-all"></i> View Responses</a></td>
            </tr>
            
            ';
        }
    }
    }
    public function editAd(){
        if(isset($_REQUEST['refNo'])){
            $refNo = $_REQUEST['refNo'];
        }
        $rows = $this->searchM->editAd($refNo);

        if($rows){
            echo '
            <div class="editAd-col1">
            <form method="post" id="editAdForm" action="../controllers/userController.php" enctype="multipart/form-data">
            <input type="hidden" name="type" value="editAd">
            <input type="hidden" name="refNo" value="'.$rows->ref_no.'">
            <label for="adTitle">Ad Title<span class="reqStar">*</span></label>
            <input id="adTitle" name="adTitle" type="text" value="'.$rows->ad_title.'" required>
    
            <br>
            <label for="jobPos">Job Position<span class="reqStar">*</span></label>
            <input id="jobPos" name="jobPos" type="text" value="'.$rows->job_title.'" required>
    
            <br>
            <label for="jobType">Job Type<span class="reqStar">*</span></label>
            <select class="jobTypeDropdown selectBox" name="jobType" required>
                                    <option value="" selected disabled>Select:</option>
                                    <option value="1">Full Time</option>
                                    <option value="2">Part Time</option>
                                    <option value="3">Work From Home</option>
            </select>
    
            <label for="sal">Salary (LKR)<span class="reqStar">*</span></label>
            <input id="sal" name="sal" type="number" min="1" step="any" value="'.$rows->rate.'" required>
    
            <label>Salary Frequency<span class="reqStar">*</span></label>
                    <select class="salFreq" name="salFreq" required>
                        <option value="" selected disabled>Select:</option>
                        <option value="1">Hourly</option>
                        <option value="2">Daily</option>
                        <option value="3">Monthly</option>
                        <option value="4">Per Job</option>
            </select>
            <label>Duration<span class="reqStar">*</span></label>
                    <select class="adDuration" name="adDuration" required>
                        <option value="" selected disabled>Select:</option>
                        <option value="1">7 Days</option>
                        <option value="2">14 Days</option>
                        <option value="3">30 Days</option>
            </select>
            
            <label for="desc">Description<span class="reqStar">*</span></label>
            <textarea id="desc" name="desc" type="text"  form="editAdForm" required>'.$rows->description.'</textarea>

            <label for="skills">Required Skills</label>
            <textarea  id="skills" name="skills" type="text" form="editAdForm" placeholder="Type the skills seperated by commas...">'.$rows->skills.'</textarea>
            
            <label for="updateFlyer">Update Flyer</label><br>
            <input class="updateFlyer" id="updateFlyer" type="checkbox"><br>

            <div class="flyerUploadCont">
            <label for="flyerUpload">Upload Flyer</label><br>
            <p id="errMsg"></p>
            <input class="flyerUpload" name="flyerUpload" id="flyerUpload" type="file" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <button id="saveBtn" type="submit">SAVE</button>
            </div>
            </form>
            
            <script>
            $("#updateFlyer").change(function(){
                
                if($("#updateFlyer").prop("checked")){
                    $(".flyerUploadCont").show();
                }
                else{
                    $(".flyerUploadCont").hide();
                }
            });


            </script>
            ';
        }
        
    }

    public function listInterviewers(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->listInterviewers($uName);

        if($rows){
            echo '<tr>
            <th><i class="fas fa-signature"></i> Interviewer Name</th>
            <th><i class="fas fa-id-card"></i> NIC</th>
            <th><i class="fas fa-at"></i> E-mail</th>
            <th><i class="fas fa-phone"></i> Contact.No</th>
            <th></th>
          </tr>';
            for($x=0;$x<count($rows);$x++){
                echo '<tr>
                <td>'.$rows[$x]->name.'</td>
                <td>'.$rows[$x]->nic.'</td>
                <td>'.$rows[$x]->email.'</td>
                <td>'.$rows[$x]->contact_no.'</td>
                <td><a href="../controllers/userController.php?q=removeInter&uname='.$rows[$x]->inter_username.'" onclick="openAlert()">Remove</a></td>
                </tr>
                ';
            }
            
        }
    }

    public function candAllJobReqs(){
        if(isset($_REQUEST['uName'])){
            $uName = $_REQUEST['uName'];
        }

        $rows = $this->searchM->candAllJobReqs($uName);
        if($rows){
            echo '<tr>
            <th><i class="fas fa-signature"></i> Oraganization\'s Name</th>
            <th><i class="fas fa-briefcase"></i> Job Position</th>
            <th><i class="fas fa-briefcase"></i> Job Type</th>
            <th><i class="fas fa-coins"></i> Salary</th>
            <th></th>
          </tr>';
          for($x=0;$x<count($rows);$x++){
              echo '<tr>
              <td>'.$rows[$x]->company_name.'</td>
              <td>'.$rows[$x]->job_position.'</td>
              <td>'.$rows[$x]->job_type.'</td>
              <td>'.$rows[$x]->salary. ' LKR ' .$rows[$x]->salary_freq.'</td>
              <td><a target="_blank" href="../views/respond_req_cand.php?id='.$rows[$x]->id.'"> View</a></td>
              </tr>';
          }
        }
    }

    public function viewJobReqCand(){
        if(isset($_REQUEST["id"])){
            $id = $_REQUEST["id"];
        }
        $rows = $this->searchM->viewJobReqCand($id);

        if($rows){
            echo '<div class="col1-viewAd">
                <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows->profile_photo).'"/>';
                
    echo '
    </div>
    <div class="col2-viewAd">
        <fieldset>
            <legend>Company Details</legend>
        <div class="persDet-viewCand" id="persDet-viewCand">
            <table class="viewCand-table">
            <tr>
            <td class="icons"><i class="fas fa-signature"></i></td><td class="title">Name: </td><td>'.$rows->company_name.'</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-map-marker-alt"></i></td><td class="title">Address: </td><td>'.$rows->address_line1.', '.$rows->address_line2.', '.$rows->street_name.', '.$rows->city.'.</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-at"></i></td><td class="title">E-mail: </td><td>'.$rows->email.'</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-phone"></i></td><td class="title">Contact No.: </td><td>'.$rows->telephone_no.'</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-globe"></i></td><td class="title">Website: </td><td>'.$rows->company_website.'</td>
            </tr>
            </table>
        </div>
        </fieldset>
        
        <fieldset>
            <legend>Vacancy Details</legend>
        <div>
        <table class="viewCand-table2">
            <tr>
            <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Job Position: </td><td>'.$rows->job_position.'</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-briefcase"></i></td><td class="title">Job Type: </td><td>'.$rows->job_type.'</td>
            </tr>
            <tr>
            <td class="icons"><i class="fas fa-coins"></i></td><td class="title">Salary: </td><td>'.$rows->salary.' '.$rows->salary_freq.'</td>
            </tr>
            
        </table>
        </div>
        </fieldset>
        
    </div>

    <div class="col3-viewAd">
        <fieldset>
            <legend>Job Description</legend>
        <div class="jobDesc-viewJobReqCand" id="jobDesc-viewJobReqCand">
        '.$rows->description.'
            
        </div></fieldset>';
        if($rows->status=="Accepted"){
            echo '<div class="button-viewAd"><button class="sendReqBtn-viewAd" type="submit" disabled>ACCEPTED</button></a></div>
            <form action="../controllers/userController.php" method="post">
            <input type="hidden" name="type" value="candDeclineOrgReq">
            <input type="hidden" name="id" value="'.$rows->id.'">
            <div class="button-viewAd"><button class="cancelBtn-viewAd" type="submit">DECLINE</button></div>
            </form>';
        }
        else if($rows->status=="Declined"){
            echo '<div class="button-viewAd"><button class="cancelBtn-viewAd" type="submit" disabled>DECLINED</button></div>
            <form action="../controllers/userController.php" method="post">
            <input type="hidden" name="type" value="candAcceptOrgReq">
            <input type="hidden" name="id" value="'.$rows->id.'">
            <div class="button-viewAd"><button class="sendReqBtn-viewAd" type="submit">ACCEPT</button>
            </form>
            
            ';
        }
        
        
        echo '
    </div>
    
    
    ';
        }
    }

    public function viewAllUsers(){
        $rows = $this->searchM->viewAllUsers();

        if($rows){
            echo '<tr>
            <th><i class="fas fa-user"></i> Username</th>
            <th><i class="fas fa-user-tag"></i> User Role</th>
            <th><i class="fas fa-flag"></i> Account Status</th>
            <th></th>
          </tr>
            
            ';
            for($x=0;$x<count($rows);$x++){
                echo '<tr>
                <td>'.$rows[$x]->username.'</td>
                <td>'.$rows[$x]->user_role.'</td>
                <td>'.$rows[$x]->account_status.'</td>
                <td>abc</td>
              </tr>
                ';
            }
        }
    }

    public function viewAllRecs(){
        $rows = $this->searchM->viewAllRecs();

        if($rows){
            echo '<table class="hireRecTable">
            <tr>
            <th><i class="fas fa-signature"></i> Agency Name</th>
            <th><i class="fas fa-at"></i> E-mail</th>
            <th><i class="fas fa-phone"></i> Contact No.</th>
            <th><i class="fas fa-business-time"></i> Work Experience</th>
            <th><i class="fas fa-star-half-alt"></i> Rating</th>
            <th><i class="fas fa-tasks"></i> Specialized In</th>
            <th></th>
          </tr>
            
            ';
            for($x=0;$x<count($rows);$x++){
                $isHired = $this->searchM->isHired($rows[$x]->rec_username,$_SESSION['username']);
                echo '<tr>
                <td>'.$rows[$x]->agency_name.'</td>
                <td>'.$rows[$x]->email.'</td>
                <td>'.$rows[$x]->contact_no.'</td>
                <td>'.$rows[$x]->work_experience.'</td>';
                if($rows[$x]->average_rating){
                    echo '<td>'.$rows[$x]->average_rating.'</td>';
                }
                else{
                    echo '<td>Not rated yet</td>';
                }
                echo '
                <td>'.$rows[$x]->specialized_areas.'</td>';
                
                if($isHired){
                    echo '<td><button type="button" disabled><i class="fas fa-briefcase"></i> Hired</button></td>';
                }
                else{
                    $uname = $rows[$x]->rec_username;
                    echo '<td><button onclick="openHireForm(\''.$uname.'\')"><i class="fas fa-briefcase"></i> Hire Recruiter</button></td>';
                }
                echo '
                
              </tr>
              
                

                <script>
                $("#closeBtnForm").on("click",function(){
                    $("#hireRecForm").hide();
                });
                function openHireForm(recUname) {
                    document.getElementById("hireRecForm").style.display = "block";
                    document.getElementById("recUname").value = recUname;
                }
                
                </script>
                ';
            }

        }
    }

    public function viewFilteredRecs(){
        if(isset($_REQUEST['searchTerm'])){
            $searchTerm = '%' . $_REQUEST['searchTerm'] . '%';
        }
        $rows = $this->searchM->viewFilteredRecs($searchTerm);

        if($rows){
            echo '<table class="hireRecTable">
            <tr>
            <th><i class="fas fa-signature"></i> Agency Name</th>
            <th><i class="fas fa-at"></i> E-mail</th>
            <th><i class="fas fa-phone"></i> Contact No.</th>
            <th><i class="fas fa-business-time"></i> Work Experience</th>
            <th><i class="fas fa-star-half-alt"></i> Rating</th>
            <th><i class="fas fa-tasks"></i> Specialized In</th>
            <th></th>
          </tr>
            
            ';
            for($x=0;$x<count($rows);$x++){
                $isHired = $this->searchM->isHired($rows[$x]->rec_username,$_SESSION['username']);
                echo '<tr>
                <td>'.$rows[$x]->agency_name.'</td>
                <td>'.$rows[$x]->email.'</td>
                <td>'.$rows[$x]->contact_no.'</td>
                <td>'.$rows[$x]->work_experience.'</td>';
                if($rows[$x]->average_rating){
                    echo '<td>'.$rows[$x]->average_rating.'</td>';
                }
                else{
                    echo '<td>Not rated yet</td>';
                }
                echo '
                <td>'.$rows[$x]->specialized_areas.'</td>
                <td>';
                if($isHired){
                    echo '<button onclick="openHireForm()" type="button" disabled><i class="fas fa-briefcase"></i> Hired</button>';
                }
                else{
                    $uname = $rows[$x]->rec_username;
                    echo '<button onclick="openHireForm(\''.$uname.'\')" type="button"><i class="fas fa-briefcase"></i> Hire Recruiter</button>';
                }
                echo '
                </td>
              </tr>

                <script>
                function openHireForm(recUname) {
                    document.getElementById("hireRecForm").style.display = "block";
                    document.getElementById("recUname").value = recUname;
                }
                $("#closeBtnForm").on("click",function(){
                    $("#hireRecForm").hide();
                });
                </script>
                ';
            }

        }
        else{
            echo "<div class='noResult'><img id='noResultRec' src='../material/images/no-result.png'></div>";
        }
    }


    public function viewResponses(){
        if(isset($_REQUEST['refNo'])){
            $refNo = $_REQUEST['refNo'];
        }
        $rows = $this->searchM->viewResponses($refNo);

        if($rows){
            echo '<table class="hireRecTable">
            <tr>
            <th><i class="fas fa-signature"></i> Candidate Name</th>
            <th><i class="fas fa-map-marker-alt"></i> Location</th>
            <th><i class="fas fa-business-time"></i> Work Experience</th>
            <th><i class="fas fa-graduation-cap"></i> Education</th>
            <th></th>
          </tr>
            ';
            for($x=0;$x<count($rows);$x++){
                echo '<tr>
                <td>'.$rows[$x]->first_name.' '.$rows[$x]->last_name.'</td>
                <td>'.$rows[$x]->city.', '.$rows[$x]->district.'</td>
                <td>'.$rows[$x]->work_experience.'</td>
                <td>'.$rows[$x]->level_of_education.'</td>
                <td><a target="_blank" href="../views/view_responded_cand_org.php?uName='.$rows[$x]->cand_username.'">View Candidate</a></td>
              </tr>
                ';
            }

        }
    }

    public function listSchedules(){
        $uname = $_SESSION['username'];
        $rows = $this->searchM->listSchedules($uname);
        

        if($rows){
            echo '<table class="hireRecTable">
            <tr>
            <th><i class="fas fa-signature"></i> Candidate Name</th>
            <th><i class="fas fa-user-tie"></i> Interviewer Name</th>
            <th><i class="fas fa-calendar-week"></i> Date</th>
            <th><i class="far fa-clock"></i> Time</th>
            <th><i class="fas fa-link"></i> Link</th>
            <th><i class="fas fa-file-alt"></i> CV</th>
          </tr>
            ';
            for($x=0;$x<count($rows);$x++){
                $cv = $this->searchM->getCV($rows[$x]->cand_username);
                if($cv){
                    $_SESSION['cvDetails'] = $cv;
                }
                echo '<tr>
                <td>'.$rows[$x]->cand_name.'</td>
                <td>'.$rows[$x]->int_name.'</td>
                <td>'.$rows[$x]->date.'</td>
                <td>'.$rows[$x]->time.'</td>
                <td><a target="_blank" href="'.$rows[$x]->link.'">URL</a></td>';
                if($cv){
                    echo '<br>
                    <a   href="../helpers/downloadCV.php"><i class="fas fa-download"></i> Download CV</a>';
                }else{
                    echo '<td>No CV</td>';
                }
                echo '
                
              </tr>
                ';
            }
        }

    }


    public function recViewInter(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->recViewInter($uName);
        
        if($rows){
            echo '
            <tr>
                  <th>Organization Name</th>
                  <th>Candidate Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Link</th>
                  <th></th>
                  <th></th>
                </tr>';
        
        for($x=0;$x<count($rows);$x++){
            echo '<tr>
            <td>'.$rows[$x]->org_username.'</td>
            <td>'.$rows[$x]->cand_username.'</td>
            <td>'.$rows[$x]->date.'</td>
            <td>'.$rows[$x]->time.'</td>
            <td>'.$rows[$x]->link.'</td>
            <td>
            <a target="_blank" href="../views/resch_int_inter_rec.php?refNo='.$rows[$x]->ref_no.'"><i class="fas fa-edit"></i> Reschedule</a>
            <td>';
    
        }
     }
    }

    public function recReschedInter(){
        if(isset($_REQUEST['refNo'])){
            $refNo = $_REQUEST['refNo'];
        }
        $rows = $this->searchM->recReschedInter($refNo);
        if($rows){
            echo '
            
            <form method="post" id="scheInt" action="../controllers/userController.php" enctype="multipart/form-data">
            <input type="hidden" name="type" value="scheInt">

            <label for="intScheDate">Date<span class="reqStar">*</span></label>
            <input id="intScheDate" name="intScheDate" type="date" value="'.$rows->date.'" required>
    
            <br>
            <label for="intScheTime">Time<span class="reqStar">*</span></label>
            <input id="intScheTime" name="intScheTime" type="time" value="'.$rows->time.'" required>
    
            <br>
            <label for="intLink">Link<span class="reqStar">*</span></label>
            <textarea id="intLink" name="intLink" type="text" form="scheInt" required>'.$rows->link.'</textarea>

        
            <button class="publishButton" type="submit">RESCHEDULE</button>
         
            </form>
            ';
        }      
    }
  
    
    public function recOrgList(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->recOrgList($uName);
             
        if(isset($rows)){
            
            if($rows){
                echo '
                    <div class="recentW">
                    <h2>Recent Works
                        
                    </h2>
                    </div>';
                for ($x=0;$x<count($rows);$x++){
                    echo '<div class="recJobs">
                    <form method="POST" action="view_cand_list_rec.php" target="_blank">
                    <input type="hidden" name="uName" >
                    </form>
                    <table class="det">
                      <tr>
                      <td class="title"><i class="fas fa-signature"></i><b> Organization </b></td><td><h3>'.$rows[$x]->company_name.'</h3></td>
                        </tr>
                      <tr>
                      <td class="title"><b> Job </b></td><td>'.$rows[$x]->description.'</td>
                      </tr>
                     
                    </table>
                    </div>
                    <script>
                    $(".recJobs").on("click",function(){
                        $(this).children("form").submit();
                    });
                    </script>

                    ';
                }
             }
             else{
                echo '<div class="noResult"><img id="noResult" src="../material/images/no-result.png" alt="Profile Picture"></div>';
             }
            }
    }

    public function recViewOrgList(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->recViewOrgList($uName);

        if($rows){
            echo '<tr>
            <th>Organization Name</th>
            <th>Description</th>
            <th></th>
        </tr>';
        
        for($x=0;$x<count($rows);$x++){
            echo '<tr>
            <td>'.$rows[$x]->company_name.'</td>
            <td>'.$rows[$x]->description.'</td>
            
            </td>
            <td><a target="_blank" href="../views/view_cand_list_rec.php?refNo='.$rows[$x]->company_name.'"><i class="fas fa-reply-all"></i> View List</a></td>
            </tr>
            
            ';
        }
    }
    }

    public function recViewCandList(){
        $uName = $_SESSION['username'];
        $rows = $this->searchM->viewCand($uName);

        if(isset($rows)){
            if($rows){
                for ($x=0;$x<count($rows);$x++){
                    echo '<div class="candSearchResContOrgHome">
                    <form method="POST" action="view_cand_rec.php?refNo='.$rows[$x]->org_username.'" target="_blank">
                    <input type="hidden" name="uName" value="'.$rows[$x]->cand_username.'">
                    </form>
                    <div class="pp">
                    <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($rows[$x]->profile_photo).'"/>
                    <p>'.$rows[$x]->first_name.' '.$rows[$x]->last_name.'</p>
                    </div>
                    <table class="det">
                      <tr>
                      <td class="title"><i class="fas fa-briefcase"></i> Job Positions </td><td>'.$rows[$x]->jobPos.'</td>
                        </tr>
                      <tr>
                      <td class="title"><i class="fas fa-clipboard-list"></i> Skills </td><td>'.$rows[$x]->skills.'</td>
                      </tr>
                      <tr>
                      <td class="title"><i class="fas fa-user-graduate"></i> Education </td><td>'.$rows[$x]->level_of_education.'</td>
                      </tr>
                      <tr>
                      <td class="title"><i class="fas fa-university"></i> University/Institute </td><td>';
                      if($rows[$x]->uni_or_institute){
                          echo ''.$rows[$x]->uni_or_institute.'</td>';
                      }else{
                        echo '-NA-</td>';
                      }
                      echo '
                      </tr>
                      <tr>
                      <td class="title"><i class="fas fa-map-marker-alt"></i> Location </td><td>'.$rows[$x]->city.', '.$rows[$x]->district.'</td>
                      <tr>
                      <td class="title"><i class="fas fa-business-time"></i> Working Experience </td><td>'.$rows[$x]->work_experience.'</td>
                      </tr>
                    </table>
                    </div>';
                }
            }
            else{
                echo '<div class="noResult"><img id="noResult" src="../material/images/no-result.png" alt="Profile Picture"></div>';
             }
        }

    }


}

$init = new userController;

switch($_GET['q']){
    case 'orgSearchingCand':
        $init->searchCandSuggestions();
        break;
    case 'recSearchingCand':
        $init->searchCandSuggestions();
        break;
    case 'candSearchingVacancy':
        $init->searchVacancySuggestions();
        break;    
    case 'tags1Suggestions':
        $init->tags1Suggestions();
        break;
    case 'tags2Suggestions':
        $init->tags2Suggestions();
        break;
    case 'mostSearchedSkills':
        $init->mostSearchedSkills();
        break;
    case 'mostSearchedJobs':
        $init->mostSearchedJobs();
        break;
    case 'compSuggestions':
        $init->compSuggestions();
        break;
    case 'desigSuggestions':
        $init->desigSuggestions();
        break;
    case 'uniSuggestions':
        $init->uniSuggestions();
        break;
    case 'degSuggestions':
        $init->degSuggestions();
        break;
    case 'orgSearchingCandRes':
        $init->orgSearchingCand();
        break;
    case 'recSearchingCandRes':
        $init->recSearchingCand();
        break;
    case 'candSearchingVacancyRes':
        $init->candSearchingVacancy();
        break;   
    case 'filterRes':
        $init->filterRes();
        break;
    case 'filterResVacancy':
        $init->filterResVacancy();
        break;
    case 'viewCand':
        $init->viewCand();
        break;
    case 'viewAd':
        $init->viewAd();
        break;
    case 'jobReqCount':
        $init->jobReqCount();
        break;
    case 'allJobReqs':
        $init->allJobReqs();
        break;
    case 'JobReqsFiltered':
        $init->JobReqsFiltered();
        break;
    case 'viewMyAds':
        $init->viewMyAds();
        break;
    case 'editAd':
        $init->editAd();
        break;
    case 'listInterviewers':
        $init->listInterviewers();
        break;
    case 'candAllJobReqs':
        $init->candAllJobReqs();
        break;
    case 'viewJobReqCand':
        $init->viewJobReqCand();
        break;
    case 'viewAllUsers':
        $init->viewAllUsers();
        break;
    case 'viewAllRecs':
        $init->viewAllRecs();
        break;
    case 'viewFilteredRecs':
        $init->viewFilteredRecs();
        break;
    case 'viewResponses':
        $init->viewResponses();
        break;
    case 'viewRespondedCand':
        $init->viewRespondedCand();
        break;
    case 'listSchedules':
        $init->listSchedules();
        break;
    case 'recViewInter':
        $init->recViewInter();
        break;
    case 'recReschedInter':
        $init->recReschedInter();
        break;
    case 'recOrgList':
        $init->recOrgList();
        break;
    case 'recViewOrgList':
        $init->recViewOrgList();
        break;
    case 'recViewCandList':
        $init->recViewCandList();
        break;
        
        
}
