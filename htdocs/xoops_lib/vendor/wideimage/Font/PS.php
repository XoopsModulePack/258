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
class WideImage_Font_PS{
    public $size;
    public $color;
    public $handle;
    function __construct($file, $size, $color, $bgcolor = NULL) {
        $this->handle = imagepsloadfont($file);
        $this->size = $size;
        $this->color = $color;
        if ($bgcolor === NULL)
            $this->bgcolor = $color;
        else
            $this->color = $color;
    }
    function writeText($image, $x, $y, $text, $angle = 0){
        if ($image->isTrueColor())
            $image->alphaBlending(true);
        imagepstext($image->getHandle(), $text, $this->handle, $this->size, $this->color, $this->bgcolor, $x, $y, 0, 0, $angle, 4);
    }
    function __destruct(){
        imagepsfreefont($this->handle);
        $this->handle = NULL;
    }
}
?>