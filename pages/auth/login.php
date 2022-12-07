<?php
session_start();
include_once '../functions.php';
if (isAuthenticated()) {
    // echo $_SESSION['authenticated'];
    return header("location:/pages/home");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>login</title>
</head>

<body class=" bg-gray-500">
    <div class="max-w-xl mx-auto bg-white rounded-lg shadow-sm mt-10">
        <h3 class="text-4xl text-red-700 font-semibold text-center py-10">Login</h3>



        <form action="controllers/login.php" method="POST" class="px-20 pb-5">
            <div class="mb-3">
                <input type="email" class="w-full focus:outline-blue-500 p-2 rounded-lg" name="email" placeholder="johndoe@gmail.com">
            </div>
            <div class="mb-3">
                <input type="password" class="w-full focus:outline-blue-500 p-2 rounded-lg" name="password" placeholder="*******">
            </div>


            <div class="mt-5 w-full">
                <button class="w-full font-semibold text-gray-50 rounded-lg shadow-sm bg-orange-500 py-2">Login</button>
            </div>
        </form>
        <div class="px-20 pb-5">
            <span class="text-gray-500 text-sm">Don't have an account <a href="register.php" class="text-orange-500 font-semibold">Register</a></span>
        </div>
    </div>
</body>

</html>