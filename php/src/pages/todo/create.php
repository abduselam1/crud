<?php
    include_once '../functions.php';
    include_once './todo.php';

    session_start();
    if (! isAuthenticated()){
        return header("location:/crud/pages/auth/login.php");
    }

    if (count($_POST) != 1) {
        echo "Invalid data";
    } else {
    
        if (!isset($_POST['text']) || $_POST['text'] == '') {
            echo "Invalid text address";
        }else {
    
            $text = $_POST['text'];
            
            include_once "../../connection.php";
            
            //TODO create

        }
    }
    




?>