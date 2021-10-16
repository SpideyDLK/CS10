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
                var container = document.getElementById("intReschCandContainer");
                var count = +document.getElementById("count").value; 
                var countElement = document.getElementById("count");

                var label = document.createElement("label");
                label.innerHTML = "Date & Time "+(count+1);
                label.id="label"+count;
                var inputDate = document.createElement("input");
                inputDate.type = "date";
                inputDate.name = "reschDate"+count;
                inputDate.style.display = "block";
                inputDate.style.marginLeft = "auto";
                inputDate.style.marginRight = "auto";
                inputDate.style.background = "rgba(255,255,255,0.1)";
                inputDate.style.fontSize = "15px";
                inputDate.style.height = "30px";
                inputDate.style.width = "80%";
                inputDate.style.backgroundColor = "var(--textBoxBack)";
                inputDate.style.color = "var(--textBoxTyping)";
                inputDate.style.boxShadow = "0 1px 0 rgba(0,0,0,0.03) inset";
                inputDate.style.borderRadius = "10px";
                inputDate.id = "inputD"+count;
                inputDate.setAttribute('required','required');

                var inputTime = document.createElement("input");
                inputTime.type = "time";
                inputTime.name = "reschDate"+count;
                inputTime.style.display = "block";
                inputTime.style.marginLeft = "auto";
                inputTime.style.marginRight = "auto";
                inputTime.style.background = "rgba(255,255,255,0.1)";
                inputTime.style.fontSize = "15px";
                inputTime.style.height = "30px";
                inputTime.style.width = "80%";
                inputTime.style.backgroundColor = "var(--textBoxBack)";
                inputTime.style.color = "var(--textBoxTyping)";
                inputTime.style.boxShadow = "0 1px 0 rgba(0,0,0,0.03) inset";
                inputTime.style.borderRadius = "10px";
                inputTime.id = "inputT"+count;
                inputTime.setAttribute('required','required');
                
                div.appendChild(label);
                div.appendChild(inputDate);
                div.appendChild(inputTime);
                container.style.height = "fit-content";

                count++;
                countElement.value = count;
            }
            function addLessInputs(){
                var div = document.getElementById("moreInput");
                var count = +document.getElementById("count").value;
                var countElement = document.getElementById("count");
                var inputDate = document.getElementById('inputD'+(count-1));
                var label = document.getElementById('label'+(count-1));
                var inputTime = document.getElementById('inputT'+(count-1));
                inputDate.parentNode.removeChild(inputDate);
                inputTime.parentNode.removeChild(inputTime);
                label.parentNode.removeChild(label);
                var container = document.getElementById("intReschCandContainer");
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

        <div class="reschIntCand"><h>Request for reschedule</h></div>
        <div class="reschIntCandMsg"><p>*Please enter all the free dates and times you would be available to participate in the interview</p></div>
        <div class="intReschCandContainer" id="intReschCandContainer">
            <form action="#" method="post">
                <input type="hidden" name="type" value="addJobPos">
                
                <label for="intScheDate">Date & Time<span class="reqStar">*</span></label>
                <input id="intScheDate" name="intScheDate" type="date" required>
                <input id="intScheTime" name="intScheTime" type="time" required>
                
                <div class="addMoreIcon" onclick="addMoreInputs()"><i  id="addMoreIcon"class="fas fa-plus-circle"></i></div>
                <div class="addLessIcon" onclick="addLessInputs()"><i id="addLessIcon" class="fas fa-minus-circle"></i></div>
                <div id="moreInput"></div>
                <input type="hidden" id="count" name="count" value="1">
                <button class="submitBtn-compProfile" type="submit">SUBMIT</button>

            </form>
        </div>


</body>
</html>