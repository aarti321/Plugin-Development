<?php

/*
Plugin Name: 1WD Slider
Plugin URI: http://plugindev.com/
Description: Slider Component for WordPress
Version: 1.0
Author: Aarti Bhattarai
Author URI: http://plugindev.com/
License: GPLv2 or later
*/

class SliderPlugin{
  public function __construct(){
   
    register_activation_hook(__FILE__, array($this,'fwds_slider_activation'));
    register_deactivation_hook(__FILE__,  array($this,'fwds_slider_deactivation'));
    add_action('init',  array($this,'fwds_register_slider'));
    add_shortcode("1wd_slider",  array($this,"fwds_display_slider"));
    add_action('wp_enqueue_scripts',  array($this,'fwds_scripts'));
    add_action('wp_enqueue_scripts', array($this,'fwds_styles'));
   
    add_action('add_meta_boxes',array($this, 'fwds_slider_meta_box'));
    add_action('save_post', array($this, 'fwds_save_slider_info'));
    add_action('admin_menu', array($this,'fwds_plugin_settings'));
    

  }
 
    
  
  
  function fwds_slider_activation() {
    //
  }
 
  
  
  function fwds_slider_deactivation() {
    //
  }
 
  
  
  
  
  
  function fwds_scripts() {
    wp_enqueue_script('jquery');
    wp_register_script('slidesjs_core', plugins_url('js/jquery.slides.min.js', __FILE__), array("jquery"));//register script file in wp
    wp_enqueue_script('slidesjs_core');
  
  
  
    $effect      = (get_option('fwds_effect') == '') ? "slide" : get_option('fwds_effect');
    $interval    = (get_option('fwds_interval') == '') ? 2000 : get_option('fwds_interval');
    $autoplay    = (get_option('fwds_autoplay') == 'enabled') ? true : false;
    $playBtn    = (get_option('fwds_playbtn') == 'enabled') ? true : false;
    $config_array = array(
            'effect' => $effect,
            'interval' => $interval,
            'autoplay' => $autoplay,
            'playBtn' => $playBtn
        );
  
    wp_localize_script('slidesjs_init', 'setting', $config_array);
    //(key for js,variable name acess js,array to fun)
  
  }
  
  
  
  function fwds_styles() {
  
    wp_register_style('slidesjs_example', plugins_url('css/example.css', __FILE__));
    wp_enqueue_style('slidesjs_example');
    
  
  }
  
 
  
  function fwds_display_slider($attr, $content) {
  
      extract(shortcode_atts(array(
                  'id' => ''
                      ), $attr));
  
      $gallery_images = get_post_meta($id, "_fwds_gallery_images", true);
      $gallery_images = ($gallery_images != '') ? json_decode($gallery_images) : array();
  
  
  
      $plugins_url = plugins_url();
  
  
      $html = '<div class="container">
      <div id="slides">';
  
      foreach ($gallery_images as $gal_img) {
          if ($gal_img != "") {
              $html .= "<img src='" . $gal_img . "' />";
          }
      }
  
      $html .= '<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
        <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
      </div>
    </div>';
  
      return $html;
  }
  
  //CPT
  
  
  function fwds_register_slider() {
  
      $labels = array(
  
         'menu_name' => _x('Sliders', 'slidesjs_slider'),//(nameof Cpt,unique name)
  
      );
  
      $args = array(
  
         'labels' => $labels,
  
         'hierarchical' => true,
  
         'description' => 'Slideshows',
  
         'supports' => array('title', 'editor'),
  
         'public' => true,
  
         'show_ui' => true,
  
         'show_in_menu' => true,
  
         'show_in_nav_menus' => true,
  
         'publicly_queryable' => true,
  
         'exclude_from_search' => false,
  
         'has_archive' => true,
  
         'query_var' => true,
  
         'can_export' => true,
  
         'rewrite' => true,
  
         'capability_type' => 'post'
  
      );
  
      register_post_type('slidesjs_slider', $args);
      error_log('hello');
  
  }
  
  
 
  
  function fwds_slider_meta_box() {
  
      add_meta_box("fwds-slider-images", __('Slider Images','plugindev'), array($this,'fwds_view_slider_images_box'), "slidesjs_slider", "normal");
      //(id,title,fun,uniqueposttype,screen)
  }
  
