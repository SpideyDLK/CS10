<?php
session_start();
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Candidate</title>
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
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-building"></i> Job Requests</button>
        <button class="tabs" onclick="toggleTab('2')" id="2"><i class="fas fa-paper-plane"></i> Job Applications</button>
        <span class="glider" id="glider"></span>
        </div>
    </div>

    <div class="tabContent" id="tab1">
    <table class="candJobReqTable">

    </table>
    </div>

    <div class="tabContent" id="tab2">
    <table class="candJobAppTable">

    </table>
    </div>

    <?php $uName = $_SESSION['username'] ?>


    <script>
            var tableContainer = $(".candJobReqTable");
            var tableContainer2 = $(".candJobAppTable");
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
            $.get("../controllers/searchDataController.php?q=candAllJobReqs", {uName:uName}).done(function(data){
                    tableContainer.html(data);    
            });

            $.get("../controllers/searchDataController.php?q=candJobApp", {uName:uName}).done(function(data){
                    tableContainer2.html(data);    
            });
        });

    </script>

</body>
</html>
