<?php

require_once ('../functions.php');
$error = 0;

isset($_POST["name"]) ? $name = $_POST["name"] : $error = 1;
isset($_POST["email"]) ? $email = $_POST["email"] : $error = 2;
isset($_POST["active"]) ? $active = (int)$_POST["active"] : $active = 0;
isset($_POST["group_id"]) ? $group_id = (int)$_POST["group_id"] : $error = 4;
isset($_POST["id"]) ? $id = (int)$_POST["id"] : $error = 3;

if (!$error) {
    $message = "Данные успешно обновлены!";
    $group_id = getGroupId($id);
    updateRecipient($id, $name, $email, $group_id, $active);
    header("location: ../?view=recipients&id=$group_id");
}
else 
{echo "Что-то пошло не так. Код ошибки: $error";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

