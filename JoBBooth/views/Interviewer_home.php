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
        <title>Interviewer</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
          function openForm() {
            document.getElementById("myForm").style.display = "block";
          }

          function closeForm() {
            document.getElementById("myForm").style.display = "none";
          }
        </script>
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

        <div class="candHomeRow1">
            <div class="welcomeMsg">
                <h1>Hello, <?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h1>
                <h2>We welcome you to JoBBooth !</h2>
                <h3>Your struggling days to recruit is now behind...</h3>
            </div>
            <div class="proPic">
                <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                  <div class="moreDropDown">
                  <div class="moreBtn"><a href=""></a><span class="arrowDownIcon"><i id="userSettingsIcon" class="fas fa-user-cog"></i></span></div>
                  <div class="moreDropDown-content">
                        <a href="int_edit_pro.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </div>
                  </div>
            </div>
        </div>
        
   
        <div class="intReschReqInter">
                <div class="jobReqHeading"><h>Interview Reschedule Requests</h></div>
            <div class="pendingJobReqContainer">
                <table class="pendingJobReq">
        
                <tr>
                  <th>Organization Name</th>
                  <th>Candidate's Name</th>
                  <th>Requested dates & times</th>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>User</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                </tr>
                
                
              </table>
        </div>
        </div>

        <div class="form-popup" id="myForm">
  <form class="form-container">
  <table class="pendingJobReq">
        
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>date_01</td>
          <td><form>
          <input type="radio" id="time_01"name="time" value="time_01">
  <label for="time_011">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
          <tr>
          <td>date_02</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
          <tr>
          <td>date_03</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr><tr>
          <td>date_04</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
        
                </table>
               </form>
               <div class="outer">
        <div id="close" onclick="closeForm()"><i class="fas fa-times-circle"></i></div>
    </div>
</div>


        <div class="pendingIntContainerOuterInter">
          <div class="pendIntHeading"><h>Pending Interviews</h></div>
            <div class="pendingIntContainer">
            <table class="pendingInterviews">
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
        <br>
       </div> 
       <br> <br>
  </body> 
</html>