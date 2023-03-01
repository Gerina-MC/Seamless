<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" type="text/css" href="style_form.css">
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
                        echo "<a class='nav-link active' style='padding-left:10px' href=/Seamless/login.php>Login</a>";
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
        <?PHP
            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        ?>
        <div id = "frm">  
            <h2 style="text-align:center">Login</h2>  
            <form name="f1" action = "authentication.php" onsubmit = "return validation()" method = "POST">   
                <label> UserName: </label><br>  
                <input type = "text" id ="user" name  = "user" style="width: 150px;" required/><br>   
                <label> Password: </label><br>   
                <input type = "password" id ="pass" name  = "pass" style="width: 150px;" required/><br><br>  
                <input type =  "submit" id = "btn" value = "Login" class="btn btn-primary"/><br>  
                <p>
                New user??Click here to <a href="register.php">register</a>
                </p>
            </form>  
        </div>
    <?php
    }
    else{
        echo "<h3>Already logged in...<a href='logout.php'>logout</a> to login again</h3>";
    }
    ?>  
    </body>
</html>