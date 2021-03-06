<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Contact module
 *
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      Kazumi Ono (aka Onokazu)
 * @author      Trabis <lusopoemas@gmail.com>
 * @author      Hossein Azizabadi (AKA Voltan)
 * @version     $Id: header.php 12159 2013-10-07 19:11:27Z beckmi $
 */

include '../../mainfile.php';
include XOOPS_ROOT_PATH."/modules/contact/class/contact.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

$contact_handler = & xoops_getModuleHandler('contact', 'contact');
