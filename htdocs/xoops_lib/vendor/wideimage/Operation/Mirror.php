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
class WideImage_Operation_Mirror{
	function execute($image){
		$new = $image->copy();
		$width = $image->getWidth();
		$height = $image->getHeight();
		if ($new->isTransparent())
			imagefilledrectangle($new->getHandle(), 0, 0, $width, $height, $new->getTransparentColor());
		for ($x = 0; $x < $width; $x++)	{
			if (!imagecopy($new->getHandle(), $image->getHandle(), $x, 0, $width - $x - 1, 0, 1, $height)) 
				throw new WideImage_GDFunctionResultException("imagecopy() returned false");
		}
		return $new;
	}
}
?>