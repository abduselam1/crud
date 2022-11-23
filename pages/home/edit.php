<?php
session_start();
include_once '../functions.php';
include_once '../connection.php';

$query = "SELECT * FROM category WHERE 1";

$categories = $database->query($query);

$id = $_GET['id'];

$query = "SELECT * FROM todos WHERE id = $id";

$todos = $database->query($query);
$todo = $todos->fetch_assoc();

if (!isAuthenticated()) {
    return header("location:/crud/pages/auth/login.php");
}

$id = $_SESSION['id'];

// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

    </style>
    <title>Edit</title>
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
        <h2 class="py-5 text-3xl font-semibold text-center">Edit my ToDo</h2>
        <form method="POST" action="controller/edit.php">
            <div class="flex justify-between">
                <div class="w-full mr-3 ">
                    <input type="text" name="id" hidden class="w-full hidden  focus:outline-blue-500 p-1 rounded-lg border-2 border-gray-300 h-10" value="<?php echo $todo['id'] ?>" id="myInput" placeholder="Title...">

                    <input type="text" name="title" class="w-full  focus:outline-blue-500 p-1 rounded-lg border-2 border-gray-300 h-10" value="<?php echo $todo['title'] ?>" id="myInput" placeholder="Title...">
                    <select name="category" id="" class="w-full mt-2 focus:outline-blue-500 p-1 rounded-lg border-2 border-gray-300 h-10">

                        <?php
                        while ($row  = $categories->fetch_assoc()) {
                            if($row['id'] == $todo['category_id']){
                                echo '<option value="' . $row['id'] . '"  selected  class="text-gray-600 font-semibold">' . $row['name'] . '</option>';

                            }else{

                                echo '<option value="' . $row['id'] . '"   class="text-gray-600 font-semibold">' . $row['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <textarea name="body" id="myInput" class="w-full focus:outline-blue-500 p-2 rounded-lg border-2 border-gray-300" placeholder="Todo body"><?php echo $todo['body'] ?></textarea>
            </div>
            <div class="flex justify-center mt-5 ">
                <button class="px-10 py-2 text-white bg-orange-500 rounded-lg" type="submit" name="submit">Update</button>
            </div>
        </form>

        



        

        
</body>

</html>