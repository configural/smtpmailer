<?php

require_once ('../functions.php');
$error = 0;

isset($_POST["name"]) ? $name = $_POST["name"] : $error = 1;

if (!$error) {
    $message = "Данные успешно обновлены!";
    addGroup($name);
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

