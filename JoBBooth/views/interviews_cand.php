<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Interviewers | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="viewIntOrg">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>
        <?php popUp('loginGreen');?>
        <div class="interviewsCandTabCont">
            <table class="interviewsCandTab">

            </table>
        </div>

        <div class="interviewForm" id="interviewForm">
    <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
    <input type="hidden" name="type" value="rescheIntCand">
    <i id="closeBtn" class="far fa-times-circle"></i>
    <div class="heading"><h>Re-schedule</h></div>
    <p><span class="reqStar">*</span>You can select upto 5 dates and times that you will be available</p>
    <input id="refNo" type="hidden" name="refNo" value="">

    <div style="display:flex" class="flexDatenTime">
        <div class="dateRow">
            <label for="date1">Date 1</label>
            <input id="date1" name="date1" type="date" required>
        </div>

        <div>
        <label for="time1">Time 1</label>
        <input id="time1" name="time1" type="time" required>
        </div>
    </div>

    <div style="display:flex" class="flexDatenTime">
        <div class="dateRow">
            <label for="date2">Date 2</label>
            <input id="date2" name="date2" type="date" >
        </div>

        <div>
        <label for="time2">Time 2</label>
        <input id="time2" name="time2" type="time" >
        </div>
    </div>

    <div style="display:flex" class="flexDatenTime">
        <div class="dateRow">
            <label for="date3">Date 3</label>
            <input id="date3" name="date3" type="date" >
        </div>

        <div>
        <label for="time3">Time 3</label>
        <input id="time3" name="time3" type="time" >
        </div>
    </div>

    <div style="display:flex" class="flexDatenTime">
        <div class="dateRow">
            <label for="date4">Date 4</label>
            <input id="date4" name="date4" type="date" >
        </div>

        <div>
        <label for="time4">Time 4</label>
        <input id="time4" name="time4" type="time">
        </div>
    </div>

    <div style="display:flex" class="flexDatenTime">
        <div class="dateRow">
            <label for="date5">Date 5</label>
            <input id="date5" name="date5" type="date">
        </div>

        <div>
        <label for="time5">Time 5</label>
        <input id="time5" name="time5" type="time">
        </div>
    </div>
        

        

        <button type="submit">SEND REQUEST</button>
    </form>
    </div>


        <script>
            $( document ).ready(function() {
            var intList = $(".interviewsCandTab");
            
            $.get("../controllers/searchDataController.php?q=viewIntsCand", {}).done(function(data){
                intList.html(data);     
            });
            
            
            });
        </script>

        
  </body> 
</html>