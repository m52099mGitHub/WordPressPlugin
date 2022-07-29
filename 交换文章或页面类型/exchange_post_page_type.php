<?php

/**
 * Plugin Name: Exchange Post And Page Type
 * Description: Exchange Post And Page Type.
 * Version: 1.0.0
 * Author: ColinHong
 */
?>


<?php
if (!class_exists('exchange_post_and_page_type')) {//这句必须加上，否则可能导致类名无法注册
    class exchange_post_and_page_type
    {
        public function __construct()
        {
            $opt = get_option('exchange_post_page_type_options'); //在安装插件期间初始化选项,避免过度查询数据库
            //激活钩子
            register_activation_hook(__FILE__, array(&$this, 'exchange_post_page_type_install'));
            //将“文章页面类型交换”插件作为子菜单显示在“设置”主菜单下
            add_action('admin_menu', array(&$this, 'exchange_post_page_type_options_page'));
            //加载插件列表界面的按钮
            add_filter('plugin_action_links', array(&$this, 'exchange_post_page_type_action_links'), 10, 2);
        }


        //在插件列表中为该插件添加操作链接“去作者主页”，“设置”，“禁用”(“禁用”是默认有的)
        public function exchange_post_page_type_action_links($links, $file)
        {
            if ($file == plugin_basename(__FILE__)) {
                // echo $file;//exchange-post-page-type/exchange_post_page_type.php
                //插件"设置"按钮
                $exchange_post_page_type_links = '<a href="' . esc_url(get_admin_url()) . 'options-general.php?page=exchange_post_page_type_settings">' . __('配置', 'exchange_post_page_type') . '</a>';
                //插件"去作者主页"按钮
                $exchange_post_page_type_custom_url = '<a href="https://bdtdl.xyz/?plugin=exchange-post-page-type" title="' . __('作者主页', 'exchange-post-page-type') . '" target="_blank" style="font-weight:bold">' . __('去作者主页', 'exchange-post-page-type') . '</a>';

                //array_unshift() :将一个或多个元素(数组)添加到数组的开头
                array_unshift($links, $exchange_post_page_type_links);
                array_unshift($links, $exchange_post_page_type_custom_url);
            }
            return $links;
        }


        //将“文章页面类型交换”插件作为子菜单显示在“设置”主菜单下
        public function exchange_post_page_type_options_page()
        {

            add_options_page(
                __('文章页面类型互换', 'exchange-post-page-type'),
                __('文章页面类型互换', 'exchange-post-page-type'),
                'manage_options',
                'exchange_post_page_type_settings',
                array(&$this, 'exchange_post_page_type_settings')
            );
        }


        //加载插件设置页面(到这里，设置页面已经正常显示)
        public function exchange_post_page_type_settings()
        {
            if (current_user_can('manage_options')) {
                include 'exchange_post_page_type_setting.php';
            }
        }

        //     //重定向
        public static function admincolin_redirect($url)
        {
            $web_url = esc_url_raw($url);
            echo $web_url . '<hr>';
            wp_register_script('admincolin-setting-redirect', '');

            wp_enqueue_script('admincolin-setting-redirect');

            wp_add_inline_script('admincolin-setting-redirect', ' window.location.href="' . $web_url . '" ;');
        }
    }
}
new exchange_post_and_page_type();
?>