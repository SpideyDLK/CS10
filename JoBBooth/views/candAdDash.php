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

        <table class="adResponseTable">

        </table>


 
    <script>
        $( document ).ready(function() {
            var adResponses = $(".adResponseTable");
            var refNo = "<?php echo $refNo ?>";
            $.get("../controllers/searchDataController.php?q=viewAdCand", {refNo:refNo}).done(function(data){
                adResponses.html(data);     
            });
            
            
        });
    </script>

</body>
</html>