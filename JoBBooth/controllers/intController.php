<?php
require_once '../models/intModels.php';
require_once '../helpers/session_helper.php';

class userController{
    private $intM;

    public function __construct(){
        $this->intM = new intModel;
    }

 
    public function rescheIntInterviewer(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'refNo' => trim($_POST['refNo']),
            'date' => trim($_POST['intScheDate']),
            'time' => trim($_POST['intScheTime']),
            'link' => trim($_POST['intLink'])
            
            ];

        if($this->intM->rescheIntInterviwer($data)){
            // $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/intList.php");
        }else{
            die("Something went wrong");
        }
    }
    public function listInterviews(){
        $uName = $_SESSION['username'];
        $rows = $this->intM->listInterviews($uName);

        if($rows){
            echo '<tr>
            <th><i class="fas fa-signature"></i> Candidate Name</th>
            <th><i class="fas fa-id-card"></i> Date</th>
            <th><i class="fas fa-at"></i>Time</th>
            <th><i class="fas fa-phone"></i> Link</th>
            <th></th>
            <th></th>
            <th></th>
            
          </tr>';
            for($x=0;$x<count($rows);$x++){
                $isFinished = $this->intM->isFinished($rows[$x]->ref_no);
                echo '<tr>
                <td>'.$rows[$x]->cand_name.'</td>
                <td>'.$rows[$x]->date.'</td>
                <td>'.$rows[$x]->time.'</td>
                <td><a target="_blank" href="'.$rows[$x]->link.'">URL</a></td>
                <td><a href="../views/view_responded_cand_int.php?uName='.$rows[$x]->cand_username.'">View</a></td>
                <td><button onclick="openEditForm('.$rows[$x]->ref_no.')"><i class="far fa-edit"></i> Reschedule</button></td>';
                if($isFinished){
                    echo '<td><button disabled> Already Finished</button></td>';
                }
                else{
                    echo '<td><button onclick="openFBForm('.$rows[$x]->ref_no.')">Finish</button></td>;';
                }
                echo '
               
                    
                }
                
               

                </tr>
                <script>
                $("#closeBtn1").on("click",function(){
                    $("#interviewForm").hide();
                });
                function openEditForm(refNo) {
                document.getElementById("interviewForm").style.display = "block";
                document.getElementById("refNo").value = refNo;
                }
                $("#closeBtn2").on("click",function(){
                    $("#finishIntContainer").hide();
                });
                function openFBForm(refNo) {
                document.getElementById("finishIntContainer").style.display = "block";
                document.getElementById("refno").value = refNo;
                
                
                }
                </script>'
                ;
            }
            
        }
    }



    public function finishedList(){
        $uName = $_SESSION['username'];
        $rows = $this->intM->finishedList($uName);

        if($rows){
            echo '<tr>
            <th>Candidate Name</th>
            <th>Rate</th>
            <th></th>
            <th></th>
            <th></th>
            
            
          </tr>';
            for($x=0;$x<count($rows);$x++){
                echo '<tr>
                <td>'.$rows[$x]->cand_name.'</td>
                
                <td>'.$rows[$x]->rate.'</td>
                <td>
                <a href="../views/view_responded_cand_int.php?uName='.$rows[$x]->cand_username.'" target="_blank">View Candidate</a>

               
               </td>
             <td>
             <a href="../views/view_feedback_int.php?uName='.$rows[$x]->cand_username.'">View Feedback</a>
             </td>
                
                <td>';
                 echo'
                <form id="selectForm" method="post" action="../controllers/intController.php">
                <input type="hidden" name="type" value="select">
                <input  type="hidden" name="refNo" value="'.$rows[$x]->ref_no.'">
                <input  type="hidden" name="selected" value="selected">
                <button type="submit">Select</button>
                </form>';
                echo'
                
                </td>
                
                </tr>
               '
                ;
            }
            
        }
    }
    public function select(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data =[
            'refNo' => trim($_POST['refNo']),
            'selected' => trim($_POST['selected'])
            
            
            ];

        if($this->intM->select($data)){
            // $_SESSION['candUname'] = $data['candUname'];
            redirect("../views/intList.php?tabNo=2");
        }else{
            die("Something went wrong");
        }
    }

    public function selectedList(){
        $uName = $_SESSION['username'];
        $rows = $this->intM->selectedList($uName);

        if($rows){
            echo '<tr>
            <th>Candidate Name</th>
            <th>Rate</th>
            <th></th>
            <th></th>
            
            
          </tr>';
            for($x=0;$x<count($rows);$x++){
                echo '<tr>
                <td>'.$rows[$x]->cand_name.'</td>
                
                <td>'.$rows[$x]->rate.'</td>
                <td><a href="../views/view_responded_cand_int.php?uName='.$rows[$x]->cand_username.'" target="_blank">View Candidate</a></td>
                <td><a href="../views/view_feedback_int.php?uName='.$rows[$x]->cand_username.'">View Feedback</a></td>

                </tr>
               '
                ;
            }
            
        }
    }

    public function viewRespondedCand(){
        if(isset($_REQUEST["uName"])){
            unset($_SESSION['cvDetails']);
            unset($_SESSION['interviewers']);
            $uName = $_REQUEST["uName"];
            $rows = $this->intM->viewCand($uName);
            $cv = $this->intM->getCV($uName);
           

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
                
                
              
                ' ;
               
            echo'
            </div>
            
            
            
            ';
                }
            }
        }

        public function viewFeedback(){
            if(isset($_REQUEST["uName"])){
                
            
                $uName = $_REQUEST["uName"];
                $rows = $this->intM->viewFeedback($uName);
                 if($rows){
                    echo '<tr>
                    <th>Feedback</th>
                    </tr>';
                    echo '<tr>
                    <td>'.$rows->feedback.'</td>
                    </tr>
                    ';
                    }
                }
            }
        public function ratingFeedback(){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data =[
                'refNo' => trim($_POST['refNo']),
                'rate' => trim($_POST['rate']),
                'status' => trim($_POST['status']),
                'feedback' => trim($_POST['feedback'])
                
                ];
    
            if($this->intM->ratingFeedback($data)){
              
                redirect("../views/intList.php");
            }else{
                die("Something went wrong");
            }
        }

        public function pendingInterviews(){
            $uName = $_SESSION['username'];
            $rows = $this->intM->listInterviews($uName);
        
            if(isset($rows)){
                
                if($rows){
                    
                    for ($x=0;$x<count($rows);$x++){
                        echo '<div class="recJobs">
                        <form method="POST" action="intList.php" target="_blank">
                        <input type="hidden" name="uName" >
                        </form>
                        <table class="det">
                          <tr>
                          <td class="title"><i class="fas fa-signature"></i><b>Candidate Name </b></td><td><h3>'.$rows[$x]->cand_name.'</h3></td>
                            </tr>
                          <tr>
                          <td class="title"><b> Date</b></td><td>'.$rows[$x]->date.'</td>
                          </tr>
                          <tr>
                          <td class="title"><b> Time</b></td><td>'.$rows[$x]->time.'</td>
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
         


}

$init = new userController;

if($_SERVER['REQUEST_METHOD']=='POST'){
    switch($_POST['type']){
        case 'rescheIntInterviewer':
            $init->rescheIntInterviewer();
            break;
        
        case 'ratingFeedback':
             $init->ratingFeedback();
            break;  
        case 'select':
            $init->select();
            break;    
      //  case 'save':
        //    $init->rate();
        default:
            redirect("../views/home.php");
       
        }
        }
else {
    switch($_GET['q']){

        case 'viewRespondedCand':
            $init->viewRespondedCand();
            break;
        case 'listInterviews':
            $init->listInterviews();
            break;
        case 'finishedList':
            $init->finishedList();
            break;
        case 'selectedList':
            $init->selectedList();
            break;
        case 'viewFeedback':
            $init->viewFeedback();
            break;
        case 'pendingInterviews':
            $init->pendingInterviews();
            break;
    }
}

