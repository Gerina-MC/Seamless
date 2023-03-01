<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                    <a class="nav-link active" style="padding-left:10px" href="/Seamless/browse.php">Browse</a>
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
        <div>
            <h3 style="padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)">List of designers</h3>
            <ul>
            <?php
            error_reporting(0);
            include('connection.php');
            $res=mysqli_query($con,"select * from login_details");

            while($row = mysqli_fetch_array($res)) { 
                $Username=$row['Username'];
                $Name=$row['Name'];
                $result = mysqli_query($con, "select *from image where username = '$Username'");  
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                $count = mysqli_num_rows($result);
                if($count)
                {
                echo "<li><h5><a href='designer_details.php?user={$Username}'>{$Name}</a></h5></li>";
                }
            }
            ?>
            </ul>
        </div>
    </body>
</html>