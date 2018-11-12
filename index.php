<?php
require_once 'init.php';
require_once 'functions.php';
header('Content-Type: text/html; charset=utf-8');


isset($_GET["view"]) ? $view = $_GET["view"] : $view = "";
isset($_GET["id"]) ? $id = (int) $_GET["id"] : $id = "";


include 'template/header.php';
include 'template/menu.php';


switch($view) {
    case "recipient": { include "views/recipient.php"; break; }
    case "recipients": { include "views/recipients.php"; break; }
    case "grouplist": { include "views/grouplist.php"; break; }
    case "editgroup": { include "views/editgroup.php"; break; }
    case "addgroup": { include "views/addgroup.php"; break; }
    case "addrecipient": { include "views/addrecipient.php"; break; }
    case "message": { include "views/message.php"; break; }
    case "messages": { include "views/messages.php"; break; }
    case "addmessage": { include "views/addmessage.php"; break; }
    case "queue": { include "views/queue.php"; break; }
    case "delete": { include "views/deleterecepient.php"; break; }
    default : { include "views/main.php";}
}

include 'template/footer.php';

?>
