<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registrations and Details</title>
</head>
<body bgcolor="#ff80ff">
<center>

    <!--Registration form-->
    <h1 style="border:2px solid DodgerBlue;">Student Details</h1>

    <!--search data-->
<form action="../view/results.php" method="GET">
        <input type="text" id="txtSearch" name="txtSearch" placeholder="Enter the name" required/><br>
        <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name="Search" value="Search Student">
    </form>
    <br>

    <!--delete data-->
    <form action="../view/messages.php" method="GET">
    <input type="text" id="txtSearch" name="txtSearch" placeholder="Enter the name" required/><br>
    <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name="delete" value="Delete Student">
    </form>
    <br><br>

    <!--view table-->
    <form action="../view/results.php" method="GET">
        <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name="ok" value="View Table">
    </form>
    <br>
    <br>
    <br>

    <!--insert and update-->
    <h1 style="border:3px solid DodgerBlue;">Registration Form</h1>
    <form action="../view/messages.php" method="GET">
    <input type="text" id="txtIndex" name="txtIndex" placeholder="Index Number" required/><br><br>
    <input type="text" id="txtName" name="txtName" placeholder="Name" required/><br><br>
    <input type="text" id="txtAge" name="txtAge" placeholder="Age" required/><br><br>
    <input type="text" id="txtTel" name="txtTel" placeholder="Mobile Number" required/><br><br>
    <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name= "insert" value="Insert Details">
    <input type="submit" style="font-face: 'Comic Sans MS'; font-size: larger; color: #800000; background-color: #b3ffff" name="update" value="Update Details">
    </form>
    
</center>
</body>
</html>