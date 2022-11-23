<?php

include_once '../../functions.php';
include_once '../../connection.php';

session_start();

if( !isset($_POST['title']) || ! isset($_POST['body']) || ! isset($_POST['category'])){
    echo "Invalid data <br> make sure you fill the form field correctly";

}else{
    $id = $_POST['id'];
    // var_dump($id);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'],FILTER_SANITIZE_STRING);

    $query = "UPDATE `todos` set `title`= '$title',`body`= '$body',`category_id` = $category WHERE id = $id";
    

    echo $query;

    $user_id = null;
    
    // $userInfo = auth($database);
    
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
        $database->query($query);
        return header("location:/crud/pages/home/");
    
    }else{
        echo "Not authenticated";
        return;
    }



    
    // if(){

    // }else{
    //     echo "Something went wrong please try again";
    // }
    
}