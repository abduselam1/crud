<?php

include_once '../../functions.php';
include_once '../../connection.php';
session_start();

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $userId = $_SESSION['id'];
    if(isset($_SESSION['id'])){
        $query = "DELETE FROM `todos` WHERE (user_id = $userId AND id = $id)";
        $database->query($query);
        
        return header("location:/crud/pages/home/");
    }else{
        echo "Not authenticated";
    }
}else{
    echo "Incomplete data";
}


