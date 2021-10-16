<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
    redirect("../views/home.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Ad | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php viewFullAd($_GET['adNo'],$_SESSION['searchRes']); ?>
</head>
<body class="viewAd" onload="viewFullAdd()">
    <div class="logoBack">
    
        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>
 
    <div class="viewAdContainer"> 
        <div class="col1-viewAd">
        <img id="proPic-viewAd" src="../material/images/dafault_pro_pic.jpg" alt="Profile Photo">
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Organization</legend>
            <div class="orgName-viewAd" id="orgName-viewAd"></div>
            </fieldset>
            
            <fieldset>
                <legend>Description</legend>
            <div class="Desc-viewAd"><p id="Desc-viewAd"></p></div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Available Position</legend>
            <div class="jobPos-viewAd" id="jobPos-viewAd"></div>
            </fieldset>

            <fieldset>
                <legend>Salary</legend>
            <div class="salary-viewAd" id="salary-viewAd"></div>
            </fieldset>
            <div class="button-viewAd"><button class="sendReqBtn-viewAd" type="submit">APPLY</button></div>
        </div>
        

    </div>

</body>
</html>