<?php

require_once($_ROOT."/model/Manager.php");

class UserManager extends Manager
{
    public function getSettings()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM USER');

        return $req;
    }

    public function getUser($usr_login, $hashpass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM USER WHERE usr_login=? AND usr_passwd=?');
        $req->execute(array($usr_login, $hashpass));

        return $req;
    }

    public function createUser($usr_login, $usr_mail, $hashpass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO USER(usr_login, usr_mail, usr_passwd)
        VALUES(?, ?, ?)');
        $affectedLines = $req->execute(array($usr_login, $usr_mail, $hashpass));

        return $affectedLines;
    }

    public function checkIfUserExists($usr_login, $usr_mail)
    {
        return ($this->checkIfLoginExists($usr_login)
        || $this->checkIfMailExists($usr_mail));
    }

    public function checkIfLoginExists($usr_login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM USER WHERE usr_login=?');
        $req->execute(array($usr_login));

        return $req->rowCount();
    }

    private function checkIfMailExists($usr_mail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM USER WHERE usr_mail=?');
        $req->execute(array($usr_mail));

        return $req->rowCount();
    }

    public function getUserId($user_req)
    {
        $usr_datas = $user_req->fetch();
        return ($usr_datas['usr_id']);
    }

    public function getUserSettings($usr_id)
    {
        $db = $this->dbConnect();
        $usr_settings = $db->prepare('SELECT usr_login, usr_mail, usr_notif FROM USER WHERE usr_id=?');
        $usr_settings->execute(array($usr_id));

        return $usr_settings;
    }
}