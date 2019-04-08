<?php
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbdbname = "hms";
    $conn = new mysqli($dbservername,$dbusername,$dbpassword,$dbdbname);
    if($conn->connect_error){
        echo "Connection error!" . $conn->connect_error;
    }
?>