<?php
include_once '../../functions.php';

// $session_time = $session_time->session;
// var_dump($session_time);
$session_time = 1000 * 60;
// die($session_time);
ini_set('session.cookie_lifetime', "$session_time");

session_start();

if (count($_POST) != 3) {
    echo "Invalid data";
} else {

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        echo "Invalid email address";
    } else if (!isset($_POST['password']) || $_POST['password'] == '') {
        echo "Invalid password address";
    } else if(!isset($_POST['name']) || $_POST['name'] == ''){
        echo  "Invalid name";
    }else {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        
        include_once "../../connection.php";

        $sqlQuery = "SELECT * FROM users WHERE `email` = '$email'";
        $row_value = $database->query($sqlQuery);

        
        $count = $row_value->fetch_assoc();
        if(!empty($count) == 1){
            $count;
        }else{

            $password = hashMake($password);
            $query ="INSERT INTO `users` (name,email,password,role) values ('$name','$email','$password','2')";
            echo($query);
            $row_value = $database->query($query);
            if ($row_value) {
                $sqlQuery = "SELECT * FROM users WHERE `email` = '$email'";
                $row_value = $database->query($sqlQuery);

                $userInfo = [];
                while ($row  = $row_value->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        $userInfo[$key] = $value;
                    }
                    // return $user;
                    // var_dump($row);
                }
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['authenticated'] = true;
                header("location:/crud/pages/home");

            }else{
                echo $row_value;
            }
        }
        
        // var_dump($userInfo);
        
    }
}
