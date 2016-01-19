<?php
defined('XOOPS_ROOT_PATH') || die('Restricted access');
if(!isset($DirTcpdf)) $DirTcpdf = __DIR__;
if(!is_array($pdf_data)) {
    $pdf_data = array();
    $GLOBALS['xoopsLogger']->addDeprecated('Please use $pdf_data for configuration. See http://www.chg-web.org/ or ./docs/pdf_data.txt');
}
// DOCUMENT_ROOT fix for IIS Webserver
if ((!isset($_SERVER['DOCUMENT_ROOT'])) OR (empty($_SERVER['DOCUMENT_ROOT']))) {
	if(isset($_SERVER['SCRIPT_FILENAME'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
	} elseif(isset($_SERVER['PATH_TRANSLATED'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
	} else {
		// define here your DOCUMENT_ROOT path if the previous fails (e.g. '/var/www')
		$_SERVER['DOCUMENT_ROOT'] = '/';
	}
}
$_SERVER['DOCUMENT_ROOT'] = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT']);
if (substr($_SERVER['DOCUMENT_ROOT'], -1) != '/') $_SERVER['DOCUMENT_ROOT'] .= '/';
$tcpdf_config_files = $DirTcpdf.'/config/tcpdf_config.php';
if(is_file($tcpdf_config_files) && is_readable($tcpdf_config_files)) {
    require_once($tcpdf_config_files);
    $GLOBALS['xoopsLogger']->addDeprecated('Please use $pdf_data for configuration. See http://www.chg-web.org/ or ./docs/pdf_data.txt');
}
if (!defined('K_PATH_MAIN')) define ('K_PATH_MAIN', $DirTcpdf.'/');
if (!defined('K_PATH_FONTS')) define ('K_PATH_FONTS', K_PATH_MAIN.'fonts/');
if (!defined('K_PATH_URL')) {
    $DiTemp = dirname(__DIR__);
    $temp_url = '%s/'.$DiTemp.'/'.$DirTcpdf.'/';
    if (defined('XOOPS_PROT') && defined('XOOPS_URL')){
        define ('K_PATH_URL', sprintf($temp_url,XOOPS_URL));
    }else{
        die('XOOPS URL not defined');
    }
    unset($temp_url,$DiTemp);
}
if (!defined('K_PATH_IMAGES')) {
    if(array_key_exists('path_images',$pdf_data) && is_dir($pdf_data['path_images'])){
        define('K_PATH_IMAGES',$pdf_data['path_images'].'/');
    }else{
        define('K_PATH_IMAGES',K_PATH_MAIN.'images/');
    }
    if(is_dir(K_PATH_IMAGES)){
        if(array_key_exists('header_logo',$pdf_data) && is_file(K_PATH_IMAGES.$pdf_data['header_logo'])){
            define('PDF_HEADER_LOGO',$pdf_data['header_logo']);
        }elseif(is_file(K_PATH_IMAGES.'/logo.png')){
            define('PDF_HEADER_LOGO','logo.png');
        }else{
            if(is_file(K_PATH_IMAGES.'_blank.png')){
                define('PDF_HEADER_LOGO','_blank.png');
            }else{
                $GLOBALS['xoopsLogger']->handleError(E_USER_ERROR,'File logo not exist in image directory',__FILE__, __LINE__);
            }
        }
    }else{
        $GLOBALS['xoopsLogger']->handleError(E_USER_ERROR,'Image directory not exist',__FILE__, __LINE__);
    }
}else{
    if(array_key_exists('header_logo',$pdf_data) && is_file(K_PATH_IMAGES.$pdf_data['header_logo'])){
        define('PDF_HEADER_LOGO',$pdf_data['header_logo']);
    }elseif(is_file(K_PATH_IMAGES.'/logo.png')){
        define('PDF_HEADER_LOGO','logo.png');
    }else{
        if(is_file(K_PATH_IMAGES.'_blank.png')){
            define('PDF_HEADER_LOGO','_blank.png');
        }else{
            $GLOBALS['xoopsLogger']->handleError(E_USER_ERROR,'File logo not exist in image directory',__FILE__, __LINE__);
        }
    }
}
if (!defined('PDF_HEADER_LOGO_WIDTH')) {
	if (PDF_HEADER_LOGO != '_blank.png') {
        if(array_key_exists('header_logo_width',$pdf_data)){
            define('PDF_HEADER_LOGO_WIDTH', $pdf_data['header_logo_width']);
        }else{
		    define ('PDF_HEADER_LOGO_WIDTH', 30);
        }
	} else {
		define ('PDF_HEADER_LOGO_WIDTH', 0);
	}
}
if (!defined('K_PATH_CACHE')) {
    if(array_key_exists('path_cache',$pdf_data) && is_dir($pdf_data['path_cache'])){
        define('K_PATH_CACHE',$pdf_data['path_cache']);
    }else{
	    $K_PATH_CACHE = ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir();
	    if (substr($K_PATH_CACHE, -1) != '/') $K_PATH_CACHE .= '/';
	    define ('K_PATH_CACHE', $K_PATH_CACHE);
    }
}
if (!defined('K_BLANK_IMAGE')) define ('K_BLANK_IMAGE', '_blank.png');
if (!defined('PDF_PAGE_FORMAT')) {
    if(array_key_exists('page_format',$pdf_data)){
        define('PDF_PAGE_FORMAT',$pdf_data['page_format']);
    }else{
	    define ('PDF_PAGE_FORMAT', 'A4');
    }
}
if (!defined('PDF_PAGE_ORIENTATION')) {
    if(array_key_exists('page_orientation',$pdf_data)){
        define ('PDF_PAGE_ORIENTATION', $pdf_data['page_orientation']);
    }else{
	    define ('PDF_PAGE_ORIENTATION', 'P');
    }
}
if (!defined('PDF_CREATOR')) define ('PDF_CREATOR', 'TCPDF_for_Xoops');
if (!defined('PDF_AUTHOR')) {
    if(array_key_exists('author',$pdf_data)){
        define ('PDF_AUTHOR', $pdf_data['author']);
    }else{
        define ('PDF_AUTHOR', htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES));
    }
}
if (!defined('PDF_HEADER_TITLE')) {
    if(array_key_exists('title',$pdf_data)){
        define ('PDF_HEADER_TITLE', $pdf_data['title']);
    }else{
        define ('PDF_HEADER_TITLE', 'Article of '. htmlspecialchars($GLOBALS['xoopsConfig']['sitename'], ENT_QUOTES));
    }
}
if (!defined('PDF_HEADER_STRING')) {
    if(array_key_exists('header_string',$pdf_data)){
        define ('PDF_HEADER_STRING', $pdf_data['header_string']);
    }else{
        define ('PDF_HEADER_STRING', "by montuy337513, philodenelle\nwww.chg-web.org");
    }
}
if (!defined('PDF_UNIT')) {
    if(array_key_exists('unit',$pdf_data)){
        define ('PDF_UNIT', $pdf_data['unit']);
    }else{
        define ('PDF_UNIT', 'mm');
    }
}
if (!defined('PDF_MARGIN_HEADER')) {
    if(array_key_exists('margin_header',$pdf_data)){
        define ('PDF_MARGIN_HEADER', $pdf_data['margin_header']);
    }else{
        define ('PDF_MARGIN_HEADER', 5);
    }
}

if (!defined('PDF_MARGIN_FOOTER')) {
    if(array_key_exists('margin_footer',$pdf_data)){
        define ('PDF_MARGIN_FOOTER', $pdf_data['margin_footer']);
    }else{
        define ('PDF_MARGIN_FOOTER', 10);
    }
}
if (!defined('PDF_MARGIN_TOP')) {
    if(array_key_exists('margin_top',$pdf_data)){
        define ('PDF_MARGIN_TOP', $pdf_data['margin_top']);
    }else{
        define ('PDF_MARGIN_TOP', 27);
    }
}
if (!defined('PDF_MARGIN_BOTTOM')) {
    if(array_key_exists('margin_bottom',$pdf_data)){
        define ('PDF_MARGIN_BOTTOM', $pdf_data['margin_bottom']);
    }else{
        define ('PDF_MARGIN_BOTTOM', 25);
    }
}
if (!defined('PDF_MARGIN_LEFT')) {
    if(array_key_exists('margin_left',$pdf_data)){
        define ('PDF_MARGIN_LEFT', $pdf_data['margin_left']);
    }else{
        define ('PDF_MARGIN_LEFT', 15);
    }
}
if (!defined('PDF_MARGIN_RIGHT')) {
    if(array_key_exists('margin_right',$pdf_data)){
        define ('PDF_MARGIN_RIGHT', $pdf_data['margin_right']);
    }else{
        define ('PDF_MARGIN_RIGHT', 15);
    }
}
if (!defined('PDF_FONT_NAME_MAIN')) {
    if(array_key_exists('font_name_main',$pdf_data)){
        define ('PDF_FONT_NAME_MAIN', $pdf_data['font_name_main']);
    }else{
        define ('PDF_FONT_NAME_MAIN', 'helvetica');
    }
}

if (!defined('PDF_FONT_SIZE_MAIN')) {
    if(array_key_exists('font_size_main',$pdf_data)){
        define ('PDF_FONT_SIZE_MAIN', $pdf_data['font_size_main']);
    }else{
        define ('PDF_FONT_SIZE_MAIN', 10);
    }
}
if (!defined('PDF_FONT_NAME_DATA')) {
    if(array_key_exists('font_name_data',$pdf_data)){
        define ('PDF_FONT_NAME_DATA', $pdf_data['font_name_data']);
    }else{
        define ('PDF_FONT_NAME_DATA', 'helvetica');
    }
}
if (!defined('PDF_FONT_SIZE_DATA')) {
    if(array_key_exists('font_size_data',$pdf_data)){
        define ('PDF_FONT_SIZE_DATA', $pdf_data['font_size_data']);
    }else{
        define ('PDF_FONT_SIZE_DATA', 8);
    }
}
if (!defined('PDF_FONT_MONOSPACED')) {
    if(array_key_exists('font_spaced',$pdf_data)){
        define ('PDF_FONT_MONOSPACED', $pdf_data['font_monospaced']);
    }else{
        define ('PDF_FONT_MONOSPACED', 'courier');
    }
}
if (!defined('PDF_IMAGE_SCALE_RATIO')) {
   if(array_key_exists('image_scale_ratio',$pdf_data)){
        define ('PDF_IMAGE_SCALE_RATIO', $pdf_data['image_scale_ratio']);
   }else{
        define ('PDF_IMAGE_SCALE_RATIO', 1.25);
   }
}
if (!defined('HEAD_MAGNIFICATION')) {
    if(array_key_exists('head_magnification',$pdf_data)){
        define ('HEAD_MAGNIFICATION', $pdf_data['head_magnification']);
    }else{
        define ('HEAD_MAGNIFICATION', 1.1);
    }
}
if (!defined('K_CELL_HEIGHT_RATIO')) {
    if(array_key_exists('k_cell_height_ratio',$pdf_data)){
        define ('K_CELL_HEIGHT_RATIO', $pdf_data['k_cell_height_ratio']);
    }else{
        define ('K_CELL_HEIGHT_RATIO', 1.25);
    }
}
if (!defined('K_TITLE_MAGNIFICATION')) {
    if(array_key_exists('k_title_magnification',$pdf_data)){
        define ('K_TITLE_MAGNIFICATION', $pdf_data['k_title_magnification']);
    }else{
        define ('K_TITLE_MAGNIFICATION', 1.3);
    }
}
if (!defined('K_SMALL_RATIO')) {
    if(array_key_exists('k_small_ratio',$pdf_data)){
        define ('K_SMALL_RATIO', $pdf_data['k_small_ratio']);
    }else{
        define ('K_SMALL_RATIO', 2/3);
    }
}
if (!defined('K_THAI_TOPCHARS')) {
    if(array_key_exists('k_thai_topchars',$pdf_data)){
        define ('K_THAI_TOPCHARS', $pdf_data['k_thai_topchars']);
    }else{
        define ('K_THAI_TOPCHARS', false);
    }
}
if (!defined('K_TCPDF_CALLS_IN_HTML')) {
    if(array_key_exists('k_tcpdf_calls_in_html',$pdf_data)){
        define ('K_TCPDF_CALLS_IN_HTML', $pdf_data['k_tcpdf_calls_in_html']);
    }else{
        define ('K_TCPDF_CALLS_IN_HTML', false);
    }
}
if (!defined('K_TCPDF_THROW_EXCEPTION_ERROR')) {
    if(array_key_exists('k_tcpdf_throw_exception_error',$pdf_data)){
        define ('K_TCPDF_THROW_EXCEPTION_ERROR', $pdf_data['k_tcpdf_throw_exception_error']);
    }else{
        define ('K_TCPDF_THROW_EXCEPTION_ERROR', false);
    }
}
// For compatibility with older versions of "makefile.php" - DEPRECATED
if (!defined('PDF_FONT_NAME_SUB')) {
    if(array_key_exists('font_name_main',$pdf_data)){
        define ('PDF_FONT_NAME_SUB', $pdf_data['font_name_main']);
    }else{
        define ('PDF_FONT_NAME_SUB', 'helvetica');
    }
}

if (!defined('PDF_FONT_SIZE_SUB')) {
    if(array_key_exists('font_size_main',$pdf_data)){
        define ('PDF_FONT_SIZE_SUB', $pdf_data['font_size_main']);
    }else{
        define ('PDF_FONT_SIZE_SUB', 10);
    }
}
if (!defined('K_TIMEZONE')) {
    if(array_key_exists('date_default_timezone_get',$pdf_data)){
        define ('K_TIMEZONE', $pdf_data['date_default_timezone_get']);
    }else{
        define('K_TIMEZONE', @date_default_timezone_get());
    }
	
}

