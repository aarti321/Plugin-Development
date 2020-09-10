<?php

/*
Plugin Name: Plugin_active
Plugin URI: http://plugindev.com/
Description: Activate the plugin 
Version: 1.0
Author: Aarti Bhattarai
Author URI: http://plugindev.com/
License: GPLv2 or later
*/

interface Plugin_Setup_Interface
{
    public function activate( $test );

}

class Plugin_Setup implements Plugin_Setup_Interface
{

    public function activate( $test ) {
        echo "This is from ".$test;
    }

   
}
$network=new Plugin_Setup();
$network->activate('interface');


abstract class AbstractClass{
    abstract public static function display($arg);

}

class NewClass extends AbstractClass{
    public static function display($arg){
        echo "This is from ".$arg;
    }
}
NewClass::display('Abstract Class');


class Plugin_Starter
{

    public function __construct(){
        add_action( 'admin_notices', array($this,'notice_example()' ));  

    }
    
     function notice_example(){
           
                ?>
                <div class="notice">
                    <p>Thank you for using this plugin! <strong>You are awesome</strong>.</p>
                </div>
                <?php
        
        }
}


new Plugin_Starter();
