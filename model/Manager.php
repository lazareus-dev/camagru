<?php

require_once("/var/www/html/config/database.php");

class Manager
{
    protected function dbConnect()
    {
        global $DB_DSN, $DB_USER, $DB_PASSWORD;

        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return ($db);
    }
}