<?php
/**
 * Plugin Name:       meta boxes
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



add_action( 'save_post','Details_save' );
add_action("add_meta_boxes", "add_custom_meta_box");

add_action( 'comment_form_before', 'frontend_template');
function frontend_template(){
  $var = get_post_meta( get_the_ID(), 'boxes_info');
  $textbox = isset($var['0']['my_textbox'])? $var['0']['my_textbox']:'';
  $select = isset($var['0']['select'])? $var['0']['select']:'';
  $textarea = isset($var['0']['textarea'])? $var['0']['textarea']:'';
  echo '<table>';
  echo '<tr>';
  echo '<td>Textbox</td>';
  echo '<td>'.$textbox.'</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>TextArea</td>';
  echo '<td>'.$textarea.'</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>Select</td>';
  echo '<td>'.$select.'</td>';
  echo '</tr>';
  echo '</table>';
} 

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", " Meta Box", "custom_meta_box", "post", "side", "high", null);
}

function custom_meta_box($post)
{
       
    $var = get_post_meta( $post->ID, 'boxes_info');
    
    echo '<label for="my_textbox">Input field <br> </label>';
    echo '<input type="text" id="my_textbox" name="my_textbox" value="'. $var['0']['my_textbox'] .'" placeholder="Text" />';


   echo '<textarea  id="textarea" value="" name="textarea" >'. $var['0']['textarea'] .'</textarea>';

   $options = array(
    'Mercedes' => 'Mercedes',
    'velvo' => 'Velvo',
  );

   printf( '<select id="my_select" name="select">' );
        printf( '<option> -- Select -- </option>' );
        foreach ( $options as $option_value => $option_label ) {
        printf(
            '<option value="%s" %s >%s</option>',
            $option_value,
            $var['0']['select'] === $option_value ? 'selected' : '',
            $option_label
        );
        }
        printf( '</select>' );


        


   
}
function Details_save( $post_id ) {

    $array_details = array(
      'my_textbox'=> $_POST['my_textbox'] ,
      'select'=>$_POST['select'] ,
      'textarea'=> $_POST['textarea'] ,
       
      );

    update_post_meta( $post_id, 'boxes_info', $array_details );
  }


