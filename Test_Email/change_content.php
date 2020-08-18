<?php
class EmailUsingHook{
    public function __construct()
    {
        add_action("sending_email", array($this, 'sending_email'), 10, 3);
        add_filter("new_filter", array($this, "filter_email"), 10, 1);
    }
     function sending_email($my_email, $my_subject, $my_message){
        wp_mail($my_email, $my_subject, $my_message);
    }
     function filter_email($my_message){
        return $my_message .= "This is added by filter";
    }
}
new EmailUsingHook();
