<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="style_display.css">
        <meta charset="utf-8">
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
                    <a class="nav-link" href="/Seamless/index.php">Home</a>
                    <a class="nav-link" href="/Seamless/browse.php">Browse</a>
                    <a class="nav-link" href="/Seamless/about.php">About</a>
                    <?PHP
                    session_start();
                    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                        echo "<a class='nav-link' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='nav-link' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='nav-link active' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='nav-link' href=/Seamless/logout.php>Logout</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div style="height:150px"></div>
        <?PHP
            if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
        ?>
        <?php
        error_reporting(0);     
        include('connection.php'); 
        $username = $_SESSION['login']; 
          
            //to prevent from mysqli injection  
            $username = stripcslashes($username);  
            $username = mysqli_real_escape_string($con, $username);  
          
            $sql = "select *from login_details where username = '$username'";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result); 
              
            if($count == 1){  
                echo "<h3 style='padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)'>Profile</h3>";
                $_SESSION['login'] =$row['Username'];
                $email=$row['Email_address'];
                echo "<h5><center>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Name"]."</center></h5>";
                echo "\n";
                echo "<h5><center>Username:&nbsp;&nbsp;&nbsp;&nbsp;".$row["Username"]."</center></h5>";
                echo "\n";
                echo "<h5><center>Email address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Email_address"]."</center></h5>";
            }

        ?>
        <?php
        $con = mysqli_connect("localhost", "root", "","seamless");
        $query = mysqli_query($con,"select * from image where username = '$username'");  
        $count = mysqli_num_rows($query);
        if($count)
        {
        ?>
        <h3 style="padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)">My designs</h3>
        <div style="padding: 2rem">
            <section class="gallery">
        <?php
                while($row1 = mysqli_fetch_array($query)) {
                echo "<div class='item'>
                    <img src='image/{$row1['filename']}'>
                    <div class='item__overlay'>
                        <div style='margin: 2rem; text-align: center;'>
                            <h4 style='color:blue;'>{$row1['apparel']}</h4>
                            <h6>Material: {$row1['material']} Color: {$row1['colour']}</h6>
                            <h6>Size: {$row1['size']}</h6>
                            <h6>Gender: {$row1['gender']} Age group: {$row1['age']}</h6>
                            <p>{$row1['description']}</p>
                            <div><h5 style='color:blue;'>{$row1['price']}</h5></div>
                        </div>
                    </div>
                </div>" ;
                }
            }
                else
                {
                    echo "<h3 style='padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)''>No designs were uploaded</h3>";
                }
                ?>
            </section>
        </div>
        <?php
    }
    else{
        echo "<h3><a href='login.php'>Login</a> to view profile</h3>";
    }
    ?>
    </body>
</html>