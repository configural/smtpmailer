<?php
// конфигурационный массив с электронными ящиками
$SenderConfig = array(
 
     array(
            "SMTP_server"   =>  "smtp.yandex.ru",
            "SMTP_port"     =>  "465",
            "SMTP_email"    =>  "edu.fns@yandex.ru",
            "SMTP_pass"     =>  "",
            "SMTP_type"     =>  "SSL"),
    
    array(  "SMTP_server"   =>  "smtp.yandex.ru",
            "SMTP_port"     =>  "465",
            "SMTP_email"    =>  "pipk.fns@yandex.ru",
            "SMTP_pass"     =>  "",
            "SMTP_type"     =>  "SSL"),
    
    array(
            "SMTP_server"   =>  "smtp.yandex.ru",
            "SMTP_port"     =>  "465",
            "SMTP_email"    =>  "fns.pipk@yandex.ru",
            "SMTP_pass"     =>  "",
            "SMTP_type"     =>  "SSL"),
   
    /*array(
            "SMTP_server"   =>  "ssl://smtp.rambler.ru",
            "SMTP_port"     =>  "465",
            "SMTP_email"    =>  "pipk-fns@rambler.ru",
            "SMTP_pass"     =>  "",
            "SMTP_type"     =>  "SSL"),        

);

date_default_timezone_set('Europe/Moscow');

function dbConnect() {
    if ($db = mysqli_connect("localhost", "root", "", "mailer")) { 
     $db->set_charset('utf8') ;
   // echo "Соединение с базой данных успешно"; 
} else {
    echo "Ошибка подклюяения к БД";
}
return $db;

}

function dbDisconnect($db) {
    mysqli_close($db);
}

function groupList() {
    $db = dbConnect();
    $res = $db->query("select * from `groups` where `active`=1");
    echo "<h1>Группы пользователей</h1>";
    echo "<ol>";
    while ($row = $res->fetch_object()) {
        echo "<li><a href='?view=recipients&id=" . $row->id . "'>" . $row->name . "</a> [ <a href=?view=editgroup&id=$row->id>Изменить</a> ]  [ <a href='actions/removegroup.php?id=$row->id'>Удалить</a> ]</li>";        
    }
    echo "</ol>";
    dbDisconnect($db);
    return $res->num_rows;
}

function recipientsList($id) {
    $db = dbConnect();
    $id = (int)$id;
    //die();
    echo "<h1>" . groupDetails($id)->name . "</h1>";
    echo "<ol>";
    $res = $db->query("select * from `recipients` where `group_id`='$id'");
    
    while ($row = $res->fetch_object()) {
        if ($row->active == 1) {
            echo "<li><a href='?view=recipient&id=" . $row->id . "'>" . $row->name . " [ <a href='actions/removerecipient.php?id=$row->id'>Удалить</a>]</li>";        
        } else  {
            echo "<li>#<a href='?view=recipient&id=" . $row->id . "'>" . $row->name . " [ <a href='actions/removerecipient.php?id=$row->id'>Удалить</a>]</li>";        
            
        }
    }
    echo "</ol>";
    dbDisconnect($db);
    return $res->num_rows;
}


function recipientDetails($id) {
    $id = (int)$id;
    $db = dbConnect();
    $row = $db->query("select * from `recipients` where `id`='$id'")->fetch_object();
    dbDisconnect($db);
    return $row;
    
}

function groupDetails($id) {
    $id = (int)$id;
    $db = dbConnect();
    $row = $db->query("select * from `groups` where `id`='$id'")->fetch_object();
    dbDisconnect($db);
    return $row;
    
}


function showGroupsSelect()
{
    $db = dbConnect();
    $res = $db->query("select * from `groups` where `active`");
    echo "<select name='group_id'>"; 
    echo "<option value=0>Разослать всем</option>";
    while($row = $res->fetch_object()) {
            echo "<option value=$row->id>$row->name</option>";
        }
    echo "</select>";
    dbDisconnect($db); 
    return true;
    
}


function updateRecipient($id, $name="no_name", $email="no@email", $group_id, $active=1) {
    $db = dbConnect();
    $id = (int)$id;
    $group_id = (int)$group_id;
    $name = mysqli_real_escape_string($db, $name);
    $email = mysqli_real_escape_string($db, $email);
    $active = (int)$active;
   //die();
    $db->query("update `recipients` set `name`='$name', `email`='$email', `group_id` = '$group_id', `active`='$active' where `id`='$id'");
    dbDisconnect($db);
    return true;
}


function removeRecipient($id) {
    $db = dbConnect();
    $id = (int)$id;
    $db->query("update `recipients` set `active`=NULL where `id`='$id'");
    dbDisconnect($db);
    return true;
}


function addGroup($name="no_name") {
    $db = dbConnect();
    $name = mysqli_real_escape_string($db, $name);
    //die();
    $db->query("insert into `groups` (`name`, `active`) values ('$name', 1)");
    dbDisconnect($db);
    return true;
}

function addRecipient($name="no_name", $email="mail@localhost", $group_id) {
    $db = dbConnect();
    $name = mysqli_real_escape_string($db, $name);
    $email = mysqli_real_escape_string($db, $email);
    $group_id = (int)$group_id;
    //die();
    $db->query("insert into `recipients` (`name`, `email`, `group_id`) values ('$name', '$email', '$group_id')");
    dbDisconnect($db);
    return true;
}

function addMessage($name="no_name", $text="no_text", $attachement) {
    $db = dbConnect();
    $name = mysqli_real_escape_string($db, $name);
    $text = mysqli_real_escape_string($db, $text);
    $attachement = mysqli_real_escape_string($db, $attachement);
    
    //die();
    $db->query("insert into `messages` (`name`, `text`, `attachement`) values ('$name', '$text', '$attachement')");
    dbDisconnect($db);
    return true;
}

function updateMessage($id, $name="no_name", $text="no_text", $attachement="") {
    $db = dbConnect();
    $id = (int)$id;
    $name = mysqli_real_escape_string($db, $name);
    $text = mysqli_real_escape_string($db, $text);
    $attachement = mysqli_real_escape_string($db, $attachement);
    
    //die("update `messages` set `name`='$name', `text`='$text', `attachement` = '$attachement'  where `id`='$id'");
    
    if ($attachement) {
    $db->query("update `messages` set `name`='$name', `text`='$text', `attachement` = '$attachement'  where `id`='$id'");
    } else {
    $db->query("update `messages` set `name`='$name', `text`='$text' where `id`='$id'");    
    }
    dbDisconnect($db);
    return true;
}

function removeGroup($id) {
    $db = dbConnect();
    $id = (int)$id;
    //die();
    $db->query("update `groups` set `active`=NULL where `id`=$id");
    dbDisconnect($db);
    return true;
}

function updateGroup($id, $name="no_name", $active=1) {
    $db = dbConnect();
    $id = (int)$id;
    $active = (int)$active;
    $name = mysqli_real_escape_string($db, $name);
    //die();
    $db->query("update `groups` set `name`='$name', `active`='$active' where `id`='$id'");
    dbDisconnect($db);
    return true;
}


function messageDetails($id) {
    $id = (int)$id;
    $db = dbConnect();
    $row = $db->query("select * from `messages` where `id`='$id'")->fetch_object();
    dbDisconnect($db);
    return $row;
    
}

function queueAdd($message_id, $group_id) {
    $db = dbConnect();
    $message_id = (int)$message_id;
    $group_id = (int)$group_id;
    if ($group_id)
    {
        // получаем список адресатов из группы и формируем запрос на добавление
        $res = $db->query("select * from `recipients` where `group_id` = $group_id and `active`");
        while ($row = $res->fetch_object()) {
            $sql = "insert into `queue` (`message_id`, `group_id`, `recipient_id`) values ('$message_id', '$group_id', '$row->id')";
            $db->query($sql);    
        }
    } else {
        $res = $db->query("select * from `recipients` where `active`");
        while ($row = $res->fetch_object()) {
        $sql = "insert into `queue` (`message_id`, `group_id`, `recipient_id`) values ('$message_id', '$row->group_id', '$row->id')";
        $db->query($sql);    
        } 
    }
        
    
    
    
    dbDisconnect($db);
    return true;
}


function getGroupId($id) {
        $db = dbConnect();
        $id = (int)$id;
        $row = $db->query("select `group_id` from `recipients` where `id` = $id")->fetch_object();
        dbDisconnect($db);
    return $row->group_id;
}


function messagesList() {
    $db = dbConnect();
    $res = $db->query("select * from `messages` where `active` order by `timestamp` desc");
    echo "<table border=1>";
    echo "<tr><th>Создано</th><th>Тема</th><th>Содержимое</th><th>Вложение</th><th>Операции</th></tr>";
    while ($row = $res->fetch_object()) {
            echo "<tr>"
                    . "<td>" . $row->timestamp . "</td>"
                    . "<td><a href='?view=message&id=" . $row->id . "'>" . $row->name . "</td>"
                    . "<td>" . strip_tags(substr($row->text, 0, 500)) . "</td>"
                    . "<td>" . $row->attachement . "</td>"                     
                    . "<td>[ <a href='actions/removemessage.php?id=$row->id'>Удалить</a>]</td>"
                    . "</tr>";        
    }
    echo "</table>";
    dbDisconnect($db);
    return $res->num_rows;
}


function showQueue($option = 0) {
    $db = dbConnect();
    if ($option)  {
            $res = $db->query("select * from `queue` where `status` is NULL order by `id` desc limit 200");
        } else {
            $res = $db->query("select * from `queue` where `status` = $status `id` desc  limit 200");
        }
    
    echo "<table border=1>";
    $i = 0;
    echo "<tr><th>#</th><th>Заголовок сообщения</th><th>Группа</th><th>Email</th><th>статус</th></tr>";
    while ($row = $res->fetch_object()) {
        if ($row->status) $status = "OK";
        else $status = "Ожидание отправки";
            $i++;
            echo "<tr>"
                    . "<td>" . $i . "</td>"
                    . "<td>" . messageDetails($row->message_id)->name . "</td>"
                    . "<td>" . groupDetails($row->group_id)->name . "</td>"
                    . "<td>" . recipientDetails($row->recipient_id)->email .  "</td>"                     
                    . "<td>" . $status .  "</td>"                     
                    . "</tr>";        
    }
    echo "</table>";
    dbDisconnect($db);
    return $res->num_rows;
}


function getQueue($MailCount) {
		$db = dbConnect();
		$queue = array();
		$res = $db->query("select * from `queue` where `status` is NULL order by `id` desc limit $MailCount");
		
		while ($row = $res->fetch_object()) {
			$message = array();
                        $message['id'] = $row->id;
			$message['to'] = recipientDetails($row->recipient_id)->email;
			$message['subject'] = messageDetails($row->message_id)->name;
			$message['text'] = messageDetails($row->message_id)->text;
			$message['attachement'] = messageDetails($row->message_id)->attachement;
			
			$queue[] = $message;
			
		}
			
		
		dbDisconnect($db);
		return $queue;
}

function setQueueStatus($id, $status) {
    $db = dbConnect();
    $id = (int)$id;
    $status = (int)$status;
    $db->query("update `queue` set `status`='$status' where `id`='$id'");
    dbDisconnect($db);
    return true;
    
}

function getQueueCount($status) {
    $db = dbConnect();
    $status = (int)$status;
    if ($status) { $res = $db->query("SELECT `id` FROM `queue` WHERE `status`='$status'");
    } else {
            $res = $db->query("SELECT `id` FROM `queue` WHERE `status` IS NULL");
    }
    dbDisconnect($db);
    return $res->num_rows;
}

function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    
    $str = str_replace($rus, $lat, $str);
    $str = str_replace(" ", "_", $str);
        
    return $str;
    
}

function import_email($email, $group_id) {
    
    $db = dbConnect();
    $email = explode(",", $email);
    
    foreach ($email as $e) {
        $e = trim($e);
        $query = "select `id` from `recipients` where `email`='$e' and `group_id`='$group_id'";
        $res = $db->query($query);
        if ($res->num_rows == 0) {
        
            $db->query("insert into `recipients` (`name`, `email`, `group_id`) values ('$e', '$e', '$group_id')");
            echo $e . " - добавлено<br>";
        } else {
            echo $e . " - уже существует<br>";
        }
       
    }
    
    dbDisconnect($db);
    echo "<a href=\"../?view=grouplist\">Продолжить</a>" ;
    
}


function counterIncrement($n=1) {
    
    $db = dbConnect();
    $res = $db->query("select `id`, `count` from `counter` where `date` = CURDATE()");
    if ($res->num_rows) { 
        $db->query("update `counter` set `count` = `count` + $n where `date` = CURDATE() ");
    } else {
        $db->query("insert into `counter` (`date`, `count`) values (CURDATE(), $n)");
        
    }
    
    
    dbDisconnect($db);
}

function deleteRecepient($email) {
 
    $db = dbConnect();
    $db->query("update `recipients` set `active`=NULL where `email` like '$email'");
    dbDisconnect($db);
 
    return true;
}
    
    
