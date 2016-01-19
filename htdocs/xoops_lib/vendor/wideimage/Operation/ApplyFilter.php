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
class WideImage_Operation_ApplyFilter{
	static protected $one_arg_filters = array(IMG_FILTER_SMOOTH, IMG_FILTER_CONTRAST, IMG_FILTER_BRIGHTNESS);
	function execute($image, $filter, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL){
		$new = $image->asTrueColor();
		if (in_array($filter, self::$one_arg_filters))
			$res = imagefilter($new->getHandle(), $filter, $arg1);
		elseif (defined('IMG_FILTER_PIXELATE') && $filter == IMG_FILTER_PIXELATE)
			$res = imagefilter($new->getHandle(), $filter, $arg1, $arg2);
		elseif ($filter == IMG_FILTER_COLORIZE)
			$res = imagefilter($new->getHandle(), $filter, $arg1, $arg2, $arg3, $arg4);
		else
			$res = imagefilter($new->getHandle(), $filter);
		if (!$res)
			throw new WideImage_GDFunctionResultException("imagefilter() returned false");
		return $new;
	}
}
?>