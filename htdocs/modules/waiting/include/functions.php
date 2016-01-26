<?php

function waiting_get_plugin_info( $dirname , $language = 'english' )
{
    // get $mytrustdirname for D3 modules
    $mytrustdirname = '' ;
    if( defined( 'XOOPS_TRUST_PATH' ) && file_exists( XOOPS_ROOT_PATH."/modules/".$dirname."/mytrustdirname.php" ) ) {
        @include XOOPS_ROOT_PATH."/modules/".$dirname."/mytrustdirname.php" ;
    }

    $module_plugin_file = XOOPS_ROOT_PATH."/modules/".$dirname."/include/waiting.plugin.php" ;
    $d3module_plugin_file = XOOPS_TRUST_PATH."/modules/".$mytrustdirname."/include/waiting.plugin.php" ;
    $builtin_plugin_file = XOOPS_ROOT_PATH."/modules/waiting/plugins/".$dirname.".php" ;

    if( file_exists( $module_plugin_file ) ) {
        // module side (1st priority)
        $lang_files = array(
            XOOPS_ROOT_PATH."/modules/$dirname/language/$language/waiting.php" ,
            XOOPS_ROOT_PATH."/modules/$dirname/language/english/waiting.php" ,
        ) ;
        $langfile_path = '' ;
        foreach( $lang_files as $lang_file ) {
            if( file_exists( $lang_file ) ) {
                $langfile_path = $lang_file ;
                break ;
            }
        }
        $ret = array(
            'plugin_path' => $module_plugin_file ,
            'langfile_path' => $langfile_path ,
            'func' => 'b_waiting_'.$dirname ,
            'type' => 'module' ,
        ) ;
    } else if( ! empty( $mytrustdirname ) && file_exists( $d3module_plugin_file ) ) {
        // D3 module's plugin under xoops_trust_path (2nd priority)
        $lang_files = array(
            XOOPS_TRUST_PATH."/modules/$mytrustdirname/language/$language/waiting.php" ,
            XOOPS_TRUST_PATH."/modules/$mytrustdirname/language/english/waiting.php" ,
        ) ;
        $langfile_path = '' ;
        foreach( $lang_files as $lang_file ) {
            if( file_exists( $lang_file ) ) {
                $langfile_path = $lang_file ;
                break ;
            }
        }
        $ret = array(
            'plugin_path' => $d3module_plugin_file ,
            'langfile_path' => $langfile_path ,
            'func' => 'b_waiting_'.$mytrustdirname ,
            'type' => 'module (D3)' ,
        ) ;
    } else if( file_exists( $builtin_plugin_file ) ) {
        // built-in plugin under modules/waiting (3rd priority)
        $ret = array(
            'plugin_path' => $builtin_plugin_file ,
            'langfile_path' => '' ,
            'func' => 'b_waiting_'.$dirname ,
            'type' => 'Waiting' ,
        ) ;
    } else {
        $ret = array() ;
    }

    return $ret ;
}
