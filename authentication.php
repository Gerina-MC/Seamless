<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" type="text/css" href="style2.css">
        <meta charset="utf-8">
        <style>
        .navbar{
            background-color: #f3f3f3;
        }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-md navbar-light fixed-top" style="width:100%">
            <div class="container-fluid navbar-left">
                <a href="index.php" class="navbar-brand navbar-left">
                    <h2><img src="Seamlogo.svg" alt="Seamless logo" class="d-inline-block align-text-center" style="height:50px;width:50px;">
                    Seamless</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </div>
            <div class="navbar-nav" >
                <div class="collapse navbar-collapse navbar-right" id="collapsibleNavbar">
                    <a class="nav-link" style="padding-left:10px" href="index.php">Home</a>
                    <a class="nav-link" style="padding-left:10px" href="browse.php">Browse</a>
                    <a class="nav-link" style="padding-left:10px" href="about.php">About</a>
                </div>
            </div>
        </nav>
        <div style="height:85px"></div>
<?php
    error_reporting(0);      
    include('connection.php'); 
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from login_details where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result); 
          
        if($count == 1){
            session_start();
		    $_SESSION['login'] =$row['Username'];
            header("Location: profile.php", true, 301);
            exit();  
            /*echo "<h1>Profile:</h1>";
            $phone=$row['Phone_Number'];
            $email=$row['Email_address'];
            echo "<h3><center>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Name"]."</center></h3>";
            echo "\n";
            echo "<h3><center>Username:&nbsp;&nbsp;&nbsp;&nbsp;".$row["Username"]."</center></h3>";
            echo "\n";
            echo "<h3><center>Email address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Email_address"]."</center></h3>";
            echo "<h3><a href=design_upload.php>Upload Design</h3>";
            echo "<h3><a href=logout.php>Logout</h3>";*/
        }  
        else{
            session_start();
		    $_SESSION['login'] = "";  
            echo "<h2>Invalid username or password.</h2>";
            echo "<a href='register.php'>Click here</a> to create new account";  
        }     
?>

    </body>
</html>