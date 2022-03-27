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
    <title>Edit | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script>
            function addMoreInputs(){
                var div = document.getElementById("moreInput");
                var container = document.getElementById("compProfileContainer");
                var count = +document.getElementById("count").value; 
                var countElement = document.getElementById("count");

                var inputF = document.createElement("input");
                inputF.type = "text";
                inputF.name = "areaRec"+count;
                inputF.style.display = "block";
                inputF.style.marginLeft = "auto";
                inputF.style.marginRight = "auto";
                inputF.style.background = "rgba(255,255,255,0.1)";
                inputF.style.fontSize = "15px";
                inputF.style.height = "30px";
                inputF.style.width = "80%";
                inputF.style.backgroundColor = "var(--textBoxBack)";
                inputF.style.color = "var(--textBoxTyping)";
                inputF.style.boxShadow = "0 1px 0 rgba(0,0,0,0.03) inset";
                inputF.style.borderRadius = "10px";
                inputF.id = "input"+count;
                inputF.setAttribute('required','required');
                console.log(inputF.id);
                div.appendChild(inputF);
                container.style.height = "fit-content";

                count++;
                countElement.value = count;
            }
            function addLessInputs(){
                var div = document.getElementById("moreInput");
                var count = +document.getElementById("count").value;
                var countElement = document.getElementById("count");
                var inputF = document.getElementById('input'+(count-1));
                inputF.parentNode.removeChild(inputF);
                var container = document.getElementById("compProfileContainer");
                container.style.height = "fit-content";
                count--;
                console.log(count);
                countElement.value = count;
            }
        </script>
</head>
<body class="compProfile">
      <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="compProfileH"><h>Add Specializing Areas</h></div>
        <div class="compProfileContainer" id="compProfileContainer">
            <form action="../controllers/userController.php" method="post">
                <input type="hidden" name="type" value="addSpecialAreaRec">
                <label for="jobPos">Specializing Areas<span class="reqStar">*</span></label>
                <input id="jobPos" name="areaRec" type="text" required>
                
                <div class="addMoreIcon" onclick="addMoreInputs()"><i  id="addMoreIcon"class="fas fa-plus-circle"></i></div>
                <div class="addLessIcon" onclick="addLessInputs()"><i id="addLessIcon" class="fas fa-minus-circle"></i></div>
                <div id="moreInput"></div>
                <input type="hidden" id="count" name="count" value="1">
                <button class="submitBtn-compProfile" type="submit">SUBMIT</button>

            </form>
        </div>


</body>
</html>