<?php
/**
 * Plugin Name:       Shortcodes
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

add_action( 'init', 'save_setting_details' ) ;
add_shortcode('my_redirect_after_registration','frontend');





function frontend( $attr ){




   
?> 
	<div class="alar-registration-form">
		<div class="alar-registration-heading">
		
		    <form method ="POST">
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

                <label for="username"><b>User Name</b></label>
                <input type="text" placeholder="User Name" name="user_name" id="username" required>

                <label for="dispalyname"><b>Display  Name</b></label>
                <input type="text" placeholder="display Name" name="display_name" id="displayname" required>

                <label for="firstname"><b>First Name</b></label>
                <input type="text" placeholder="first Name" name="first_name" id="firstname" required>

                <label for="lastname"><b>Last Name</b></label>
                <input type="text" placeholder="Last Name" name="last_name" id="lastname" required>

                <label for="Role">Choose a Role:</label>

                    <select name="roles" id="roles">
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="administrator">Administrator</option>
                    </select>


                <br>
                <button type="submit"name="com_submit" class="registerbtn">Register</button>
            </form>   
        </div>
    <div>            
           
<?php	
}
function save_setting_details(){
    if(isset($_POST['com_submit'])){

        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $display_name = $_POST['display_name'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $roles = $_POST['roles'];


        $id_check = username_exists( $user_name );
        if ( !$id_check and email_exists($email) == false ) {
            // $id_check = wp_create_user( $user_name, $psw, $email );
            $saving_data = wp_insert_user(array(
                
                'user_login'        => $user_name,
                        'user_pass'         => $psw,
                        'user_email'        => $email,
                        'first_name'        => $first_name,
                        'last_name'         => $last_name,
                        'display_name'       => $display_name,
                        'role'              => $roles,
            )
        );

        $content_post = get_post(get_the_ID());
                $content = $content_post->post_content;
                if ( ( has_shortcode( $content, 'my_registration_form' ))){
                   $var=  preg_match( '/' . get_shortcode_regex() . '/s', $content, $matches );
                   // Remove all html tags.
                     $escaped_atts_string = preg_replace( '/<[\/]{0,1}[^<>]*>/', '', $matches[3] );
                     $attributes   = shortcode_parse_atts( $escaped_atts_string );
                     $redirect_url = isset( $attributes['redirect_after_registration'] ) ? $attributes['redirect_after_registration'] : '';
                     $redirect_url = trim( $redirect_url, ']' );
                     $redirect_url = trim( $redirect_url, '"' );
                     $redirect_url = trim( $redirect_url, "'" );
                     error_log($redirect_url);
                    if (! empty( $redirect_url ) ) {
                        wp_safe_redirect($_SERVER['HTTP_HOST'].'/'. $redirect_url );
                        exit();
                    }
                }
            
           
        }
    }
}    