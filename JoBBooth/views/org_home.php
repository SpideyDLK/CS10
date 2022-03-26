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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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
                <!-- <img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture">
               -->
               <?php if(isset($_SESSION['pp'])){
                    echo "<embed class='proPicEdit' src='data:image/png;base64,".base64_encode($_SESSION['pp'])."'/>";
                }else{
                    echo "<div id='generatedProPic'></div>";
                }?>
                
                <h><?php if(isset($_SESSION['fName'])){
                  echo $_SESSION['fName'];
                  }?></h>
                  <div class="moreDropDown">
                  <div class="moreBtn"><a href=""></a><span class="arrowDownIcon"><i id="userSettingsIcon" class="fas fa-user-cog"></i></span></div>
                  <div class="moreDropDown-content">
                        <a href="org_edit_pro.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                  </div>
                  </div>
            </div>
        </div>
        
        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="../views/interviewers.php"><i class="far fa-handshake"></i>  Interviews</a>
            <a href="../views/ads.php"><i class="fas fa-ad"></i> Advertisements</a>
            <a href="../views/org_jobs.php"><i class="fas fa-briefcase"></i> Jobs</a>
            <!-- <a href="publish_ad.php">Publish Ad</a> -->
            <a href="hire_rec.php"> <i class="fas fa-user-plus"></i> Hire a Recruiter</a>
            <a href="#"> <i class="fas fa-cog"></i></i> Settings</a>
            <!-- <a href="reg_interviewer.php">Register an Interviewer</a> -->
        </div>
  
       </div>
  
        <div class="searchVacancy">
            <form action="../controllers/searchDataController.php?q=orgSearchingCandRes" method="post">
                <!-- <input type="hidden" name="type" value="searchCand"> -->
                <input class="searchBar" autocomplete="off" id="searchBar" name="searchTerm" type="text" placeholder="Search for a candidate by skill or job position..." required>
                <button type="submit" class="searchButtonOrg"><i class="fa fa-search"></i></button>
                <div class="result" id="res"></div>
                <div class="trendySearches">
                <p class="trendyJobs"></p>
                <p class="trendySkills"></p>
                </div>
            </form> 
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

        <script>
          $(document).ready(function(){
            //search suggestions
            $('.searchVacancy input[type="text"]').on("keyup input",function(){
              var searchTerm = $.trim($(this).val());
              var resultDropdown = $(this).siblings(".result");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=orgSearchingCand", {term: searchTerm}).done(function(data){
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

          //profile pic first name first letter
          $(document).ready(function(){
            var firstName = "<?php echo $_SESSION['fName']?>";
            let initials = firstName.charAt(0).toUpperCase();
            document.getElementById("generatedProPic").innerHTML = initials;
          });
          

          //side bar

//           let arrow = document.querySelectorAll(".arrow");
// for (var i = 0; i < arrow.length; i++) {
//   arrow[i].addEventListener("click", (e)=>{
//  let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
//  arrowParent.classList.toggle("showMenu");
//   });
// // }

// let cand_sidebar = document.querySelector(".cand_sidebar");
// let cand_sidebarBtn = document.querySelector(".bx-menu");
// console.log(cand_sidebarBtn);
// cand_sidebarBtn.addEventListener("click", ()=>{
//     cand_sidebar.classList.toggle("close");
// });

// var cand1 = true;
// function candDash1(){
//   if(cand===true){
//     document.getElementById("candDashTopic").style.block = "display";
//     cand1 = false;
//   }
//   else{
//     document.getElementById("candDashTopic").style.display = "none";
//     cand1 = true;
//   }
// }

// //candidate dashboard
// let sidebar = document.querySelector(".sidebar");
// let closeBtn = document.querySelector("#candbtn");
// let searchBtn = document.querySelector(".bx-search");

// closeBtn.addEventListener("click", ()=>{
//   sidebar.classList.toggle("open");
//   menuBtnChange();
// });

// searchBtn.addEventListener("click", ()=>{ 
//   sidebar.classList.toggle("open");
//   menuBtnChange(); 
// });


// function menuBtnChange() {
//  if(sidebar.classList.contains("open")){
//    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
//  }else {
//    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
//  }
// }
        </script>


        
        
  </body> 
</html>