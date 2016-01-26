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
class WideImage_Font_GDF{
    protected $font;
    protected $color;
    function __construct($face, $color) {
        if (is_int($face) && $face >= 1 && $face <= 5)
            $this->font = $face;
        else
            $this->font = imageloadfont($face);
        $this->color = $color;
    }
    function writeText($image, $x, $y, $text){
        imagestring($image->getHandle(), $this->font, $x, $y, $text, $this->color);
    }
}
?>