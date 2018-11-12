<?php

require_once ('../functions.php');
$error = 0;

isset($_POST["name"]) ? $name = $_POST["name"] : $error = 1;
isset($_POST["text"]) ? $text = $_POST["text"] : $error = 2;
$file = $_FILES["attachement"]; 

$dir = "uploads/";
$filename = translit($file["name"]);

$attachement = $dir . $filename;
       

if (move_uploaded_file($file["tmp_name"], "../" . $dir . $filename)) {
    echo "файл успешно загружен";
} else {
    //echo "Файл не загружен!";
}


//die();


if (!$error) {
    $message = "Данные успешно обновлены!";
    addMessage($name, $text, $attachement);
    header("location: ../?view=messages");
}
else 
{echo "Что-то пошло не так. Код ошибки: $error";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

