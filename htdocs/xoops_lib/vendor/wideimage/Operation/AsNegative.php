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
class WideImage_Operation_AsNegative{
	function execute($image){
		$palette = !$image->isTrueColor();
		$transparent = $image->isTransparent();
		if ($palette && $transparent)
			$tcrgb = $image->getTransparentColorRGB();
		$new = $image->asTrueColor();
		if (!imagefilter($new->getHandle(), IMG_FILTER_NEGATE))
			throw new WideImage_GDFunctionResultException("imagefilter() returned false");
		if ($palette){
			$new = $new->asPalette();
			if ($transparent){
				$irgb = array('red' => 255 - $tcrgb['red'], 'green' => 255 - $tcrgb['green'], 'blue' => 255 - $tcrgb['blue'], 'alpha' => 127);
				$new_tci = imagecolorexactalpha($new->getHandle(), $irgb['red'], $irgb['green'], $irgb['blue'], 127);
				$new->setTransparentColor($new_tci);
			}
		}
		return $new;
	}
}
?>