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
        <link rel="stylesheet" href="intstyle.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="../views/intList.php"><i class="far fa-handshake"></i>  Interviews</a>
            <a href="#"> <i class="fas fa-cog"></i></i> Settings</a>
        <!--   <a href="../views/ads.php"><i class="fas fa-ad"></i> Advertisements</a>
            <a href="../views/org_jobs.php"><i class="fas fa-briefcase"></i> Jobs</a>
            <a href="publish_ad.php">Publish Ad</a> 
            <a href="hire_rec.php"> <i class="fas fa-user-plus"></i> Hire a Recruiter</a> 
           
            <a href="reg_interviewer.php">Register an Interviewer</a> -->
        </div>
  
       </div>
       <br>
       <div class="pendingIntHead"> <h>Your Pending Interviews</h> </div>
       <br><br>
       <div class="jobContainer">
       <div class="pendingListCont">
        
                </div></div>

      
        <script>
         
        $( document ).ready(function() {
            var container = $(".pendingListCont");
            
            $.get("../controllers/intController.php?q=pendingInterviews", {}).done(function(data){
              container.html(data);     
            });         
            
        });
       
        </script>




      
  </body> 
</html>