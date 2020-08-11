<?php
/**
 * Plugin Name:       SettingApi
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

defined('ABSPATH')||exit;


add_action('admin_init', 'wporg_settings_init');

function wporg_settings_init()
{
    // register a new setting for "reading" page
    register_setting('reading', 'wporg_setting_name');
 
    // register a new section in the "reading" page
    add_settings_section(
        'settings_section',//id
        'Settings Section',//field
        'wporg_settings_section_cb',//callable func
        'reading'//page
    );
 
    // register a new field in the "wporg_settings_section" section, inside the "reading" page
    add_settings_field(
        'settings_field',
        'Input Field',
        'wporg_settings_field_cb',
        'reading',
        'settings_section'
    );
    add_settings_field(
        'settings_field1',
        'Radio Box ',
        'wporg_settings_field_cbc',
        'reading',
        'settings_section'
    );
    add_settings_field(
        'settings_field2',
        'Check Box ',
        'wporg_settings_field_checkbox',
        'reading',
        'settings_section'
    );
    add_settings_field(
        'settings_field3',
        'Text Area ',
        'wporg_settings_field_text',
        'reading',
        'settings_section'
    );
    add_settings_field(
        'settings_field4',
        'Dropdown ',
        'wporg_settings_field_drop',
        'reading',
        'settings_section'
    );

    function wporg_settings_section_cb()
    {
        echo '<p>WPOrg Section Introduction.</p>';
    }
   

    function wporg_settings_field_cb()
    {
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('wporg_setting_name');
        // output the field
        ?>
        <input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">

        <?php
    }

    function wporg_settings_field_cbc()
    {   ?>
        <input type="radio" id="1" name="size" value="5">
        <label for="size">Size</label><br>
        <input type="radio" id="2" name="size" value="6">
        <label for="medium">Medium </label><br>
        <?php
    }  
    
    function wporg_settings_field_checkbox(){
        ?>
       
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="materialUnchecked">
                <label class="form-check-label" for="materialUnchecked">Material unchecked</label>
            </div>
        <?php
    }
    function wporg_settings_field_text()
    {
        ?>
      <div class="form-group">
        
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
    </div>

        <?php
    }
    function wporg_settings_field_drop(){
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