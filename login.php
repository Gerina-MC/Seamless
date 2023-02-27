<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" type="text/css" href="style1.css">
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
                    <a class="navbar-brand" href="/Seamless/browse.php">Browse</a>
                    <a class="navbar-brand" href="/Seamless/about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='navbar-brand' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='navbar-brand' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='navbar-brand' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='navbar-brand' href=/Seamless/logout.php>Logout</a>";
                    }

                    ?>
                </div>
            </div>
        </nav>
        <?PHP
            if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        ?>
        <div id = "frm">  
            <h1>Login</h1>  
            <form name="f1" action = "authentication.php" onsubmit = "return validation()" method = "POST">  
              <p>  
                <label> UserName: </label>  
                <input type = "text" id ="user" name  = "user" />  
              </p>  
              <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name  = "pass" />  
              </p>  
              <p>     
                <input type =  "submit" id = "btn" value = "Login" style="height:30px" />  
              </p><br>  
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