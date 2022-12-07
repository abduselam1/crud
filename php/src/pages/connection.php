<?php

$database = new mysqli('mysql','root','crud123','crud');

if ($database->connect_errno) {
    echo "connection faild";
}else{
}