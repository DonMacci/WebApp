<?php
    $Servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_webapp";

    $conn = new mysqli($Servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection Failed." . $conn->connect_error);
    }
?>