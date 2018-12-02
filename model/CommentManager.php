<?php

require_once("/var/www/html/model/Manager.php");

class CommentManager extends Manager
{
    public function postComment($usr_id, $pic_id, $comment)
    {
        $comment = trim($comment);
        if ($comment === '')
            return -1;
        $db = $this->dbConnect();
        $rq = $db->prepare('INSERT INTO COMMENT(usr_id, pic_id, cmt_content)
        VALUES(?, ?, ?)');
        $affectedLines = $rq->execute(array($usr_id, $pic_id, $comment));

        return $affectedLines;
    }

    public function getComments($pic_id)
    {
        $db = $this->dbConnect();
        $rq = $db->prepare('SELECT COMMENT.cmt_id, COMMENT.cmt_content, USER.usr_login 
                            FROM COMMENT, USER 
                            WHERE pic_id=?
                            AND COMMENT.usr_id = USER.usr_id
                            ORDER BY cmt_date DESC');
        $rq->execute(array($pic_id));

        return $rq;
    }

    public function getCommentById($cmt_id)
    {
        $db = $this->dbConnect();
        $rq = $db->prepare('SELECT * FROM COMMENT WHERE cmt_id=?');
        $rq->execute(array($cmt_id));

        return $rq;
    }

    public function deleteComment($cmt_id)
    {
        $db = $this->dbConnect();
        $rq = $db->prepare('DELETE FROM COMMENT WHERE cmt_id=?');
        $affectedLines = $rq->execute(array($cmt_id));

        return $affectedLines;
    }
}