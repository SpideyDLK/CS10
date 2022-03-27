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
        <title>JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome" >

        <div class="logoBack">
            <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>

        
        <div class="searchVacancy">
            <form action="../controllers/userController.php" method="post">
                <input type="hidden" name="type" value="searchCandRec">
                <input class="searchBar" name="searchTerm" type="text" placeholder="Search for a candidate by job position..." required> <span class="searchIconOrg"><i id="searchIconOrg" class="fas fa-search"></i></span>
                <button class="searchButtonOrg" name="searchBtn" type="submit">SEARCH</button>
            </form> 
        </div>
        <?php

        if(isset($_SESSION['searchRes'])){
          if(count($_SESSION['searchRes'])==0){
            echo '<div id="searchResults" align="center"><i>No results</i></div>';
          }
          else{
            echo '<div class="searchResultsOrgHome">
            <table class="searchResultsTable">
                <tr>
                  <th>Profile Photo</th>
                  <th>Candidate\'s Name</th>
                  <th>Level of Education</th>
                  <th></th>
                </tr>';
                for($x=0 ; $x<count($_SESSION['searchRes']) ; $x++){
                  echo '<tr>
                  <td><img id="proPic" src="../material/images/dafault_pro_pic.jpg" alt="Profile Picture"></td>
                  <td>'.$_SESSION['searchRes'][$x]->first_name.' '.$_SESSION['searchRes'][$x]->last_name.'</td>
                  <td>'.$_SESSION['searchRes'][$x]->level_of_education.'</td>
                  <td><a href="view_cand_org.php?candNo='.$x.'">View Candidate</a></td>
                </tr>';

                }
                echo '</table> </div>';
          }
        }
        ?>
        
    
    
    </body>
</html>