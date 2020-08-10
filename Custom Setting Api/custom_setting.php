<?php
/**
 * Plugin Name:      Customsetting
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


 
/**
 * custom option and settings
 * 
 * 
 */

function wporg_settings_init() {
 // register a new setting for "wporg" page
 register_setting( 'wporg', 'wporg_options' );
 
 // register a new section in the "wporg" page
 add_settings_section(
 'wporg_section_developers',
 __( 'The Matrix has you.', 'wporg' ),
 'wporg_section_developers_cb',
 'wporg'
 );
 
 // register a new field in the "wporg_section_developers" section, inside the "wporg" page
 add_settings_field(
 'wporg_field_pill', // as of WP 4.6 this value is used only internally
 // use $args' label_for to populate the id inside the callback
 __( 'Pill', 'wporg' ),
 'wporg_field_pill_cb',
 'wporg',
 'wporg_section_developers',
 [
 'label_for' => 'wporg_field_pill',
 'class' => 'wporg_row',
 'wporg_custom_data' => 'custom',
 ]
 );

 add_settings_field(
    'wporg_field_checkbox', 
    
    __( 'Checkbox', 'wporg' ),
    'wporg_field_pill_cbc',
    'wporg',
    'wporg_section_developers',
    [
    'label_for' => 'wporg_field_checkbox',
    'class' => 'wporg_row',
    'wporg_custom_data' => 'custom',
    ]
    );

    add_settings_field(
        'wporg_field_Radio', 
        
        __( 'Radio', 'wporg' ),
        'wporg_field_pill_radio',
        'wporg',
        'wporg_section_developers',
        [
        'label_for' => 'wporg_field_radio',
        'class' => 'wporg_row',
        'wporg_custom_data' => 'custom',
        ]
        );

        add_settings_field(
            'wporg_field_textarea', 
            
            __( 'Textarea', 'wporg' ),
            'wporg_field_pill_textarea',
            'wporg',
            'wporg_section_developers',
            [
            'label_for' => 'wporg_field_textarea',
            'class' => 'wporg_row',
            'wporg_custom_data' => 'custom',
            ]
            );

            add_settings_field(
                'wporg_field_drop', 
                
                __( 'Textarea', 'wporg' ),
                'wporg_field_pill_dropdown',
                'wporg',
                'wporg_section_developers',
                [
                'label_for' => 'wporg_field_dropdown',
                'class' => 'wporg_row',
                'wporg_custom_data' => 'custom',
                ]
                );

 
}
 
/**
 * register our wporg_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wporg_settings_init' );
 



function wporg_section_developers_cb(){
    echo "hello";
}
function wporg_field_pill_cb() {
      ?>
 <input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
 <?php


//next function
 function wporg_field_pill_cbc()
 {
                ?>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="materialUnchecked">
                    <label class="form-check-label" for="materialUnchecked">Material unchecked</label>
                </div>
            <?php       
 }

 function wporg_field_pill_radio(){
    ?>
    <input type="radio" id="1" name="size" value="5">
    <label for="size">Size</label><br>
    <input type="radio" id="2" name="size" value="6">
    <label for="medium">Medium </label><br>
    <?php
 }


 function wporg_field_pill_textarea(){
    ?>
    <div class="form-group">
      
      <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
  </div>

      <?php
   }

   function wporg_field_pill_dropdown()
    {
        ?>
        <label for="cars">Choose a car:</label>

        <select name="cars" id="cars">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
        </select>

        <?php

    }


}


 
/**
 * top level menu
 */
function wporg_options_page() {
 // add top level menu page
 add_menu_page(
 'WPOrg',//title
 'WPOrg Options',//menu name
 'manage_options',//capability
 'wporg',//menu slug
 'wporg_options_page_html'//callbackfunction
 );
}
 
/**
 * register our wporg_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wporg_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function wporg_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'wporg_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wporg"
 settings_fields( 'wporg' );
 // output setting sections and their fields
 // (sections are registered for "wporg", each field is registered to a specific section)
 do_settings_sections( 'wporg' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}