<?php
include_once '../../functions.php';

// $session_time = $session_time->session;
// var_dump($session_time);
$session_time = 1000 * 60;
// die($session_time);
ini_set('session.cookie_lifetime', "$session_time");

session_start();

if (count($_POST) != 2) {
    return "Invalid data";
    echo "Invalid data";
} else {

    if (!isset($_POST['email']) || $_POST['email'] == '') {
        echo "Invalid email address";
    } else if (!isset($_POST['password']) || $_POST['password'] == '') {
        echo "Invalid password address";
    } else {


        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        include_once "../../connection.php";

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
        // var_dump($userInfo);
        if (!empty($userInfo)) {

            if (hashCheck($password, $userInfo['password'])) {
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['authenticated'] = true;
                if($userInfo['role'] == 1){
                    header("location:/crud/pages/admin");
                }else{
                    header("location:/crud/pages/home");
                }

            } else {
                echo "Password doen't match";
            }
        } else {
            echo "User not found";
        }
    }
}
