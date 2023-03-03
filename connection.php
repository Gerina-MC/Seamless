<?php
    error_reporting(0);      
    $host = "sql306.epizy.com";  
    $user = "epiz_33713201";  
    $password = 'jem0zCeeeL4T';  
    $db_name = "epiz_33713201_seamless";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  
?>