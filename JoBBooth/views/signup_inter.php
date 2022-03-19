<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up - Interviewer</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupInt">

        <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Sign Up - Interviewer</h></div>


        <form class="signUpCandContainer" id="intSignupForm" enctype="multipart/form-data" onsubmit="return validateForm()" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="signupInt">
            <div class="signUpCandContainerH">Add interviewer</div>
            <div id="popup" class="signupRed"></div>

                    <fieldset class="form1" id="f1">

                        <legend>Personal Details</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="intFullName">Full Name<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intFullName" name="intFullName" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="intNIC">NIC<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intNIC" name="intNIC" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="intEmail">Email<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intEmail" name="intEmail" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="intContact">Contact No.<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intContact" name="intContact" type="text">
                        </div>


                        <div class="btn-box">
                                <button class="nextButton" type="button" id="next1">Next</button>
                            </div>

                    </fieldset>


                      <fieldset class="form2" id="f2">
                        <legend>Account Details</legend>

                        <div class="form-group" id="form-group-input">
                        <label for="intUname">Username<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intUname" name="intUname" type="text">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="intPwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intPwd" name="intPwd" type="password">
                        </div>

                        <div class="form-group" id="form-group-input">
                        <label for="intConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="intConfPwd" name="intConfPwd" type="password">
                        </div>

                        <div class="btn-box">
                        <input class="signupButton" id="signupButton" type="submit" value="SIGN UP">
                        <button class="backButton" type="button" id="back1">Back</button>
                        </div>

                    </fieldset>
                
       <script>
         //email,contact,username and pwd validation
            $("#intEmail").keyup(function(){
                validateEmail();
            });
            $("#intContact").keyup(function(){
                validateContact();
            });
            $("#intUname").keyup(function(){
                validateUname();
            });
            $("#intConfPwd").keyup(function(){
                checkPwds();
            });
            $("#intPwd").keyup(function(){
                checkPwdStrength();
            });
            

            function validateForm(){
                if(checkEmptyFields("#f2")&&validateUname()&&checkPwds()&&checkPwdStrength()){
                    return true;
                }
                else{
                    return false;
                }
            }

            //disappear error msgs when typing or selecting from drop down
            $(document).ready(function(){
                $("#intSignupForm :input").each(function(){
                    $(this).keyup(function(){
                        if($(this).css("border-style")=="solid"){
                            $(this).css({"border":"none"});
                            $(this).siblings("#errMsg").html("");
                        }
                        switch($(this).attr("id")){
                            case "intEmail":
                                validateEmail();
                                break;
                            case "intContact":
                                validateContact();
                                break;
                            case "intUname":
                                validateUname();
                                break;
                            case "intPwd":
                                checkPwdStrength();
                                break;
                            case "intConfPwd":
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
            

            var next1 = document.getElementById("next1");
            var back1 = document.getElementById("back1");



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

            

            function validateEmail(){
                email = document.getElementById("intEmail");
                popup = document.getElementById("popup");
            
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
                    checkemailAvailability();
                    return true;
                }
                else{
                    $("#intEmail").siblings("#errMsg").html("Invalid Email");
                    $("#intEmail").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateContact(){
                contact = document.getElementById("intContact");
                popup = document.getElementById("popup");
                if (contact.value.charAt(0)=='+'){
                    if(contact.value.length==12){
                        $("#intContact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#intContact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#intContact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else if(contact.value.charAt(0)=='0'){
                    if(contact.value.length==10){
                        $("#intContact").siblings("#errMsg").html("");
                        return true;
                    }
                    else{
                        $("#intContact").siblings("#errMsg").html("Invalid Contact No.");
                        $("#intContact").siblings("#errMsg").css({"color":"red"});
                        return false;
                    }
                }
                else{
                    $("#intContact").siblings("#errMsg").html("Invalid Contact No.");
                    $("#intContact").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            function validateUname(){
                if($("#intUname").val().length>=5){
                    checkUnameAvailability();
                    return true;
                }
                else{
                    $("#intUname").siblings("#errMsg").html("Must be at least 5 characters");
                    $("#intUname").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
            }

            

            //live check email availability
            function checkemailAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkIntEmail",
                data:'intEmail='+$("#intEmail").val(),
                type: "POST",
                success:function(data){
                $("#intEmail").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkUnameAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkIntUname",
                data:'intUname='+$("#intUname").val(),
                type: "POST",
                success:function(data){
                $("#intUname").siblings("#errMsg").html(data);
                },
                error:function (){}
            });
            }

            function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("intPwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#intPwd").siblings("#errMsg").html("Password is strong");
                    $("#intPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    //$('.signupButton').prop('disabled',false);
                }
                else{
                    $("#intPwd").siblings("#errMsg").html("Password is too weak");
                    $("#intPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    //$('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#intPwd").val()!=$("#intConfPwd").val()){
                    $("#intConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#intConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#intConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#intConfPwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                }
            }


            //Press enter to next , backspace to back
            $(document).ready(function() {
            $(window).keydown(function(event){
                
                if(event.keyCode == 13) {
                    event.preventDefault();
                    if(formNumber==2){
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
