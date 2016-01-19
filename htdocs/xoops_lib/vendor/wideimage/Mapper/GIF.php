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
class WideImage_Mapper_GIF{
	function load($uri)	{
		return @imagecreatefromgif($uri);
	}
	function save($handle, $uri = NULL)	{
		if ($uri)
			return imagegif($handle, $uri);
		else
			return imagegif($handle);
	}
}
?>