<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Interviews | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="intstyle.css">
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

        <div class="tabContainer">
        <div class = "tabContainerInner">
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-user-tie"></i> Interviews</button>
        <button class="tabs" onclick="toggleTab('2')" id="2"><i class="far fa-calendar-alt"></i>Finished</button>
        <button class="tabs" onclick="toggleTab('3')" id="3"><i class="far fa-calendar-alt"></i>Selected</button>
        <span class="glider3" id="glider"></span>
        </div>
        </div>

        <div class="tabContent" id="tab1">
        
        <table class="interListTable1">
        
        </table>

        </div>

        <div class="tabContent" id="tab2">
        
        <table class="finishedListTable"> 

        </table>

        </div>

        <div class="tabContent" id="tab3">
        
        <table class="selectedListTable"> 

        </table>
        
        </div>
        
        <br>
        <div id="viewCandCont" class="viewCandCont"></div>
        <div id ="finishIntContainer">
        <i id="closeBtn2" class="far fa-times-circle"></i>
            <br>
        <div id = "ratingContainer">
        <h5>Rate the candidate</h5>
            <i class="fa fa-star"  data-index="0"></i>
            <i class="fa fa-star"  data-index="1"></i>
            <i class="fa fa-star"  data-index="2"></i>
            <i class="fa fa-star"  data-index="3"></i>
            <i class="fa fa-star"  data-index="4"></i>
        </div>
            <div id="feedbackContainer">
                <h5>Enter your feedback here</h5>
            <form id="fbForm" method="post" action="../controllers/intController.php">
            <input type="hidden" name="type" value="ratingFeedback">
            <input id="refno" type="hidden" name="refNo" value="">
            <input type="hidden" id="rate" name="rate" value="">
            <input type="hidden" name="status" value="finished">
            <textarea id="feedback" name="feedback" type="text" form="fbForm" rows="6" cols="50" ></textarea><br>
            <button type="submit">SAVE</button>
           
</form>
</div>
</div>


        <div class="interviewForm" id="interviewForm">
    <form id="form-container" class="form-container" method="post" action="../controllers/intController.php">
    <input type="hidden" name="type" value="rescheIntInterviewer">
    <i id="closeBtn1" class="far fa-times-circle"></i>
    <div class="heading"><h>Schedule Interview</h></div>
    <input id="refNo" type="hidden" name="refNo" value="">
    
        <label for="intScheDate">Date<span class="reqStar">*</span></label>
        <input id="intScheDate" name="intScheDate" type="date" required>

        <label for="intScheTime">Time<span class="reqStar">*</span></label>
        <input id="intScheTime" name="intScheTime" type="time" required>

        <label for="intLink">Link<span class="reqStar">*</span></label>
        <textarea id="intLink" name="intLink" type="text" required></textarea>

        
        <button type="submit">SAVE</button>
    </form>
    </div>

        <script>
        function toggleTab(tabNo){
            glider = document.getElementById("glider");
            if(tabNo=="default"){
                document.getElementById("tab1").style.display="block";
                document.getElementById("tab2").style.display="none";
                document.getElementById("tab3").style.display="none";
                glider.style.transform = "translateX(0)";
            }
            else if(tabNo=="2"){
                document.getElementById("tab2").style.display="block";
                document.getElementById("tab1").style.display="none";
                document.getElementById("tab3").style.display="none";
                glider.style.transform = "translateX(100%)";
            }
            else{
               document.getElementById("tab3").style.display="block";
               document.getElementById("tab1").style.display="none";
               document.getElementById("tab2").style.display="none";
                glider.style.transform = "translateX(200%)";
            }
        }

        var uName = "<?php 
        if(isset($_GET['uName'])){
            echo $_GET['uName'];
        }
        ?>";
        
        var tabNo = "<?php 
        if(isset($_GET['tabNo'])){
            echo $_GET['tabNo'];
        }
        ?>";
        if(tabNo){
            document.getElementById(tabNo).click();

        }
        else{
            document.getElementById("default").click();

        }
        //load interviewers
        $( document ).ready(function() {
            var intList = $(".interListTable1");
            var finishedList = $(".finishedListTable");
            var selectedList = $(".selectedListTable");
            var viewCand=$(".viewCandCont")
            
            $.get("../controllers/intController.php?q=listInterviews", {}).done(function(data){
                intList.html(data);     
            });
            $.get("../controllers/intController.php?q=finishedList", {}).done(function(data){
                finishedList.html(data); 
            });
            $.get("../controllers/intController.php?q=selectedList", {}).done(function(data){
                selectedList.html(data); 
            });
           $.get("../controllers/intController.php?q=viewRespondedCand", {uName:uName}).done(function(data){
             viewCand.html(data); 
            });
            
        });

        var ratedIndex = -1;
         rate;
$(document).ready(function(){
    
 $('.fa-star').on('click',function(){
    ratedIndex = parseInt($(this).data('index'));
    rate = ratedIndex+1;
    
    //localStorage.setItem('ratedIndex', ratedIndex);
    document.getElementById("rate").value = rate;
    

});
$('.fa-star').mouseover(function(){
     $('.fa-star').css('color','black');
        var currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
});

$('.fa-star').mouseleave(function(){
     $('.fa-star').css('color','black');
       if (ratedIndex !=-1 )
       setStars(ratedIndex);
         
         });
});

function setStars(max){
    for(var i=0;i<=max;i++)
              $('.fa-star:eq('+i+')').css('color','teal');
        
    }
        
 </script>

        
  </body> 
</html>