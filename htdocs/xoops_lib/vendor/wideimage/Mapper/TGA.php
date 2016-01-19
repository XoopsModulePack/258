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
include_once WideImage::path() . '/vendor/de77/TGA.php';
class WideImage_Mapper_TGA{
	function load($uri){
		return WideImage_vendor_de77_TGA::imagecreatefromtga($uri);
	}
	function loadFromString($data){
		return WideImage_vendor_de77_TGA::imagecreatefromstring($data);
	}
	function save($handle, $uri = NULL){
		throw new WideImage_Exception("Saving to TGA isn't supported.");
	}
}
?>