<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Sign up</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="signupInt">

        <div class="authHeading"><h>Administrator Sign Up</h></div>

        <form class="signUpAdminContainer" method="post" action="../controllers/userController.php">
        <input type="hidden" name="type" value="signupAdmin">
                
                <div class="colRegInt">

                    <fieldset>
                        <legend>Account Details</legend>
                        <span class="signupAdmin-errMsg" id="errMsg"></span><br>
                        <div>
                        <label for="uname">Username<span class="reqStar">*</span></label>
                        <input id="uname" name="uname" type="text" required>
                        </div>

                        <div>
                        <label for="pwd">Password<span class="reqStar">*</span></label>
                        <input id="pwd" name="pwd" type="password" required>
                        </div>

                        <div>
                        <label for="confPwd">Confirm Password<span class="reqStar">*</span></label>
                        <input id="confPwd" name="confPwd" type="password" required>
                        </div>
                    </fieldset>

                    <button class="adminSignupButton" type="submit">SIGN UP</button>
                </div>
                
                

        </form>

        <script>
            $("#confPwd").keyup(function(){
                checkPwds();
            });
            $("#uname").keyup(function(){
                checkUnameAvailability();
            });

            function checkPwds(){
                if($("#pwd").val()!=$("#confPwd").val()){
                    $("#errMsg").html("Passwords didn't match");
                    $("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#errMsg").html("Passwords match");
                    $("#errMsg").css({"color":"green"});
                    return true;
                }
            }
            function checkUnameAvailability() {
                jQuery.ajax({
                url: "../controllers/dataAvailabilityController.php?q=checkAdminUname",
                data:'uname='+$("#uname").val(),
                type: "POST",
                success:function(data){
                $("#errMsg").html(data);
                },
                error:function (){}
            });
            }
        </script>
    </body>

</html>
