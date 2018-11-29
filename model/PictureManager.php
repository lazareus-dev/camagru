<?php

require_once("/var/www/html/model/Manager.php");

class PictureManager extends Manager
{
    public function getPictures()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM PICTURE');

        return ($req);
    }

    public function addPicture($usr_id, $sticker_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO PICTURE (usr_id, pic_path) VALUES(?, ?)');
        $affectedLines = $req->execute(array($usr_id, $sticker_id));

        return $affectedLines;
    }
}