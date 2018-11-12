<?php

$row = recipientDetails($id);

?>
<form action="actions/editrecipient.php" method="post">
    <p>ФИО<br><input name="name" value="<?=$row->name;?>" required></p>
    <p>Электронная почта<br><input name="email" type="email" value="<?=$row->email;?>" required></p>
    
    <p>Группа<br><input name="group_id" value="<?=$row->group_id;?>"></p>
    
    <p>Запись активна?<br><input name="active" value="<?=$row->active;?>"></p>
    
    <input type="hidden" name="id" value="<?=$id;?>">
    <p><span class="message"></span></p>
    <button>Обновить данные</button>
</form>

<p> 
    <a href="?view=recipients&id=<?=$row->group_id;?>"><< К списку группы</a>
</p>