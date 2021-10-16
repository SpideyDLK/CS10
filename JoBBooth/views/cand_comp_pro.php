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
    <title>Complete Profile | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        
</head>
<body class="compProfile">
      <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="compProfileH"><h>Complete Profile</h></div>
        <div class="compProfileContainer">
            <form action="#" method="post">
                <input type="hidden" name="type" value="compProfileCand">

                <label for="nic">NIC<span class="reqStar">*</span></label>
                <input id="nic" name="nic" type="text" required>

                <fieldset>
                    <legend>Address</legend>

                    <label for="candAL1">Address Line 1<span class="reqStar">*</span></label>
                    <input id="candAL1" name="candAL1" type="text" required>

                    <label for="candAL2">Address Line 2</label>
                    <input id="candAL2" name="candAL2" type="text">

                    <label for="candStrtName">Street Name<span class="reqStar">*</span></label>
                    <input id="candStrtName" name="candStrtName" type="text" required>

                    <label for="candCity">City<span class="reqStar">*</span></label>
                    <input id="candCity" name="candCity" type="text" required>

                </fieldset>

                <button class="submitBtn-compProfile" type="submit">SUBMIT</button>

            </form>
        </div>


</body>
</html>