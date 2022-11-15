<?php
session_start();
session_destroy();

return header("location:/crud/pages/auth/login.php");
