<?php 
/**
*@package AdminColin's Second Plugin
*@version 1.0.0
*/

/*
    Plugin Name: AdminColin's Second Plugin
    Description: You will get a email after a post
    Version: 1.0.0
    Author: AdminColin
*/

//用加特殊前缀的方法避免函数名和wordpress核心函数及其他人的函数同名
//wp_mail()函数在localhost上是无法工作的,wp_mail也被认为是一种不安全的邮件方式，
    function admincolin_email_friends($post_id) {
        $friends = 'm52099m@gmail.com, m52099m@163.com';
        wp_mail($friends, 'test post updated', 'I just put something new on my blog:http://localhost/wordpress/2022/07/12/test-post-email/');
        return $post_id;
    }
    add_action('publish_post', 'admincolin_email_friends');


//用类的方法避免函数同名
// class emailer {
//     static function send($post_ID) {
//         $friends = 'm52099m@gmail.com';
//         wp_mail($friends, "AdminColin's blog updated", "I just put something new on my blog:http://localhost/wordpress/2022/07/12/test-post-email/");
//         return $post_ID;
//     }
// }

// $myEmailClass = new emailer();
// add_action('publish_post', array($myEmailClass, 'send'));


?>