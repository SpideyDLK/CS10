<?php
session_start();
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Candidate</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="candHome" onload="selectBoxLoad()">
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
        <button class="tabs" onclick="toggleTab('default')" id="default"><i class="fas fa-user-edit"></i> Edit Profile</button>
        <button class="tabs" onclick="toggleTab('2')" id="2"><i class="fab fa-slack-hash"></i> Reset Password</button>
        <span class="glider" id="glider"></span>
        </div>
    </div>
    <?php popUp('loginGreen');?>

    <div class="tabContent" id="tab1">
    <div class="candJobReqTable">

    <div class="candProfileEditContainer">
            <form action="../controllers/userController.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="editProPicCand">

                <fieldset class="fileUpload">
                    <legend>Profile Photo</legend>
                    <!-- <img class='proPicEdit' src="../material/images/dafault_pro_pic.jpg" alt=""> -->
                <?php if(isset($_SESSION['pp'])){
                    echo "<div class='proPicEditCont'></div>";
                }
                else{
                    echo "<div id='generatedProPicEdit'></div>";
                }
                
                ?>

                <input type="file" name="proPic" id="proPic" required/>
                <label class="customUploadBtn" for="proPic">Choose File </label>
                <label class="fileChosen" id="fileChosen">No file chosen</label>

                <button class="saveButtonEditProfile" type="submit">SAVE</button>
                <script>
                const actualBtn = document.getElementById('proPic');

                const fileChosen = document.getElementById('fileChosen');

                actualBtn.addEventListener('change', function(){
                fileChosen.innerHTML = this.files[0].name
                fileChosen.innerHTML = fileChosen.innerHTML.substr(0, 30)
                })
                </script>
                </fieldset>
            </form>

            <form action="../controllers/userController.php" method="post" enctype="multipart/form-data">
            <input name="type" type="hidden" value="edit_profile">
                <fieldset>
                    <legend>Personal Details</legend>
                    <label for="fName">First Name<span class="reqStar">*</span></label>
                    <input id="fName" name="fName" type="text" value="<?php echo $_SESSION['curr_details']->first_name; ?>"  required>

                    <label for="lName">Last Name<span class="reqStar">*</span></label>
                    <input id="lName" name="lName" type="text" value="<?php echo $_SESSION['curr_details']->last_name; ?>"  required>

                    <label for="nic">NIC</label>
                    <input id="nic" name="nic" type="text" value="<?php echo $_SESSION['curr_details']->nic; ?>"  >

                    <label for="district">District<span class="reqStar">*</span></label>
                    <input id="district" name="district" type="text" value="<?php echo $_SESSION['curr_details']->district; ?>"  required>

                    <label for="city">City<span class="reqStar">*</span></label>
                    <input id="city" name="city" type="text" value="<?php echo $_SESSION['curr_details']->city; ?>"  required>

                    <div>
                    <label for="contact">Contact No.<span class="reqStar">*</span></label>
                    <span class="signup-errMsg" id="errMsg"></span><br>
                    <input id="contact" name="contact" type="text" value="<?php echo $_SESSION['curr_details']->contact_no; ?>"  required>
                    </div>
                    
                    <div>
                    <label for="candEmail">E-mail<span class="reqStar">*</span></label>
                    <span class="signup-errMsg" id="errMsg"></span><br>
                    <input id="candEmail" name="candEmail" type="text" value="<?php echo $_SESSION['curr_details']->email; ?>"  required>
                    </div>
                    

                    <label>Work Experience<span class="reqStar">*</span></label>
                    <select id="workEx" class="workExEdit selectBox" name="workEx">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">Fresher</option>
                                <option value="2">1-5 years</option>
                                <option value="3">5-10 years</option>
                                <option value="4">10-20 years</option>
                                <option value="5">More than 20</option>
                    </select><br><br>

                    <label for="currComp">Current Company<span class="reqStar">*</span></label>
                    <input id="currComp" name="currComp" type="text" value="<?php echo $_SESSION['curr_details']->current_company; ?>"  >

                    <label for="currDesig">Current Designation<span class="reqStar">*</span></label>
                    <input id="currDesig" name="currDesig" type="text" value="<?php echo $_SESSION['curr_details']->current_designation; ?>"  >

                    <label>Level of Education<span class="reqStar">*</span></label>
                    <select id="loe" class="eduDropDownEdit selectBox" name="eduLevel">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">G.C.E. Ordinary Level</option>
                                <option value="2">G.C.E. Advanced Level</option>
                                <option value="3">Certificate / Advanced Certificate</option>
                                <option value="4">Diploma / Higher Diploma</option>
                                <option value="5">Undergraduate</option>
                                <option value="6">Bachelors / Bachelors Honours</option>
                                <option value="7">Postgraduate Certificate / Diploma</option>
                                <option value="8">Masters by course work / course work and a research component</option>
                                <option value="9">MPhil / PhD / MD with Board Certification / Doctor of Letters / Doctor of Science</option>
                    </select><br><br>

                    <div class="dynamicInput1-candSignup" id="form-group-input">
                    <label for="uniOrInstitute">University/Institute</label>
                    <span class="signup-errMsg" id="errMsg"></span><br>
                    <input autocomplete = "off" id="uniOrInstitute" name="uniOrInstitute" value="<?php echo $_SESSION['curr_details']->uni_or_institute; ?>" type="text">
                    <div class="uni-suggestions-edit" id="uniSuggestions"></div>
                    </div>

                    <div class="dynamicInput2-candSignup" id="form-group-input">
                    <label for="degreeTitle"></label>
                    <span class="signup-errMsg" id="errMsg"></span><br>
                    <input autocomplete = "off" id="degreeTitle" name="degreeTitle" type="text" value="<?php echo $_SESSION['curr_details']->deg_cert_or_dip_title; ?>" disabled>
                    <div class="deg-suggestions-edit" id="degSuggestions"></div>
                    </div>

                    <label style="width:90%">Upload your CV/Resume (Optional)</label>
                        <label for="cvInput">
                        <div class="cvUpload" id="cvUpload">
                        <input class="cvInput" name="cvInput" id="cvInput" type="file" accept=".pdf,">
                        <p class="cvUploadP"><i class="fas fa-upload" id="uploadIcon"></i><br><br>Drag your CV/Resume here or click in this area.<br><br><i id="pdfIcon" class="far fa-file-pdf"></i><br><br> PDF Only (Max: 10 MB)</p>
                        </div>
                        </label>
                        <div class="cvFileNameCont">
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <p class="fileNameCV"></p>&nbsp;
                        <button class='fileCancelBtn' id='fileCancelBtn' type="button"><i class='far fa-times-circle'></i></button>
                        </div>
                    
                    <button class="saveButtonEditProfile2" type="submit">SAVE</button>
                </fieldset>
            </form>
        </div>
      
        <script>

            //select box load data from db
            function selectBoxLoad(){
                //work experience
                var work_ex = "<?php echo $_SESSION['curr_details']->work_experience; ?>"
                var workEx = document.getElementById("workEx");
                for(i=0;i<workEx.length;i++){
                    
                    if(workEx[i].text === work_ex){
                        workEx[i].selected = 'selected';
                    }
                }

                //level of edu
                var loe = "<?php echo $_SESSION['curr_details']->level_of_education; ?>"
                var loeBox = document.getElementById("loe");
                for(i=0;i<loeBox.length;i++){
                    
                    if(loeBox[i].text === loe){
                        loeBox[i].selected = 'selected';
                    }
                }

                // uni and degree dropdown on load
                if($('.eduDropDownEdit').val()!="1" && $('.eduDropDownEdit').val()!="2"){
                    $(".dynamicInput1-candSignup").show();
                    $(".dynamicInput2-candSignup").show();
                    $(".dynamicInput2-candSignup").children("label").text("Certificate Title");
                    $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                    $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Certificate in Business Law");
                    $(".dynamicInput2-candSignup").children("input").prop("required",true);
                    $(".dynamicInput1-candSignup").children("input").prop("required",true);
                    $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                    $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                }
                else{
                    $(".dynamicInput1-candSignup").hide();
                    $(".dynamicInput2-candSignup").hide();
                    $(".dynamicInput2-candSignup").children("input").prop("required",false);
                    $(".dynamicInput1-candSignup").children("input").prop("required",false);
                }

            }

            //profile pic
            var proPic = $('.proPicEditCont');
            $.get("../controllers/searchDataController.php?q=getProPic").done(function(data){
              proPic.html(data);
            });

            


            //show uni or institute when level of edu selected
            $(".eduDropDownEdit").on("change",function(){
    
        switch($(this).val()){
            case "1":
                $(".dynamicInput1-candSignup").hide();
                $("#degreeTitle").val("");
                $(".dynamicInput2-candSignup").hide();
                $("#uniOrInstitute").val("");
                $(".dynamicInput2-candSignup").children("input").prop("required",false);
                $(".dynamicInput1-candSignup").children("input").prop("required",false);
                break;
            case "2":
                $(".dynamicInput1-candSignup").hide();
                $("#degreeTitle").val("");
                $(".dynamicInput2-candSignup").hide();
                $("#uniOrInstitute").val("");
                $(".dynamicInput2-candSignup").children("input").prop("required",false);
                $(".dynamicInput1-candSignup").children("input").prop("required",false);
                break;
            case "3":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Certificate Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Certificate in Business Law");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("3");
                break;
            case "4":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Diploma Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Diploma in Human Resource Management");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("4");
                break;
            case "5":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Degree Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Bachelor of Computer Science");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("5");
                break;
            case "6":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Degree Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Bachelor of Computer Science");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                break;
            case "7":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Diploma/Cartificate Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Postgraduate Diploma in Project Management");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("7");
                break;
            case "8":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Degree Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - Master of Computer Science");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("8");
                break;
            case "9":
                $(".dynamicInput1-candSignup").show();
                $(".dynamicInput2-candSignup").show();
                $(".dynamicInput2-candSignup").children("label").text("Degree Title");
                $(".dynamicInput1-candSignup").children("label").text("University/Institute");
                $(".dynamicInput2-candSignup").children("input").attr("placeholder","e.g. - M.Phil/ PhD in Demography");
                $(".dynamicInput2-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("input").prop("required",true);
                $(".dynamicInput1-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $(".dynamicInput2-candSignup").children("label").append("<span class='reqStar'>*</span>");
                $("#typeOfLoe").val("9");
                break;
        }
        });

            //candEmail,contact,username and pwd validation
            $("#candEmail").keyup(function(){
                validateEmail();
            });
            $("#contact").keyup(function(){
                validateContact();
            });

            $(document).ready(function(){
            $('#uniOrInstitute').on("keyup input",function(){
              if($.trim($(this).val()).length>0){
                $("#degreeTitle").prop("disabled",false);
                $("#degreeTitle").siblings("label").css({"color":"var(--labelColor)"});
              }else{
                $("#degreeTitle").prop("disabled",true);
                $("#degreeTitle").siblings("label").css({"color":"var(--textBoxTyping)"});
              }
              var searchTerm = $.trim($(this).val());
              var resultDropdown = $(this).siblings("#uniSuggestions");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=uniSuggestions", {term: searchTerm}).done(function(data){
                        resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
            });

            $(document).on("click", "#uniSuggestions p", function(){
                $(this).parents("#form-group-input").find('input[type="text"]').val($(this).text());
                $(this).parent("#uniSuggestions").empty();
            });
            $('#uniOrInstitute').on('focusin',function() {
                $("#uniSuggestions").empty();
            });
          });

          $(document).ready(function(){
            $('#degreeTitle').on("keyup input",function(){
              var searchTerm = $.trim($(this).val());
              var uniName = $.trim($("#uniOrInstitute").val());
              var loe = $.trim($(".eduDropdown").val());
              switch(loe){
                  case "3":
                    loe = "cert";
                    break;
                  case "4":
                    loe = "diploma";
                    break;
                  case "5":
                    loe = "undergraduate";
                    break;
                  case "6":
                    loe = "undergraduate";
                    break;
                  case "7":
                    loe = "postgradDip";
                    break;
                  case "8":
                    loe = "masters";
                    break;
                  case "9":
                    loe = "mphilPhd";
                    break;
              }
              var resultDropdown = $(this).siblings("#degSuggestions");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=degSuggestions", {term: searchTerm, uni: uniName, loe: loe}).done(function(data){
                    
                    resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
                  });

            $(document).on("click", "#degSuggestions p", function(){
                $(this).parents("#form-group-input").find('input[type="text"]').val($(this).text());
                $(this).parent("#degSuggestions").empty();
            });
            $('#degreeTitle').on('focusin',function() {
                $("#degSuggestions").empty();
            });
          });


            //disappear error msgs when typing or selecting from drop down
            $(document).ready(function(){
                $("#candEditProForm :input").each(function(){
                    $(this).keyup(function(){
                        if($(this).css("border-style")=="solid"){
                            $(this).css({"border":"none"});
                            $(this).siblings("#errMsg").html("");
                        }
                        switch($(this).attr("id")){
                            case "candEmail":
                                validateEmail();
                                break;
                            case "contact":
                                validateContact();
                                break;
                            
                        }
                    });
                });
                $(".selectBox").each(function(){
                    $(this).click(function(){
                        if($(this).css("border-style")=="solid"){
                            $(this).css({"border":"none"});
                            $(this).siblings("#errMsg").html("");
                        }
                    });
                });
            });

        
            function validateEmail(){
                candEmail = document.getElementById("candEmail");
                popup = document.getElementById("popup");
            
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(candEmail.value)){
                    checkemailAvailability();
                    return true;
                }
                else{
                    $("#candEmail").siblings("#errMsg").html("Invalid Email");
                    $("#candEmail").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateContact(){
                contact = document.getElementById("contact");
                popup = document.getElementById("popup");
                if (contact.value.charAt(0)=='+'){
                    if(contact.value.length==12){
                        $("#contact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#contact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#contact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else if(contact.value.charAt(0)=='0'){
                    if(contact.value.length==10){
                        $("#contact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#contact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#contact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else{
                    $("#contact").siblings("#errMsg").html("Invalid Contact No.");
                    $("#contact").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateUname(){
                if($("#candUname").val().length>=5){
                    checkUnameAvailability();
                    return true;
                }
                else{
                    $("#candUname").siblings("#errMsg").html("Must be at least 5 characters");
                    $("#candUname").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            

            //live check candEmail availability
            function checkemailAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkEmail",
                data:'candEmail='+$("#candEmail").val(),
                type: "POST",
                success:function(data){
                $("#candEmail").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkUnameAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkUname",
                data:'candUname='+$("#candUname").val(),
                type: "POST",
                success:function(data){
                $("#candUname").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("candPwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#candPwd").siblings("#errMsg").html("Password is strong");
                    $("#candPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    // $('.signupButton').prop('disabled',false);
                }
                else{
                    $("#candPwd").siblings("#errMsg").html("Password is too weak");
                    $("#candPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    // $('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#candPwd").val()!=$("#candConfPwd").val()){
                    $("#candConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#candConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#candConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#candConfPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                }
            }

            //CV drag and drop
            var fileCancel = document.getElementById("fileCancelBtn");

            fileCancel.onclick = function(){
                document.getElementById("cvInput").value="";
                $('.fileNameCV').text("No file chosen");
                document.getElementById("fileCancelBtn").style.display="none";
            }

            $(document).ready(function(){
                if($('.cvUpload input').val()==""){
                    $('.fileNameCV').text("No file chosen");
                    document.getElementById("fileCancelBtn").style.display="none";
                }
                else{
                    $('.fileNameCV').html(this.files[0].name);
                    document.getElementById("fileCancelBtn").style.display="";
                }

            $('.cvUpload input').change(function () {

                var fileSize = ((this.files[0].size/1024)/1024).toFixed(4);
                var filePath = $(this).val();
                var allowedExtensions = /(.pdf)$/i;

                if(fileSize>10 || !allowedExtensions.exec(filePath)){
                    document.getElementById("cvInput").value="";
                    $('.fileNameCV').text("File is too large or invalid file type");
                    $('.fileNameCV').css({"color":"red"});
                    document.getElementById("fileCancelBtn").style.display="none";
                }
                else{
                    $('.fileNameCV').css({"color":"var(--textBoxTyping)"});
                    if($('.cvUpload input').val()==""){
                    $('.fileNameCV').text("No file chosen");
                    document.getElementById("fileCancelBtn").style.display="none";
                    }
                    else{
                        $('.fileNameCV').html(this.files[0].name.substr(0,30)+"...");
                        document.getElementById("fileCancelBtn").style.display="";
                    }
                }

            });
            });

            
        </script>
        <script>
            

          //university and degree suggestions
          $(document).ready(function(){
            $('#uniOrInstitute').on("keyup input",function(){
              if($.trim($(this).val()).length>0){
                $("#degreeTitle").prop("disabled",false);
                $("#degreeTitle").siblings("label").css({"color":"var(--labelColor)"});
              }else{
                $("#degreeTitle").prop("disabled",true);
                $("#degreeTitle").siblings("label").css({"color":"var(--textBoxTyping)"});
              }
              var searchTerm = $.trim($(this).val());
              var resultDropdown = $(this).siblings("#uniSuggestions");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=uniSuggestions", {term: searchTerm}).done(function(data){
                        resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
                  });

            $(document).on("click", "#uniSuggestions p", function(){
                $(this).parents("#form-group-input").find('input[type="text"]').val($(this).text());
                $(this).parent("#uniSuggestions").empty();
            });
            $('#uniOrInstitute').on('focusin',function() {
                $("#uniSuggestions").empty();
            });
          });
          $(document).ready(function(){
            $('#degreeTitle').on("keyup input",function(){
              var searchTerm = $.trim($(this).val());
              var uniName = $.trim($("#uniOrInstitute").val());
              var loe = $.trim($(".eduDropdown").val());
              switch(loe){
                  case "3":
                    loe = "cert";
                    break;
                  case "4":
                    loe = "diploma";
                    break;
                  case "5":
                    loe = "undergraduate";
                    break;
                  case "6":
                    loe = "undergraduate";
                    break;
                  case "7":
                    loe = "postgradDip";
                    break;
                  case "8":
                    loe = "masters";
                    break;
                  case "9":
                    loe = "mphilPhd";
                    break;
              }
              var resultDropdown = $(this).siblings("#degSuggestions");
              if(searchTerm.length){
                  $.get("../controllers/searchDataController.php?q=degSuggestions", {term: searchTerm, uni: uniName, loe: loe}).done(function(data){
                        resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
                  });

            $(document).on("click", "#degSuggestions p", function(){
                $(this).parents("#form-group-input").find('input[type="text"]').val($(this).text());
                $(this).parent("#degSuggestions").empty();
            });
            $('#degreeTitle').on('focusin',function() {
                $("#degSuggestions").empty();
            });
          });


        </script>

    </div>
    </div>

    <div class="tabContent" id="tab2">
        <div class="resetPass">

        <!-- <div class="authHeading"><h>Reset Password</h></div> -->

        
    <div class="fpContainer">
      <form method="post" action="../controllers/userController.php">
      <input type="hidden" name="type" value="current_password">
      <label for="orgEmail">Current Password</label>
                        <input id="currPass" name="currPass" type="password">

                        <div class="form-group" id="form-group-input">
                        <label for="newPwd">New Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="newPwd" name="newPwd" type="password">
                        </div>

                    
                        <label for="newConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="newConfPwd" name="newConfPwd" type="password">
                        
      
      
      
        <button type="submit" id="resetbtn" name="resetbtn">Reset</button>
        <?php echo popup('loginRed') ?>
      </form>
    </div>

    <script>
 $("#newConfPwd").keyup(function(){
                checkPwds();
            });
            $("#newPwd").keyup(function(){
                checkPwdStrength();
            });
            
function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("newPwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#newPwd").siblings("#errMsg").html("Password is strong");
                    $("#newPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    //$('.signupButton').prop('disabled',false);
                }
                else{
                    $("#newPwd").siblings("#errMsg").html("Password is too weak");
                    $("#newPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    //$('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#newPwd").val()!=$("#newConfPwd").val()){
                    $("#newConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#newConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#newConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#newConfPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                }
            }


            //Press enter to next , backspace to back
            $(document).ready(function() {
            $(window).keydown(function(event){
                
                if(event.keyCode == 13) {
                    event.preventDefault();
                    if(formNumber==3){
                        document.getElementById("signupButton").click();
                    }
                    else{
                        document.getElementsByClassName("nextButton")[formNumber-1].click();
                    }
                return false;
                }
            });
            });
      </script>

        </div>
    </div>

    <?php $uName = $_SESSION['username'] ?>


    <script>
            var tableContainer = $(".candJobReqTable");
            var tableContainer2 = $(".resetPass");
            var uName = "<?php echo $uName ?>";


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
    

        $(document).ready(function(){
            var firstName = "<?php echo $_SESSION['fName']?>";
            let initials = firstName.charAt(0).toUpperCase();
            document.getElementById("generatedProPicEdit").innerHTML = initials;
          });

    </script>

</body>
</html>