<?php
/*
    WideImage_for_xoops
    By CHG-WEB
    2012/04/08
    Cédric MONTUY (montuy337513 / black_beard)
    Original author : Gaspar Kozak
*/
if (!defined('XOOPS_ROOT_PATH')) {
    die("XOOPS root path not defined");
}
class WideImage_Mapper_GD{
    function load($uri) {
        return @imagecreatefromgd($uri);
    }
    function save($handle, $uri = NULL){
        if ($uri == NULL)
            return imagegd($handle);
        else
            return imagegd($handle, $uri);
    }
}
?>