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

class PostType{
  function __construct(){
    add_action( 'init', array($this,'Custom_post_type' ));
    add_action( 'add_meta_boxes',array($this, 'movies_box' ));
    add_action( 'save_post', array($this,'Details_save' ));

  }

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
  function movies_box() {
    add_meta_box( 
        'movies_box',//id
         'movies',//title
       array($this,'movie_box_content') ,//callback
        'movie', //same as in register_post_type id
        'normal',//context
        'high'//priority
    );
  
  
  }

  function movie_box_content($post ) {

    $var = get_post_meta( $post->ID, 'Movie_info');
  
    echo '<label for="movies"></label>';
    echo '<input type="date" id="movie" name="movie_date" value="'. $var['0']['movie_date'] .'" placeholder="Movie Released Date" />';
    echo '<label for="movies"></label>';
    echo '<input type="text" id="movie" name="movie_writer" value="'. $var['0']['movie_writer'] .'"  placeholder="Writer" />';
    echo '<label for="movie"></label>';
    echo '<input type="text" id="movie" name="movie_cast"value="'. $var['0']['movie_cast'] .'"placeholder="cast" />';

  
  }
    
function Details_save( $post_id ) {

  $array_details = array(
    'movie_date'=> $_POST['movie_date'] ,
    'movie_writer'=>$_POST['movie_writer'] ,
    'movie_cast'=> $_POST['movie_cast'] ,
     
    );
  
  update_post_meta( $post_id, 'Movie_info', $array_details );
}
}
new PostType();//object initialization

  



