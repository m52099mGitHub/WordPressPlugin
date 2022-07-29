<?php 
/*
* Plugin Name: AdminColin's Sixth Plugin
* Description: 为帖子主菜单添加一个名为“Course”的子菜单
* Version: 1.0
* Author: AdminColin
* Author URI: https://wpscale.cn
*/
?>


<?php 
//新建的“Course”分类没有出现在帖子的编辑页面
function admincolin_register_child_taxonomy_course_for_post() {
    $labels = array (
        'name'                     => _x('Courses','taxonomy general name'),
        'singular_name'            => _x('Course','taxonomy singular name'),
        'search_items'             => __('Search Courses'),
        'all_items'                => __('All Course'),
        'parent_item'              => __('Parent Course'),
        'parent_item_colon'        => __('Parent Course:'),
        'edit_item'                => __('Edit Course'),
        'update_item'              => __('Update Course'),
        'add_new_item'             => __('Add New Course'),
        'new_item_name'            => __('New Course Name'),
        'menu_name'                => __('Course'),
    );
    $args = array(
        'hierarchical'             => true, //分层
        'labels'                   => $labels,
        'show_ui'                  => true,
        'show_admin_column'        => true,
        'show_in_rest'             => true,//这一行用于将分类选项显示在帖子编辑页面右侧选项栏
        'query_var'                => true,
        'rewrite'                  => ['slug' => 'course'],
    );
    register_taxonomy('course', ['post','page','admincolin_services'], $args);
}
add_action('init', 'admincolin_register_child_taxonomy_course_for_post');
?>


<?php 

?>