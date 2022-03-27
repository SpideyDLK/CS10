<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interviewer Registration</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
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

        <div class="authHeading"><h>Register an Interviewer</h></div>

        <form class="signUpIntContainer" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="signupInt">
            <div class="signUpIntContainerH">Add your interviewers...</div><br><br>
            <?php popUp('signupRed') ?>

                <div class="colRegInt">
                    <fieldset>

                        <legend>Personal Details</legend>

                        <label for="intFullName">Full Name<span class="reqStar">*</span></label>
                        <input id="intFullName" name="intFullName" type="text" required>

                        <label for="intNIC">NIC<span class="reqStar">*</span></label>
                        <input id="intNIC" name="intNIC" type="text" required>

                        <label for="intEmail">Email<span class="reqStar">*</span></label>
                        <input id="intEmail" name="intEmail" type="text" required>

                        <label for="intContact">Contact No.<span class="reqStar">*</span></label>
                        <input id="intContact" name="intContact" type="text"  required>

                    </fieldset>
                </div>

                
                
                <div class="colRegInt">

                    <fieldset>
                        <legend>Account Details</legend>

                        <label for="intUname">Username<span class="reqStar">*</span></label>
                        <input id="intUname" name="intUname" type="text" required>

                        <label for="intPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <input id="intPwd" name="intPwd" type="password" required>

                        <label for="intConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <input id="intConfPwd" name="intConfPwd" type="password" required>
                    </fieldset>

                    <button class="signupButton" type="submit">REGISTER</button>
                </div>
                
                

        </form>
    </body>

</html>
