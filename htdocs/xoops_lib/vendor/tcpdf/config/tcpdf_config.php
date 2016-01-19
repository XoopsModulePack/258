<?php
if (!defined('XOOPS_ROOT_PATH')) die('XOOPS root path not defined');
// IMPORTANT:
// If you define the constant K_TCPDF_EXTERNAL_CONFIG, all the following settings will be ignored.
// If you use the tcpdf_autoconfig.php, then you can overwrite some values here.
//define ('K_PATH_MAIN', '');
//define ('K_PATH_URL', '');
//define ('K_PATH_FONTS', K_PATH_MAIN.'fonts/');
//define ('K_PATH_IMAGES', '');
//define ('PDF_HEADER_LOGO', '');
//define ('PDF_HEADER_LOGO_WIDTH', 0);
//define ('K_PATH_CACHE', '/tmp/');
define ('K_BLANK_IMAGE', '_blank.png');
//define ('PDF_PAGE_FORMAT', 'A4');
//define ('PDF_PAGE_ORIENTATION', 'P'); // Page orientation (P=portrait, L=landscape).
define ('PDF_CREATOR', 'TCPDF_for_Xoops - Version 2.00');
if(isset($pdf_data['author'])){
    define ('PDF_AUTHOR', $pdf_data['author']);
}else{
    define ('PDF_AUTHOR', htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES));
}

define ('PDF_HEADER_TITLE', 'Article of'. htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES));
define ('PDF_HEADER_STRING', "by montuy337513, philodenelle\nwww.chg-web.org");
define ('PDF_UNIT', 'mm'); //[pt=point, mm=millimeter, cm=centimeter, in=inch]
define ('PDF_MARGIN_HEADER', 5);
define ('PDF_MARGIN_FOOTER', 10);
define ('PDF_MARGIN_TOP', 27);
define ('PDF_MARGIN_BOTTOM', 25);
define ('PDF_MARGIN_LEFT', 15);
define ('PDF_MARGIN_RIGHT', 15);
define ('PDF_FONT_NAME_MAIN', 'helvetica');
define ('PDF_FONT_SIZE_MAIN', 10);
define ('PDF_FONT_NAME_DATA', 'helvetica');
define ('PDF_FONT_SIZE_DATA', 8);
define ('PDF_FONT_MONOSPACED', 'courier');
define ('PDF_IMAGE_SCALE_RATIO', 1.25);
define('HEAD_MAGNIFICATION', 1.1);
define('K_CELL_HEIGHT_RATIO', 1.25);
define('K_TITLE_MAGNIFICATION', 1.3);
define('K_SMALL_RATIO', 2/3);
//Set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language.
define('K_THAI_TOPCHARS', false);
/**
 * If true allows to call TCPDF methods using HTML syntax
 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
 */
define('K_TCPDF_CALLS_IN_HTML', true);
/**
 * If true and PHP version is greater than 5, then the Error() method throw new exception instead of terminating the execution.
 */
define('K_TCPDF_THROW_EXCEPTION_ERROR', false);