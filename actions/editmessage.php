<?php

require_once ('../functions.php');
$error = 0;

isset($_POST["id"]) ? $id = $_POST["id"] : $error = 0;
isset($_POST["name"]) ? $name = $_POST["name"] : $error = 1;
isset($_POST["text"]) ? $text = $_POST["text"] : $error = 2;



if (!$error) {
    $message = "Данные успешно обновлены!";
    updateMessage($id, $name, $text, "");
}
else 
{   die("Что-то пошло не так. Код ошибки: $error");
}


if ($_FILES["attachement"]) $file = $_FILES["attachement"];
{

$file = $_FILES["attachement"]; 

$dir = "uploads/";
$filename = translit($file["name"]);

$attachement = $dir . $filename;
       

if (move_uploaded_file($file["tmp_name"], "../" . $dir . $filename)) {
    echo "файл успешно загружен";
     updateMessage($id, $name, $text, $attachement);

} else {

    //echo "Файл не загружен!";
}

}

header("location: ../?view=messages");
