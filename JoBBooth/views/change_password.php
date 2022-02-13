<?php
session_start();
include_once '../helpers/session_helper.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="fPassword">
      <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="authHeading"><h>Change Password</h></div>

        
    <div class="fpContainer">
      <form method="post" action="../controllers/forgotpasswordController.php">
      <input type="hidden" name="type" value="changepassword">
      <input id="token" name="token" type="hidden" value="<?php echo $_GET['token'];?>">
      <label for="orgEmail">Email Address</label>
                        <input id="email" name="email" type="text" value="<?php echo $_GET['email'];?>">

                        <div class="form-group" id="form-group-input">
                        <label for="Pwd">Password<span class="reqStar">*</span> <div class="tooltip"><span><i id="infoIcon" class="fas fa-info-circle"></i></span><span class="tooltipText">Your password should contain:<br>&nbsp;&nbsp; - At least 8 characters<br>&nbsp;&nbsp; - At least one number or a <br>&nbsp;&nbsp;&nbsp;special character(!@#$%^)</span></div></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="Pwd" name="Pwd" type="password">
                        </div>

                    
                        <label for="ConfPwd">Confirm Password<span class="reqStar">*</span></label>
                        <span class="signup-errMsg" id="errMsg"></span><br>
                        <input id="ConfPwd" name="ConfPwd" type="password">
                        
      
      
      
        <button type="submit" id="resetbtn" name="resetbtn">Reset</button>
        <?php echo popup('loginRed') ?>
      </form>
    </div>

    <script>
 $("#ConfPwd").keyup(function(){
                checkPwds();
            });
            $("#Pwd").keyup(function(){
                checkPwdStrength();
            });
            
function checkPwdStrength(){
                var letter = /[a-zA-Z]/g;
                var number = /[0-9]/g;
                var special = /[!@#$%^]/g;
                var pwd = document.getElementById("Pwd");

                if(pwd.value.match(letter)&&pwd.value.match(number)&&pwd.value.match(special)&&pwd.value.length>=8){
                    $("#Pwd").siblings("#errMsg").html("Password is strong");
                    $("#Pwd").siblings("#errMsg").css({"color":"green"});
                    return true;
                    //$('.signupButton').prop('disabled',false);
                }
                else{
                    $("#Pwd").siblings("#errMsg").html("Password is too weak");
                    $("#Pwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                    //$('.signupButton').prop('disabled',true);
                }
            }

            function checkPwds(){
                if($("#Pwd").val()!=$("#ConfPwd").val()){
                    $("#ConfPwd").siblings("#errMsg").html("Passwords didn't match");
                    $("#ConfPwd").siblings("#errMsg").css({"color":"red"});
                    return false;
                }
                else{
                    $("#ConfPwd").siblings("#errMsg").html("Passwords match");
                    $("#ConfPwd").siblings("#errMsg").css({"color":"green"});
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