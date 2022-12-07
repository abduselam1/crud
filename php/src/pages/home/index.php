<?php
session_start();
include_once '../functions.php';
include_once '../connection.php';

$query = "SELECT * FROM category WHERE 1";

$categories = $database->query($query);


if (!isAuthenticated()) {
    // echo $_SESSION['authenticated'];
    return header("location:/pages/auth/login.php");
}

$id = $_SESSION['id'];
$pinnedQuery = "SELECT todos.id as todoID, todos.*,category.* FROM todos INNER JOIN category ON todos.category_id = category.id WHERE (user_id = $id and is_pinned = 1)";
$unpinnedQuery = "SELECT todos.id as todoID, todos.*,category.* FROM todos INNER JOIN category ON todos.category_id = category.id WHERE (user_id = $id and is_pinned = 0)";

$pinnedTodos  = $database->query($pinnedQuery);
$unpinnedTodos  = $database->query($unpinnedQuery);
// while ($row  = $unpinnedTodos->fetch_assoc()) {
//         print_r($row);
//         echo "<br><br>";

//     }
//     // var_dump($pinnedTodos->fetch_assoc());
//     // print_r($unpinnedTodos->fetch_assoc());
// // var_dump($pinnedTodos->num_rows);

// 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

    </style>
    <title>home</title>
</head>

<body>
    <div class="sticky top-0 left-0 px-5 py-2 bg-gray-700 w-full flex justify-between">
        <div class="text-gray-50 text-xl font-semibold">
            <span>Todo's</span>
        </div>
        <div>
            <span class="text-white font-semibold text-lg">Abduselam</span>
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
    <div id="myDIV" class="mx-auto md:max-w-3xl sm:max-w-xl w-full px-5 sm:px-0">
        <h2 class="py-5 text-3xl font-semibold text-center">My ToDo List</h2>
        <form method="POST" action="controller/add_new_todo.php">
            <div class="flex justify-between">
                <div class="w-full mr-3 ">
                    <input type="text" name="title" class="w-full  focus:outline-blue-500 p-1 rounded-lg border-2 border-gray-300 h-10" id="myInput" placeholder="Title...">
                    <select name="category" id="" class="w-full mt-2 focus:outline-blue-500 p-1 rounded-lg border-2 border-gray-300 h-10">
                        <option value="" class="text-gray-600">Select a category</option>

                        <?php
                        while ($row  = $categories->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '"  class="text-gray-600 font-semibold">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <textarea name="body" id="myInput" class="w-full focus:outline-blue-500 p-2 rounded-lg border-2 border-gray-300" placeholder="Todo body"></textarea>
            </div>
            <div class="flex justify-center mt-5 ">
                <button class="px-10 py-2 text-white bg-orange-500 rounded-lg" type="submit" name="submit">Add</button>
            </div>
        </form>

        <div class="mt-10">
            <?php
            if ($pinnedTodos->num_rows != 0) {
                echo '<span class="font-semibold text-gray-500"> Pinned</span>';

                while ($row = $pinnedTodos->fetch_assoc()) {

                    echo '<div class=" group rounded-xl border border-gray-500 px-5 py-3 mt-3">
                    <div class="flex justify-between">
                        <span class="text-xl font-bold text-gray-800">' . $row['title'] . '</span>
                        <span class="text-sm font-semibold text-gray-600">' . $row['name'] . '</span>
    
                    </div>
                    <p class=" font-semibold text-gray-700">' . $row['body'] . '</p>
                    <div class="mt-5 flex text-gray-700 hidden group-hover:flex">
                        <div class="pr-5 cursor-pointer">
                            <form action="controller/pin.php" method="POST">
                                <input type="checkbox" name="pinned" hidden>
                                <input type="text" name="id" value="' . $row['todoID'] . '" hidden>
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hover:text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l1.5 1.5.75-.75V8.758l2.276-.61a3 3 0 10-3.675-3.675l-.61 2.277H12l-.75.75 1.5 1.5M15 11.25l-8.47 8.47c-.34.34-.8.53-1.28.53s-.94.19-1.28.53l-.97.97-.75-.75.97-.97c.34-.34.53-.8.53-1.28s.19-.94.53-1.28L12.75 9M15 11.25L12.75 9" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <a href="edit.php?id=' . $row['todoID'] . '" class="pr-5 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hover:text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <div class="pr-5 cursor-pointer">
                            <form action="controller/delete.php" method="POST">
                                <input type="text" name="id" value="' . $row['todoID'] . '" hidden>

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
            }
            ?>

        </div>



        <div class="my-10">

            <span class="font-semibold text-gray-500"> Others</span>
            <?php
            while ($row = $unpinnedTodos->fetch_assoc()) {
                echo '<div class=" group rounded-xl border border-gray-500 px-5 py-3 mt-3">
                    <div class="flex justify-between">
                            
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-gray-800 pr-3">' . $row['title'] . '</span>
                            <span class="text-sm font-semibold text-gray-500">' . $row['created_at'] . '</span>

                        </div>
                        <span class="text-sm font-semibold text-gray-600">' . $row['name'] . '</span>
    
                    </div>
                    <p class=" font-semibold text-gray-700">' . $row['body'] . '</p>
                    <div class="mt-5 flex text-gray-700 hidden group-hover:flex">
                        <div class="pr-5 ">
                            <form action="controller/pin.php" method="POST">
                                <input type="checkbox" name="pinned" checked hidden>
                                <input type="text" name="id" value="' . $row['todoID'] . '" hidden>

                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hover:text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l1.5 1.5.75-.75V8.758l2.276-.61a3 3 0 10-3.675-3.675l-.61 2.277H12l-.75.75 1.5 1.5M15 11.25l-8.47 8.47c-.34.34-.8.53-1.28.53s-.94.19-1.28.53l-.97.97-.75-.75.97-.97c.34-.34.53-.8.53-1.28s.19-.94.53-1.28L12.75 9M15 11.25L12.75 9" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <a href="edit.php?id=' . $row['todoID'] . '" class="pr-5 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 hover:text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <div class="pr-5 cursor-pointer">
                            <form action="controller/delete.php" method="POST">
                                    <input type="text" name="id" value="' . $row['todoID'] . '" hidden>

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
            ?>

        </div>


</body>

</html>