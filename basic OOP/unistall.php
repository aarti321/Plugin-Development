<?php 



if (! defined ('WP_uNISTALL_PLUGIN')) {
    die;
}

//Access the database
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
$wpdb->query("DELETE FROM wp_postmeta WHERe post_id NOT IN (Select id FROM Wp_posts)");
