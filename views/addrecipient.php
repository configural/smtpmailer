<?php
$error = 0;
isset($_GET["group_id"]) ? $group_id = (int)$_GET["group_id"] : $error = 1;

if ($error) {
    die("Что-то пошло не так. Не указан id группы.");
}

?>
<form action="actions/addrecipient.php" method="post">
    <p>ФИО<br><input type="text" name="name" required></p>
    <p>Электронная почта<br><input name="email" type="email" value="" required></p>
    
    <input type="hidden" name="group_id" value="<?=$group_id;?>"></p>
    
    <p><span class="message"></span></p>
    <button>Создать адресата</button>
</form>

<p> 
    <a href="?view=recipients&id=<?=$id;?>"><< К списку группы</a>
</p>