<?php

require($_ROOT."/model/picturesModel.php");

function displayPictures()
{
    global $_ROOT;
    $pictures = getPictures();
    require($_ROOT."/view/main_gallery.php");
}