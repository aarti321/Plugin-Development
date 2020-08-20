<?php
/**
 * Plugin Name:       Shortcodes
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
defined('ABSPATH') or die();

class MetaBox{
    function __construct(){
        add_action( 'init', array($this,'Custom_post_type' ));
    }
    $labels = array(
        'name'               => _x( 'Test', 'post type general name' ),
        'singular_name'      => _x( 'Test', 'post type singular name' ),
        'add_new'            => _x( 'Test', 'Test' ),
        'add_new_item'       => __( 'Add New Test' ),
        'edit_item'          => __( 'Edit Test' ),
        'new_item'           => __( 'New Test' ),
        'all_items'          => __( 'All Test' ),
        'view_item'          => __( 'View Test' ),
        'search_items'       => __( 'Search Test' ),
        'not_found'          => __( 'No Test found' ),
        'not_found_in_trash' => __( 'No Test found in the Trash' ), 
        'menu_name'          => 'test'
      );
      $args = array(
        'labels'        => $labels,
        'description'   => 'Displays the detail about test l',
        'public'        => true,
        'menu_position' => 9,
        'supports'      => array( 'title','author', 'editor', 'thumbnail' ),
        'has_archive'   => true,
      );
      register_post_type( 'test', $args ); 
    }

}
new Metabox;