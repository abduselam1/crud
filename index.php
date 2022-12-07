<?php

session_start();
include_once 'pages/functions.php';
include_once 'pages/connection.php';

$query = "SELECT * FROM category WHERE 1";

$categories = $database->query($query);


if (!isAuthenticated()) {
    // echo $_SESSION['authenticated'];
    return header("location:/pages/auth/login.php");
}else{
    return header("location:/pages/home");
}