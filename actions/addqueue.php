<?php

require_once ('../functions.php');
$error = 0;
isset($_POST["group_id"]) ? $group_id = (int) $_POST["group_id"] : $error = 1;
isset($_POST["message_id"]) ? $message_id = (int) $_POST["message_id"] : $error = 2;

if (!$error){
    
    if (queueAdd($message_id, $group_id)) {
        echo "Задание успешно добавлено в очередь. <a href='../?view=queue'>Продолжить</a>";
    } else {
        echo "Ошибка добавления в очередь.";
    }
    
}
 else {
    echo "Что-то пошло не так. Ошибка $error";
}