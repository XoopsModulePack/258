<?php
// $Id: xoops_version.php,v 1.7 2005/04/23 10:07:12 gij Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

$modversion['name'] = _MI_WAITING_NAME;
$modversion['version'] = 0.97;
$modversion['description'] = _MI_WAITING_DESC;
$modversion['author'] = "Ryuji (http://ryus.co.jp/)";
$modversion['author_website_url'] = "http://ryus.co.jp";
$modversion['credits'] = "Ryus";
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html";
$modversion['official'] = 0;
$modversion['image'] = "images/waiting_slogo.png";
$modversion['dirname'] = "waiting";

$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['icons32'] = '../../Frameworks/moduleclasses/icons/32';

//about
$modversion['release_date']     = '2013/04/25';
$modversion["module_website_url"] = "www.xoops.org/";
$modversion["module_website_name"] = "XOOPS";
$modversion["module_status"] = "Beta 1";
$modversion['min_php']='5.2';
$modversion['min_xoops']="2.5.6";
$modversion['min_admin']='1.1';
$modversion['min_db']= array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['system_menu'] = 1;
$modversion['adminmenu'] = "admin/menu.php";
$modversion['adminindex'] = "admin/index.php";

// Templates

// Blocks
$modversion['blocks'][1]['file'] = "waiting_waiting.php";
$modversion['blocks'][1]['name'] = _MI_WAITING_BNAME1;
$modversion['blocks'][1]['description'] = "Shows contents waiting for approval";
$modversion['blocks'][1]['show_func'] = "b_waiting_waiting_show";
$modversion['blocks'][1]['edit_func'] = "b_waiting_waiting_edit";
$modversion['blocks'][1]['template'] = 'waiting_block_waiting.html';
$modversion['blocks'][1]['options'] = '1|5';

// On Update
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
    include dirname( __FILE__ ) . "/include/updateblock.inc.php" ;
}
