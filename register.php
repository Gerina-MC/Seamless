<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" type="text/css" href="style2.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-light bg-light" style="width:100%">
            <div class="container-fluid" >
                <div class="navbar-brand navbar-left" style="max-width:100px">
                    <img src="Seamlogo.svg" alt="Seamless logo" style="height:75px;width:75px;">
                </div>
                <div class="navbar-brand me-auto" style="max-width:20%">
                    <h1>Seamless</h1>
                </div>
                <div class="btn-group">
                    <a class="navbar-brand" href="/Seamless/index.php">Home</a>
                    <a class="navbar-brand" href="/Seamless/about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='navbar-brand' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='navbar-brand' href=/Seamless/design_upload.php>Upload Design</a><a class='navbar-brand' href=/Seamless/logout.php>Logout</a>";
                    }

                    ?>
                </div>
            </div>
        </nav>
        <?php
            error_reporting(0);
            include('connection.php');
            if(isset($_POST['submit'])){
                $name=$_POST['Name'];
                $username=$_POST['Username'];
                $password=$_POST['Password'];
                if(isset($_POST['Phone_Number']))
                {
                    $phone=$_POST['Phone_Number'];
                }
                $email="";
                if(isset($_POST['Email_address']))
                {
                    $phone=$_POST['Email_address'];
                }
                $query="INSERT into login_details(Name,Username,Password,Phone_Number,Email_address)VALUES('$name','$username','$password','$phone','$email')";
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
        
            }else{
            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        ?>
        <div id ="form">
            <form class="form" action="register.php" method="post">
                <h1 class="login-title">Registration</h1>
                <br>
                <input type="text" class="login-input" name="Name" placeholder="Name" required><br>
                <br>
                <input type="text" class="login-input" name="Username" placeholder="Username"><br>
                <br>
                <input type="password" class="login-input" name="Password" placeholder="Password"><br>
                <br>
                <input type="text" class="login-input" name="Phone Number" placeholder="Phone_Number"><br>
                <br>
                <input type="text" class="login-input" name="email" placeholder="Email_address"><br>
                <br>
                <input type="submit" name="submit" value="Register" class="login-button">
            </form>
            </div>
        <?php
            }
        else{
            echo "<h3>Already logged in...Logout to create a new account</h3>";
        }
        }
        ?>
    </body>
</html>