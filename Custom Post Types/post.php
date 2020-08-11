<?php
/**
 * Plugin Name:       Custom POst Type
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
add_action( 'init', 'Custom_post_type' );
function Custom_post_type() {
    $labels = array(
      'name'               => _x( 'Movies', 'post type general name' ),
      'singular_name'      => _x( 'Movies', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'movie' ),
      'add_new_item'       => __( 'Add New movie' ),
      'edit_item'          => __( 'Edit movie' ),
      'new_item'           => __( 'New movie' ),
      'all_items'          => __( 'All movies' ),
      'view_item'          => __( 'View movie' ),
      'search_items'       => __( 'Search movies' ),
      'not_found'          => __( 'No movies found' ),
      'not_found_in_trash' => __( 'No movies found in the Trash' ), 
      'menu_name'          => 'Movies'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Displays the detail about movies like release date, cast, director',
      'public'        => true,
      'menu_position' => 9,
      'supports'      => array( 'title','author', 'editor', 'thumbnail' ),
      'has_archive'   => true,
    );
    register_post_type( 'movie', $args ); 
  }

  add_action( 'add_meta_boxes', 'movies_box' );
function movies_box() {
    add_meta_box( 
        'movies_box',//id
         'movies',//title
        'movie_box_content',//callback
        'movie', //same as in register_post_type id
        'normal',//context
        'high'//priority
    );
}
function movie_box_content( $post ) {

    echo '<label for="movies"></label>';
    echo '<input type="date" id="movie" name="movie_name" placeholder="Movie Released Date" />';
    echo '<label for="movies"></label>';
    echo '<input type="text" id="movie" name="movie_name" placeholder="Writer" />';
    echo '<label for="movie"></label>';
    echo '<input type="text" id="movie" name="movie_name" placeholder="cast" />';
  }