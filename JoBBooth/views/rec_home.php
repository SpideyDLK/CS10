<?php
session_start();
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['jobReqRec'])){
  redirect("../controllers/userController.php?q=loadJobReq");
}
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="orgHomeRow1">
            <div class="welcomeMsg">
                <h1>Hello, <?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h1>
                <h2>We welcome you to JoBBooth !</h2>
                <h3>Hundreds of companies awaits your service...</h3>
            </div>
            <div class="proPic">
                <!-- <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
               -->
               <?php if(isset($_SESSION['pp'])){
                    echo "<embed class='proPicEdit' src='data:image/png;base64,".base64_encode($_SESSION['pp'])."'/>";
                }?>
                <div id="generatedProPic"></div>
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                  <div class="moreDropDown">
                  <div class="moreBtn"><a href=""></a><span class="arrowDownIcon"><i id="userSettingsIcon" class="fas fa-user-cog"></i></span></div>
                  <div class="moreDropDown-content">
                        <a href="rec_edit_pro.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../views/add_more_special_rec.php"><i class="fas fa-plus-circle"></i> Add Specialized Areas</a>
                        <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </div>
                  </div>
                
            </div>
        </div>

        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="rec_view_orgList.php">View Organizations</a>
            <a href="rec_search_cand.php">Search Candidates</a>
            <a href="resch_int_req_rec.php">Interview Reschedule Requests</a>
        </div>
        
        <br>
        <?php popUp('loginGreen');?>

        <div class="pendingJobAppContainerOuter">
          <div class="jobAppHeading"><h>Job Requests</h></div>
          <?php if(isset($_SESSION['jobReqRec'])){
          loadJobReq($_SESSION['jobReqRec']);
        }?>
      
      </div>


        <div class="pendinginterContainerOuter">
            <div class="pendinginterHeading"><h>Pending Interviews</h></div>
            <div class="pendinginterContainer">
            <table class="pendinginter">
                <tr>
                  <th>Profile Photo</th>
                  <th>Organization Name</th>
                  <th>Candidate's Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="resch_int_inter_rec.php">Reschedule</a></td>
                  <td><a href="#">Cancel Interview</a></td>
                </tr>
                
                
                
              </table>
        </div>
        
       </div> 
  </body> 
</html>