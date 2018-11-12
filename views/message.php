<?php

$row = messageDetails($id);

?>
<form action="actions/editmessage.php" method="post"  enctype="multipart/form-data">
    <p>Заголовок<br><input name="name" value="<?=$row->name;?>" required></p>
    <p>Текст<br><textarea name="text"><?=$row->text;?></textarea></p>
    <p>Вложение: <?=$row->attachement; ?><br><br><input type="file" name="attachement" value="<?=$row->attachement;?>"></p>
    <input type="hidden" name="id" value="<?=$id;?>">
    <p><span class="message"></span></p>
    <button>Сохранить</button>
</form>

<p> 
    <a href="?view=messages&id=<?=$id;?>"><< К списку сообщений</a>
</p>
<hr>
<h3>Разослать сообщение</h3>
<form action="actions/addqueue.php" method="post">
<input type="hidden" name="message_id" value="<?=$row->id;?>">
<p>Выберите группу адресатов для рассылки: 
    <?php showGroupsSelect(); ?>
    <button>Поехали!</button>
</form>