<?php

include_once '../../functions.php';
include_once '../../connection.php';

if( !isset($_POST['title']) || ! isset($_POST['body']) || ! isset($_POST['category'])){
    echo "Invalid data <br> make sure you fill the form field correctly";

}else{
    $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'],FILTER_SANITIZE_STRING);

    $stmt = $database->prepare("INSERT INTO todos ( user_id, title, body, category_id) VALUES (?, ?, ?, ?)");
    
    $user_id = null;
    
    $userInfo = auth($database);
    
    if($userInfo){
        $user_id = $userInfo['id'];
    }else{
        echo "Not authenticated";
        return;
    }



    $stmt->bind_param('ssss',$user_id,$title,$body,$category);
    
    if($stmt->execute()){
        echo "Posted successfuly";
    }else{
        echo "Something went wrong please try again";
    }
    $stmt->close();
    
}
