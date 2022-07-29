<?php 
/*
* Plugin Name: Show AppearanceMenu
* Description: 为帖子主菜单添加一个名为“Course”的子菜单
* Version: 1.0
* Author: AdminColin
* Author URI: https://wpscale.cn
*/

function register_admincolin_menus () {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
			'iextra-menu' =>__('Extra Menu')
		)
		);
}
add_action('init', 'register_admincolin_menus');

?>






















