<?php

$user = "root";
$pass = "Arsenal@76mysql";
$host = "localhost";
$dbName = "language_app";

$conn = mysqli_connect($host, $user, $pass, $dbName);

if(!$conn){
    die("connection failed: ". mysqli_connect_error());
}