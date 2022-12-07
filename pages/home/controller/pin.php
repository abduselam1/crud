<?php

include_once '../../functions.php';
include_once '../../connection.php';
session_start();
$pinned = null;
if (isset($_POST['pinned'])) {
    $pinned = 1;
} else {
    $pinned = 0;
}
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $userId = $_SESSION['id'];
    if (isset($_SESSION['id'])) {
        $query = "UPDATE todos SET is_pinned = $pinned WHERE (user_id = $userId AND id = $id)";
        $database->query($query);

        return header("location:/pages/home/");
    }
} else {
    echo "Incomplete data";
}
