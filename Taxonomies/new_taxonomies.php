<?php
/**
 * Plugin Name:       Taxonomies
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


add_action('init','add_fruits_taxonomy_to_post');
add_action('init', 'new_terms');

function new_terms() {
    $taxonomy = 'Fruits';
    $terms = array (
        '0' => array (
            'name'          => 'Apple',
            'slug'          => 'apple',
            'description'   => 'Hello ,this is testing term one ',
        ),
        '1' => array (
            'name'          => 'Banana',
            'slug'          => 'banana',
            'description'   => 'Hello ,this is testing term two',
        ),
        '2' => array (
            'name'          => 'Orange',
            'slug'          => 'orange',
            'description'   => 'Hello ,this is testing term three',
        ),
    );  
    foreach ( $terms as $term_key=>$term) {
            wp_insert_term(
                $term['name'],
                $taxonomy, 
                array(
                    'description'   => $term['description'],
                    'slug'          => $term['slug'],
                )
            );
        unset( $term ); 
    }
}
 

function add_fruits_taxonomy_to_post(){

    //set the name of the taxonomy
    $taxonomy = 'Fruits';
    //set the post types for the taxonomy
    $object_type = 'post';
    
    //populate our array of names for our taxonomy
    $labels = array(
        'name'               => 'Fruits',
        'singular_name'      => 'Fruit',
        'search_items'       => 'Search Fruits',
        'all_items'          => 'All Fruits',
        'parent_item'        => 'Parent Fruits',
        'parent_item_colon'  => 'Parent Fruits:',
        'update_item'        => 'Update Fruits',
        'edit_item'          => 'Edit Fruits',
        'add_new_item'       => 'Add New Fruits', 
        'new_item_name'      => 'New Member Fruits',
        'menu_name'          => 'Fruits'
    );
    
    //define arguments to be used 
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'Fruits')
    );
    
    //call the register_taxonomy function
    register_taxonomy($taxonomy, $object_type, $args); 
}

