<?php 
/*
Plugin Name: Duplicate Post And Page
Plugin URI: 
Description: 复制文章，页面或用户自定义页面.
Author: AdminColin
Version: 1.0.0
Author URI: 
License: GPLv2
Text Domain: duplicate-post-page
*/
?>
<?php 
    /**
     * 插件编写思路:
     * 1.在标头定义插件名称：Duplicate Post And Page
     * 2.设计插件的配置页面(admin_setting_post_and_page.php)，配置项包括
     *      a. "选择默认编辑器",
     *      b. "选择复制的新帖子或文章的状态("draft","publishing","pending","private")",
     *      c. "复制后默认跳转到的页面("文章列表页","页面列表页",...)",
     *      d. "复制后新帖子的后缀默认后缀"
     * 2.将插件配置页面作为“设置”菜单的子菜单并显示,显示时机(钩子)----add_action('admin_menu', ''):在管理菜单中加载管理菜单之前触发
     * 3.为插件设置相关跳转"按钮"(或"链接")---->"去作者主页","配置"，按钮显示时机(钩子)----add_filter('plugin_action_links', ''):过滤为插件列表中的每个插件显示的操作链接
     * 4.复制器的复制操作主函数
     *      
     * 
     * */

?>
<?php 
if (!defined('Duplicate_Post_and_Page_Plugin_Dirname')) {//未定义插件文件目录则进行下面的定义操作
    define('Duplicate_Post_and_Page_Plugin_Dirname', plugin_basename(dirname(__FILE__)));//定义插件基本名称(从插件文件名中提取)
    // echo plugin_basename(dirname(__FILE__));//duplicate-post-and-page
}
if (!defined('Duplicate_Post_and_Page_Plugin_Version')) {//未定义插件版本则进行下面的定义操作
    define('Dupicate_Post_and_Page_Plugin_Version', '1.0.0');
    // echo define('Dupicate_Post_and_Page_Plugin_Version', '1.0.0');//1
}

