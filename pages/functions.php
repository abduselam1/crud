<?php

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