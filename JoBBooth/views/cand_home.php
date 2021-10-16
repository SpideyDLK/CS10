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
        <title>JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome" >

        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>

        <div class="candHomeRow1">
            <div class="welcomeMsg">

                <h1>Hello, <?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h1>

                <h2>We welcome you to JoBBooth !</h2>
                <h3>Your struggling days to find a job is now behind...</h3>
            </div>
            <div class="proPic">
                <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                  <div class="moreDropDown">
                  <div class="moreBtn"><a href="">More </a><span class="arrowDownIcon"><i class="fa fa-caret-down"></i></i></span></div>
                  <div class="moreDropDown-content">
                        <a href="cand_comp_pro.php">Complete Profile</a>
                        <a href="../views/add_more_job_pos.php">Add Job Positions</a>
                        <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                  </div>
                  </div>
                
            </div>
            <!-- <div class="compProfileBtn"><a href="../views/complete_profile_cand.php">Complete Profile</a></div> -->
            <div class="editIcon"><a href="#"><i id="editIcon" class="far fa-edit"></i></a></div>
        </div>

        <div class="searchVacancy">
            <form action="../controllers/userController.php" method="post">
              <input type="hidden" name="type" value="searchAd">
                <input class="searchBar" type="text" name="searchTerm" placeholder="Search for a vacancy..." required> <span class="searchIcon"><i id="searchIcon" class="fas fa-search"></i></span>
                <button class="searchButton" type="submit">SEARCH</button>
            </form> 
        </div>

          <?php if(isset($_SESSION['searchRes'])){
            printTable($_SESSION['searchRes']);
            }
            ?>

        <div class="pendingJobReqContainerOuter">
            <div class="jobReqHeading"><h>Pending Job Requests</h></div>
        <div class="pendingJobReqContainer">
            <table class="pendingJobReq">
                <tr>
                  <th>Profile Photo</th>
                  <th>Organization Name</th>
                  <th>Job Position</th>
                  <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Financial Accountant</td>
                  <td><a href="../views/respond_req_cand.php">View Job</a></td>
                </tr>
                
                
              </table>
        </div>

        </div>
        

        <div class="pendingIntContainerOuter">
            <div class="pendIntHeading"><h>Pending Interviews</h></div>
            <div class="pendingIntContainer">
            <table class="pendingInterviews">
                <tr>
                  <th>Organization Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Link</th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                <tr>
                  <td>JobBooth Inc.</td>
                  <td>2022-01-22</td>
                  <td>9.00 AM</td>
                  <td><a href="#">Click Here</a></td>
                  <td><a href="#">Accept</a><br><a href="#">Decline</a></td>
                  <td><a href="resch_req_cand.php">Reschedule</a></td>
                </tr>
                
                
                
              </table>
        </div>

        </div>
        
        
    
    
    </body>
</html>