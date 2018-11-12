<?php

require_once ('../functions.php');
$error = 0;

$email_list = "";
$id = "";
isset($_POST["email_list"]) ? $email_list = $_POST["email_list"] : $error = 1;
isset($_POST["id"]) ? $id = $_POST["id"] : $error = 2;

if (!$error) {

        import_email($email_list, $id);
    
}
else 
{echo "Что-то пошло не так. Код ошибки: $error";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

