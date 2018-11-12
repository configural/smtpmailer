<?php

$row = groupDetails($id);

?>

<form action="actions/editgroup.php" method="post">
    <p>Название группы<br><input name="name" value="<?=$row->name;?>" required></p>
    <p>Запись активна?<br><input name="active" value="<?=$row->active;?>"></p>
    
    <input type="hidden" name="id" value="<?=$id;?>">
    <p><span class="message"></span></p>
    <button>Обновить данные</button>
</form>

<p> 
    <a href="?view=grouplist"><< К списку групп</a>
</p>