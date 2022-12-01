<?php

$database = new mysqli('127.0.0.1','root','crud','crud');

if ($database->connect_errno) {
    echo "connection faild";
}else{
}