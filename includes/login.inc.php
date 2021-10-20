<?php
require_once "dbhconnection.inc.php";
require_once "functions.inc.php";

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(emptyfieldlogin($username, $password) !== False){
        $error = ["417 Expectation Failed"=> "emptyfield"];
        echo json_encode($error);
        exit();
    }

    loginUser($conn, $username, $password);
}
else{
    header("location: ../login.php");
    exit();
}