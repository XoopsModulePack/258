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
class WideImage_Mapper_GD2{
	function load($uri){
		return @imagecreatefromgd2($uri);
	}
	function save($handle, $uri = NULL, $chunk_size = NULL, $type = NULL){
		return imagegd2($handle, $uri, $chunk_size, $type);
	}
}
?>