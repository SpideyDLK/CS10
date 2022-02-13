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
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome" >

        <div class="logoBack">
            <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>

        
        <div class="authHeading"><h>Hire Recruiters</h></div>

        <div class="searchRec">
                <!-- <input type="hidden" name="type" value="searchCand"> -->
                <input class="searchBarRec" autocomplete="off" id="searchBar" name="searchTerm" type="text" placeholder="Filter by entering a specialization area..." required>
                <div class="result" id="res"></div>
                <div class="trendySearches">
                <p class="trendyJobs"></p>
                <p class="trendySkills"></p>
                </div>
        </div>

        <div class="hireRecTableCont">

        </div>
        <div class="hireRecForm" id="hireRecForm">
                <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
                <i id="closeBtnForm" class="far fa-times-circle"></i>
                <input type="hidden" name="type" value="hireRec">
                <input type="hidden" id ="recUname" name="recUname" value="">
                <label for="hireRecDesc">Description<span class="reqStar">*</span></label>
                <textarea id="hireRecDesc" name="hireRecDesc" type="text" form="form-container" placeholder="Describe the required service in-detail..." required></textarea>
                <button  type="submit">SEND REQUEST</button>
                </form>
        </div>

        
        
    
        <script>
            $( document ).ready(function() {
            var recs = $(".hireRecTableCont");
            
            $.get("../controllers/searchDataController.php?q=viewAllRecs", {}).done(function(data){
                recs.html(data);     
            });
            
            
            });

            $(".searchBarRec").on("keyup",function(){
                var searchTerm = $(".searchBarRec").val();
                var recs = $(".hireRecTableCont");
                
                $.get("../controllers/searchDataController.php?q=viewFilteredRecs", {searchTerm:searchTerm}).done(function(data){
                recs.html(data);     
            });
            });
        </script>
    
    </body>
</html>