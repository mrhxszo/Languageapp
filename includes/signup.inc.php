<?php

require_once "dbhconnection.inc.php";
require_once "functions.inc.php";


if (isset($_POST["submit"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $language = $_POST["language"];
    $level = $_POST["level"];

    if(emptyfield($firstname,$lastname,$username,$email,$password,$repassword) !== False){
        $error = ["417 Expectation Failed"=> "emptyfields"];
        echo json_encode($error);
        header('Content-Type: application/json; charset=utf-8');
        exit();
    }
    if(invalidusername($username) != False){
        $error = ["417 Expectation Failed"=> "invalidUsername"];
        echo json_encode($error);
        exit();
    }
    if(invalidemail($email) != False){
        $error = ["417 Expectation Failed"=>"invalidEmail"];
        echo json_encode($error);
        exit();
    }
    if(passwordmatch($password, $repassword) != False){
        $error = ["417 Expectation Failed"=> "nopasswordmatch"];
        echo json_encode($error);
        exit();
    }
    if(usernameexists($conn, $username, $email) != False){
        $error = ["417 Expectation Failed"=> "usernameexists"];
        echo json_encode($error);
        exit();      
    }
    if(strlen($password) <= 5 ){
        $error = ["417 Expectation Failed"=> "passwordshort"];
        echo json_encode($error);
        exit(); 
    }

    createuser($conn, $firstname, $lastname, $username, $email, $password, $language, $level);
    
    $error = ["201"=> "created"];
    echo json_encode($error);
    // if($_GET["error"] == "none"){
    //     $error = ["error"=> $_GET["error"]];
    //     echo json_encode($error);
    //     echo "<a href ='index.php'>return to homepage!</a>";
    // }
}

else{
    header("location: ../signup.php");
}