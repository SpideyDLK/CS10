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
    <title>Edit Profile | JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        
        
</head>
<body class="editPro">
      <div class="logoBack">
        <div><a href="home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="../views/home.php">HOME</a>
            </div>
        </div>

        <div class="compProfileH"><h>Edit Profile</h></div>
        <div class="candProfileEditContainer">
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="hidden" name="type" value="editProfileCand">

                <fieldset class="fileUpload">
                    <legend>Profile Photo</legend>
                    <img class='proPicEdit' src="../material/images/dafault_pro_pic.jpg" alt="">
                <?php if(isset($_SESSION['proPic'])){
                    // echo "<embed class='proPicEdit' src='data:image/png;base64,".base64_encode($_SESSION['proPic']->profile_photo)."'/>";
                }?>

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

            <form action="#">
                <fieldset>
                    <legend>Personal Details</legend>
                    <label for="nic">First Name<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="fname"  required>

                    <label for="nic">Last Name<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="lname"  required>

                    <label for="nic">NIC<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="420220115V"  required>

                    <label for="nic">Contact No.<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="0711111111"  required>

                    <label for="nic">Address Line 1<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="Address Line 1"  required>

                    <label for="nic">Address Line 2</label>
                    <input id="nic" name="nic" type="text" value="Address Line 2">

                    <label for="nic">Street Name<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="Street Name"  required>

                    <label for="nic">City<span class="reqStar">*</span></label>
                    <input id="nic" name="nic" type="text" value="City Name"  required>

                    <label>Level of Education<span class="reqStar">*</span></label>
                        <select class="eduDropDownEdit" name="eduLevel">
                                <option value="0" selected disabled>Select:</option>
                                <option value="1">School</option>
                                <option value="2">Diploma</option>
                                <option value="3">Undergraduate</option>
                                <option value="4">Bachelor's Degree</option>
                                <option value="5">Master's Degree or Higher</option>
                        </select>
                    
                    <button class="saveButtonEditProfile2" type="submit">SAVE</button>
                </fieldset>
            </form>
        </div>


</body>
</html>