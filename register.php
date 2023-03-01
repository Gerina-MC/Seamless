<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" type="text/css" href="style_form.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top" style="width:100%">
            <div class="container-fluid navbar-left">
                <a href="/Seamless/index.php" class="navbar-brand navbar-left">
                    <h2><img src="Seamlogo.svg" alt="Seamless logo" class="d-inline-block align-text-center" style="height:50px;width:50px;">
                    Seamless</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </div>
            <div class="navbar-nav" >
                <div class="collapse navbar-collapse navbar-right" id="collapsibleNavbar">
                    <a class="nav-link" style="padding-left:10px" href="/Seamless/index.php">Home</a>
                    <a class="nav-link" style="padding-left:10px" href="/Seamless/browse.php">Browse</a>
                    <a class="nav-link" style="padding-left:10px" href="/Seamless/about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/logout.php>Logout</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div style="height:85px"></div>
        <?php
            error_reporting(0);
            include('connection.php');
            if(isset($_POST['submit'])){
                $name=$_POST['Name'];
                $username=$_POST['Username'];
                $password=$_POST['Password'];
                $email=$_POST['Email_address'];
                $sql = "select *from login_details where username = '$username' and password = '$password'";  
                $res1 = mysqli_query($con, $sql);  
                $row = mysqli_fetch_array($res1, MYSQLI_ASSOC);  
                $count = mysqli_num_rows($res1);
                if(!($count))
                {
                $query="INSERT into login_details(Name,Username,Password,Email_address)VALUES('$name','$username','$password','$email')";
                $result   = mysqli_query($con, $query);
                if($result)
                {
                    echo "<h2>Account created!</h2>";
                    echo "<h3>Click here to <a href=login.php> login</h3>";
                }
                else
                {
                    echo "error:".mysqli_error($con);
                }
                }
                else
                {
                    echo "<h3>Username already exists...choose another username</h3>";
                    echo "<h3><a href='register.php'>Register</a></h3>";
                }
        
            }else{
            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        ?>
        <div id ="frm" style="text-align:center">
            <form class="form" action="register.php" method="post">
                <h2 class="login-title">Registration</h2>
                <br>
                <input type="text" class="login-input" name="Name" placeholder="Name" style="width: 150px;" required><br>
                <br>
                <input type="text" class="login-input" name="Username" placeholder="Username" style="width: 150px;" required><br>
                <br>
                <input type="password" class="login-input" name="Password" placeholder="Password" style="width: 150px;" required><br>
                <br>
                <input type="text" class="login-input" name="Email_address" placeholder="Email_address" style="width: 150px;" required><br>
                <br>
                <input type="submit" name="submit" value="Register" class="btn btn-primary"><br><br>
            </form>
            </div>
        <?php
            }
        else{
            echo "<h3>Already logged in...<a href='logout.php'>logout</a> to create a new account</h3>";
        }
        }
        ?>
    </body>
</html>