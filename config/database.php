<?php
    $DB_DSN = 'mysql:dbname=lazygru_db;host=127.0.0.1';
    $DB_USER = 'tle';
    $DB_PASSWORD = 'lazypass';

    try {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        die('Fail to connect DB : ' . $e->getMessage());
    }
?>