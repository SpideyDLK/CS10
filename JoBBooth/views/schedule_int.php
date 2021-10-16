<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Schedule Interview | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="scheInt">

        <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Schedule Interview</h></div>

        <form id="scheInt" class="scheIntContainer" method="post" action="#">
        <input type="hidden" name="type" value="scheInt">

        <label for="intScheDate">Date<span class="reqStar">*</span></label>
        <input id="intScheDate" name="intScheDate" type="date" required>

        <label for="intScheTime">Time<span class="reqStar">*</span></label>
        <input id="intScheTime" name="intScheTime" type="time" required>

        <label for="intLink">Link<span class="reqStar">*</span></label>
        <textarea id="intLink" name="intLink" type="text" required></textarea>

        <div>
            <label>Select Interviewer<span class="reqStar">*</span></label>
            <select class="selectInt" name="selectInt">
                    <option value="0" selected disabled>Select:</option>
                    <option value="1">Interviewer 1</option>
                    <option value="2">Interviewer 2</option>
                    <option value="3">Interviewer 3</option>
                    <option value="4">Interviewer 4</option>
                    <option value="5">Interviewer 5</option>
            </select>
            </div>
        <button class="publishButton" type="submit">SCHEDULE</button>

        

        </form>
            


    </body>

</html>
