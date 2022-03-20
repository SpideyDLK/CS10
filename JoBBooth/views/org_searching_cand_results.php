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
            <form action="../controllers/searchDataController.php?q=orgSearchingCandRes" method="post">
                <!-- <input type="hidden" name="type" value="searchCand"> -->
                <input class="searchBar" autocomplete="off" id="searchBar" value="<?php if(isset($_SESSION['searchTerm'])) echo $_SESSION['searchTerm'];?>" name="searchTerm" type="text" placeholder="Search for a candidate by skill or job position..." required>
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
                <legend><i class="fas fa-user-tie"></i> Professional</legend>
                
                <select class="workexDropdown selectBox" name="workEx">
                                <option value="0" selected disabled>Work Experience:</option>
                                <option value="1">Fresher</option>
                                <option value="2">1-5 years</option>
                                <option value="3">5-10 years</option>
                                <option value="4">10-20 years</option>
                                <option value="5">More than 20</option>
                </select>
                <i id="workExCancel" class="far fa-times-circle"></i>
                <select class="eduDropdown selectBox" name="eduLevel">
                <option value="0" selected disabled>Education:</option>
                                <option value="1">G.C.E. Ordinary Level</option>
                                <option value="2">G.C.E. Advanced Level</option>
                                <option value="3">Certificate / Advanced Certificate</option>
                                <option value="4">Diploma / Higher Diploma</option>
                                <option value="5">Undergraduate</option>
                                <option value="6">Bachelors / Bachelors Honours</option>
                                <option value="7">Postgraduate Certificate / Diploma</option>
                                <option value="8">Masters by course work / course work and a research component</option>
                                <option value="9">MPhil / PhD / MD with Board Certification / Doctor of Letters / Doctor of Science</option>
                </select>
                <i id="loeCancel" class="far fa-times-circle"></i>
                <select class="uniDropdown selectBox" name="uni">
                <option value="0" selected disabled>University/Institute:</option>
                <?php for($x=0;$x<count($_SESSION['allUnis']);$x++){
                    echo '<option value="'.($x+1).'">'.$_SESSION['allUnis'][$x]->uniName.'</option>';
                }?>
                                
                                
                </select>
                <i id="uniCancel" class="far fa-times-circle"></i>

                <br>
                <input type="checkbox" id="cv">
                <label for="cv">Curriculum Vitae (CV)</label>

            </fieldset>

            <fieldset>
                <legend><i class="fas fa-map-marked-alt"></i> Location</legend>
                <select name="district" id="districtDropdown" class="districtDropdown selectBox" onclick ="changeCities()"></select>
                <i id="disCancel" class="far fa-times-circle"></i>
                <select name="city" id="cityDropdown" class="cityDropdown selectBox" disabled >
                        <option selected="true" disabled>City:</option>
                </select>
                <i id="cityCancel" class="far fa-times-circle"></i>
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
                        $initial = $_SESSION['searchRes'][$x]->first_name;
                        $initial = substr($initial,0,1);
                        $initial = strtoupper($initial);
                        echo '<div class="candSearchResContOrgHome">
                        <form method="POST" action="view_cand_org.php" target="_blank">
                        <input type="hidden" name="uName" value="'.$_SESSION['searchRes'][$x]->cand_username.'">
                        </form>
                        <div class="pp">
                        ';
                        if($_SESSION['searchRes'][$x]->profile_photo){
                            echo '<img id="proPic" src="data:image/jpeg;base64,'.base64_encode($_SESSION['searchRes'][$x]->profile_photo).'"/>';
                        }
                        else{
                            echo '<div id="generatedProPicSearch">'.$initial.'</div>';
                        }
                        echo
                        '
                        <p>'.$_SESSION['searchRes'][$x]->first_name.' '.$_SESSION['searchRes'][$x]->last_name.'</p>
                        </div>
                        <table class="det">
                          <tr>
                          <td class="title"><i class="fas fa-briefcase"></i> Job Positions </td><td>'.$_SESSION['searchRes'][$x]->jobPos.'</td>
                            </tr>
                          <tr>
                          <td class="title"><i class="fas fa-clipboard-list"></i> Skills </td><td>'.$_SESSION['searchRes'][$x]->skills.'</td>
                          </tr>
                          <tr>
                          <td class="title"><i class="fas fa-user-graduate"></i> Education </td><td>'.$_SESSION['searchRes'][$x]->level_of_education.'</td>
                          </tr>
                          <tr>
                          <td class="title"><i class="fas fa-university"></i> University/Institute </td><td>';
                          if($_SESSION['searchRes'][$x]->uni_or_institute){
                              echo ''.$_SESSION['searchRes'][$x]->uni_or_institute.'</td>';
                          }else{
                            echo '-NA-</td>';
                          }
                          echo '
                          </tr>
                          <tr>
                          <td class="title"><i class="fas fa-map-marker-alt"></i> Location </td><td>'.$_SESSION['searchRes'][$x]->city.', '.$_SESSION['searchRes'][$x]->district.'</td>
                          <tr>
                          <td class="title"><i class="fas fa-business-time"></i> Working Experience </td><td>'.$_SESSION['searchRes'][$x]->work_experience.'</td>
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

            

            //city and district
            document.getElementById("cityDropdown").disabled = "true";
            let dropdown1 = $('#districtDropdown');

            dropdown1.empty();

            dropdown1.append('<option selected="true" disabled>District:</option>');
            dropdown1.prop('selectedIndex', 0);

            const url = '../libraries/cities.json';
            $.getJSON(url, function (data) {
                var cities = data.districts.districts;
            $.each(cities, function (key, entry) {
                
                dropdown1.append($('<option></option>').attr('value', entry).text(entry));
                
            })
            });

            function changeCities(){
                var dis = document.getElementById("districtDropdown").value;
                let dropdown2 = $('#cityDropdown');
                dropdown2.prop('disabled',false);

                dropdown2.empty();

                dropdown2.append('<option selected="true" disabled>Select:</option>');
                dropdown2.prop('selectedIndex', 0);
                
                const url = '../libraries/cities.json';
                $.getJSON(url, function (data) {
                    var cities = data[dis][dis];
                $.each(cities, function (key, entry) {
                    
                    dropdown2.append($('<option></option>').attr('value', entry).text(entry));
                    
                })
                });
            }

            //filters
            $(".workexDropdown").change(function(){
                filterRes();
                $("#workExCancel").show();
            });
            $(".eduDropdown").change(function(){
                filterRes();
                $("#loeCancel").show();
            });
            $(".uniDropdown").change(function(){
                filterRes();
                $("#uniCancel").show();
            });
            $("#cv").change(function(){
                filterRes();
            });
            $(".districtDropdown").change(function(){
                filterRes();
                $("#disCancel").show();
            });
            $(".cityDropdown").change(function(){
                filterRes();
                $("#cityCancel").show();
            });
            

            function filterRes(){
                var workEx = "";
                var loe = "";
                var uni = "";
                var district = "";
                var city = "";
                var searchResults = $(".searchResultContainerInner");   
                if($(".workexDropdown").val()){
                    workEx = $('.workexDropdown').find(":selected").text();
                }
                if($(".eduDropdown").val()){
                    loe = $('.eduDropdown').find(":selected").text();
                }
                if($(".uniDropdown").val()){
                    uni = $('.uniDropdown').find(":selected").text();
                }
                if($("#cv").prop("checked")){
                    var cv = true;
                }
                if($(".districtDropdown").val()){
                    district = $('.districtDropdown').find(":selected").text();
                }
                if($(".cityDropdown").val()){
                    city = $('.cityDropdown').find(":selected").text();
                }
                $.get("../controllers/searchDataController.php?q=filterRes", {workEx: workEx,loe:loe,cv:cv,dis:district,city:city,uni:uni}).done(function(data){
                    searchResults.html(data);
                });
                return;
            }

            //filter cancel buttons
            $("#workExCancel").on("click",function(){
                $('.workexDropdown option[value="0"]').prop("selected",true);
                filterRes();
                $(this).hide();
            });
            $("#loeCancel").on("click",function(){
                $('.eduDropdown option[value="0"]').prop("selected",true);
                filterRes();
                $(this).hide();
            });
            $("#uniCancel").on("click",function(){
                $('.uniDropdown option[value="0"]').prop("selected",true);
                filterRes();
                $(this).hide();
            });
            $("#disCancel").on("click",function(){
                $('.districtDropdown option:eq(0)').prop("selected",true);
                filterRes();
                $(this).hide();
            });
            $("#cityCancel").on("click",function(){
                $('.cityDropdown option:eq(0)').prop("selected",true);
                filterRes();
                $(this).hide();
            });

            //on click search result - view result

            $(".candSearchResContOrgHome").on("click",function(){
                $(this).children("form").submit();
            });
        </script>
      
        
        
  </body> 
</html>