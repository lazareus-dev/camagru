<?php

require_once($_ROOT."/model/Manager.php");

class UserManager extends Manager
{
    public function getPictures()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM PICTURE');

        return ($req);
    }
}