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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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
                <!-- <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
                <img id="proPic" src="data:image/jpeg;base64,"base64_encode($_SESSION['searchRes'][$x]->profile_photo).""/> -->
                <?php if(isset($_SESSION['pp'])){
                    echo "<div class='proPicEditCont'></div>";
                }else{
                    echo "<div id='generatedProPic'></div>";
                }?>
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                  <div class="logOutBtn" >
                  <a href="../controllers/userController.php?q=logout"> <span><i class="fas fa-sign-out-alt"></i> Logout</span> </a>
                  </div>
                  
                  <!-- <div class="moreDropDown">
                  <div class="moreBtn"><a href=""></a><span class="arrowDownIcon"><i id="userSettingsIcon" class="fas fa-user-cog"></i></span></div>
                  <div class="moreDropDown-content">
                        <a href="cand_edit_pro.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../views/add_more_job_pos.php"><i class="fas fa-plus-circle"></i> Add Job Positions</a>
                        <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </div>
                  </div> -->
                
            </div>
        </div>
        <div class="candContainer">

        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="interviews_cand.php"><i class="far fa-handshake"></i>  Interviews</a>
            <a href="cand_Pending_Job_Requests.php"><i class="fas fa-briefcase"></i> Jobs</a>
            <a href="../controllers/userController.php?q=settings_cand"> <i class="fas fa-cog"></i></i> Settings</a>
            <!-- <a href="reg_interviewer.php">Register an Interviewer</a> -->
        </div>
                </div>

                <div class="searchVacancy">
                <form action="../controllers/searchDataController.php?q=candSearchingVacancyRes" method="post">
                <!-- <input type="hidden" name="type" value="searchCand"> -->
                <input class="searchBar" autocomplete="off" id="searchBar" name="searchTerm" type="text" placeholder="Search for a vacancy by skill or job position..." required>
                <button type="submit" class="searchButtonOrg"><i class="fa fa-search"></i></button>
                <div class="result" id="res"></div>
                <div class="trendySearches">
                <p class="trendyJobs"></p>
                <p class="trendySkills"></p>
                </div>
            </form> 
            </div>
       
        <div class="jobContainer">
        
          <div class="slideshow-container">

           </div>       
        </div>
        
        <script>

          //profile pic
          var proPic = $('.proPicEditCont');
            $.get("../controllers/searchDataController.php?q=getProPic").done(function(data){
              proPic.html(data);
            });

          $(document).ready(function(){
            //search suggestions
            $('.searchVacancy input[type="text"]').on("keyup input",function(){
              var searchTerm = $.trim($(this).val());
              var resultDropdown = $(this).siblings(".result");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=candSearchingVacancy", {term: searchTerm}).done(function(data){
                      resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
              });

            $(document).on("click", ".result p", function(){
              $(this).parents(".searchVacancy").find('input[type="text"]').val($(this).text().replace(/\(.*?\)/g,''));
              $(this).parents(".searchVacancy").find('button[type="submit"]').click();
              $(this).parent(".result").empty();
            });

            //most searched
            var trendyJobs = $('.trendyJobs');
            $.get("../controllers/searchDataController.php?q=mostSearchedJobs").done(function(data){
              trendyJobs.html(data);
            });
            var trendySkills = $('.trendySkills');
            $.get("../controllers/searchDataController.php?q=mostSearchedSkills").done(function(data){
                trendySkills.html(data);
            });

            $(document).on("click", ".trendyJobs button", function(){
              $("#searchBar").val($(this).text());
            });
            $(document).on("click", ".trendySkills button", function(){
              $("#searchBar").val($(this).text());
            });

          });
          //profile picture first name
          $(document).ready(function(){
            var firstName = "<?php echo $_SESSION['fName']?>";
            let initials = firstName.charAt(0).toUpperCase();
            document.getElementById("generatedProPic").innerHTML = initials;
          });

          $( document ).ready(function() {
            var container = $(".slideshow-container");
            
            $.get("../controllers/searchDataController.php?q=candDashboard", {}).done(function(data){
              container.html(data);     
            });         
            
          });

          </script>
    
    </body>
</html>