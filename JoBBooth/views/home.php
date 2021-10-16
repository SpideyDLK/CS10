<?php
session_start();
include_once '../helpers/session_helper.php';
if(isset($_SESSION['username'])){
    switch($_SESSION['userRole']){
        case 'Organization':
            redirect("../views/org_home.php");
            break;
        case 'Candidate':
            redirect("../views/cand_home.php");
            break;
        case 'Interviewer':
            redirect("../views/interviewer_home.php");
            break;
        case 'Recruiter':
            redirect("../views/rec_home.php");
            break;
    }
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

    <body class="home">

        <div class="logoBackHome">
            <div> <img id="logoHome" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
        </div>

        <div class="desc">
            <p1>Welcome to JoBBooth!</p1>
            <p2>JoBBooth is a job finding and recruitment platform with lots of cool features that will make your life easy. This platform is mainly built up to overcome the difficulties faced by job seekers and organizations in the recruitment process.</p2>
            <p3>Join with us to make your job hunting or recruitment so much easier. </p3>
        </div>

        <div class="loginFormContainer">

            <h>Login</h>
            <form class="loginForm" method = "post" action = "../controllers/userController.php">
            <input type="hidden" name="type" value="login">
                <br>

                <i id="userIcon" class="fas fa-user"></i>
                <input id="uname" name="un" class="username" type="text" placeholder="Username" required>
                <br><br>
                <i id="passIcon" class="fas fa-lock"></i>
                <input id="pwd" name="pwd" class="password" type="password" placeholder="Password" required>
                <i id="eyeIcon" class="fas fa-eye-slash"></i>
                <br><br>
                <?php if(popUp('loginRed')){
                    echo '<script>
                    document.getElementById("userIcon").style.color = "red";
                    document.getElementById("passIcon").style.color = "red";
                    document.getElementById("uname").style.borderColor = "red";
                    document.getElementById("pwd").style.borderColor = "red";
                    </script>';
                    
                }
                popUp('loginGreen');
                ?>
                <br>
                <i id="keyIcon" class="fas fa-key fa-am"></i>
                <a class="fp" href="forgot_pwd.html">Forgot password?</a>
                <br><br><br>
                <button type="submit">LOGIN</button>
                <br><br>
                <a>New to JoBBooth? </a><br> <a class="su" href="signup_cand.php">Sign Up as a Candidate</a> <br> <a class="su" href="signup_org.php">Sign Up as an Organization</a>

            </form>
        </div>
        <script src="home_js.js"></script>
    </body>

</html>