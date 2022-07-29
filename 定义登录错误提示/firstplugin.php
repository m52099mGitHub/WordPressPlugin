<?php
/**
* Plugin Name: AdminColin's First Plugin
* Plugin URI: 
* Description: This is a plugin to change the login eroor info.
* Version: 1.0.0
* Author: AdminColin
* Author URI: 
**/

function admincolin_login_wordpress_errors() {
    return 'Something went wrongwrong1!';
}
add_filter('login_errors', 'admincolin_login_wordpress_errors');
?>