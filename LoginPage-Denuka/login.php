<!DOCTYPE html>
<html lang="en">
<head>

<style>
body {
  background-image: url("lap.jpg");
}
</style>

</head>
<body>

<h1 style="border:3px solid DodgerBlue;">Registration Form</h1>
    <form action="../view/messages.php" method="GET">
    <input type="text" id="txtIndex" name="txtIndex" placeholder="Index Number" required/><br><br>
    <input type="text" id="txtName" name="txtName" placeholder="Name" required/><br><br>
    <input type="text" id="txtAge" name="txtAge" placeholder="Age" required/><br><br>
    <input type="text" id="txtTel" name="txtTel" placeholder="Mobile Number" required/><br><br>
    <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name= "insert" value="Insert Details">
    <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name="update" value="Update Details">
    
    </form>

</body>
</html>
