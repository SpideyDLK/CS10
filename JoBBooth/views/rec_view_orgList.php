<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Organization List | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="viewOrgList">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>
    <div class="authHeading"><h>List of Organizations</h></div>

    
    <div class="viewOrgListRecContainerOuter">
            
        <div class="viewOrgListRecContainer">
            <table class="viewOrgListRec">
                <tr>
                    <th>Profile Photo</th>
                    <th>Organization Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/LOGO.png" alt="Profile Picture"></td>
                  <td>JoBBooth Inc.</td>
                  <td>Description Here</td>
                  <td><a href="view_cand_list_rec.php">View</a></td>
                </tr>
                
                
              </table>
        </div>

        </div>

        
  </body> 
</html>