<?php

class PracticePluginDeactivate 
{ 
    
    public static function deactivate(){
       
        flush_rewrite_rules();
     }
 }    