<?php
/**
 * Plugin Name:       Adminstration menus
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            aarti
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 * 
 */

defined('ABSPATH')||exit;
add_action('admin_menu','plugin_menu');
function plugin_menu(){
    add_menu_page('Movie','Movie','manage_options','User-options','Userprocess',$icon_url ='dashicons-menu',65);
    add_submenu_page('User-options','Dashboard','Dashboard','manage_options','settings','add_new_funct');
    add_submenu_page('User-options','settings','settings','manage_options','settings','setting_func');
}
function Userprocess(){
   //
}

function add_new_funct(){
   //
}
function setting_func(){
    //
}