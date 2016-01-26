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
class WideImage_Operation_CopyChannelsPalette{
    function execute($img, $channels){
        $blank = array('red' => 0, 'green' => 0, 'blue' => 0);
        if (isset($channels['alpha']))
            unset($channels['alpha']);
        $width = $img->getWidth();
        $height = $img->getHeight();
        $copy = WideImage_PaletteImage::create($width, $height);
        if ($img->isTransparent()){
            $otci = $img->getTransparentColor();
            $TRGB = $img->getColorRGB($otci);
            $tci = $copy->allocateColor($TRGB);
        }else{
            $otci = NULL;
            $tci = NULL;
        }
        for ($x = 0; $x < $width; $x++)
            for ($y = 0; $y < $height; $y++){
                $ci = $img->getColorAt($x, $y);
                if ($ci === $otci){
                    $copy->setColorAt($x, $y, $tci);
                    continue;
                }
                $RGB = $img->getColorRGB($ci);
                $newRGB = $blank;
                foreach ($channels as $channel)
                    $newRGB[$channel] = $RGB[$channel];
                $color = $copy->getExactColor($newRGB);
                if ($color == -1)
                    $color = $copy->allocateColor($newRGB);
                $copy->setColorAt($x, $y, $color);
            }
        if ($img->isTransparent())
            $copy->setTransparentColor($tci);
        return $copy;
    }
}
?>