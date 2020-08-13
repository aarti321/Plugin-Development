<?php
/**
 * Plugin Name:       basic OOP
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



 defined ('ABSPATH') or die ('Hey ,you cant access this file,');

 class PracticePlugin 
 {   

    function __construct() {
        add_action( 'init',array ($this , 'custom_post_type'));
    }
     

    function register(){
        add_action('admin_enqueue_scripts',array($this,'enqueue'));
    }
    

    function custom_post_type(){
        register_post_type('book' , ['public' => true,'label'=> 'Books'] );
    }
     //wp_enqueue_style( string $handle, string $src = '', string[] $deps = array(), string|bool|null $ver = false, string $media = 'all' )
    function enqueue() {
        wp_enqueue_style ('mypluginstyle',plugins_url('/assests/style.css',__FILE__));
        wp_enqueue_script ('mypluginscript',plugins_url('/assests/myscript.s',__FILE__));
    }
 }

 if ( class_exists( 'PracticePlugin') ){
     $practicePlugin = new PracticePlugin ();
     $practicePlugin->register();
 }


//activate

require_once plugin_dir_path(__FILE__). 'inc/pluginactivate.php';
register_activation_hook(__File__, array('PracticePluginActivate' ,'activate'));


//deactivate
require_once plugin_dir_path(__FILE__). 'inc/plugindeactivate.php';
register_deactivation_hook(__File__, array('PracticePluginDeactivate ' ,'deactivate'));


