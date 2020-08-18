<?php
/**
 * Plugin Name:       Test Email
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

class SendMail{
  function __construct()
  {
    add_action('admin_menu', array($this, 'add_menu'));
    add_action( 'admin_init', array($this, 'save_setting_details' ));
    add_action("init", array($this, "include_content"));
  }
  function add_menu(){
    add_menu_page('Menu Title', 'Sendmail', 'manage_options', 'send_email', array($this, 'function'));
    add_submenu_page( 'send_email', 'Send Mail', 'Settings menu label', 'manage_options', 'email-slug', array($this, 'email_send'));
  }
  function function(){
  }
  function email_send(){
    ?>
    <div class="wrap">
        <h1>My Settings</h1>
        <form method="post">
        Send Email To: <input type="email" id="my_email" name="send_email" /><br>
        Message: <input type="text" id="my_message" name="send_message"  /><br>
        Subject: <input type="text" id="my_subject" name="send_subject"  /><br>
        <input type="submit" name="my_submit_button" value="Save"/>
        </form>
    </div>
    <?php
  }
  function save_setting_details(){
    if(isset($_POST['my_submit_button'])){
        $my_email= $_POST['send_email'];
        $my_subject = $_POST['send_subject'];
        $my_message= isset($_POST['send_message'])?apply_filters("new_filter", $_POST['send_message']): 'Default'; 
        do_action("sending_email", $my_email, $my_subject, $my_message);
    }
}
public function include_content(){
  include_once dirname(__FILE__).'/change_content.php';
}
}
new SendMail();