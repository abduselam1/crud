<?php
session_start();
include_once '../functions.php';
if (! isAuthenticated()){
    // echo $_SESSION['authenticated'];
   return header("location:/crud/pages/auth/login.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>home</title>
</head>
<body>
    <div class="sticky top-0 left-0 px-5 py-2 bg-gray-700 w-full flex justify-between">
        <div class="text-gray-50 text-xl font-semibold">
            <span>Todo's</span>
        </div>
        <div class="text-gray-50">
            <form action="controller/logout.php" method="POST">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
        
    </div>
    <span>heloo</span>
</body>
</html>