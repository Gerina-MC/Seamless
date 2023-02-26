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
        <?PHP
            if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
        ?>
        <div id="content" style="margin-left:5%;margin-right:5%">
        <h3>Upload Design:</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div><br>
            <div class="form-group">
                <label for="tailname"><h5>Designer Name:</h5></label>
                <input type="text" name="tailname" required><br><br>

                <label for="contact"><h5>Contact Detail:</h5></label>
                <input type="text" name="contact" required><br><br>

                <label for="appname"><h5>Apparel Name:</h5></label>
                <input type="text" name="appname" required><br><br>

                <label for="color"><h5>Colour:</h5></label>
                <input type="text" name="color" required><br><br>

                <label for="material"><h5>Material:</h5></label>
                <input type="text" name="material" required><br><br>

                <label for="gender"><h5>Gender:</h5></label>
                <select name="gender">
                <option value="None">None</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select><br><br>

                <label for="age"><h5>Age Group:</h5></label>
                <select name="age">
                <option value="Kids">Kids</option>
                <option value="Adults">Adults</option>
                </select><br><br>


                <h5>Sizes Available:</h5>
                <input type="checkbox" name="size[]" value="XXS">
                <label for="size[]">XXS</label><br>
                <input type="checkbox" name="size[]" value="XS">
                <label for="size[]">XS</label><br>
                <input type="checkbox" name="size[]" value="S">
                <label for="size[]">S</label><br>
                <input type="checkbox" name="size[]" value="M">
                <label for="size[]">M</label><br>
                <input type="checkbox" name="size[]" value="L">
                <label for="size[]">L</label><br>
                <input type="checkbox" name="size[]" value="XL">
                <label for="size[]">XL</label><br>
                <input type="checkbox" name="size[]" value="XXL">
                <label for="size[]">XXL</label><br>

                <label for="price"><h5>Price:</h5></label>
                <input type="number" name="price" min="0.1" max="10000000" step="0.01" value="1"><br><br>

                <label for="description"><h5>Description:</h5></label>
                <input type="textbox" name="description"><br><br>

                <button class="btn btn-primary" type="submit" name="upload">Save</button>
                <button class="btn btn-danger" onclick="window.location.href='/Seamless/index.php';">Back</button>
            </div>
        </form>
    <?php
    error_reporting(0);
    include('connection.php');
      
    if (isset($_POST['upload'])) {
        $msg = "";
        $db = mysqli_connect("localhost", "root", "", "seamless");
        $tn=$_POST['tailname'];
        $cont=$_POST['contact'];
        $aname=$_POST['appname'];
        $col=$_POST['color'];
        $mat=$_POST['material'];
        $gen=$_POST['gender'];
        $agrp=$_POST['age'];
        $pri=$_POST['price'];
        $des="";
        if(isset($POST['description'])){
            $des=$_POST['description'];
        }
        $checkbox1=$_POST['size'];  
        $chk="";
        $i=0;  
        foreach($checkbox1 as $chk1)  
        {   if($i)
            {
                $chk .= ",".$chk1; 
            }
            else{
                $chk .= $chk1;
            }
            $i+=1; 
        }
        
        $target_dir = "image/";
        $fname = $_FILES["uploadfile"]["name"];
        if($fname){
        $filename = $target_dir . basename($_FILES["uploadfile"]["name"]);
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["uploadfile"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        }
        else {
            echo "<h5> File is not an image.</h5><br>";
            $uploadOk = 0;
        }

        if (file_exists($filename)) {
            echo "<h5> Sorry, file already exists.</h5><br>";
            $uploadOk = 0;
        }
        
        else if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "<h5> Sorry, your file is too large.</h5><br>";
            $uploadOk = 0;
        }
        else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "<h5> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h5><br>";
            $uploadOk = 0;
        }
        else if($fname)
        {
            $folder = "./image/" . $fname;
        
            $db = mysqli_connect("localhost", "root", "", "designs");

            $sql = "INSERT INTO image (filename,Tailor_Name,Contact,apparel,size,colour,material,gender,age,price,description) VALUES ('$fname','$tn','$cont','$aname','$chk','$col','$mat','$gen','$agrp','$pri','$des')";

            mysqli_query($db, $sql);
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h5>  Design uploaded successfully!</h5><br>";
            } else {
                echo "<h5>  Failed to upload design!</h6><br>";
            }
        }
        else{
            echo "<h5>  Failed to upload design!</h6><br>";
        }
        }
        else{
            echo "<h5>Choose a design</h5><br>";
        }
    }
    ?>
    </div>
    <?php
    }
    else{
        echo "<h3>Login to upload design</h3>";
    }
    ?>
    </body>
</html>