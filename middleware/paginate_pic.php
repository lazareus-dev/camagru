<?php
if (!isset($page))
    header('Location: /index.php');

$limit = 5;
$total = ($picMgmt->getAllPictures())->rowCount();

$nbPages = ceil($total / $limit);
if ($nbPages < 1)
    $nbPages = 1;

if ($page < 1)
    $page = 1;
else if ($page > $nbPages)
    $page = $nbPages;

$start = ($page - 1) * $limit;

$pictures = $picMgmt->paginateAllPictures($start, $limit);