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
class WideImage_Operation_ApplyConvolution{
	function execute($image, $matrix, $div, $offset){
		$new = $image->asTrueColor();
		if (!imageconvolution($new->getHandle(), $matrix, $div, $offset))
			throw new WideImage_GDFunctionResultException('imageconvolution() returned false');
		return $new;
	}
}
?>