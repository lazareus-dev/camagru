<?php
include("config/database.php");

function dbConnect()
{
    try {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ERRMODE_EXCEPTION);
        return ($db);
    } catch (PDOException $e){
        die('Fail to connect DB : ' . $e->getMessage());
    }
}