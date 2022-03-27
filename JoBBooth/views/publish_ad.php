<?php 
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
    redirect("../views/home.php");
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Publish Ad | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="publishAd">

        <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Publish Ad</h></div>

        <form id="publishAd" class="publishAdContainer" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="publishAd">

        <label for="adTitle">Title<span class="reqStar">*</span></label>
        <input id="adTitle" name="adTitle" type="text" required>

        <label for="descPubAd">Description</label>
        <textarea id="descPubAd" name="descPubAd" type="text" form="publishAd"> </textarea>

        <label for="jobTitlePubAd">Job Title<span class="reqStar">*</span></label>
        <input id="jobTitlePubAd" name="jobTitlePubAd" type="text" required>

        <div class="salaryPubAd">
            <div class="row1">
                <label>Frequency<span class="reqStar">*</span></label>
                <select class="payFreq" name="payFreq">
                    <option value="0" selected disabled>Select:</option>
                    <option value="1">Hourly</option>
                    <option value="2">Daily</option>
                    <option value="3">Monthly</option>
                    <option value="4">Per Job</option>
                </select>
            </div>

            <div class="row2">
                
                <label for="amountPubAd">Amount<span class="reqStar">*</span></label>
                <input id="amountPubAd" name="amountPubAd" type="number" min="1" step="any" required>
            </div>
        </div>
        <button class="publishButton" type="submit">PUBLISH</button>

        

        </form>
            


    </body>

</html>
