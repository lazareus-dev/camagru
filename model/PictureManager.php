<?php

require_once("/var/www/html/model/Manager.php");

class PictureManager extends Manager
{
    public function getAllPictures()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT pic_path, pic_id, usr_id FROM PICTURE ORDER BY pic_date DESC');

        return $req;
    }

    public function addPicture($usr_id, $img_path)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO PICTURE (usr_id, pic_path) VALUES(?, ?)');
        $affectedLines = $req->execute(array($usr_id, $img_path));

        return $affectedLines;
    }

    public function getAllUserPics($usr_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pic_path, pic_id FROM PICTURE WHERE usr_id=? ORDER BY pic_date DESC');
        $req->execute(array($usr_id));

        return $req;
    }

    public function getPictureInfos($pic_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM PICTURE WHERE pic_id=?');
        $req->execute(array($pic_id));

        return $req;
    }

    public function getNumberOfLikes($pic_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) FROM LIKES WHERE pic_id=?');
        $req->execute(array($pic_id));

        return $req->fetch();
    }

    public function getNumberOfComments($pic_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) FROM COMMENT WHERE pic_id=?');
        $req->execute(array($pic_id));

        return $req->fetch();
    }
}