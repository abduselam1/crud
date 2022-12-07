<?php

// include_once 'connection.php';

function hashMake($value){

        
    $hashed = hash('sha256',$value);
    return $hashed;

}

function hashCheck($value, $hashedValue){

    $hashed = hash('sha256',$value);
    
    return $hashed == $hashedValue ? true : false;

}

function isAuthenticated(){
    if (isset($_SESSION['authenticated'])) {
        return true;
    }else{
        return false;
    }
}

function isAdmin($database){
    $id = $_SESSION['id'];
    
    $query = "SELECT * FROM users WHERE id = $id LIMIT 1";
    $user = $database->query($query);
    $user = $user->fetch_assoc();

    if($user['role'] == 1){
        return true;
    }
    return false;
}

function auth($database){
    session_start();
    // var_dump($_SESSION['authenticated']);
    if (isset($_SESSION['authenticated'])) {
        $userId = $_SESSION['authenticated'];
        var_dump($userId);
        $query = "SELECT * FROM users WHERE id = $userId LIMIT 1";
        $user = $database->query($query);
        $userInfo = '';
        while ($row  = $user->fetch_assoc()) {
            $userInfo = $row;
            // return $user;
            // var_dump($row);
        }
        if( $userInfo == ''){
            return null;
        }
        
        return $userInfo;
        
    }else{
        return null;
    }
}