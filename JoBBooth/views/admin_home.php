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
        <title>Administrator</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome">

        <div class="logoBackAdminHome">
            <div> <img id="logoAdmin" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
        </div>

        <div class="adminHomeRow1">
            <div class="welcomeMsgAdminHome">
                <h1>Welcome, Admin</h1>
            </div>
        </div>
        
        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="../views/usersAdmin.php"><i class="fas fa-users"></i>  Users</a>
            <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i>  Log Out</a>
            
        </div>
  
       </div>



        
        
  </body> 
</html>