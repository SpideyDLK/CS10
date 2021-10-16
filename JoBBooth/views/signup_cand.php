<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up - Candidate</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupCand">

        <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Sign Up - Candidate</h></div>

        <form class="signUpCandContainer" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="signupCand">
            <div class="signUpCandContainerH">Join with us!</div><br><br>
            <?php popUp('signupRed') ?>

                <div class="col">
                    <fieldset>

                        <legend>Personal Details</legend>

                        <label for="candFname">First Name<span class="reqStar">*</span></label>
                        <input id="candFname" name="candFname" type="text" required>

                        <label for="candLname">Last Name<span class="reqStar">*</span></label>
                        <input id="candLname" name="candLname" type="text" required>

                        <label for="candEmail">Email<span class="reqStar">*</span></label>
                        <input id="candEmail" name="candEmail" type="text" required>

                        <label for="candContact">Contact No.<span class="reqStar">*</span></label>
                        <input id="candContact" name="candContact" type="text"  required>

                    </fieldset>
                </div>

                <div class="midCol"></div>

                <div class="col">
                    <fieldset>
                        <legend>Professional Details</legend>

                        <label for="jobPos">Interested Job Position<span class="reqStar">* </span><div class="tooltip jptooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText jptooltipText">You can add more positions once logged in</span></div></label>
                        <input id="jobPos" name="jobPos" type="text" required>

                        <div>
                        <label>Level of Education<span class="reqStar">*</span></label>
                        <select class="eduDropdown" name="eduLevel">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">School</option>
                                <option value="2">Diploma</option>
                                <option value="3">Undergraduate</option>
                                <option value="4">Bachelor's Degree</option>
                                <option value="5">Master's Degree or Higher</option>
                        </select>
                        </div>

                    </fieldset>

                    <div class="haveAcc">Already have an account ? <a class="link" href="../views/home.php">Login</a><br><br>
                        <a class="link" href="signup_org.php">Click Here</a>
                        <i id ="handLeftIcon" class="fas fa-hand-point-left"></i>
                        to sign up as an Organization
                    </div>

                </div>

                <div class="midCol"></div>
                
                <div class="col">

                    <fieldset>
                        <legend>Account Details</legend>

                        <label for="candUname">Username<span class="reqStar">*</span></label>
                        <input id="candUname" name="candUname" type="text" required>

                        <label for="candPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <input id="candPwd" name="candPwd" type="password" required>

                        <label for="candConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <input id="candConfPwd" name="candConfPwd" type="password" required>
                    </fieldset>

                    <button class="signupButton" type="submit">SIGN UP</button>
                </div>
                
                

        </form>
    </body>

</html>
