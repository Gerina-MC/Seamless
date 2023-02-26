<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="style_gallery.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-light bg-light">
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
                        echo "<a class='navbar-brand' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='navbar-brand' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='navbar-brand' href=/Seamless/logout.php>Logout</a>";
                    }

                    ?>
                </div>
            </div>
        </nav>
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
                echo "<h1>Profile:</h1>";
                $_SESSION['login'] =$row['Username'];
                $phone=$row['Phone_Number'];
                $email=$row['Email_address'];
                echo "<h3><center>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Name"]."</center></h3>";
                echo "\n";
                echo "<h3><center>Username:&nbsp;&nbsp;&nbsp;&nbsp;".$row["Username"]."</center></h3>";
                echo "\n";
                echo "<h3><center>Email address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row["Email_address"]."</center></h3>";
            }

        ?>
        <h3 style="padding: 1rem 0 0 2rem; color:rgb(0, 0, 94)">My designs:</h3>
        <div style="padding: 2rem">
            <section class="gallery">
                <?php
                $db1 = mysqli_connect("localhost", "root", "","seamless");
                $query = mysqli_query($db1,"select * from image where username = '$username'");
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
                mysqli_close($db1);
                ?>
            </section>
        </div>
        <?php
    }
    else{
        echo "<h3>Login to view profile</h3>";
    }
    ?>
    </body>
</html>