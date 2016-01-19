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
include_once WideImage::path() . '/vendor/de77/BMP.php';
class WideImage_Mapper_BMP{
	function load($uri){
		return WideImage_vendor_de77_BMP::imagecreatefrombmp($uri);
	}
	function loadFromString($data){
		return WideImage_vendor_de77_BMP::imagecreatefromstring($data);
	}
	function save($handle, $uri = NULL){
		if ($uri == NULL)
			return WideImage_vendor_de77_BMP::imagebmp($handle);
		else
			return WideImage_vendor_de77_BMP::imagebmp($handle, $uri);
	}
}
?>