<?php
$result = 'asdf';
if(isset($_POST['command'])){
    $serverIp = $_POST['command'];
    $flag = true;
    $newServerIp = "";

    $lists = explode('.',$serverIp);
    for ($i=0; $i < 4; $i++) { 
        if(is_numeric($lists[$i])){
            $newServerIp = $newServerIp + $lists[$i];
        }else{
            $flag = false;
            break;
        }
    }
    if ($flag) {
        $result = shell_exec('ping 124.10.55.230');
    }else{
        $result = "Invalid serve ip address";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="command.php" method="POST">
        <div class="" style="display: block;">
            <label for="command">Type your command *ping only</label>
            <input type="text" name="command" >
        </div>

        <button type="submit">Send</button>
    </form>

    <p><?php echo $result; ?></p>

</body>
</html>