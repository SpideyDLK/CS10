<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="fPassword">
      <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Forgot Password?</h></div>


        
    <div class="fpContainer">
    
      <form method="post" id="pwdResetForm" action="../controllers/forgotpasswordController.php">
      <input type="hidden" name="type" value="passwordreset">
        <!-- <label for="email">Enter your email:</label><br> -->
       <!-- <input type="email" id="email" name="email" placeholder="Enter your email:" required><br><br><br>-->


        
                        <label for="email">Enter your email:<span class="reqStar">*</span></label><br>
                        <input id="email" name="email" type="text" required>
                        
        
      
      
      
        <button type="submit" name="password_reset_link">Send Password Reset Link</button>
      </form>
      <?php popUp('loginRed') ?><?php popUp('loginGreen') ?>
    </div>

    
     
</body>
</html>