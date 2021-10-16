<?php
session_start();
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Organization</title>
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
                  }?> </h1>
                <h2>We welcome you to JoBBooth !</h2>
                <h3>Your struggling days to recruit is now behind...</h3>
            </div>
            <div class="proPic">
                <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                <h class="logOut"><a  href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></h>
            </div>
            <div class="editIconOrg"><a href="#"><i id="editIconOrg" class="far fa-edit"></i></a></div>
        </div>
        
        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="../controllers/userController.php?q=intList">View Interviewers</a>
            <a href="../controllers/userController.php?q=myAds">My Ads</a>
            <a href="publish_ad.php">Publish Ad</a>
            <a href="hire_rec.php">Hire a Recruiter</a>
            <a href="reg_interviewer.php">Register an Interviewer</a>
        </div>
  
       </div>
   
        <div class="searchVacancy">
            <form action="" method="post">
                <input class="searchBar" type="text" placeholder="Search for a candidate..." required> <span class="searchIconOrg"><i id="searchIconOrg" class="fas fa-search"></i></span>
                <button class="searchButtonOrg" type="submit">SEARCH</button>
            </form> 
        </div>

        <div class="searchResultsOrgHome">
            <table class="searchResultsTable">
                <tr>
                  <th>Profile Photo</th>
                  <th>Candidate's Name</th>
                  <th>Interested Job Position(s)</th>
                  <th>Level of Education</th>
                  <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_cand_org.php">View Candidate</a></td>
                </tr>
                
                
              </table>
        </div>

        <div class="searchResultsOrgHome">
          <div class="jobAppHeading"><h>Pending Job Applications</h></div>
      <div class="pendingJobAppContainer">
          <table class="pendingJobApp">
          <tr>
                  <th>Profile Photo</th>
                  <th>Candidate's Name</th>
                  <th>Interested Job Position(s)</th>
                  <th>Level of Education</th>
                  <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Undergraduate</td>
                  <td><a href="view_pending_cand_org.php">View Candidate</a></td>
                </tr>
                
            </table>
      </div>

      </div>


        <div class="pendingJobReqContainerOuter">
            <div class="jobReqHeading"><h>Recruiter's List</h></div>
        <div class="pendingJobReqContainer">
            <table class="pendingJobReq">
                <tr>
                  <th>Profile Photo</th>
                  <th>Candidate's Name</th>
                  <th>Rating</th>
                  <th>Feedback</th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.5</td>
                  <td></td>
                </tr>
                
              </table>
        </div>

        </div>
        

        <div class="pendingIntContainerOuter">
            <div class="pendIntHeading"><h>Interviewer's List</h></div>
            <div class="pendingIntContainer">
            <table class="pendingInterviews">
                <tr>
                  <th>Profile Photo</th>
                  <th>Candidate's Name</th>
                  <th>Rating</th>
                  <th>Feedback</th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.9</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.9</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.9</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.9</td>
                  <td></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>4.9</td>
                  <td></td>
                </tr>
                  <tr>
                    <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                    <td>User</td>
                    <td>4.9</td>
                    <td></td>
                  </tr>
              </table>
        </div>

        </div>
        
  </body> 
</html>