<?php

/**
 * Plugin Name:Dashboard for Different Login User Testing Copy 4
 * Description: It's a combination of Testing Copy 2 & Copy 3
 * Author: Colin Hong
 * Version: 1.0.0
 * Author URI:https://bdtdl.xyz
 * 
 * 
 * 1. 输入一个已经注册过的用户名和为这个用户配置的授权项
 * 2. 后台获取用户名，并验证用户是否已经注册到数据库中(只能为已经注册的用户授权)，提示输入用户的角色信息，
 * 当验证通过后，再将获取到的授权设置项授予该用户
 * 3.创建数据库表，将配置信息根据用户名（或ID）的不同保存到数据库中以供用户下次登陆时调用
 * 
 */
error_reporting(0);

if (!defined('dashboard_for_different_login_user_Plugin_Dirname')) { //未定义插件文件目录则进行下面的定义操作
    define('dashboard_for_different_login_user_Plugin_Dirname', plugin_basename(dirname(__FILE__))); //定义插件基本名称(从插件文件名中提取)
}

if (!defined('dashboard_for_different_login_user_Plugin_Version')) { //未定义插件版本则进行下面的定义操作
    define('dashboard_for_different_login_user_Plugin_Version', '1.0.0');
}



if (!class_exists('dashboard_menu_adjust')) {
    class dashboard_menu_adjust
    {
        public function __construct()
        {
            // $opt = get_option($_POST['userRole'].'set_display_item_for_user_options');
            register_activation_hook(__FILE__, array(&$this, 'dashboard_for_different_login_user_install'));
            add_action('admin_menu', array(&$this, 'dashboard_add_option_button_to_tool_memu'));
            //加载插件列表界面的按钮
            add_filter('plugin_action_links', array(&$this, 'dashboard_add_settings_page_action_links'), 10, 2);
            add_action('admin_menu', array(&$this, 'dashboard_menu_display'));
            // add_action('admin_menu', array(&$this, 'load_dashboard_menu_when_user_login'));
        }


        //启动插件并加载默认设置项
        public function dashboard_for_different_login_user_install()
        {

            //默认设置
            $defaultsettings = array(
                //默认用户名为admin
                'userRole' => 'AdminColin',
                //默认帖子菜单显示
                'postMenu' => 'Yes_Display',
                //默认媒体菜单不显示
                'mediaMenu' => 'No_Display',
                //默认页面菜单不显示
                'pageMenu' => 'No_Display',
                //默认评论菜单不显示
                'commentMenu' => 'No_Display',
                //默认外观菜单不显示
                'appearanceMenu' => 'No_Display',
                //默认插件菜单不显示
                'pluginMenu' => 'No_Display',
                //默认用户菜单不显示
                'userMenu' => 'No_Display',
                //默认工具菜单不显示
                'toolMenu' => 'No_Display',
                //默认设置菜单不显示
                'settingMenu' => 'No_Display',
            );
            $opt = get_option($_POST['userRole'].'_set_display_item_for_user_options');
            // 确定变量是否已声明并且不是null
            if ($opt) {
                //更新选项设置
                update_option($_POST['userRole'].'_set_display_item_for_user_options', $defaultsettings);
            }
        }
        //将插件作为子菜单置于工具(Tool)主菜单下
        public function dashboard_add_option_button_to_tool_memu()
        {
            add_management_page(
                __('用户授权', 'dashboard-for-different-login-user'),
                __('登陆用户权限定义', 'dashboard-for-different-login-user'),
                'manage_options',
                'dashboard_add_settings_page',
                array(&$this, 'dashboard_add_settings_page')
            );
        }
        public function dashboard_add_settings_page_action_links($links, $file)
        {
            if ($file == plugin_basename(__FILE__)) {
                // echo $file;//exchange-post-page-type/dashboard_add_settings_page.php
                //插件"设置"按钮
                $dashboard_add_settings_page_links = '<a href="' . esc_url(get_admin_url()) . 'tools.php?page=dashboard_add_settings_page">' . __('配置', 'dashboard_add_settings_page') . '</a>';
                //插件"去作者主页"按钮
                $dashboard_add_settings_page_custom_url = '<a href="https://bdtdl.xyz/?plugin=exchange-post-page-type" title="' . __('作者主页', 'dashboard_add_settings_page') . '" target="_blank" style="font-weight:bold">' . __('去作者主页', 'dashboard_add_settings_page') . '</a>';

                //array_unshift() :将一个或多个元素(数组)添加到数组的开头
                array_unshift($links, $dashboard_add_settings_page_links);
                array_unshift($links, $dashboard_add_settings_page_custom_url);
            }
            return $links;
        }
        
        //加载用户授权设置页面
        public function dashboard_add_settings_page()
        {
            if (current_user_can('manage_options')) {
                include 'dashboard_for_different_login_user_settings.php';
            }
        }

        public function dashboard_menu_display()
        {
            $currentLoginUserInfo = wp_get_current_user();
            $currentLoginUserName = $currentLoginUserInfo -> user_login;
            $opt = get_option($currentLoginUserName.'_set_display_item_for_user_options');
            //获取输入框输入的用户名
            $currentInputUserName = $opt['userRole'];
            //获取输入框输入的用户名对应的用户信息
            $userInfo = new WP_User($currentInputUserName);
            //获取输入框输入的用户的ID
            $userId = $userInfo -> ID;
            //获取用户的角色信息
            // $userRole =  $userInfo ->roles;
            //获取用户等级信息
            $userLevel = $userInfo -> user_level;

            if (username_exists($currentInputUserName)) {

                // echo '<p style="text-align:center; color:#E66;">用户:' . $currentInputUserName . '已注册, 他是' .$userLevel. '级用户, ID为' . $userId .', 已授权成功</p>';
                
                if ($currentLoginUserName  == $currentInputUserName) { //若当前登录用户名是Colin,则不执行后续语句。若不是则对管理员用户Admin和Colin以外的以外的用户隐藏下面的菜单内容
                    if ($opt['postMenu'] != 'Yes_Display') remove_menu_page('posts.php'); //文章
                    if ($opt['mediaMenu'] != 'Yes_Display') remove_menu_page('upload.php'); //媒体
                    if ($opt['pageMenu'] != 'Yes_Display') remove_menu_page( 'edit.php?post_type=page' ); //页面
                    if ($opt['commentMenu'] != 'Yes_Display') remove_menu_page('edit-comments.php'); //评论
                    if ($opt['appearanceMenu'] != 'Yes_Display') remove_menu_page('themes.php'); //主题
                    if ($opt['pluginMenu'] != 'Yes_Display') remove_menu_page('plugins.php'); //插件
                    if ($opt['userMenu'] != 'Yes_Display') remove_menu_page('users.php'); //用户
                    if ($opt['toolMenu'] != 'Yes_Display') remove_menu_page('tools.php'); //工具
                    if ($opt['settingMenu'] != 'Yes_Display') remove_menu_page('options-general.php'); //设置
                }
            }
            else {
                return;
            }
        }

        //保存后
        public static function admincolin_dashboard_refresh_redirect($url)
        {
            $web_url = esc_url_raw($url);
            // wp_register_script('admincolin-setting-redirect', '');

            // wp_enqueue_script('admincolin-setting-redirect');

            wp_add_inline_script('admincolin-setting-redirect', ' window.location.href="' . $web_url . '" ;');
        }

        public function load_dashboard_menu_when_user_login () {
            //获取当前登录用户的信息
            $currentLoginUserInfo = wp_get_current_user();
            // 获取当前登录用户的用户名
            $currentLoginUserName= $currentLoginUserInfo -> user_login;
            //获取当前登录用户的仪表盘菜单配置选项数据
            $opt = get_option($currentLoginUserName.'_set_display_item_for_user_options');
            // var_dump($opt['userRole']);
            // print_r('当前登录的用户名为: '.$currentLoginUserName);
            

        }
    }
    new dashboard_menu_adjust();
}

?>