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
     function activate(){
        $this->custom_post_type();
        flush_rewrite_rules();
     }
    function deactivate(){
        echo 'The plugin was deactivated';

    }
    function uninstall(){

    }

    function custom_post_type(){
        register_post_type('book' , ['public' => true,'label'=> 'Books'] );
    }
 }

 if ( class_exists( 'PracticePlugin') ){
     $practicePlugin = new PracticePlugin ();
 }


//activate
register_activation_hook(__File__, array($practicePlugin ,'activate'));


//deactivate
register_deactivation_hook(__File__, array($practicePlugin ,'deactivate'));

