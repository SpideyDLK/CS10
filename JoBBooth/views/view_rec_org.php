<?php
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>JoBBooth</title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <?php $recNo = $_GET['recNo'];
        $rows = $_SESSION['searchResRec'];
        $rows2 = $_SESSION['searchResRecSpecAreas'];
        ?>
</head>
<body class="viewAd">
    <div class="logoBack">
    
        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>
 
    <div class="viewRecContainer"> 
        <div class="col1-viewAd">
        <img id="proPic-viewAd" src="../material/images/dafault_pro_pic.jpg" alt="Profile Photo">
        </div>

        <div class="col2-viewAd">
            <fieldset>
                <legend>Agency Details</legend>
            <div class="agencyDet-viewRec" id="agencyDet-viewRec"><?php echo'<b>Agency Name: </b>'.$rows[$recNo]->agency_name.' <br><b>Reg. No.: </b>'.$rows[$recNo]->agency_reg_no.'<br><b>Email: </b>'.$rows[$recNo]->email.'<br><b>Contact No.: </b>'.$rows[$recNo]->contact_no.''; ?></div>
            </fieldset>
            
            <fieldset>
                <legend>Description</legend>
            <div class="descRecView"><p id="address-viewCand"><?php if($rows[$recNo]->description == ""){
                echo '<i>No Description</i>';
            }else{
                echo ''.$rows[$recNo]->description.'';
            } ?></p></div>
            </fieldset>
            
        </div>

        <div class="col3-viewAd">
            <fieldset>
                <legend>Area(s) of Specialization</legend>
            <div class="jobPos-viewCand" id="jobPos-viewCand">
                <ul>
                <?php
                    for($x=0;$x<count($rows2);$x++){
                        if($rows2[$x]->rec_username == $rows[$recNo]->rec_username){
                            echo '<li>'.$rows2[$x]->specialized_in.'</li>';
                        }
                    }
                    
                    ?>
                    
                </ul>
            </div>
            </fieldset>

            <fieldset>
                <legend>Rating</legend>
            <div  id="lvlEdu-viewCand"><i id="ratingIcon" class="fas fa-star"></i> <?php echo''.$rows[$recNo]->average_rating.''; ?></div>
            </fieldset>
            <button class="sendReqBtn-viewCand" type="submit">SEND HIRE REQUEST</button>
        </div>
        

    </div>

</body>
</html>