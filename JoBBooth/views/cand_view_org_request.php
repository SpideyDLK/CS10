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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php 
        if(isset($_POST["uName"])){
            $uName =  $_POST["uName"];
        }
        else if(isset($_SESSION['candUname'])){
            $uName =  $_SESSION['candUname'];
            unset($_SESSION['candUname']);
        }
            
        ?>
</head>
<body class="viewAd">
    <div class="logoBack">
    
        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>
 
    <div class="viewCandContainer"> </div>

    <div class="orgJobReqtoCandForm" id="orgJobReqtoCandForm">
    <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
    <i id="closeBtn" class="far fa-times-circle"></i>
    <div class="heading"><h>Send Job Request</h></div>
        <input type="hidden" name="type" value="orgSendJobReqCand">
        <input id="candUnameInput" type="hidden" name="candUname" value="">

        <label for="jobPos">Available Job Position<span class="reqStar">*</span></label>
        <input id="jobPos" name="jobPos" type="text" required>

        <br>
        <label for="jobType">Job Type<span class="reqStar">*</span></label>
        <select class="jobTypeDropdown selectBox" name="jobType">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">Full Time</option>
                                <option value="2">Part Time</option>
                                <option value="3">Work From Home</option>
        </select>

        <label for="sal">Salary (LKR)<span class="reqStar">*</span></label>
        <input id="sal" name="sal" type="number" min="1" step="any" required>

        <label>Salary Frequency<span class="reqStar">*</span></label>
                <select class="salFreq" name="salFreq">
                    <option value="0" selected disabled>Select:</option>
                    <option value="1">Hourly</option>
                    <option value="2">Daily</option>
                    <option value="3">Monthly</option>
                    <option value="4">Per Job</option>
        </select>
        <br>
        <label for="desc">Description</label>
        <textarea id="desc" name="desc" type="text" form="form-container"> </textarea>
        <button type="submit">SEND</button>
    </form>
    </div>

    <div class="areYourSureMsg" id="areYourSureMsg">
    <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
    <input type="hidden" name="type" value="orgCancelJobReqCand">
    <input id="candUnameInput2" type="hidden" name="candUname" value="">
    <h><i class="fas fa-exclamation"></i> Are you sure to cancel the job request?</h><br>
    <button class="yesBtn" type="submit">Yes</button>
    <button class="noBtn" type="button">No</button>
    </form>
    </div>


    <script>
        var uName = "<?php echo $uName ?>";
        $( document ).ready(function() {
            var searchResults = $(".viewCandContainer");
            $.get("../controllers/searchDataController.php?q=viewCand", {uName:uName}).done(function(data){
                    searchResults.html(data);
                   
            });
            $("#candUnameInput").val(uName);
            $("#candUnameInput2").val(uName);
            
        });

        $("#closeBtn").on("click",function(){
            $("#orgJobReqtoCandForm").hide();
        });
        $(".noBtn").on("click",function(){
            $("#areYourSureMsg").hide();
        });

        function openForm() {
        document.getElementById("orgJobReqtoCandForm").style.display = "block";
        }
        function openAlert() {
        document.getElementById("areYourSureMsg").style.display = "block";
        }

    </script>

</body>
</html>