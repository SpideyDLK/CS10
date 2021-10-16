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
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="myAdsbody">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>
        <div class="authHeading"><h>List of Candidates</h></div>
        <div class="pendinginterContainerOuter">
            <div class="pendinginterHeading"><h>JoBBooth Inc.</h></div>
            <div class="candListRecContainer">
            <table class="pendinginter">
                <tr>
                  <th>Profile Photo</th>
                  <th>Candidate's Name</th>
                  <th>Interested Job Position(s)</th>
                  <th>Level of Education</th>
                  <th></th>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                <tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>User</td>
                  <td>Financial Accountant</td>
                  <td>Bachelor's Degree</td>
                  <td><a href="view_cand_rec.php">View</a></td>
                </tr>
                
                
                
              </table>
        </div>
        
       </div> 

        
  </body> 
</html>