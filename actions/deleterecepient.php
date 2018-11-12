<?php

require_once ('../functions.php');
$error = 0;


if (isset($_POST["email"])) 
{   $email = $_POST["email"];
    deleteRecepient($email);
    header("location: ../?view=delete");
}
else 
{echo "Что-то пошло не так. Код ошибки: $error";
}
