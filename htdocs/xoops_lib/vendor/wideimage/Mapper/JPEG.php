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
class WideImage_Mapper_JPEG{
	function load($uri){
		return @imagecreatefromjpeg($uri);
	}
	function save($handle, $uri = NULL, $quality = 100){
		return imagejpeg($handle, $uri, $quality);
	}
}
?>