<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign-UP</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupInt">
    <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>
        
    <div class="signupRoleSelectCont">
        <a href="../views/signup_cand.php">
        <div class="signupRoleSelectSq">
            Candidates
            <img src="../material/images/candidateSign.png" alt="asd">

        </div>
        </a>

        <a href="../views/signup_org.php">
        <div class="signupRoleSelectSq">
            Organizations
            <img src="../material/images/orgSign.png" alt="asd">
        </div>
        </a>

        <a href="../views/signup_rec.php">
        <div class="signupRoleSelectSq">
            Recruiters
            <img src="../material/images/recruiterSign.png" alt="asd">
        </div>
        </a>
    </div>
        
    </body>

</html>
