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

    public function checkIfMailExists($usr_mail)
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

    public function checkPassword($usr_id, $pass_to_check)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT usr_passwd FROM USER WHERE usr_id=?');
        $req->execute(array($usr_id));

        return ($this->comparePassword($req, $pass_to_check));
    }

    private function comparePassword($dbRequest, $pass_to_check)
    {
        if ($dbRequest)
        {
            $usr_datas = $dbRequest->fetch();
            $passwd = $usr_datas['usr_passwd'];
            if ($passwd === hash('Whirlpool', $pass_to_check))
                return (true);
        }

        return (false);
    }

    public function updateLogin($usr_id, $new_login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE USER SET usr_login=? WHERE usr_id=?');
        $affectedLines = $req->execute(array($new_login, $usr_id));

        return $affectedLines;
    }

    public function updateEmail($usr_id, $new_mail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE USER SET usr_mail=? WHERE usr_id=?');
        $affectedLines = $req->execute(array($new_mail, $usr_id));

        return $affectedLines;
    }
    
    public function updateNotif($usr_id, $new_notif)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE USER SET usr_notif=? WHERE usr_id=?');
        $affectedLines = $req->execute(array($new_notif, $usr_id));

        return $affectedLines;
    }

    public function updatePassword($usr_id, $new_passwd)
    {
        $db = $this->dbConnect();
        $hashpass = hash('Whirlpool', $new_passwd);
        $req = $db->prepare('UPDATE USER SET usr_passwd=? WHERE usr_id=?');
        $affectedLines = $req->execute(array($hashpass, $usr_id));

        return $affectedLines;
    }
}