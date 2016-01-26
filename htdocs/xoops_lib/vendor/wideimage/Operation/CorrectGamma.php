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
class WideImage_Operation_CorrectGamma{
    function execute($image, $input_gamma, $output_gamma){
        $new = $image->copy();
        if (!imagegammacorrect($new->getHandle(), $input_gamma, $output_gamma))
            throw new WideImage_GDFunctionResultException("imagegammacorrect() returned false");
        return $new;
    }
}
?>