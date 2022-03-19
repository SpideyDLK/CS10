<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up - Recruiter</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupRec">

        <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Sign Up - Recruiter</h></div>


        <form class="signUpCandContainer" id="recSignupForm" enctype="multipart/form-data" onsubmit="return validateForm()" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="signupRec">
            <div class="signUpCandContainerH">Join with us!</div>
            <div id="popup" class="signupRed"></div>

                    <fieldset class="form1" id="f1">

                        <legend>Agency Details</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="agencyName">Agency Name<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="agencyName" name="agencyName" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="agencyRegNo">Agency Reg. No.<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="agencyRegNo" name="agencyRegNo" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="agencyEmail">Email<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="agencyEmail" name="agencyEmail" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="AgencyContact">Contact No.<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="AgencyContact" name="AgencyContact" type="text">
                        </div>


                        <div class="btn-box">
                                <button class="nextButton" type="button" id="next1">Next</button>
                            </div>

                    </fieldset>

                    <fieldset class="form2" id="f2">
                        <legend>Professional Details</legend>

                        <div class="tags1" id="tags1">
                        <label>Specialization Area(s)<span class="reqStar">* </span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input type="text" id="tagsInput1" value="" placeholder="You can add multiple tags">
                        </div>
                        
                        <div class="form-group" id="form-group-select">
                        <label>Work Experience<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <select class="workexDropdown" name="workexperience">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">Fresher</option>
                                <option value="2">1-5 years</option>
                                <option value="3">5-10 years</option>
                                <option value="4">10-20 years</option>
                                <option value="5">More than 20</option>
                        </select>

                        <div class="btn-box">
                            <button class="nextButton" type="button" id="next2">Next</button>
                            <button class="backButton" type="button" id="back1">Back</button>
                        </div>

                    </fieldset>

                      <fieldset class="form3" id="f3">
                        <legend>Account Details</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="recUname">Username<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="recUname" name="recUname" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="recPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="recPwd" name="recPwd" type="password">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="recConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="recConfPwd" name="recConfPwd" type="password">
                        </div>

                        <div class="btn-box">
                        <input class="signupButton" id="signupButton" type="submit" value="SIGN UP">
                        <button class="backButton" type="button" id="back2">Back</button>
                        </div>

                    </fieldset>
                </form>
                <div class="haveAcc"><br>Already have an account ? <a class="link" href="../views/home.php">Login</a>
                    
                    </div>
       <script>
         //email,contact,username and pwd validation
            $("#agencyEmail").keyup(function(){
                validateEmail();
            });
            $("#AgencyContact").keyup(function(){
                validateContact();
            });
            $("#recUname").keyup(function(){
                validateUname();
            });
            $("#recConfPwd").keyup(function(){
                checkPwds();
            });
            $("#recPwd").keyup(function(){
                checkPwdStrength();
            });
            

            function validateForm(){
                if(checkEmptyFields("#f3")&&validateUname()&&checkPwds()&&checkPwdStrength()){
                    return true;
                }
                else{
                    return false;
                }
            }

            //disappear error msgs when typing or selecting from drop down
            $(document).ready(function(){
                $("#recSignupForm :input").each(function(){
                    $(this).keyup(function(){
                        if($(this).css("border-style")=="solid"){
                            $(this).css({"border":"none"});
                            $(this).siblings("#errMsg").html("");
                        }
                        switch($(this).attr("id")){
                            case "agencyEmail":
                                validateEmail();
                                break;
                            case "AgencyContact":
                                validateContact();
                                break;
                            case "recUname":
                                validateUname();
                                break;
                            case "recPwd":
                                checkPwdStrength();
                                break;
                            case "recConfPwd":
                                checkPwds();
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

            // next and back forms
            let formNumber = 1;
            var form1 = document.getElementById("f1");
            var form2 = document.getElementById("f2");
            var form3 = document.getElementById("f3");
            

            var next1 = document.getElementById("next1");
            var next2 = document.getElementById("next2");
            var back1 = document.getElementById("back1");
            var back2 = document.getElementById("back2");


            next1.onclick = function(){
                if(checkEmptyFields('#f1')&&validateEmail()&&validateContact()){
                    form1.style.left = "-450px";
                    form2.style.left = "55px";
                    formNumber++;  
                }
            }

            back1.onclick = function(){
                form1.style.left = "55px";
                form2.style.left = "550px";
                formNumber--;
            }

            next2.onclick = function(){
                if(checkEmptyTags()&&checkEmptyFields('#f2')){
                    form2.style.left = "-450px";
                    form3.style.left = "55px";
                    formNumber++;
                }
            }
            
            back2.onclick = function(){
                form2.style.left = "55px";
                form3.style.left = "550px";
                formNumber--;
            }
            
            

            function checkEmptyFields(f){
                let isValid = true;
                $(f).children('#form-group-input').each(function(){
                    if($.trim($(this).children("input").val()).length==0){
                        $(this).children("#errMsg").html("Please fill this field");
                        $(this).children("#errMsg").css({"color":"red"});
                        $(this).children("input").css({"border": "0.5px red solid"});
                        isValid = false;
                    }
                    
                });
                $(f).children('#form-group-select').each(function(){
                    if($(this).children("select").val()==null){
                        $(this).children("#errMsg").html("Please fill this field");
                        $(this).children("#errMsg").css({"color":"red"});
                        $(this).children("select").css({"border": "0.5px red solid"});
                        isValid = false;
                    }
                });

                return isValid;
            }

            function checkEmptyTags(){
                let isValid = true;
                if($("#tags1").children("#newTag").length==0){
                    $("#tagsInput1").css({"border":"0.5px red solid"});
                    $("#tagsInput1").siblings("#errMsg").html("Enter at least one");
                    $("#tagsInput1").siblings("#errMsg").css({"color":"red"});
                    isValid = false;
                }
                else{
                    $("#tagsInput1").css({"border":"none"});
                    $("#tagsInput1").siblings("#errMsg").html("");
                }
                return isValid;
            }

            function validateEmail(){
                email = document.getElementById("agencyEmail");
                popup = document.getElementById("popup");
            
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
                    checkemailAvailability();
                    return true;
                }
                else{
                    $("#agencyEmail").siblings("#errMsg").html("Invalid Email");
                    $("#agencyEmail").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateContact(){
                contact = document.getElementById("AgencyContact");
                popup = document.getElementById("popup");
                if (contact.value.charAt(0)=='+'){
                    if(contact.value.length==12){
                        $("#AgencyContact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#AgencyContact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#AgencyContact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else if(contact.value.charAt(0)=='0'){
                    if(contact.value.length==10){
                        $("#AgencyContact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#AgencyContact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#AgencyContact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else{
                    $("#AgencyContact").siblings("#errMsg").html("Invalid Contact No.");
                    $("#AgencyContact").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateUname(){
                if($("#recUname").val().length>=5){
                    checkUnameAvailability();
                    return true;
                }
                else{
                    $("#recUname").siblings("#errMsg").html("Must be at least 5 characters");
                    $("#recUname").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            

            //live check email availability
            function checkemailAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkRecEmail",
                data:'agencyEmail='+$("#agencyEmail").val(),
                type: "POST",
                success:function(data){
                $("#agencyEmail").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkUnameAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkRecUname",
                data:'recUname='+$("#recUname").val(),
                type: "POST",
                success:function(data){
                $("#recUname").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("recPwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#recPwd").siblings("#errMsg").html("Password is strong");
                    $("#recPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    //$('.signupButton').prop('disabled',false);
                }
                else{
                    $("#recPwd").siblings("#errMsg").html("Password is too weak");
                    $("#recPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    //$('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#recPwd").val()!=$("#recConfPwd").val()){
                    $("#recConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#recConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#recConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#recConfPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                }
            }


            //Press enter to next , backspace to back
            $(document).ready(function() {
            $(window).keydown(function(event){
                
                if(event.keyCode == 13) {
                    event.preventDefault();
                    if(formNumber==2){  
                        if($.trim($("#tagsInput1").val()).length==0 && $.trim($("#tagsInput2").val()).length==0){
                            document.getElementsByClassName("nextButton")[formNumber-1].click();
                        }
                    }
                    else if(formNumber==3){
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

        <script>
        //tags
        jQuery(function($) {
            $('#tags1 input').on('focusout', function() {
            var txt = this.value.replace(/[^a-z A-Z0-9\+\-\.\#]/g, '');
            if ($.trim(txt)) $(this).before('<div id="newTag"><span class="tag">' + txt + '</span>' + '<input class="tagHidden" type="hidden" value="'+ txt + '" name = "speArea[]"></div>');
            $("#tagsInput1").css({"border":"none"});
            $("#tagsInput1").siblings("#errMsg").html("");
            this.value = "";

        }).on('keyup', function(e) {

        if (/(188|13)/.test(e.which)) $(this).trigger('focusout');
        });

        $('#tags1').on('click', '.tag', function() {
            $(this).parent().remove();
        });

        });
       
        </script>

    </body>

</html>
