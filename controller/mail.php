<?php

require_once("/var/www/html/model/PictureManager.php");
require_once("/var/www/html/model/UserManager.php");

if (isset($new_user) && $new_user == true)
    sendActivationMail($email, $activkey);

function sendActivationMail($usr_mail, $activkey)
{
    $mail = $usr_mail;
    $activlink = 'http://localhost:8008/index.php?action=confirm&activkey=' . $activkey;

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    	$passage_ligne = "\r\n";
    else
        $passage_ligne = "\n";

    $message_txt = "Hello and welcome to Lazygram, please activate your account by clicking the following link : " . $activlink;
    $message_html = "<html><head></head><body><b>Hello and welcome to Lazygram</b>,
                    please activate your account by clicking the following link : " . $activlink ." </body></html>";
    
    $boundary = "-----=".md5(rand());
    
    //=====Définition du sujet.
    $sujet = "Activate yout account !";
    //=========
    
    //=====Création du header de l'e-mail.
    $header = "From: \"Lazygram\"<tle-coza@student.le-101.fr>".$passage_ligne;
    $header.= "Reply-to: \"Lazygram\" <tle-coza@student.le-101.fr>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========
    
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========
    
    mail($mail, $sujet, $message, $header);
}

function sendNotificationMail($type, $pic_id, $comment)
{
    $picMgmt = new PictureManager();
    $usrMgmt = new UserManager();

    $pic_req = $picMgmt->getPicOwnerNotifDatas($pic_id);
    $user_datas = $pic_req->fetch();
    $mail = $user_datas['usr_mail'];
    if ($user_datas['usr_notif'] == 0 || !$mail)
        die();

    $piclink = 'http://localhost:8008/index.php?action=display&pic_id=' . $pic_id;

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) 
    	$passage_ligne = "\r\n";
    else
        $passage_ligne = "\n";

    if ($type == 'comment') {
        $message_txt = "Hello, someone commented your picture : " . $comment . " link : " . $piclink;
        $message_html = "<html><head></head><body><b>Hello</b>,
                        someone commented your picture: <br/><i>\""
                         . $comment . "\"</i><br/>link : " . $piclink ." </body></html>";
    }
    else if ($type == 'like') {
        $message_txt = "Hello, someone liked your picture : " . $piclink;
        $message_html = "<html><head></head><body><b>Hello</b>,
                        someone liked your picture: " . $piclink ." </body></html>";
    }
    $boundary = "-----=".md5(rand());
    
    $sujet = "You have a notification from Lazygram !";
    
    $header = "From: \"Lazygram\"<tle-coza@student.le-101.fr>".$passage_ligne;
    $header.= "Reply-to: \"Lazygram\" <tle-coza@student.le-101.fr>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    
    mail($mail, $sujet, $message, $header);
}