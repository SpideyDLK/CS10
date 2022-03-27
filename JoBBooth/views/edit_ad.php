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
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    if(isset($_GET['refNo'])){
        $refNo = $_GET['refNo'];
    }
    ?>
</head>
<body class="editAd">
    <div class="logoBack">
    
        <div class="logoBack">
            <div><a href="cand_home.php"><img id="logo" src="../material/images/LOGO.png" alt="JoBBooth"></a></div>
            <div class="navBar">
                <a href="contact.html">CONTACT</a>
                <a href="about.html">ABOUT</a>
                <a href="home.php">HOME</a>
            </div>
        </div>

        <div class="headingPubAd"><h>Edit Ad</h></div>
        <div class="editAdContainer">
        
        </div>
 
    
    <script>
        
        $(document).ready(function(){
            var refNo = "<?php echo $refNo ?>";
            var container = $(".editAdContainer");
            $.get("../controllers/searchDataController.php?q=editAd", {refNo:refNo}).done(function(data){
                container.html(data);
                   
            });
        });
        
    </script>
</body>
</html>