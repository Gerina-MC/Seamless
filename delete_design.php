<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="style_display.css">
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
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/login.php>Login</a>";
                    }
                    else{
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/design_upload.php>Upload Design</a>";
                        echo "<a class='nav-link active' style='padding-left:10px' href=/Seamless/profile.php>Profile</a>";
                        echo "<a class='nav-link' style='padding-left:10px' href=/Seamless/logout.php>Logout</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div style="height:85px"></div>
        <?PHP
            if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
        ?>
        <?php
        error_reporting(0);    
        include('connection.php');
        
        $url = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        parse_url( $url, $component = -1 );
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $design=$params['des']; 
        if($design)
        {
            $design = stripcslashes($design);  
            $design = mysqli_real_escape_string($con, $design);  
            $username=$_SESSION['login'];
            $sql = "select *from image where filename = '$design' and username= '$username'";  
            $result = mysqli_query($con, $sql);  
            $count = mysqli_num_rows($result);
            if(!$count || $count!==1)
            {
                echo "<h3>You are not authorized to do this action</h3>";
            }
            else{
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo "
                <div style='text-align:center'>
                    <img src='image/{$design}' style='height:350px;width:250px;overflow:hidden;padding:10px;'>
                    <h6>Apparel Name: {$row['apparel']}</h6>
                    <h6>Material: {$row['material']}</h6>
                    <h6>Color: {$row['colour']}</h6>
                    <h6>Size: {$row['size']}</h6>
                    <h6>Gender: {$row['gender']}</h6>
                    <h6>Age group: {$row['age']}</h6>
                    <h6>Price: {$row['price']}</h6>";
                if(empty($row['description']))
                {
                    echo "</div>";
                }
                else
                {
                    echo "<h6>Description: {$row['description']}</h6></div>";
                }
                echo "<div style='text-align:center;margin:10px'>
                <h4>Are you sure you want to delete?</h4>
                <form method='POST' action='' enctype='multipart/form-data'>
                <button class='btn btn-danger' type='submit' name='delete'>Yes</button>
                <a class='btn btn-primary' href='profile.php'>No</a>
                </form>
                </div>";
                if (isset($_POST['delete']))
                {
                    $username = $_SESSION['login'];
                    unlink('image/'.$design);
                    $sql1 = "DELETE FROM image WHERE username = '$username' and filename = '$design'";
                    mysqli_query($con,$sql1);
                    header('location:profile.php');
                }
                

            }
            
        }
        else
        {
            echo "<h3><a href='profile.php'>Choose</a> a valid design</h3>";
        }
            ?>
        <?php
    }
    else{
        echo "<h3><a href='login.php'>Login</a> to delete design</h3>";
    }
    ?>
    </body>
</html>