<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="style_about.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <a class="nav-link active" style="padding-left:10px" href="about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='nav-link' style='padding-left:10px' href='login.php'>Login</a>";
                    }
                    else{
                        echo "<a class='nav-link' style='padding-left:10px' href='design_upload.php'>Upload Design</a>";
                        echo "<a class='nav-link' style='padding-left:10px' href='profile.php'>Profile</a>";
                        echo "<a class='nav-link' style='padding-left:10px' href='logout.php'>Logout</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div style="height:85px"></div>
        <div class="mission">
            <!--images-->
            <div>
                <div class="images">
                    <img src="img5.jpg" class="im" alt="Photo by https://unsplash.com/@the_modern_life_mrs?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">
                    <img src="img4.jpg"  class="im" alt="Photo by https://unsplash.com/@waldemarbrandt67w?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" style="margin-top: 1rem;">
                </div>
            </div>
            <div class= "content">
                <br><br><h2>Designs made with love. Designs made for <span style="color:blue">YOU</span>.</h2><br><br>
            </div>
            <div class="content">
                <br>
                <p>
                    Here at Seamless we aim to provide accessibility to homemade designs for an affordable cost. Whether you are a self-made tailor or designer aiming to sell your work, or an eager shopaholic looking for the next perfect fit; at Seamless we have something for everyone.
                </p>
                <p>
                    We pride ourselves in providing our customers with a smooth purchasing experience and small designers with a platform to showcase their talent and masterpieces. 

                </p>
                <h4 style="padding: 2rem 0">Contact us:</h4>
                <div style="margin: auto; align-items: center">
                    <div style="margin: auto; align-items: center">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google"></a>
                        <a href="#" class="fa fa-linkedin"></a>
                        <a href="#" class="fa fa-youtube"></a>
                        <a href="#" class="fa fa-instagram"></a>
                        <a href="#" class="fa fa-pinterest"></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>