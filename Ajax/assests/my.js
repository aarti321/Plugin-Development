jQuery(document).ready(function($) {
 
    jQuery('#register-button').on('click',function(e){
        e.preventDefault();
        var newUserName = jQuery('#new-username').val();
        var newUserEmail = jQuery('#new-useremail').val();
        var newUserPassword = jQuery('#new-userpassword').val();
       
        jQuery.ajax({
          type:"POST",
          url:my_vars.my_ajax_url,
          data: {
            action: "register_user_front_end",
            new_user_name : newUserName,
            new_user_email : newUserEmail,
            new_user_password : newUserPassword
          },
          success: function(results){
            console.log(results);
            jQuery('.register-message').text(results).show();
          },
          error: function(results) {

          }
        });
      });
  });
