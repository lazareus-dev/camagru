<?php

require($_ROOT."/model/dbConnect.php");

function getPictures()
{
    $db = dbConnect();
    $req = $db->query('SELECT * FROM PICTURE');
}