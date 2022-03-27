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

        <div class="tabContainer">
        <div class = "tabContainerInner">
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-file-upload"></i> Job Requests</button>
        <span class="glider1" id="glider"></span>
        </div>
    </div>

    <div class="tabContent" id="tab1">
        <div class = "innerTabsJobReqOrg">
            
        </div>
    <div class="orgJobReqListCont">
        <table class="orgJobReqTable">
          
                
                
        </table>
      </div>

    </div>

    <div class="tabContent" id="tab2">
    
    </div>
      
    <?php $uName = $_SESSION['username'] ?>
    <script>
            var tableContainer = $(".orgJobReqTable");
            var uName = "<?php echo $uName ?>";


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

        $( document ).ready(function() {
            var innerTabs = $(".innerTabsJobReqOrg");
            
            $.get("../controllers/searchDataController.php?q=jobReqCount", {uName:uName}).done(function(data){
                    innerTabs.html(data);     
            });
            
            $.get("../controllers/searchDataController.php?q=allJobReqs", {uName:uName}).done(function(data){
                    tableContainer.html(data);    
            });
        });
        

    </script>
  </body> 
</html>