<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up - Organization</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupOrg">

        <div class="logoBack">
            <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Sign Up - Organization</h></div>

        <form class="signUpOrgContainer" method="post" action="../controllers/userController.php">
            <input type="hidden" name="type" value="signupOrg">
            <div class="signUpOrgContainerH">Join with us!</div><br><br>
            <?php popUp('signupRed') ?>

                <div class="col">
                    <fieldset>

                        <legend>Organization Details</legend>

                        <label for="orgName">Organization Name<span class="reqStar">*</span></label>
                        <input id="orgName" name="orgName" type="text" required>

                        <label for="crn">Company Registration Number (CRN)<span class="reqStar">*</span></label>
                        <input id="crn" name="crn" type="text" required>

                        <label for="orgEmail">Organization Email<span class="reqStar">*</span></label>
                        <input id="orgEmail" name="orgEmail" type="text" required>

                        <label for="orgTele">Organization Telephone<span class="reqStar">*</span></label>
                        <input id="orgTele" name="orgTele" type="text" required>

                    </fieldset>
                </div>

                <div class="midCol"></div>

                <div class="col">
                    <fieldset>
                        <legend>Address</legend>

                        <label for="orgAL1">Address Line 1<span class="reqStar">*</span></label>
                        <input id="orgAL1" name="orgAL1" type="text" required>

                        <label for="orgAL2">Address Line 2</label>
                        <input id="orgAL2" name="orgAL2" type="text">

                        <label for="orgStrtname">Street Name<span class="reqStar">*</span></label>
                        <input id="orgStrtName" name="orgStrtName" type="text" required>

                        <label for="orgCity">City<span class="reqStar">*</span></label>
                        <input id="orgCity" name="orgCity" type="text" required>
                    </fieldset>

                    <div class="haveAcc">Already have an account ? <a class="link" href="../views/home.php">Login</a><br><br>
                        <a class="link" href="signup_cand.php">Click Here</a>
                        <i id ="handLeftIcon" class="fas fa-hand-point-left"></i>
                        to sign up as a Candidate
                    </div>

                </div>

                <div class="midCol"></div>
                
                <div class="col">

                    <fieldset>
                        <legend>Account Details</legend>

                        <label for="orgUname">Username<span class="reqStar">*</span></label>
                        <input id="orgUname" name="orgUname" type="text" required>

                        <label for="orgPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <input id="orgPwd" name="orgPwd" type="password" required>

                        <label for="orgConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <input id="orgConfPwd" name="orgConfPwd" type="password" required>

                    </fieldset>

                    <button class="signupButton" type="submit">SIGN UP</button>
                </div>
                
                

        </form>
    </body>

</html>
