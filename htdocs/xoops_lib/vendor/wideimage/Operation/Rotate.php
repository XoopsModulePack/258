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
class WideImage_Operation_Rotate{
    function execute($image, $angle, $bgColor, $ignoreTransparent){
        $angle = -floatval($angle);
        if ($angle < 0)
            $angle = 360 + $angle;
        $angle = $angle % 360;
        if ($angle == 0)
            return $image->copy();
        $image = $image->asTrueColor();
        if ($bgColor === NULL){
            $bgColor = $image->getTransparentColor();
            if ($bgColor == -1) {
                $bgColor = $image->allocateColorAlpha(255, 255, 255, 127);
                imagecolortransparent($image->getHandle(), $bgColor);
            }
        }
        return new WideImage_TrueColorImage(imagerotate($image->getHandle(), $angle, $bgColor, $ignoreTransparent));
    }
}
?>