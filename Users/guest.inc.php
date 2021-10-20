<?php
session_start();
$_SESSION["username"] = "Guest User";
header("location:../index.php");