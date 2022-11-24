<?php
    session_start();
    include_once '../functions.php';
    include_once '../connection.php';


    if (!isAuthenticated()) {
        // echo $_SESSION['authenticated'];
        return header("location:/crud/pages/auth/login.php");
    }
    
    if (!isAdmin($database)) {
        return header("location:/crud/pages/home/");
    }

    $userid = $_GET['userId'];
    
    $userQuery = "SELECT * FROM users WHERE id = $userid LIMIT 1";

    $user = $database->query($userQuery);

    $user = $user->fetch_assoc();

    $todoQuery = "SELECT todos.id as todoID, todos.*,category.* FROM todos INNER JOIN category ON todos.category_id = category.id WHERE user_id = ".$user['id'];

    $todos = $database->query($todoQuery);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>


    <title>Admin | user - <?php echo $user['name']; ?></title>

</head>
<body>

    <div class="sticky top-0 left-0 px-5 py-2 bg-gray-700 w-full flex justify-between">
        <div class="text-gray-50 text-xl font-semibold">
            <span>Todo's</span>
        </div>
        <div>
            <span class="text-white font-semibold text-lg">Admin</span>
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

    <div class="mx-auto md:max-w-3xl sm:max-w-xl w-full px-5 sm:px-0">

        <div class="mt-10">
                <?php
                if ($todos->num_rows != 0) {
                    echo '<span class="font-semibold text-gray-500"> Todos</span>';
    
                    while ($row = $todos->fetch_assoc()) {
    
                        echo '<div class=" group rounded-xl border border-gray-500 px-5 py-3 mt-3">
                        <div class="flex justify-between">
                            <span class="text-xl font-bold text-gray-800">' . $row['title'] . '</span>
                            <span class="text-sm font-semibold text-gray-600">' . $row['name'] . '</span>
        
                        </div>
                        <p class=" font-semibold text-gray-700">' . $row['body'] . '</p>
                        <div class="mt-5 flex text-gray-700 hidden group-hover:flex">
                            
                            
                            <div class="pr-5 cursor-pointer">
                                <form action="controller/delete.php" method="POST">
                                    <input type="text" name="id" value="'.$row['todoID'].'" hidden>
    
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hover:text-blue-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                
        
                            </div>
                        </div>
        
                    </div>';
                    }
                }else{

                    echo "<span>No todo found</span>";
                }
    
                ?>
    
            </div>
    </div>

    

</body>
</html>