  function fwds_view_slider_images_box() {
      global $post;
  
      $gallery_images = get_post_meta($post->ID, "_fwds_gallery_images", true);
      // print_r($gallery_images);exit;
      $gallery_images = ($gallery_images != '') ? json_decode($gallery_images) : array();
  
     
  
      // Use nonce for verification
      $html = '<input type="hidden" name="fwds_slider_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';
  
      $html .= '<table class="form-table">';
  
      $html .= "
            <tr>
              <th style=''><label for='Upload Images'>"._e('Image 1','plugindev')."</label></th>
              <td><input name='gallery_img[]' id='".esc_attr('fwds_slider_upload')."' type='text' value='" .esc_html( $gallery_images[0]) . "'  /></td>
            </tr>
            <tr>
              <th style=''><label for='Upload Images'>"._e('Image 2','plugindev')."</label></th>
              <td><input name='gallery_img[]' id='".esc_attr('fwds_slider_upload')."' type='text' value='" .esc_html( $gallery_images[1]). "' /></td>
            </tr>
            <tr>
              <th style=''><label for='Upload Images'>"._e('Image 3','plugindev')."</label></th>
              <td><input name='gallery_img[]' id='".esc_attr('fwds_slider_upload')." type='text'  value='" .esc_html( $gallery_images[2]) . "' /></td>
            </tr>
            <tr>
              <th style=''><label for='Upload Images'>"._e('Image 4','plugindev')."</label></th>
              <td><input name='gallery_img[]' id='".esc_attr('fwds_slider_upload')."' type='text' value='" .esc_html( $gallery_images[3]) . "' /></td>
            </tr>
            <tr>
              <th style=''><label for='Upload Images'>"._e('Image 5','plugindev')."</label></th>
              <td><input name='gallery_img[]' id='".esc_attr('fwds_slider_upload')."' type='text' value='" .esc_html( $gallery_images[4]) . "' /></td>
            </tr>          
  
          </table>";
  
      echo $html;
  }
  
  /* Save Slider Options to database */
 
  
  function fwds_save_slider_info($post_id) {
     
  
  
      // verify nonce
      if (!wp_verify_nonce($_POST['fwds_slider_box_nonce'], basename(__FILE__))) {
          return $post_id;
      }
  
      // check autosave
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return $post_id;
      }
  
      // check permissions
      if ('slidesjs_slider' == sanitize_text_field($_POST['post_type']) && current_user_can('edit_post', $post_id)) {
  
          /* Save Slider Images */
          //echo "<pre>";print_r($_POST['gallery_img']);exit;
          $gallery_images = (isset($_POST['gallery_img']) ?  $_POST['gallery_img'] : '');
          $gallery_images = strip_tags(json_encode($gallery_images));
          update_post_meta($post_id, "_fwds_gallery_images", $gallery_images);
  
         
      } else {
          return $post_id;
      }
  }
  
 
  function fwds_plugin_settings() {
      //creecho ate new top-level menu
      add_menu_page('1stWD Slider Settings', '1stWD Slider Settings', 'administrator', 'fwds_settings', array($this,'fwds_display_settings'));
  }
  
  function fwds_display_settings() {
  
      $slide_effect = (get_option('fwds_effect') == 'slide') ? 'selected' : '';
      $fade_effect = (get_option('fwds_effect') == 'fade') ? 'selected' : '';
      $interval = (get_option('fwds_interval') != '') ? get_option('fwds_interval') : '2000';
      $autoplay  = (get_option('fwds_autoplay') == 'enabled') ? 'checked' : '' ;
      $playBtn  = (get_option('fwds_playBtn') == 'enabled') ? 'checked' : '' ;
  
      $html = '<div class="wrap">
  
              <form method="post" name="options" action="options.php">
  
              <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
              <table width="100%" cellpadding="10" class="form-table">
                  <tr>
                      <td align="left" scope="row">
                      <label>'._e('Slider Effect','plugindev').'</label><select name="fwds_effect" >
                        <option value="slide" ' .esc_html( $slide_effect ). '>Slide</option>
                        <option value="fade" '.esc_html($fade_effect).'>Fade</option>
                      </select>
              
  
                      </td> 
                  </tr>
                  <tr>
                      <td align="left" scope="row">
                      <label>'._e('Enable Auto Play','plugindev').'</label><input type="checkbox" '.esc_html($autoplay).' name="fwds_autoplay" 
                      value="enabled" />
  
                      </td> 
                  </tr>
                  <tr>
                      <td align="left" scope="row">
                      <label>'._e('Enable Play Button','plugindev').'</label><input type="checkbox" '.esc_html($playBtn).' name="fwds_playBtn" 
                      value="enabled" />
  
                      </td> 
                  </tr>
                  <tr>
                      <td align="left" scope="row">
                      <label>'._e('Transition Interval','plugindev').'</label><input type="text" name="fwds_interval" 
                      value="' .esc_html($interval) . '" />
  
                      </td> 
                  </tr>
              </table>
              <p class="submit">
                  <input type="hidden" name="action" value="update" />  
                  <input type="hidden" name="page_options" value="fwds_autoplay,fwds_effect,fwds_interval,fwds_playBtn" /> 
                  <input type="submit" name="Submit" value="Update" />
              </p>
              </form>
  
          </div>';
      echo $html;
  }

}
new SLiderPlugin();



?>