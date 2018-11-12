<?php
/**
 * Отправка почты через PHP (SMTP)
 * Сделано в Live-code.ru
 * Автор: Mowshon
 * Дата: 11.11.11
 */

// Подключаем SMTP класс для работы с почтой
include_once('km_smtp_class.php');
include_once('functions.php');
//include_once('db_class.php');

$hour = date("H");
if ($hour<8 or $hour >= 17) {
    echo "Stop work! Go home!";
    sleep(1);
    exit();
}

$MailCount = rand(0,5) * count($SenderConfig);

echo "Wow! I'll send now $MailCount letters. Start!!!\r\n\r\n";

$queue = getQueue($MailCount);

$i = 0;
foreach($queue as $q) {
    $i++;
    
    $j = $i % count($SenderConfig);
    
    if ($i <= $MailCount) {
        $Receiver = $q["to"];
        $Subject = $q["subject"];
        $Text_array = explode("###", $q["text"]);
        $Attachment="";
        isset($q["attachement"]) ? $Attachment = $q["attachement"] : $Attachment = "";

        echo "$i. " . $SenderConfig[$j]['SMTP_email'] . " -> $Receiver\r\n";
        // Пишем в лог
            $f = fopen("logs/". date("Y-m-d").".txt", "a");
            $log = date("F j, Y, g:i a") . "\t" . $SenderConfig[$j]['SMTP_email'] . " -> " . $Receiver . "\t" . $Subject . "\r\n";
            fputs($f, $log);
            fclose($f);

        $mail = new KM_Mailer($SenderConfig[$j]['SMTP_server'], $SenderConfig[$j]['SMTP_port'], $SenderConfig[$j]['SMTP_email'], $SenderConfig[$j]['SMTP_pass'], $SenderConfig[$j]['SMTP_type']);
        if($mail->isLogin) {
        // Прикрепить файл
        if($Attachment !="uploads/") {$mail->addAttachment($Attachment);}

        // Добавить ещё получателей
        //$mail->addRecipient('user@mail.ru');
        //$mail->addRecipient('user@yandex.ru');

        /* $mail->send(От, Для, Тема, Текст, Заголовок = опционально) */
        $SendMail = $mail->send($SenderConfig[$j]['SMTP_email'], $Receiver, $Subject, $Text_array[array_rand($Text_array, 1)]);
        //sleep(rand(10,30));

        
        // Очищаем список получателей
        $mail->clearRecipients();
        $mail->clearCC();
        $mail->clearBCC();
        $mail->clearAttachments();

        setQueueStatus($q["id"], 1);

    }
     else {
        echo "SMTP error\r\n";
     }
    }
}
//var_dump($queue);

counterIncrement($MailCount);

/* $mail = new KM_Mailer(сервер, порт, пользователь, пароль, тип); */
/* Тип может быть: null, tls или ssl */

?>