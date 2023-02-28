<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style_display.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top" style="width:100%">
            <div class="container-fluid" >
                <a href="/Seamless/index.php" class="navbar-brand navbar-left">
                    <h1><img src="Seamlogo.svg" alt="Seamless logo" class="d-inline-block align-text-center" style="height:75px;width:75px;">
                    Seamless</h1>
                </a>
            </div>
            <div class="navbar-nav" >
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                    <a class="nav-link active" href="/Seamless/index.php">Home</a>
                    <a class="nav-link" href="/Seamless/browse.php">Browse</a>
                    <a class="nav-link" href="/Seamless/about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='nav-link' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='nav-link' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='nav-link' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='nav-link' href=/Seamless/logout.php>Logout</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div style="height:150px"></div>
        <h3 style="padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)">Popular designs</h3>
        <div style="justify-content: center;padding: 2rem">
            <section class="gallery">
                <?php
                error_reporting(0);      
                include('connection.php');
                $query = mysqli_query($con,"select * from image");
                while($row = mysqli_fetch_array($query)) {
                $Username=$row['Username'];
                $sql = "select *from login_details where username = '$Username'";
                $res2 = mysqli_query($con, $sql);  
                $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
                echo "<div class='item'>
                    <img src='image/{$row['filename']}'>
                    <div class='item__overlay'>
                        <div style='margin: 2rem; text-align: center;'>
                            <h4 style='color:blue;'>Designer: {$row2['Name']}</h4>
                            <h4 style='color:blue;'>Contact: {$row2['Email_address']}</h4>
                            <h4 style='color:blue;'>{$row['apparel']}</h4>
                            <h6>Material: {$row['material']} Color: {$row['colour']}</h6>
                            <h6>Size: {$row['size']}</h6>
                            <h6>Gender: {$row['gender']} Age group: {$row['age']}</h6>
                            <p>{$row['description']}</p>
                            <div><h5 style='color:blue;'>{$row['price']}</h5></div>
                        </div>
                    </div>
                </div>" ;
                }
                ?>
            </section>
        </div>
    </body>
</html>