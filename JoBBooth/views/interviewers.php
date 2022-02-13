<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Interviewers | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="viewIntOrg">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="tabContainer">
        <div class = "tabContainerInner">
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-user-tie"></i> Interviewers</button>
        <button class="tabs" onclick="toggleTab('2')" id="2"><i class="far fa-calendar-alt"></i> Schedules</button>
        <span class="glider" id="glider"></span>
        </div>
        </div>

        <div class="tabContent" id="tab1">
        <br>
        <?php popUp('loginGreen');?>
        <button class="addNewInter"><i class="fas fa-user-plus"></i> Add New Interviewer</button>
        <table class="interListTable">
        
        </table>

        </div>

        <div class="tabContent" id="tab2">
        <div class="scheduleListCont">

        </div>
        </div>

        <div class="interviewForm" id="interviewForm">
    <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
    <input type="hidden" name="type" value="rescheIntOrg">
    <i id="closeBtn" class="far fa-times-circle"></i>
    <div class="heading"><h>Schedule Interview</h></div>
    <input id="refNo" type="hidden" name="refNo" value="">
    
        <label for="intScheDate">Date<span class="reqStar">*</span></label>
        <input id="intScheDate" name="intScheDate" type="date" required>

        <label for="intScheTime">Time<span class="reqStar">*</span></label>
        <input id="intScheTime" name="intScheTime" type="time" required>

        <label for="intLink">Link<span class="reqStar">*</span></label>
        <textarea id="intLink" name="intLink" type="text" required></textarea>

        <div>
            <label>Select Interviewer<span class="reqStar">*</span></label>
            <select class="selectInt" name="selectInt" required>
                    <option value="" selected disabled>Select:</option>
                    
                    <?php
                    if(isset($_SESSION['interviewers'])){
                        for($x=0;$x<count($_SESSION['interviewers']);$x++){
                            echo '<option value="'.$_SESSION['interviewers'][$x]->inter_username.'">'.$_SESSION['interviewers'][$x]->name.'</option>
                            ';
                            }
                            unset($_SESSION['interviewers']);
                    }
                    ?>

            </select>
            </div>
        <button type="submit">SAVE</button>
    </form>
    </div>

        

        



    <script>
        function toggleTab(tabNo){
            glider = document.getElementById("glider");
            if(tabNo=="default"){
                document.getElementById("tab1").style.display="block";
                document.getElementById("tab2").style.display="none";
                glider.style.transform = "translateX(0)";
            }
            else{
                document.getElementById("tab2").style.display="block";
                document.getElementById("tab1").style.display="none";
                glider.style.transform = "translateX(100%)";
            }
        }
        document.getElementById("default").click();

        //load interviewers
        $( document ).ready(function() {
            var intList = $(".interListTable");
            var scheduleList = $(".scheduleListCont");
            
            $.get("../controllers/searchDataController.php?q=listInterviewers", {}).done(function(data){
                intList.html(data);     
            });
            $.get("../controllers/searchDataController.php?q=listSchedules", {}).done(function(data){
                scheduleList.html(data); 
            });
            
        });

        $(".addNewInter").on("click",function(){
            window.location.href = "../views/signup_inter.php";
        })
       
    
    </script>

        
  </body> 
</html>