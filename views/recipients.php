<?php

recipientsList($id);

?>
<p>
    [ <a href="?view=addrecipient&group_id=<?=$id; ?>">Создать адресата</a> ]
</p>

<fieldset><h3>Импортировать список адресов </h3>
    <p><a href="http://hostciti.net/calc/it/email-search.html" target="_blank">Сервис по выборке адресов из текста</a></p>
<form action="actions/import_email_list.php" method="post">
    <p>Скопируйте в это поле <a href="http://hostciti.net/calc/it/email-search.html" target="_blank">список email-адресов</a>, разделенных запятой<br>
        <p><input name="email_list" value="" style="width:100%"></p>
        <input type="hidden" name="id" value="<?=$id;?>">
    <button>Импорт</button>
</form>
</fieldset>


<p> 
    <a href="?view=grouplist"><< К списку групп</a>
</p>