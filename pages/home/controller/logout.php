<?php
session_start();
session_destroy();

return header("location:/pages/auth/login.php");
