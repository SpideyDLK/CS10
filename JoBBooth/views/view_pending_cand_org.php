<?php
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
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="viewAd">
    <div class="logoBack">
    
        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>
 
    <div class="viewCandContainer"> 
        <div class="col1-viewAd">
        <img id="proPic-viewAd" src="../material/images/dafault_pro_pic.jpg" alt="Profile Photo">
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Personal Details</legend>
            <div class="persDet-viewCand" id="persDet-viewCand"><b>Name:</b> FirstName LastName<br><b>Email:</b> abc@gmail.com<br><b>Contact No.:</b> 0711234567</div>
            </fieldset>
            
            <fieldset>
                <legend>Address</legend>
            <div>Address Line 1,<br>Address Line 2,<br>Street Name,<br>City.<p id="address-viewCand"></p></div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Interested Job Position(s)</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
                <ul>
                    <li>Job Position 1</li>
                    <li>Job Position 2</li>
                    <li>Job Position 3</li>
                    <li>Job Position 4</li>
                    <li>Job Position 5</li>
                </ul>
            </div>
            </fieldset>

            <fieldset>
                <legend>Level of Education</legend>
            <div  id="lvlEdu-viewCand">Undergraduate</div>
            </fieldset>
            <button onclick="document.location='schedule_int.php'" class="sendReqBtn-viewCand">SCHEDULE INTERVIEW</button>
        </div>
        

    </div>

</body>
</html>