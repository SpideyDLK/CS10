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
            <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>

        
        <div class="authHeading"><h>Hire Recruiters</h></div>

        <div class="searchRec">
            <form action="../controllers/userController.php" method="post">
              <input type="hidden" name="type" value="searchRec">
                <input class="searchBar" type="text" name="searchTerm" placeholder="Search for a recruiter..." required> <span class="searchIconHireRec"><i id="searchIconHireRec" class="fas fa-search"></i></span>
                <button class="searchButtonHireRec" type="submit">SEARCH</button>
            </form> 
        </div>

        <?php if(isset($_SESSION['searchResRec'])){
            printTableRec($_SESSION['searchResRec']);
            }
            ?>
        
    
    
    </body>
</html>