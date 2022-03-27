<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupInt">
        <?php popUp('loginGreen');?>
        <?php popUp('loginRed');?>
        <div class="authHeading"><h>Administrator Login</h></div>

        <form class="LoginAdminContainer" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="loginAdmin">
             
        <br>
        <input id="uname" name="un" class="username" type="text" placeholder="Username" required><br><br>
        <input id="pwd" name="pwd" class="password" type="password" placeholder="Password" required><br><br>
                
        <button class="adminSignupButton" type="submit">LOGIN</button>

        </form>

        
    </body>

</html>
