<?php

require($_ROOT."/model/dbConnect.php");

function postComment($usr_id, $pic_id, $comment)
{
    $db = dbConnect();
    $rq = $db->prepare('INSERT INTO COMMENT(usr_id, pic_id, cmt_content)
    VALUES(?, ?, ?)');
    $affectedLines = $rq->execute(array($usr_id, $pic_id, $comment));

    return $affectedLines;
}

function getComments($pic_id)
{
    $db = dbConnect();
    $rq = $db->prepare('SELECT * FROM COMMENT WHERE pic_id=? ORDER BY cmt_date DESC');
    $rq->execute(array($pic_id));

    return $rq;
}