if (!class_exists('duplicate_post_and_page')) {
    class duplicate_post_and_page{
        public function __construct()
        {
            $opt = get_option('duplicate_page_and_post_options');//在安装插件期间初始化选项,避免过度查询数据库
            //激活钩子
            register_activation_hook(__FILE__, array(&$this, 'duplicate_post_and_page_install'));
            //将“文章页面复制器”插件作为子菜单显示在“设置”主菜单下
            add_action('admin_menu', array(&$this, 'duplicate_page_and_post_options_page'));
            //加载插件列表界面的按钮
            add_filter('plugin_action_links', array(&$this, 'duplicate_post_and_page_action_links'), 10, 2);
            //以上设置页面已经正常显示
            //加载主函数
            add_action('admin_action_admincolin_duplicate_post_as_draft', array(&$this, 'admincolin_duplicate_post_as_draft'));
            //在文章列表中每篇文章的操作按钮区域添加“复制此文件”按钮
            add_filter('post_row_actions', array(&$this, 'admincolin_duplicate_post_and_page_link'),10 , 2);
            //在.页面列表中每个页面的操作按钮区域添加“复制此文件”按钮
            add_filter('page_row_actions', array(&$this, 'admincolin_duplicate_post_and_page_link'),10 , 2);
        }
        //加载插件翻译字符串
        public function duplicate_post_and_page_load_text_domain() {
            load_plugin_textdomain('duplicate_post_and_page', false, Duplicate_Post_and_Page_Plugin_Dirname.'/languages');
        }
        //加载用户资源
        //plugins_url:检索插件或mu-plugins目录中的URL
        //admin_url():检索当前站点管理区域的URL
        public function custom_assets() {
            wp_enqueue_style( 'duplicate-post-and-page', plugins_url( '/css/duplicate_post_and_page.css', __FILE__ ) );
            wp_enqueue_script( 'duplicate-post-and-page', plugins_url( '/js/duplicate_post_and_page.js', __FILE__ ) );
            wp_localize_script( 'duplicate-post-and-page', 'dt_params', array(
                'ajax_url' => admin_url( 'admin-ajax.php'),
                'nonce' => wp_create_nonce( 'nc_help_desk' ))
            );
        }
        //注册钩子
        public function duplicate_post_and_page_install(){
            //默认设置,'duplicate_':是下列各个setting的前缀
                $defaultsettings = array(
                    //设置新帖子默认编辑器选项
                    'duplicate_post_and_page_editor' => 'classic',
                    //设置新帖子默认编辑器选项
                    'duplicate_post_and_page_postType' => 'posts',
                    //设置新帖子默认状态选项：draft，publish, future, pending,trash, auto-Draft
                    'duplicate_post_and_page_status' => 'draft', 
                    //设置新帖子复制完成后要跳转到的页面,to_list表示跳转到文章列表页, to_page表示跳转到页面列表页
                    'duplicate_post_and_page_redirect' => 'to_list',
                    //设置默认复制后帖子的名称后缀,默认为空,这里默认设置为AdminCOlin
                    'duplicate_post_and_page_suffix' => 'AdminColin'
                );
                $opt = get_option('duplicate_page_and_post_options');
                // 确定变量是否已声明并且不是null
                if (!isset($opt['duplicate_post_and_page_status'])) {
                    //更新选项设置
                    update_option('duplicate_page_and_post_options', $defaultsettings);
                }
        }
         // 主函数
         public function admincolin_duplicate_post_as_draft() {
            // 获取加密令牌
            //sanitize_text_field：从用户输入或数据库中清理字符串
            $nonce = sanitize_text_field($_REQUEST['nonce']);
            
            //获取变量
            //获取帖子id
            //intval 获取变量的整数值
            $post_id = (isset($_GET['post']) ? intval($_GET['post']) : intval($_POST['post']));
            //获取文章
            $post = get_post($post_id);
            //获取当前用户id
            $current_user_id = get_current_user_id();
             //wp_verify_nonce($nonce, ): 验证是否使用了正确的安全随机数和时间限制,第二个是可选参数，表示为正在发生的事情提供上下文，本例中不填或填写错误都会报错
             //为具备以下权限的用户授予复制权限，并调用复制操作
             if (wp_verify_nonce ($nonce, 'admincolin-duplicate-post-and-page-'.$post_id)) {
                if (current_user_can('manage_options') || current_user_can('edit_others_posts')) {
                    $this -> duplicate_edit_post_and_page($post_id);
                }
                else if (current_user_can('contributor') && $current_user_id == $post -> post_author) {
                    $this -> duplicate_edit_post_and_page($post_id, 'pending');
                }
                else if (current_user_can('edit_posts') && $current_user_id == $post -> post_author) {
                    $this -> duplicate_edit_post_and_page($post_id);
                }
                else {
                    wp_die(__('对不起，权限不足', 'duplicate-post-and-page'));
                }
             }
             else{
                wp_die('安全检查问题，请重试！', 'duplicate-post-and-page');
             }
        }
        //主函数结束

        //将“页面复制器”插件作为子菜单显示在“设置”主菜单下
        public function duplicate_page_and_post_options_page() {
            
            add_options_page(__('文章页面复制器', 'duplicate-post-and-page'),
             __('文章页面复制器', 'duplicate-post-and-page'), 'manage_options', 
             'duplicate_post_and_page_settings', array(&$this, 'duplicate_post_and_page_settings'));
        }
        //在插件列表中为该插件添加操作链接“去作者主页”，“设置”，“禁用”(“禁用”是默认有的)
        public function duplicate_post_and_page_action_links ($links, $file) {
            if ($file == plugin_basename(__FILE__)) {
                // echo $file;//duplicate-post-and-page/duplicate_post_and_page.php
                //插件"设置"按钮
                $duplicate_post_and_page_links = '<a href="'.esc_url(get_admin_url()).'options-general.php?page=duplicate_post_and_page_settings">'.__('配置', 'duplicate_post_and_page').'</a>';
                //插件"去作者主页"按钮
                $duplicate_post_and_page_custom_url = '<a href="https://bdtdl.xyz/?plugin=duplicate-post-and-page" title="'.__('作者主页','duplicate-post-and-page').'" target="_blank" style="font-weight:bold">'.__('去作者主页','duplicate-post-and-page').'</a>';

                //array_unshift() :将一个或多个元素(数组)添加到数组的开头
                array_unshift($links, $duplicate_post_and_page_links);
                array_unshift($links, $duplicate_post_and_page_custom_url);

            }
            return $links;
        }

        //加载插件设置页面(到这里，设置页面已经正常显示)
        public function duplicate_post_and_page_settings () {
            if (current_user_can('manage_options')) {
                include 'inc/admin_setting_post_and_page.php';
                // include 'admin_setting_post_and_page.php';
            }
        }

        //在文章或页面列表中的每篇文章或页面的操作按钮区域添加“复制此文件”按钮和提示消息
        public function admincolin_duplicate_post_and_page_link ($actions, $post) {
            $opt = get_option('duplicate_page_and_post_options');
            $post_status = !empty($opt['duplicate_post_and_page_status']) ? esc_attr($opt['duplicate_post_and_page_status']) : 'draft';//当前文章或页面状态，没有状态默认为draft
            $postType = $opt['duplicate_post_and_page_postType'];
            echo the_ID();

            

            if (current_user_can('edit_posts')) {
                //添加“复制此文件”超链接
                $actions['duplicate'] = '<a href="admin.php?action=admincolin_duplicate_post_as_draft&amp; post='.$post -> ID.'&amp; nonce='.wp_create_nonce('admincolin-duplicate-post-and-page-'.$post->ID).'" title="'.__('复制此文件为', 'duplicate-post-and-page').$post_status.'" rel="permalink">'.__('复制此文件', 'duplicate-post-and-page').'</a>';
            }
            return $actions;
        }
 
        //复制后的文章或页面设置
        public function duplicate_edit_post_and_page($post_id, $post_status_update='') {
            global $wpdb;//WordPress数据库访问抽象类
            //获取用户在配置页输入的选项值
            $opt = get_option('duplicate_page_and_post_options'); 
            //设置复制后的文件后缀
            //isset(): 变量是否已声明且不是null
            //empty(): 变量不存在，或者变量为空，或者变量等于0都返回true

            $suffix = isset($opt['duplicate_post_and_page_suffix']) 
            && !empty($opt['duplicate_post_and_page_suffix']) ? ' -- '.esc_attr($opt['duplicate_post_and_page_suffix']) : '';

            if ($post_status_update == '') {//如果配置页新帖子状态更新为空
                $post_status = !empty($opt['duplicate_post_and_page_status']) ? esc_attr($opt['duplicate_post_and_page_status']) : 'draft';//初始状态的帖子状态不为空，则使用转义后的HTML属性，否则就默认为draft状态
            }
            else {
                $post_status = $post_status_update;//如果帖子默认状态选项有更新，则使用更新后的状态
            }

            $redirectit = !empty($opt['duplicate_post_and_page_redirect']) ? esc_attr($opt['duplicate_post_and_page_redirect']) : 'to_list';

            
            if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'admincolin_duplicate_post_as_draft' == sanitize_text_field($_REQUEST['action'])))) {
                wp_die(__('无可供复制的帖子', 'duplicate-post-and-page'));
            }

            $returnpage = '';

            //所有帖子的数据
            //根据帖子ID获取帖子对象
            $post = get_post($post_id);

            //获取当前用户对象
            $current_user = wp_get_current_user(); 
            //设置复制出来的新帖子的作者
            $new_post_author = $current_user -> ID;//此语句用于设置复制出来的新文章的作者为当前操作后台的用户：Colin(原文作者)--->AdminColin(复制出来的新文章作者)
            // $new_post_author = $post->post_author;//此语句用于设置复制出来的新文章的作者仍然为该文章的原作者: Colin--->Colin

            

            //当帖子对象存且不为空时，则开始复制操作
            if (isset($post) && $post != null) {
                //新帖子的数据组
                $args = array (
                    //以下字段可以在数据库的posts表格中查找
                    'comments_status' => $post -> comment_status,
                    'ping_status' => $post -> ping_status,
                    'post_author' => $new_post_author,
                    'post_content' => (isset($opt['duplicate_post_and_page_editor']) 
                    && $opt['duplicate_post_and_page_editor'] == 'gutenberg') ? wp_slash($post -> post_content) : $post -> post_content,
                    'post_excerpt' => $post -> post_excerpt,
                    'post_parent' => $post -> post_parent,
                    'post_password' => $post -> post_password,
                    'post_status' => $post_status,
                    'post_title' => $post -> post_title.$suffix,
                    'post_type' => $post -> post_type,
                    'to_ping' => $post -> to_ping,
                    'menu_order' => $post -> menu_order,
                    'post_date' => $post -> post_date
                );

                    

                //wp_insert_post(): 将复制的新帖子插入到列表中,并获取新帖子的ID
                $new_post_id = wp_insert_post($args);


                //给当前id指定的帖子或页面交换类型
                if ($post->post_type == "post"){
                    set_post_type($new_post_id, 'page');
                }else{
                    set_post_type($new_post_id, 'post');
                }

                // array_map('操作函数', '操作函数操作对象'): 将回调应用于给定数组的元素
                //get_object_taxonomies:返回请求的对象或对象类型注册的分类名称或对象，例如帖子对象或帖子类型名称
                $taxonomies = array_map('sanitize_text_field', get_object_taxonomies($post -> post_type));
                //
                if (!empty($taxonomies) && is_array($taxonomies)) {
                    foreach ($taxonomies as $taxonomy) {
                        //wp_get_object_terms: 在提供的分类法中检索与给定对象关联的术语。
                        $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                        //wp_set_object_terms(): 创建术语和分类关系:将对象（帖子、链接等）与术语和分类类型相关联。如果术语和分类关系不存在，则创建它。如果它不存在，则创建一个术语（使用 slug）。
                        wp_set_object_terms($new_post_id,$post_terms, $taxonomy, false);
                    }
                }
                //复制帖子元信息

                //获取帖子元信息
                //下面的{{$wpdb -> postmeta}}必须要用“{}”。 $wpdb是wordpress的类，名称不能更改
                // $post_meta_infos = $wpdb -> get_results( $wpdb -> prepare("SELECT meta_key, meta_value FROM {$wpdb -> postmeta} WHERE post_id=%d", $post_id));
                $post_meta_infos = $wpdb -> get_results( $wpdb -> prepare("SELECT meta_key, meta_value FROM {$wpdb -> postmeta} WHERE post_id=%d", $post_id));

                if (count($post_meta_infos) != 0) {
                    $sql_query = "INSERT INTO {$wpdb -> postmeta} (post_id, meta_key, meta_value)";
                    foreach ($post_meta_infos as $meta_info) {
                        $meta_key = sanitize_text_field($meta_info -> meta_key);
                        $meta_value = addslashes($meta_info -> meta_value);
                        $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
                    }
                    $sql_query .= implode(" UNION ALL AdminColin ", $sql_query_sel);
                    $wpdb -> query($sql_query);
                    echo $sql_query;
                }


                //重定向

                if ($post -> post_type != 'post') {
                    $returnpage = '?post_type='.$post -> post_type;
                }

                if (!empty($redirectit) && $redirectit == 'to_list') {
                    //Performs esc_url() for database or redirect usage.为数据库或重定向使用执行esc_url(),esc_url比esc_url_raw()更安全。
                    // wp_redirect(esc_url_raw(admin_url('edit.php'.$returnpage)));
                    wp_redirect(esc_url(admin_url('edit.php'.$returnpage)));
                }
                else if(!empty($redirectit) && $redirectit == 'to_page') {
                    // wp_redirect(esc_url_raw(admin_url('post.php?action=edit&post='.$new_post_id)));
                    wp_redirect(esc_url(admin_url('post.php?action=edit&post='.$new_post_id)));
                }
                else {
                    // wp_redirect(esc_url_raw(admin_url('edit.php'.$returnpage)));
                    wp_redirect(esc_url(admin_url('edit.php'.$returnpage)));
                }
                exit;
            }
            else {
                wp_die(__('错误！帖子创建失败，没有可复制的原始帖子', 'duplicate-post-and-page').$post_id);
            }
        }

        

        //     //重定向
        public static function admincolin_redirect ($url) {
            $web_url = esc_url_raw($url);
            echo $web_url .'<hr>';
            wp_register_script('admincolin-setting-redirect', '');

            wp_enqueue_script('admincolin-setting-direct');

            wp_add_inline_script('admincolin-setting-redirect', ' window.location.href="'.$web_url.'" ;');
        }
        
    }
}
new duplicate_post_and_page();
?>
