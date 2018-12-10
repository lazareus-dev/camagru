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

    public function paginateAllPictures($start, $limit)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pic_path, pic_id, usr_id FROM PICTURE ORDER BY pic_date DESC LIMIT :start, :limit');
        $req->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $req->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $req->execute();

        return $req;
    }

    public function addPicture($usr_id, $img_path)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO PICTURE (usr_id, pic_path) VALUES(?, ?)');
        $affectedLines = $req->execute(array($usr_id, $img_path));

        return $affectedLines;
    }

    public function getPicOwnerNotifDatas($pic_id)
    {
        $db = $this->dbConnect();
        $rq = $db->prepare('SELECT PICTURE.usr_id, USER.usr_mail, USER.usr_notif
                            FROM PICTURE, USER 
                            WHERE pic_id=?
                            AND PICTURE.usr_id = USER.usr_id');
        $rq->execute(array($pic_id));

        return $rq;
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

    public function requestDeletePicture($pic_id, $usr_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT usr_id, pic_path FROM PICTURE WHERE pic_id=?');
        $req->execute(array($pic_id));

        $picture = $req->fetch();
        if (empty($picture))
            return 0;
        if (!$this->checkPictureOwner($pic_id, $usr_id, $picture))
            $affectedLines = 0;
        else
            $affectedLines = $this->deletePicture($pic_id, $picture);

        return $affectedLines;
    }

    private function checkPictureOwner($pic_id, $usr_id, $picture)
    {
        if ($picture['usr_id'] === $usr_id)
            return true;
        return false;
    }

    private function deletePicture($pic_id, $picture)
    {
        
        $db = $this->dbConnect();
        $delcom = $db->prepare('DELETE FROM COMMENT WHERE pic_id=?');
        $dellike = $db->prepare('DELETE FROM LIKES WHERE pic_id=?');
        if (!$delcom->execute(array($pic_id)) || !$dellike->execute(array($pic_id)))
            return 0;
        $req = $db->prepare('DELETE FROM PICTURE WHERE pic_id=?');
        if ($affectedLines = $req->execute(array($pic_id)))
        {
            $path = '/var/www/html/public/' . $picture['pic_path'];
            if (file_exists($path))
                unlink($path);
        }

        return $affectedLines;
    }

    public function likePicture($pic_id, $usr_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO LIKES (pic_id, usr_id) VALUES (?, ?)');
        $req->execute(array($pic_id, $usr_id));

        return $req->rowCount();
    }

    public function dislikePicture($pic_id, $usr_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM LIKES WHERE pic_id=? AND usr_id=?');
        $affectedLines = $req->execute(array($pic_id, $usr_id));

        return $affectedLines;
    }

    public function isLikedByUser($pic_id, $usr_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT usr_id FROM LIKES WHERE pic_id=? AND usr_id=?');
        $req->execute(array($pic_id, $usr_id));

        return $req->rowCount();
    }
}