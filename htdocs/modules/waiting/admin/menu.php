<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Mamba
 * Date: 1/25/12
 * Time: 7:04 AM
 * To change this template use File | Settings | File Templates.
 */

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$dirname = basename(dirname(dirname(__FILE__)));
$module_handler = xoops_gethandler('module');
$module = $module_handler->getByDirname($dirname);
$pathIcon32 = $module->getInfo('icons32');

//xoops_loadLanguage('admin', $dirname);

$adminmenu = array();

$i = 1;
$adminmenu[$i]["title"] = _MI_WAITING_MENU_HOME;
$adminmenu[$i]["link"] = 'admin/index.php';
$adminmenu[$i]["icon"] = $pathIcon32.'/home.png';

$i++;
$adminmenu[$i]["title"] = _MI_WAITING_MENU_PLUGINS;
$adminmenu[$i]["link"] = 'admin/main.php';
$adminmenu[$i]["icon"] = $pathIcon32.'/search.png';

$i++;
$adminmenu[$i]["title"] = _MI_WAITING_MENU_ABOUT;
$adminmenu[$i]["link"] = 'admin/about.php';
$adminmenu[$i]["icon"] = $pathIcon32.'/about.png';
