<?php

require_once ('../functions.php');
$error = 0;

isset($_POST["name"]) ? $name = $_POST["name"] : $error = 1;
isset($_POST["email"]) ? $email = $_POST["email"] : $error = 2;
isset($_POST["group_id"]) ? $group_id = $_POST["group_id"] : $error = 3;

if (!$error) {
    $message = "Данные успешно обновлены!";
    addRecipient($name, $email, $group_id);
    header("location: ../?view=grouplist");
}
else 
{echo "Что-то пошло не так. Код ошибки: $error";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

