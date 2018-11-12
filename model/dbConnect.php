<?php
require($_ROOT."/config/database.php");

function dbConnect()
{
    global $DB_DSN, $DB_USER, $DB_PASSWORD;
    try {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($db);
    } catch (PDOException $e){
        die('Fail to connect DB : ' . $e->getMessage());
    }
}