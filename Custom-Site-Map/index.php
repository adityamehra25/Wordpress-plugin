<?php
/**
 * Plugin Name: Site Map
 * Plugin URI:
 * Description: Site Map
 * Author: Sandeep
 */

# Exit if accessed directly

if (!defined('ABSPATH')) {
    exit;
}
define( 'MY_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
#Absolute path to the plugin directory.
#eg - /var/www/html/wp-content/plugins/site_map/
if (!defined('site_map.php')) {
    define('site_map.php', plugin_dir_path(__FILE__));
}

#Load everything
if (file_exists(dirname(__FILE__) . '/public/site_map.php')) {
    require_once dirname(__FILE__) . '/public/site_map.php';
}
if (file_exists(dirname(__FILE__) . '/public/inc/function.php')) {
    require_once dirname(__FILE__) . '/public/inc/function.php';
}
?>