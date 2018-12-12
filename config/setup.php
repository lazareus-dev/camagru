<?php
    
include('database.php');

$dsn = "mysql:host=mysql;charset=utf8mb4";

$pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD);

$check = $pdo->query("SHOW DATABASES LIKE 'lazygru_db'");
if ($check->rowCount() != 0)
  return ;

$req = $pdo->prepare("CREATE DATABASE IF NOT EXISTS `lazygru_db`");
$req->execute();

$pdo->query("use `lazygru_db`");


$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS `COMMENT` (
    `cmt_id` int(11) NOT NULL,
    `usr_id` int(11) NOT NULL,
    `pic_id` int(11) NOT NULL,
    `cmt_content` varchar(255) NOT NULL,
    `cmt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
$req->execute();

$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS `LIKES` (
    `pic_id` int(11) NOT NULL,
    `usr_id` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
$req->execute();

$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS `PICTURE` (
    `pic_id` int(11) NOT NULL,
    `usr_id` int(11) NOT NULL,
    `pic_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `pic_path` varchar(512) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
$req->execute();

$req = $pdo->prepare("CREATE TABLE IF NOT EXISTS `USER` (
    `usr_id` int(11) NOT NULL,
    `usr_login` varchar(64) NOT NULL,
    `usr_mail` varchar(320) NOT NULL,
    `usr_passwd` char(255) NOT NULL,
    `usr_activated` tinyint(1) NOT NULL DEFAULT '0',
    `usr_notif` tinyint(1) NOT NULL DEFAULT '1',
    `usr_activkey` varchar(255) NOT NULL DEFAULT '0',
    `usr_resetkey` varchar(255) NOT NULL DEFAULT '0',
    `usr_pp` tinyint(4) NOT NULL DEFAULT '1'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `pic_id` (`pic_id`);");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `PICTURE`
  ADD PRIMARY KEY (`pic_id`),
  ADD KEY `usr_id` (`usr_id`);");
$req->execute();

 $req = $pdo->prepare("ALTER TABLE `USER`
  ADD PRIMARY KEY (`usr_id`);");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `COMMENT`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `PICTURE`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `USER`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `COMMENT`
  ADD CONSTRAINT `COMMENT_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `USER` (`usr_id`),
  ADD CONSTRAINT `COMMENT_ibfk_2` FOREIGN KEY (`pic_id`) REFERENCES `PICTURE` (`pic_id`);");
$req->execute();

$req = $pdo->prepare("ALTER TABLE `PICTURE`
  ADD CONSTRAINT `PICTURE_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `USER` (`usr_id`);
COMMIT;");
$req->execute();

rename(__FILE__, __FILE__.'.bak');

$_SESSION['usr_id'] = -1;