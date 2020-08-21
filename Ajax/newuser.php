<?php
/**
 * Plugin Name:       Ajax
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


add_action('init','my_function_for_ajax');






  function my_function_for_ajax()
  {
    add_shortcode('user_form','registration_form');
    add_action('wp_enqueue_scripts', 'vb_register_user_scripts');
    add_action('wp_ajax_register_user_front_end', 'register_user_front_end_cv');
    add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end_cv');

  }
function registration_form(){
    ?>
 
 <p class="register-message" style="display:none"></p>
    <form action="#" method="POST" name="register-form" class="register-form">
      <fieldset> 
          <label><i class="fa fa-file-text-o"></i> Register Form</label>
          <input type="text"  name="new_user_name" placeholder="Username" id="new-username">
          <input type="email"  name="new_user_email" placeholder="Email address" id="new-useremail">
          <input type="password"  name="new_user_password" placeholder="Password" id="new-userpassword">
          <input type="password"  name="re-pwd" placeholder="Re-enter Password" id="re-pwd">
          <input type="submit"  class="button" id="register-button" value="Register" >
      </fieldset>
    </form> 
 
<?php
}

function vb_register_user_scripts() {
    // Enqueue script
    wp_register_script('my_script', plugins_url() . '/Ajax/assests/my.js', array('jquery'), '1.2.3', false);
    wp_enqueue_script('my_script');
    wp_localize_script( 'my_script', 'my_vars', array(
          'my_ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
    }
 

  function register_user_front_end_cv() {
    $new_user_name = stripcslashes($_POST['new_user_name']);
    $new_user_email = stripcslashes($_POST['new_user_email']);
    $new_user_password = $_POST['new_user_password'];
   
  
    $user_data = array(
        'user_login' => $new_user_name,
        'user_email' => $new_user_email,
        'user_pass' => $new_user_password,
        'user_nicename' => $user_nice_name,
        
        'role' => 'subscriber'
        );
    $user_id = wp_insert_user($user_data);
        if (!is_wp_error($user_id)) {
        echo 'we have Created an account for you.';
        } else {
          if (isset($user_id->errors['empty_user_login'])) {
            $notice_key = 'User Name and Email are mandatory';
            echo $notice_key;
            } elseif (isset($user_id->errors['existing_user_login'])) {
            echo'User name already exixts.';
            } else {
            echo'Error Occured please fill up the sign up form carefully.';
            }
        }
  die;
}
