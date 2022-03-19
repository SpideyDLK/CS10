<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Organization List | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
          function openForm() {
            document.getElementById("myForm").style.display = "block";
          }

          function closeForm() {
            document.getElementById("myForm").style.display = "none";
          }
        </script>
    </head>

    <body class="viewOrgList">

        <div class="logoBack">
            <div> <img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>
    <div class="authHeading"><h>Interview Reschedule Requests</h></div>

    <div class="intReschReqRec">
                <div class="jobReqHeading"><h></h></div>
            <div class="pendingIntContainerRec">
                <table class="pendingJobReq">
        
                <tr>
                  <th>Organization Name</th>
                  <th>Candidate's Name</th>
                  <th>Requested dates & times</th>
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                 
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                 
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                <tr>
                  <td>JoBBooth Inc.</td>
                  <td>JoBBooth</td>
                  <td><a class="view" onclick="openForm()">View</a></td>
                  
                </tr>
                
              </table>
        </div>
        </div>

        <div class="form-popup-rec" id="myForm">
  <form class="form-container">
  <table class="pendingJobReq">
        
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>date_01</td>
          <td><form>
          <input type="radio" id="time_01"name="time" value="time_01">
  <label for="time_011">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
          <tr>
          <td>date_02</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
          <tr>
          <td>date_03</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr><tr>
          <td>date_04</td>
          <td><form>
          <input type="radio" id="time_01 "name="time" value="time_01">
  <label for="time_01">time_01</label><br>
  <input type="radio" id="time_02" name="time" value="time_02">
  <label for="time_02">time_02</label>
          </form></td>
          <td><a class="view">Accept</a></td>
          <td><a class="view">Decline</a></td>
          </tr>
        
                </table>
               </form>
               <div class="outer">
        <div id="close" onclick="closeForm()"><i class="fas fa-times-circle"></i></div>
    </div>
</div>
       
 </body> 
</html>