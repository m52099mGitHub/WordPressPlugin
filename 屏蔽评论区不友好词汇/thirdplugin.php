<?php 
/**
 * @package AdminColin's third plugin
 * @version 1.0.0 
*/

/**
 * Plugin name: AdminColin's Third plugin
 * Description: This is a test plugin for add_filter
 * Version: 1.0.0
 * Author: AdminColin
*/

function filter_profanity($content) {
    $profanities = array('badword', 'alsobad', '...');
    $content = str_ireplace( $profanities, '{censored}', $content);
    return $content;
}
add_filter('comment_text', 'filter_profanity');

?>