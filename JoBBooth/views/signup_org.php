<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up - Organization</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupOrg">

        <div class="logoBack">
            <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Sign Up - Organization</h></div>

            <form class="signUpCandContainer" id="orgSignupForm" enctype="multipart/form-data" onsubmit="return validateForm()" method="post" action="../controllers/userController.php">
            <input type="hidden" name="type" value="signupOrg">
            <div class="signUpCandContainerH">Join with us!</div><br>
            <div id="popup" class="signupRed"></div>

                
                    <fieldset class="form1" id="f1">

                        <legend>Organization Details</legend>                        
                        
                        <div class="form-group" id="form-group-input">
                        <label for="orgName">Organization Name<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgName" name="orgName" type="text">
                        </div>

                        
                        <div class="form-group" id="form-group-input">
                        <label for="crn">Company Registration Number (CRN)<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="crn" name="crn" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgEmail">Organization Email<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgEmail" name="orgEmail" type="text">
                        </div>


                        <div class="form-group" id="form-group-input">
                        <label for="orgTele">Organization Telephone<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgTele" name="orgTele" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgweb">Organization Website</label>
                        <input id="orgweb" name="orgweb" type="text">
                        </div>

                        <div class="btn-box">
                                <button class="nextButton" type="button" id="next1">Next</button>
                            </div>

                    </fieldset>

                    <fieldset class="form2" id="f2">
                        <legend>Address</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="orgAL1">Address Line 1<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgAL1" name="orgAL1" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgAL2">Address Line 2</label>
                        <input id="orgAL2" name="orgAL2" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgStrtname">Street Name<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgStrtName" name="orgStrtName" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgCity">City<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgCity" name="orgCity" type="text">
                        </div>

                        <div class="btn-box">
                            <button class="nextButton" type="button" id="next2">Next</button>
                            <button class="backButton" type="button" id="back1">Back</button>
                        </div>
                        
                     </fieldset>

                  

                    <fieldset class="form3" id="f3">
                       <legend>Account Details</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="orgUname">Username<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgUname" name="orgUname" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgPwd" name="orgPwd" type="password">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="orgConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="orgConfPwd" name="orgConfPwd" type="password">
                        </div>

                        <div class="btn-box">
                        <input class="signupButton" id="signupButton" type="submit" value="SIGN UP">
                        <button class="backButton" type="button" id="back2">Back</button>
                        </div>

                    </fieldset>

                    
               
            </form>
            <div class="haveAcc">Already have an account ? <a class="link" href="../views/home.php">Login</a><br><br>
                        <a class="link" href="signup_cand.php">Click Here</a>
                        <i id ="handLeftIcon" class="fas fa-hand-point-left"></i>
                        to sign up as a Candidate
                    </div> 
        <script>
         //email,contact,username and pwd validation
            $("#orgEmail").keyup(function(){
                validateEmail();
            });
            $("#orgTele").keyup(function(){
                validateContact();
            });
            $("#orgUname").keyup(function(){
                validateUname();
            });
            $("#orgConfPwd").keyup(function(){
                checkPwds();
            });
            $("#orgPwd").keyup(function(){
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
                $("#orgSignupForm :input").each(function(){
                    $(this).keyup(function(){
                        if($(this).css("border-style")=="solid"){
                            $(this).css({"border":"none"});
                            $(this).siblings("#errMsg").html("");
                        }
                        switch($(this).attr("id")){
                            case "orgEmail":
                                validateEmail();
                                break;
                            case "orgTele":
                                validateContact();
                                break;
                            case "orgUname":
                                validateUname();
                                break;
                            case "orgPwd":
                                checkPwdStrength();
                                break;
                            case "orgConfPwd":
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
                if(checkEmptyFields('#f2')){
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
                    if($.trim($(this).children("input").val()).length==0 && ($(this).children("input").attr("id")!="orgweb" && $(this).children("input").attr("id")!="orgAL2")){
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

            

            function validateEmail(){
                email = document.getElementById("orgEmail");
                popup = document.getElementById("popup");
            
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
                    checkemailAvailability();
                    return true;
                }
                else{
                    $("#orgEmail").siblings("#errMsg").html("Invalid Email");
                    $("#orgEmail").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateContact(){
                contact = document.getElementById("orgTele");
                popup = document.getElementById("popup");
                if (contact.value.charAt(0)=='+'){
                    if(contact.value.length==12){
                        $("#orgTele").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#orgTele").siblings("#errMsg").html("Invalid Contact No.");
                        $("#orgTele").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else if(contact.value.charAt(0)=='0'){
                    if(contact.value.length==10){
                        $("#orgTele").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#orgTele").siblings("#errMsg").html("Invalid Contact No.");
                        $("#orgTele").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else{
                    $("#orgTele").siblings("#errMsg").html("Invalid Contact No.");
                    $("#orgTele").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateUname(){
                if($("#orgUname").val().length>=5){
                    checkUnameAvailability();
                    return true;
                }
                else{
                    $("#orgUname").siblings("#errMsg").html("Must be at least 5 characters");
                    $("#orgUname").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            

            //live check email availability
            function checkemailAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkOrgEmail",
                data:'orgEmail='+$("#orgEmail").val(),
                type: "POST",
                success:function(data){
                $("#orgEmail").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkUnameAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkOrgUname",
                data:'orgUname='+$("#orgUname").val(),
                type: "POST",
                success:function(data){
                $("#orgUname").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("orgPwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#orgPwd").siblings("#errMsg").html("Password is strong");
                    $("#orgPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    //$('.signupButton').prop('disabled',false);
                }
                else{
                    $("#orgPwd").siblings("#errMsg").html("Password is too weak");
                    $("#orgPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    //$('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#orgPwd").val()!=$("#orgConfPwd").val()){
                    $("#orgConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#orgConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#orgConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#orgConfPwd").siblings("#errMsg").css({"color":"green"});
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

    </body>

</html>
