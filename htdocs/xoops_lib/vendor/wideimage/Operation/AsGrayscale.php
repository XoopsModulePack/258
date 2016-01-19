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
class WideImage_Operation_AsGrayscale{
	function execute($image){
		$new = $image->asTrueColor();
		if (!imagefilter($new->getHandle(), IMG_FILTER_GRAYSCALE))
			throw new WideImage_GDFunctionResultException('imagefilter() returned false');
		if (!$image->isTrueColor())
			$new = $new->asPalette();
		return $new;
	}
}
?>