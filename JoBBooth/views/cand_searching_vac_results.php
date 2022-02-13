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
        <title>Organization</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="searchVacancy-resultPage">
            <form action="../controllers/searchDataController.php?q=candSearchingVacancyRes" method="post">
                <!-- <input type="hidden" name="type" value="searchCand"> -->
                <input class="searchBar" autocomplete="off" id="searchBar" value="<?php if(isset($_SESSION['searchTerm'])) echo $_SESSION['searchTerm'];?>" name="searchTerm" type="text" placeholder="Search for a vacancy by skill or job position..." required>
                <button type="submit" class="searchButtonOrg"><i class="fa fa-search"></i></button>
                <div class="result" id="res"></div>
                <!-- <div class="trendySearches">
                <p class="trendyJobs"></p><br>
                <p class="trendySkills"></p>
                </div> -->
            </form> 
        </div>

        <div class="searchResultContainer">
            <div class="filterContainer">
            <p> <u>&nbsp;&nbsp;&nbsp;<i class="fas fa-filter"></i>&nbsp;Filter &nbsp;&nbsp;&nbsp; </u> </p>

            <fieldset>
                <legend><i class="fas fa-coins"></i> Salary</legend>
                
                
                <input id="sal" name="sal" type="number" min="1" placeholder="Salary less than: " step="any" required>
                
                <select class="salFreq" name="salFreq" required>
                    <option value="0" selected disabled>Payment Frequency:</option>
                    <option value="1">Hourly</option>
                    <option value="2">Daily</option>
                    <option value="3">Monthly</option>
                    <option value="4">Per Job</option>
                </select>
                <i id="salFreqCancel" class="far fa-times-circle"></i>
                
                
                
            </fieldset>

            <fieldset>
                <legend><i class="fas fa-briefcase"></i> Job</legend>
                <select class="jobTypeDropdown selectBox" name="jobType" required>
                                <option value="0" selected disabled>Job Type:</option>
                                <option value="1">Full Time</option>
                                <option value="2">Part Time</option>
                                <option value="3">Work From Home</option>
                </select>
                <i id="jobTypeCancel" class="far fa-times-circle"></i>
            </fieldset>

            </div>

            <div class="searchResultContainerInner">
            <?php

                if(isset($_SESSION['searchRes'])){
                if(count($_SESSION['searchRes'])==0){
                    echo '<div class="noResult"><img id="noResult" src="../material/images/no-result.png" alt="Profile Picture"></div>';
                }
                else{
                    for ($x=0;$x<count($_SESSION['searchRes']);$x++){
                        echo '<div class="candSearchResContOrgHome">
                        <form method="POST" action="view_ad_cand.php" target="_blank">
                        <input type="hidden" name="refNo" value="'.$_SESSION['searchRes'][$x]->ref_no.'">
                        </form>
                        <div class="pp">
                        <img id="proPic" src="data:image/jpeg;base64,'.base64_encode($_SESSION['searchRes'][$x]->profile_photo).'"/>
                        <p>'.$_SESSION['searchRes'][$x]->company_name.'</p>
                        </div>
                        <table class="det">
                          <tr>
                          <td class="title"><i class="fas fa-briefcase"></i> Job Position </td><td>'.$_SESSION['searchRes'][$x]->job_title.'</td>
                            </tr>
                          <tr>
                          <td class="title"><i class="fas fa-tasks"></i> Required Skills </td><td>'.$_SESSION['searchRes'][$x]->skills.'</td>
                            </tr>
                          <tr>
                          <td class="title"><i class="fas fa-briefcase"></i> Job Type </td><td>'.$_SESSION['searchRes'][$x]->job_type.'</td>
                          </tr>
                          <tr>
                          <td class="title"><i class="fas fa-coins"></i> Salary </td><td>'.$_SESSION['searchRes'][$x]->rate.' LKR '.$_SESSION['searchRes'][$x]->frequency.'</td>
                          </tr>
                          
                          
                        </table>
                        </div>';
                    }
                }
                }
                
            ?>
            </div>

        </div>

        <script>

            //search suggestions
            
                $('.searchVacancy-resultPage input[type="text"]').on("keyup input",function(){
                var searchTerm = $.trim($(this).val());
                var resultDropdown = $(this).siblings(".result");
                if(searchTerm.length){
                    $.get("../controllers/searchDataController.php?q=orgSearchingCand", {term: searchTerm}).done(function(data){
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
                    });

                $(document).on("click", ".result p", function(){
                $(this).parents(".searchVacancy-resultPage").find('input[type="text"]').val($(this).text().replace(/\(.*?\)/g,''));
                $(this).parents(".searchVacancy-resultPage").find('button[type="submit"]').click();
                $(this).parent(".result").empty();
            });

        
            //filters
            $(".salFreq").change(function(){
                filterRes();
                $("#salFreqCancel").show();
            });
            $(".jobTypeDropdown").change(function(){
                filterRes();
                $("#jobTypeCancel").show();
            });
            $("#sal").keyup(function(){
                filterRes();
            });
            

            function filterRes(){
                var salFreq = "";
                var jobType = "";
                var salary;

                var searchResults = $(".searchResultContainerInner");   
                if($(".salFreq").val()){
                    salFreq = $('.salFreq').find(":selected").text();
                }
                if($(".jobTypeDropdown").val()){
                    jobType = $('.jobTypeDropdown').find(":selected").text();
                }
                if($("#sal").val()){
                    salary = $("#sal").val();
                }
                $.get("../controllers/searchDataController.php?q=filterResVacancy", {salFreq: salFreq,jobType:jobType,salary:salary}).done(function(data){
                    searchResults.html(data);
                });
                return;
            }

            // filter cancel buttons
            $("#salFreqCancel").on("click",function(){
                $('.salFreq option[value="0"]').prop("selected",true);
                filterRes();
                $(this).hide();
            });
            $("#jobTypeCancel").on("click",function(){
                $('.jobTypeDropdown option[value="0"]').prop("selected",true);
                filterRes();
                $(this).hide();
            });

            // on click search result - view result

            $(".candSearchResContOrgHome").on("click",function(){
                $(this).children("form").submit();
            });

        </script>
      
        
        
  </body> 
</html>