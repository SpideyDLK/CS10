<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?> 

<!DOCTYPE html>
<html class="adsHtml">

    <head>
        <title>Advertisements | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="adsBody">

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
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-list-alt"></i> My Ads</button>
        <button class="tabs" onclick="toggleTab('2')" id="2"><i class="fas fa-plus-circle"></i> Publish a New Ad</button>
        <span class="glider" id="glider"></span>
        </div>
    </div>
    

    <div class="tabContent" id="tab1">
    <div class="headingMyAds"><h>My Ads</h></div>
    <table class="myAdsTable">

    </table>

    </div>

    <div class="tabContent" id="tab2">
    <div class="headingPubAd"><h>Publish Ad</h></div>
    <div class="pubAdContainer">
        <div class="pubAd-col1">
        <form method="post" id="pubAdForm" action="../controllers/userController.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="pubAd">
        <label for="adTitle">Ad Title<span class="reqStar">*</span></label>
        <input id="adTitle" name="adTitle" type="text" required>

        <br>
        <label for="jobPos">Job Position<span class="reqStar">*</span></label>
        <input id="jobPos" name="jobPos" type="text" required>

        <br>
        <label for="jobType">Job Type<span class="reqStar">*</span></label>
        <select class="jobTypeDropdown selectBox" name="jobType" required>
                                <option value="" selected disabled>Select:</option>
                                <option value="1">Full Time</option>
                                <option value="2">Part Time</option>
                                <option value="3">Work From Home</option>
        </select>

        <label for="sal">Salary (LKR)<span class="reqStar">*</span></label>
        <input id="sal" name="sal" type="number" min="1" step="any" required>

        <label>Salary Frequency<span class="reqStar">*</span></label>
                <select class="salFreq" name="salFreq" required>
                    <option value="" selected disabled>Select:</option>
                    <option value="1">Hourly</option>
                    <option value="2">Daily</option>
                    <option value="3">Monthly</option>
                    <option value="4">Per Job</option>
        </select>
        <label>Duration<span class="reqStar">*</span></label>
                <select class="adDuration" name="adDuration" required>
                    <option value="" selected disabled>Select:</option>
                    <option value="1">7 Days</option>
                    <option value="2">14 Days</option>
                    <option value="3">30 Days</option>
        </select>
            
        </div>
        <div class="pubAd-col2">
        <label for="desc">Description<span class="reqStar">*</span></label>
        <textarea id="desc" name="desc" type="text" form="pubAdForm" required> </textarea>

        <label for="skills">Required Skills</label>
        <textarea  id="skills" name="skills" type="text" form="pubAdForm" placeholder="Type the skills seperated by commas..."></textarea>

        <label for="flyerUpload">Upload Flyer</label><br>
        <p id="errMsg"></p>
        <input class="flyerUpload" name="flyerUpload" id="flyerUpload" type="file" accept=".pdf,.jpg,.jpeg,.png">
        <button type="submit">PUBLISH</button>
        </div>
        </form>
    </div>
    </div>

    <script>
        function toggleTab(tabNo){
            glider = document.getElementById("glider");
            if(tabNo=="default"){
                document.getElementById("tab1").style.display="block";
                document.getElementById("tab2").style.display="none";
                glider.style.transform = "translateX(0)";
            }
            else{
                document.getElementById("tab2").style.display="block";
                document.getElementById("tab1").style.display="none";
                glider.style.transform = "translateX(100%)";
            }
        }
        document.getElementById("default").click();

        //fyler size and type
        $('#flyerUpload').change(function () {
        var fileSize = ((this.files[0].size/1024)/1024).toFixed(4);
        var filePath = $(this).val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;

        if(fileSize>10 || !allowedExtensions.exec(filePath)){
            document.getElementById("flyerUpload").value="";
            $('#errMsg').text("File is too large or invalid file type");
            $('#errMsg').css({"color":"red"});
            $('#errMsg').show();
        }
        else{
            $('#errMsg').hide();
        }

        });

        $( document ).ready(function() {
            var myAds = $(".myAdsTable");
            
            $.get("../controllers/searchDataController.php?q=viewMyAds", {}).done(function(data){
                myAds.html(data);     
            });
            
            
        });
    </script>
  </body> 
</html>