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

function my_settings_init() {
 
 register_setting( 'wporg', 'wporg_options' );
 
 // register a new section in the "wporg" page
 add_settings_section(
 'my_section_developers',//id
 __( 'My customized settings', 'wporg' ),//title
 'wporg_section_developers_function1',//callable fun
 'wporg'//page
 );
 
 // register a new field in the "wporg_section_developers" section, inside the "wporg" page
 add_settings_field(
 'input_field', 
 // use $args' label_for to populate the id inside the callback
 __( 'Input Field', 'wporg' ),
 'wporg_field_pill_function2',
 'wporg',
 'my_section_developers',
 [
 'label_for' => 'input_field',
 'class' => 'wporg_row',
 'wporg_custom_data' => 'custom',
 ]
 );

 add_settings_field(
    'wporg_field_checkbox', 
    
    __( 'Checkbox', 'wporg' ),
    'wporg_field_pill_function3',
    'wporg',
    'my_section_developers',
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
        'my_section_developers',
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
     'my_section_developers',
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
    'my_section_developers',
    [
    'label_for' => 'wporg_field_dropdown',
    'class' => 'wporg_row',
    'wporg_custom_data' => 'custom',
    ]
     );

 
}
 
//register admin init hook
add_action( 'admin_init', 'my_settings_init' );
 

//callable functions

function wporg_section_developers_function1(){
    echo "hello";
}
function wporg_field_pill_function2()
 {
    ?>
        <input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    
    <?php

}

function wporg_field_pill_function3()
    {
    ?>
                    
        <div class="form-check">
                <input type="checkbox" class="form-check-input" id="materialUnchecked">
                <label class="form-check-label" for="materialUnchecked">Material unchecked</label>
        </div>
    <?php       
    }
function wporg_field_pill_radio()
 {
    ?>
    <input type="radio" id="1" name="size" value="5">
    <label for="size">Size</label><br>
    <input type="radio" id="2" name="size" value="6">
    <label for="medium">Medium </label><br>
    <?php
 }


function wporg_field_pill_textarea()
    {
        ?>
        <div class="form-group">
        
        <textarea class="form-control rounded-0" id="example" rows="3"></textarea>
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


 
//adding top level menus
function wporg_options_page() {
 // add top level menu page
 add_menu_page(
 'Settings',//title
 'Setting Options',//menu name
 'manage_options',//capability
 'wporg',//menu slug
 'wporg_options_page_html'//callbackfunction
 );
}
 
/**
 * register our wporg_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wporg_options_page' );
add_action( 'admin_init', 'setting_details' ) ;
 
//callback functions for setting details

 function setting_details(){
    if(isset($_POST['Mysubmit'])){
        $array_details = array(
            'wporg_setting_name'=> isset($_POST['wporg_setting_name']) ? sanitize_text_field($_POST['wporg_setting_name']): "Default",
             'materialUnchecked'=> isset($_POST['materialUnchecked']) ? absint($_POST['materialUnchecked']): "Default",
            'size'=> isset($_POST['size']) ? sanitize_text_field($_POST['size']): "Default",
            'cars'=> isset($_POST['cars']) ? sanitize_text_field($_POST['cars']): "Default",
             'example'=> isset($_POST['example']) ? sanitize_textarea_field($_POST['example']): "Default",
        );
        if(!empty($array_details)){
            update_option('my_option_name', $array_details);
        }
    }
 }
function wporg_options_page_html() {
        // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
    return;
    }
    

    ?>
    
    <form method="post">
    <?php
    // output security fields for the registered setting "wporg"
    settings_fields( 'wporg' );
    // output setting sections and their fields
    // (sections are registered for "wporg", each field is registered to a specific section)
    do_settings_sections( 'wporg' );
    // output save settings button
    
    ?>
    <input type ="submit" name="Mysubmit" value="save settings">
    </form>
    </div>
    <?php
}