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
        if(isset($_GET["uName"])){
            $uName =  $_GET["uName"];
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

    <div class="interviewForm" id="interviewForm">
    <form id="form-container" class="form-container" method="post" action="../controllers/userController.php">
    <input type="hidden" name="type" value="scheIntOrg">
    <i id="closeBtn" class="far fa-times-circle"></i>
    <div class="heading"><h>Schedule Interview</h></div>
    <input id="candUnameInput" type="hidden" name="candUname" value="">
    
        <label for="intScheDate">Date<span class="reqStar">*</span></label>
        <input id="intScheDate" name="intScheDate" type="date" required>

        <label for="intScheTime">Time<span class="reqStar">*</span></label>
        <input id="intScheTime" name="intScheTime" type="time" required>

        <label for="intLink">Link<span class="reqStar">*</span></label>
        <textarea id="intLink" name="intLink" type="text" required></textarea>

        <div>
            <label>Select Interviewer<span class="reqStar">*</span></label>
            <select class="selectInt" name="selectInt" required>
                    <option value="" selected disabled>Select:</option>
                    
                    <?php 
                    if(isset($_SESSION['interviewers'])){
                        for($x=0;$x<count($_SESSION['interviewers']);$x++){
                            echo '<option value="'.$_SESSION['interviewers'][$x]->inter_username.'">'.$_SESSION['interviewers'][$x]->name.'</option>
                            ';
                            }
                        unset($_SESSION['interviewers']);
                    }
                    ?>

            </select>
            </div>
        <button type="submit">SCHEDULE</button>
    </form>
    </div>

    <div class="reportCand" id="reportCand">

    <form id="reportForm-container" class="form-container" method="post" action="../controllers/userController.php">
    <i id="closeBtnReport" class="far fa-times-circle"></i>
    <input type="hidden" name="type" value="reportCand">
    <input id="candUnameInput3" type="hidden" name="candUname" value="">

    <label for="sub">Subject<span class="reqStar">*</span></label>
    <input id="sub" name="sub" type="text" placeholder="Please enter the reason you are reporting" required>

    <label for="reportDesc">Description<span class="reqStar">*</span></label>
    <textarea id="reportDesc" name="reportDesc" type="text" form="reportForm-container" placeholder="Briefly describe your reason" required></textarea>
    
    <button class="submitBtn" type="submit">SUBMIT</button>
    </form>
    </div>


    <script>
        var uName = "<?php echo $uName ?>";
        $( document ).ready(function() {
            var searchResults = $(".viewCandContainer");
            $.get("../controllers/searchDataController.php?q=viewRespondedCand", {uName:uName}).done(function(data){
                    searchResults.html(data);
                   
            });
            $("#candUnameInput").val(uName);
            $("#candUnameInput3").val(uName);
            
        });

        $("#closeBtn").on("click",function(){
            $("#interviewForm").hide();
        });
        $("#closeBtnReport").on("click",function(){
            $("#reportCand").hide();
        });

        function openReportForm() {
        document.getElementById("reportCand").style.display = "block";
        }
        function openInterviewForm() {
        document.getElementById("interviewForm").style.display = "block";
        }

        

    </script>

</body>
</html>