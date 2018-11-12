<?php

require_once($_ROOT."/model/Manager.php");

class CommentsManager extends Manager
{
    public function postComment($usr_id, $pic_id, $comment)
    {
        $comment = trim($comment);
        if ($comment === '')
            return -1;
        $db = dbConnect();
        $rq = $db->prepare('INSERT INTO COMMENT(usr_id, pic_id, cmt_content)
        VALUES(?, ?, ?)');
        $affectedLines = $rq->execute(array($usr_id, $pic_id, $comment));

        return ($affectedLines);
    }

    public function getComments($pic_id)
    {
        $db = $this->dbConnect();
        $rq = $db->prepare('SELECT * FROM COMMENT WHERE pic_id=? ORDER BY cmt_date DESC');
        $rq->execute(array($pic_id));

        return ($rq);
    }
}