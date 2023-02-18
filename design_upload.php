<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                <div>
                    <a class="navbar-brand">Home</a>
                    <a class="navbar-brand">Browse</a>
                    <a class="navbar-brand">About</a>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </div>
        </nav>
        <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">Save</button>
            </div>
        </form>
    </div>
    <?php
    error_reporting(0);
    
    $msg = "";
    
    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
    
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        if($filename)
        {
            $folder = "./image/" . $filename;
        
            $db = mysqli_connect("localhost", "root", "", "designs");

            $sql = "INSERT INTO image (filename) VALUES ('$filename')";

            mysqli_query($db, $sql);
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Design uploaded successfully!</h3>";
                echo $filename;
            } else {
                echo "<h3>  Failed to upload design!</h3>";
                echo $filename;
            }
        }
        else{
            echo "<h3>Choose a design</h3>";
        }
    }
    ?>
    </body>
</html>