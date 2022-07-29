<?php



// 内容中每一个单独的功能已经用大块换行隔开，若运行出问题，请剪切到单独文件中运行





/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


// if ( ! function_exists( 'twentytwentytwo_support' ) ) :

// 	/**
// 	 * Sets up theme defaults and registers support for various WordPress features.
// 	 *
// 	 * @since Twenty Twenty-Two 1.0
// 	 *
// 	 * @return void
// 	 */
// 	function twentytwentytwo_support() {

// 		// Add support for block styles.
// 		add_theme_support( 'wp-block-styles' );

// 		// Enqueue editor styles.
// 		add_editor_style( 'style.css' );

// 	}

// endif;

// add_action( 'after_setup_theme', 'twentytwentytwo_support' );

// if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

// 	/**
// 	 * Enqueue styles.
// 	 *
// 	 * @since Twenty Twenty-Two 1.0
// 	 *
// 	 * @return void
// 	 */
// 	function twentytwentytwo_styles() {
// 		// Register theme stylesheet.
// 		$theme_version = wp_get_theme()->get( 'Version' );

// 		$version_string = is_string( $theme_version ) ? $theme_version : false;
// 		wp_register_style(
// 			'twentytwentytwo-style',
// 			get_template_directory_uri() . '/style.css',
// 			array(),
// 			$version_string
// 		);

// 		// Enqueue theme stylesheet.
// 		wp_enqueue_style( 'twentytwentytwo-style' );

// 	}

// endif;

// add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// // Add block patterns
// require get_template_directory() . '/inc/block-patterns.php';










    // 加载外部样式文件
    // function university_files() {

    //     wp_enqueue_script('main-university-js',get_theme_file_uri('/build/index.js'),array('jquery'),'1.0.0',true);
    //     //加载谷歌字体样式文件
    //     wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    //     //加载页脚SNS图标
    //     wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //     //加载不在当前文件同级的主样式表样式表(主样式表style.css通常和index.php在同一级，这里把它放在了build文件夹下面了)
    //     wp_enqueue_style('university_main_style', get_theme_file_uri('/build/style-index.css'));//获取指定地址的样式文件
    //     //加载其它样式表
    //     wp_enqueue_style('university_extra_style', get_theme_file_uri('/build/index.css'));
    // }
    // add_action('wp_enqueue_scripts', 'university_files');//wp_enqueue_scripts加载外部样式表文件的时机，university_files进行加载动作的函数名




    
    //修改帖子的标题
    // function twentytwentytwo__filter_title($title) {
    //     return 'the' . $title . 'was filtered';
    // }
    // add_filter('the_title','twentytwentytwo__filter_title');






/**
 * 在仪表盘添加一个页面.
 */
// function admincolin_add_dashboard_menu() {
//     add_dashboard_page( __( 'AdminColin Dashboard', 'textdomain' ), __( 'AdminColin Dashboard', 'textdomain' ), 'read', 'admincolin-unique-identifier', 'admincolin_plugin_function' );
// }
// add_action('admin_menu', 'admincolin_add_dashboard_menu');






/**
 * 添加一个媒体下级菜单--Video
 */
// function admincolin_media_plugin_menu() {
//     add_media_page(
//         __( 'Video', 'textdomain' ),
//         __( '视频', 'textdomain' ),
//         'read',
//         'my-unique-identifier',
//         'admincolin_media_plugin_menu'
//     );
// }
// add_action('admin_menu', 'admincolin_media_plugin_menu');





/**
 * 添加一个下级插件目录.
 */
// function admincolin_plugin_menu() {
//     add_plugins_page(
//         __( 'AdminColin Plugin Page', 'textdomain' ),
//         __( 'AdminColin Plugin', 'textdomain' ),
//         'read',
//         'admincolin-unique-identifier',
//         'admincolin_plugin_function'
//     );
// }
// add_action( 'admin_menu', 'admincolin_plugin_menu' );










/*
*在文章菜单下添加下级菜单
*
**/
// function admincolin_add_child_post_menu() {
// 	add_posts_page(
// 		'AdminColin Child Post Menu',
// 		'AdminColin Child Post Menu',
// 		'read',
// 		'twentytwentytwo-unique-identifier',
// 		'admincolin_add_child_post_menu'
// 	);
// }
// add_action('admin_menu', 'admincolin_add_child_post_menu');







//单独为指定id的文章添加元值
// add_post_meta(56,'colin',100,true);












// function admincolin__update_custom_roles() {
//     if ( get_option( 'custom_roles_version' ) < 1 ) {
//         add_role( 'custom_role', 'Custom Subscriber', array( 'read' => true, 'level_0' => true ) );
//         update_option( 'custom_roles_version', 1 );
//     }
// }
// add_action( 'init', 'admincolin__update_custom_roles' );











//限制特定用户的WordPress后台查看权限
// function hide_admin_menus() {
// if (current_user_can( 'create_users' )) return;//若是管理员则不执行后续语句，不是管理员则继续执行后续语句
// if (wp_get_current_user()->display_name == "Colin") return; //若当前用户公开显示的名称是Colin,则不执行后续语句。若不是则对管理员用户Admin和Colin以外的以外的用户隐藏下面的菜单内容
// remove_menu_page( 'plugins.php' ); 
// remove_menu_page( 'themes.php' ); 
// remove_menu_page( 'tools.php' ); 
// remove_menu_page( 'users.php' ); 
// remove_menu_page( 'edit.php?post_type=page' ); 
// remove_menu_page( 'options-general.php' );
// remove_menu_page( 'comments.php' );
// }
// add_action( 'admin_menu', 'hide_admin_menus' );











// 条件加载
// if (is_admin()) {
// 	require_once  __DIR__. '这里填写当前主题下的仅供管理员加载的.php内容页面';
// }











//确定插件和内容目录的函数
// echo  plugins_url( __FILE__);//获取当前插件的URI，会具体显示当前.php文件：http://localhost/wordpress/wp-content/plugins/D:/WNMP/Nginx/html/wordpress/wp-content/themes/twentytwentytwo/functions.php
// echo plugin_dir_url( __FILE__);//获取当前插件所在目录的URL，只会显示当前.php文件所在的目录地址：http://localhost/wordpress/wp-content/plugins/D:/WNMP/Nginx/html/wordpress/wp-content/themes/twentytwentytwo/
// echo plugin_dir_path( __FILE__);//获取当前插件的服务器绝对地址：D:\WNMP\Nginx\html\wordpress\wp-content\themes\twentytwentytwo/
// echo plugin_basename(__FILE__);//返回当前插件文件名称(包含文件所在路径):D:/WNMP/Nginx/html/wordpress/wp-content/themes/twentytwentytwo/functions.php


//确定主题内容目录的函数
// echo get_template_directory_uri();//获取当前启用主题的目录：http://localhost/wordpress/wp-content/themes/twentytwentytwo
// echo get_stylesheet_directory_uri();//获取当前启用主题的目录:http://localhost/wordpress/wp-content/themes/twentytwentytwo
// echo get_stylesheet_uri();//获取当前启用主题的主样式表文件地址：http://localhost/wordpress/wp-content/themes/twentytwentytwo/style.css
// echo get_theme_root();//获取当前主题文件所在的目录地址：D:\WNMP\Nginx\html\wordpress/wp-content/themes
// echo get_theme_root_uri();//获取当前主题文件所在的服务器目录地址：http://localhost/wordpress/wp-content/themes
// echo get_theme_roots();//获取主题存放地址的上一级目录地址：/themes
// echo get_stylesheet_directory();//获取： D:\WNMP\Nginx\html\wordpress/wp-content/themes/twentytwentytwo
// echo get_template_directory();//获取： D:\WNMP\Nginx\html\wordpress/wp-content/themes/twentytwentytwo

//确定网站首页
// echo home_url();//获取网站首页服务器地址：http://localhost/wordpress
// echo get_home_path();//没有作用


//确定WordPress的相关地址
// echo admin_url();//输出：http://localhost/wordpress/wp-admin/
// echo site_url();//输出： http://localhost/wordpress
// echo content_url();//输出：http://localhost/wordpress/wp-content
// echo includes_url();//输出： http://localhost/wordpress/wp-includes/
//echo wp_upload_dir();//输出 Array


//确定多站点内容目录
// get_admin_url() 
// get_home_url() 
// get_site_url() 
// network_admin_url() 
// network_site_url() 
// network_home_url()



//限制受限用户删除帖子的权限
// function admincolin_generate_delete_link($content) {
// 	// 只对单页面起作用
// 	if(is_single() && in_the_loop() && is_main_query()) {
// 		//添加查询参数：action,post
// 		$url = add_query_arg(
// 			[
// 				'action' => 'admincolin_frontend_delete',
// 				'post' => get_the_ID(),
// 			], home_url()
// 		);
// 		return $content. '<a href="' . esc_url($url) . '">' . esc_html__('Delete Post', 'admincolin') . '</a>';
// 	}
// 	return null;
// }









// //操作函数
// function admincolin_delete_post() {
// 	if(isset($_GET['action']) && 'admincolin_frontend_delete' === $_GET['action']) {
// 		//确定帖子id
// 		$post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);
// 		//确定有编号为id的帖子
// 		$post = get_post((int)($post_id));
//         echo $post;
// 		if(empty($post)){
// 			return;
// 		}
// 		//删除帖子
// 		wp_trash_post($post_id);
// 		//重定向至管理页面
// 		$redirect = admin_url('edit.php');
// 		wp_safe_redirect($redirect);
// 		//结束
// 		die;
// 	}
// }









// // 添加删除帖子权限
// add_action('plugins_loaded', 'admincolin_add_delete_post_ability');

// function admincolin_add_delete_post_ability() {
// 	if (current_user_can('edit_others_posts')) {
// 		//将删除链接添加至帖子内容结尾
// 		add_filter('the_content', 'admincolin_generate_delete_link');
// 		//将删除链接的需求操作注册到初始化钩子
// 		add_action('init', 'admincolin_delete_post');
// 	}
// }










//数据验证
//PHP内置的验证函数
// isset() 和empty()//用于验证变量是否存在且不为空
// mb_strlen()或strlen()用于检查字符串是否具有预期的字符数
//preg-match(), strpos()用于检查某些字符串在其他字符串中是否出现
// count()用于检查数组中有多少项
// in_array()用于检查数组中是否存在某些东西








//wordpress内置的验证函数
// is_email() 验证邮箱地址是否有效

// term_exists()检查标签、类别或其它分类术语是否存在

// username_exists();////检查用户名是否存在;
// function username(){
// 	if(username_exists('AdminColin1')){
// 		echo 'true';
// 	};//检查用户名是否存在;
// }
// username();

// validate_file()验证输入的文件路径是否为真实路径，但你验证文件是否存在
// function validateFilePath(){
// 	if(validate_file('D:/WNMP/Nginx/html/wordpress/wp-content/themes/twentytwentytwo/functions.php')){
// 		echo 'true';
// 	}
// }
// validateFilePath();


//验证输入sanitizing
// sanitize_email()
// sanitize_file_name()
// sanitize_hex_color()
// sanitize_hex_color_no_hash()
// sanitize_html_class()
// sanitize_key()
// sanitize_meta()
// sanitize_mime_type()
// sanitize_option()
// sanitize_sql_orderby()
// sanitize_text_field()
// sanitize_textarea_field()
// sanitize_title()
// sanitize_title_for_query()
// sanitize_title_with_dashes()
// sanitize_user()
// sanitize_url()
// wp_kses()
// wp_kses_post()












//转义（保护）输出
// esc_attr() – 用于打印到 HTML 元素属性中的所有其他内容。
// esc_html() – 在 HTML 元素包含正在显示的数据部分的任何时候使用。这不会将HTML显示为 HTML（因此<strong>会按原样输出，而不是加粗），它用于在HTML中使用，并将删除您的 HTML。
// esc_js() – 用于内联 Javascript，它转义 javascript 以在<script>标签中使用。
// esc_textarea() - 使用它来编码文本以在 textarea 元素内使用。
// esc_url() – 用于所有 URL，包括HTML 元素的src和属性中的 URL。href
// esc_url_raw() – 在数据库中存储 URL 或其他需要非编码 URL 的情况下使用。
// esc_xml() – 用于转义 XML 块。
// wp_kses() – 用于安全地转义所有不受信任的 HTML（发布文本、评论文本等）。这会将HTML 显示为 HTML（因此<em>将显示为强调的文本）
// wp_kses_post() – 替代版本wp_kses()自动允许帖子内容中允许的所有 HTML。
// wp_kses_data() – 的替代版本wp_kses()只允许帖子评论中允许的 HTML。








// 本地化转义
// esc_html_e( 'Hello World', 'text_domain' );
// // 这上下两种方式功能一样
// echo esc_html( __( 'Hello World', 'text_domain' ) );
//类似的还有
// esc_html__()
// esc_html_e()
// esc_html_x()
// esc_attr__()
// esc_attr_e()
// esc_attr_x()








//自定义转义
// $custom_content = "AdminColin";
// $allowed_html = array(
// 	'a'     => array(
// 		'href' => array(),
// 		'title' => array(),
// 	),
// 	'br' => array(),
// 	'em' => array(),
// 	'strong' => array(),
// );
// echo wp_kses($custom_content, $allowed_html);












//随机数 nonce
//限制受限用户删除帖子的权限+随机数(随机数未见效果)
// function admincolin_generate_delete_link($content) {
// 	// 只对单页面起作用
// 	if(is_single() && in_the_loop() && is_main_query()) {
// 		//添加查询参数：action,post
// 		$url = add_query_arg(
// 			[
// 				'action' => 'admincolin_frontend_delete',
// 				'post' => get_the_ID(),
//                 'nonce' => wp_create_nonce('admincolin_frontend_delete'),
// 			], home_url()
// 		);
// 		return $content. '<a href="' . esc_url($url) . '">' . esc_html__('Delete Post', 'admincolin') . '</a>';
// 	}
// 	return null;
// }

// //操作函数
// function admincolin_delete_post() {
// 	if(isset($_GET['action']) 
// 		&& isset($_GET['nonce'])
// 		&& 'admincolin_frontend_delete' === $_GET['action']
// 		&& wp_verify_nonce($_GET['nonce'], 'admincolin_frontend_delete')) {
// 		//确定帖子id
// 		$post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);
// 		//确定有编号为id的帖子
// 		$post = get_post((int)($post_id));
// 		if(empty($post)){
// 			return;
// 		}
// 		//删除帖子
// 		wp_trash_post($post_id);
// 		//重定向至管理页面
// 		$redirect = admin_url('edit.php');
// 		wp_safe_redirect($redirect);
// 		//结束
// 		die;
// 	}
// }










// // 添加删除帖子权限
// add_action('plugins_loaded', 'admincolin_add_delete_post_ability');

// function admincolin_add_delete_post_ability() {
// 	if (current_user_can('edit_others_posts')) {
// 		//将删除链接添加至帖子内容结尾
// 		add_filter('the_content', 'admincolin_generate_delete_link');
// 		//将删除链接的需求操作注册到初始化钩子
// 		add_action('init', 'admincolin_delete_post');
// 	}
// }











//动作钩子  没出效果
// function admincolin_custom($post_id, $post) {
// 	do_action('save_post', $post->ID, $post);
// 	echo $post_id. "的帖子已经保存成功".$post;
// }
// add_action('save_post', 'admincolin_custom', 10, 103);








//过滤器钩子
// function admincolin_filter_title($title) {
// 	return 'The '. $title. 'was filtered';
// }
// add_filter('the_title', 'admincolin_filter_title');














//给body标签添加类样式admincolin-is-awesome
// function admincolin_add_css_body_class($classes) {
// 	if (!is_admin()) {
// 		$classes[] = 'admincolin-is-awesome';
// 	}
// 	return $classes;
// }
// add_filter('body_class', 'admincolin_add_css_body_class');


















//自定义钩子
//自定义钩子，对于action钩子使用do_action(), 对filter钩子使用apply_filters()


// 管理菜单
//先注册菜单(在外观(主题)菜单中显示菜单选项)
function register_admincolin_menus () {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
			'iextra-menu' =>__('Extra Menu')
		)
		);
}
add_action('init', 'register_admincolin_menus');
//再显示菜单
// wp_nav_menu(array(
// 	'theme_location' => 'header-menu',
// 	'container_class' => 'my_extra_menu_class'
// 	)
// );

// wp_nav_menu(
// 	array(
// 	  'menu' => 'AdminColin',
// 	  // do not fall back to first non-empty menu
// 	  'theme_location' => '__no_such_location',
// 	  // do not fall back to wp_page_menu()
// 	  'fallback_cb' => false
// 	)
//   );


// 为了后续内容，这里添加了php结束标签
?>
















<?php
// 注册自定义的仪表盘主菜单----Admin Options
//创建输出HTML函数

function admincolin_options_page_html() {
	//检查用户权限
	if (!current_user_can('manage_options')) {
		return;
	}
    ?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php
        //为注册设置“Admin Options”设置安全输出字段
        settings_fields( 'admincolin_options' );
        // 输出设置选项和字段，选项和注册字段一一对应
        do_settings_sections( 'admincolin' );
        // 输出设置按钮
        submit_button( __( 'Save Settings', 'textdomain' ) );
        ?>
      </form>
    </div>
    <?php
}
?>

<?php
// 挂钩
function admincolin_options_page () {
	// echo plugin_dir_url(__FILE__);
	echo plugin_dir_path(__FILE__);
	add_menu_page(
		'AdminColin',
		'AdminColin Options',
		'manage_options',
		'admincolin',
		'admincolin_options_page_html',
		plugin_dir_path(__FILE__). 'tools.php', null,
		plugin_dir_path(__FILE__). 'logo.png', 20
	);
}
add_action('admin_menu', 'admincolin_options_page');
?>















<?php
//删除指定的仪表盘菜单
// function admincolin_remove_options_pages() {
// 	remove_menu_page(
// 		'options.php'
// 	);
// }
// add_action('admin_menu','admincolin_remove_options_pages');
?>



















<?php
// 添加一个仪表盘主菜单的下级菜单
function admincolin_options_sub_page() {
	// add_submenu_page(
	// 	'index.php',//在dashboard下添加子菜单
	// 	'AdminColinsub Options',
	// 	'AdminColinsub Options',
	// 	'manage_options',
	// 	'admincolin',
	// 	'admincolin_options_page_html'
	// );

	add_dashboard_page(//在dashboard添加子菜单
		'AdminTitle',
		'AdminMenu',
		'manage_options',
		'admincolin_options_page_html',
		null
	);
}
add_action('admin_menu', 'admincolin_options_sub_page');

//其他菜单添加子菜单的方法
// add_dashboard_page() –index.php
// add_posts_page() –edit.php
// add_media_page() –upload.php
// add_pages_page() –edit.php?post_type=page
// add_comments_page() ——edit-comments.php
// add_theme_page() –themes.php
// add_plugins_page() –plugins.php
// add_users_page() –users.php
// add_management_page() –tools.php
// add_options_page() –options-general.php
// add_options_page() –settings.php
// add_links_page() – link-manager.php– 自 WP 3.5+ 起需要插件
// 自定义帖子类型 -edit.php?post_type=wporg_post_type
// 网络管理员 –settings.php






















//简码---没有效果
function admincolin_shortcode($atts = [], $content = null, $tag = '') {
	// 规范化属性键，小写
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	//用用户属性覆盖默认属性
	$admincolin_atts = shortcode_atts(
		array(
			'title' => 'WordPress 简码',
		), $atts, $tag
	);
	//开始div
	$outPut = '<div class="admincolin-box">';
	//title
	$outPut .='<h2>' . esc_html__($admincolin_atts['title'], 'admincolin') . '</h2>';
	//闭合标签
	if (! is_null($content)) {
		$outPut .= apply_filters('the_content', $content);
		$outPut = do_shortcode($outPut);
	}
	//结束div
	$outPut .= '</div>';
	//返回输出
	return $outPut;
}
//创建所有简码的中心位置
function admincolin_shortcodes_init() {
	add_shortcode('admincolin', 'admincolin_shortcode');
}

add_action('init', 'admincolin_shortcodes_init');



















//仪表盘设置菜单里的选项设置
//以在“阅读”选项内添加设置选项为例
function admincolin_settings_init() {
    // 为“阅读”页面注册一个“AdminColin”设置
    register_setting('reading', 'admincolin_setting_name');
 
    // 在“阅读”页面注册新版块
    add_settings_section(
        'admincolin_settings_section',
        'AdminColin Settings Section', 'admincolin_settings_section_callback',
        'reading'
    );
 
    // 在“阅读”页面的设置板块注册一个新字段
    add_settings_field(
        'admincolin_settings_field',
        'AdminColin Setting', 'admincolin_settings_field_callback',
        'reading',
        'admincolin_settings_section'
    );
}
 
/**
 * 挂钩
 */
add_action('admin_init', 'admincolin_settings_init');
 
/**
 * 回调函数
 */
 
// 板块内容回调函数
function admincolin_settings_section_callback() {
    echo '<p>AdminColin Section Introduction.</p>';
}
 
// 字段内容回调函数
function admincolin_settings_field_callback() {
    // 获取为新注册的设置选项设置的值
    $setting = get_option('admincolin_setting_name');
    // 输出字段
    ?>
    <input type="text" name="admincolin_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

?>
















<?php

// 保存元框的HTML函数
function admincolin_custom_box_html($post) {
	$value = get_post_meta($post->ID, 'admincolin-meta_key', true);
?>

	<label for="admincolin_field">字段描述</label>
	<select name="admincolin_field" id="admincolin_field" class="postbox">
		<option value="">请选择。。。</option>
		<option value="something" <?php selected($value, 'something'); ?>>something</option>
		<option value="else" <?php selected($value, 'else'); ?>>Else</option>
	</select>

<?php 
}
?>

<?php
// function admincolin_add_custom_meta_box() {
// 	$screens = ['post', 'admincolin_cpt'];
// 	foreach ($screens as $screen) {
// 		add_meta_box(
// 			'admincolin_box_id',//唯一ID
// 			'Custom Meta Box Title',//用户元盒标题
// 			'admincolin_custom_box_html',
// 			$screen//帖子类型
// 		);
// 	}
// }
// add_action('add_meta_boxes', 'admincolin_add_custom_meta_box');

//保存元值,用phpMyAdmin查看数据库变化
// function admincolin_save_postdata($post_id) {
// 	if(array_key_exists('admincolin_field', $_POST)) {
// 		update_post_meta(
// 			$post_id,
// 			'_admincolin_meta_key',
// 			$_POST['admincolin_field']
// 		);
// 	} 
// }
// add_action('save_post', 'admincolin_save_postdata',10);

// function admincolin_remove_custom_meta_box(){
// 	$screens = ['post', 'admincolin_cpt'];
// 	foreach($screens as $screen){
// 		remove_meta_box(
// 			'admincolin_box_id',
// 			'Custom Meta Box Title',
// 			'admincolin_custom_box_html',
// 			$screen
// 		);
// 	}
// }
// //挂钩不明，不知道钩在哪个操作上
// add_action('save_post', 'admincolin_remove_custom_meta_box',20);
?>













<?php
// 用面向对象的方式添加元值
	abstract class AdminColin_meta_box
	{
		//设置和添加元值
		public static function admincolin_add_meta_box() {
			$screens= ['post', 'admincolin_cpt'];
			foreach ($screens as $screen) {
				add_meta_box(
					'admincolin_box_id',//唯一ID
					'Custom Meta Box Title',//元框标题
					[self::class, 'admincolin_display_meta_box_html_to_user'],//内容回调，必须是可回调类型
					$screen//帖子类型
				);
			}
		}

		//保存元值
		//所需参数 $post_id
		public static function admincolin_save_meta_key(int $post_id) {
			if (array_key_exists('admincolin_field', $_POST)) {
				update_post_meta(
					$post_id,
					'_admincolin_meta_key',
					$_POST['admincolin_field']
				);
			}
		}

		//向用户展示元框HTML
		//参数:$post帖子对象
		public static function admincolin_display_meta_box_html_to_user($post) {
			$value = get_post_meta($post->ID, '_admincolin_meta_key', true);
			?>

			<label for="admincolin_field">字段描述</label>
			<select name="admincolin_field" id="admincolin_field" class="postbox">
				<option value="">请选择。。。</option>
				<option value="something" <?php selected($value, 'something'); ?>>something....</option>
				<option value="else" <?php selected($value, 'else'); ?>>Else....</option>
			</select>
			<?php
		}

	}
	add_action('add_meta_boxes', ['AdminColin_meta_box', 'admincolin_add_meta_box']);
	add_action('save_post', ['AdminColin_meta_box', 'admincolin_save_meta_key']);

?>



<?php 
// WordPress 带有五种默认帖子类型：post、page、attachment、revision和menu。
	//注册一个名为admincolin_services的新帖子类型
function admincolin_new_post_type () {
    register_post_type(
        'admincolin_services',
        array(
            'labels'                =>  array(
                'name'              =>  __('Colin_Services', 'textdomain'),
                'singular_name'     =>  __('Colin_Service', 'textdomain'),
            ),
            'public'                =>  true,
            'has_archive'           =>  true,
            'rewrite'               => array('slug' => 'services')//自定义slug
        ),
    );
}
add_action('init', 'admincolin_new_post_type');
?>



<?php 
//按帖子类型查询
    $args = array(
        'post_type'       => 'admincolin_services',
        'post_per_page'   => 10,
    );
    $loop = new WP_Query($args);
    while ( $loop -> have_posts()) {
        $loop -> the_post();
    ?>
    <div class="entry-content">
         <?php the_title(); ?>
         <?php the_content(); ?>
         <?php the_excerpt(); ?>
    </div>
    <?php 
    }
?>



<?php 
	//将自定义类型(admincolin_services)的帖子和其他类型的帖子混合显示在主页上显示

    function admincolin_add_custom_post_types($query) {
        if (is_home() && $query -> is_main_query()) {
            $query -> set('post_type', array('post', 'page', 'admincolin_services'));
        }
        return $query;
    }
    add_action('pre_get_posts', 'admincolin_add_custom_post_types');
?>









<?php 
//新建的“Course”分类还不能像默认分类那样整理同一类别的文章---需要修改主题模板内容
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
			'show_in_rest'             => true,
            'query_var'                => true,
            'rewrite'                  => ['slug' => 'course'],
        );
        register_taxonomy('course', ['post'], $args);
    }
    add_action('init', 'admincolin_register_child_taxonomy_course_for_post');
?>





<?php 
//用编程方式创建新用户--方法1
$user_name ='AdminColin01';
$user_email = 'm52099m@162.com';
$random_password= md5('123456');
$user_id = username_exists($user_name);
if (!$user_id && email_exists($user_email) === false) {
    $random_password = wp_generate_password(12,false);
    $user_id = wp_create_user(
        $user_name,
        $random_password,
        $user_email
    );
}

?>


<?php 
//用编程方式创建新用户--方法2
function admincolin_create_new_user_account($user_name, $user_email, $random_password){
    $user_id = username_exists($user_name);
    if (!$user_id && email_exists($user_email) === false) {
        $random_password = wp_generate_password(12,false);
        $user_id = wp_create_user(
            $user_name,
            $random_password,
            $user_email
        );
    }
}
$user_name ='AdminColin06';
$user_email = 'm52099m@166.com';
$random_password= md5('123456');
admincolin_create_new_user_account($user_name, $user_email, $random_password);
?>



<?php 
// 更新用户信息
$user_id = 8;
$website = 'https://wpscale.cn';

$user_id = wp_update_user(
    array(
        'ID'       => $user_id,
        'user_url' => $website,
    )
    );

    if (is_wp_error($user_id)) {
        echo 'error';
    }else {
        echo 'success';
    }
?>




<?php 
// 删除用户
$user_id                =   7;
$user_info              =   get_userdata( $user_id );
$this_user_roles        =   $user_info->roles;

//For wp_delete_user() function
require_once(ABSPATH.'wp-admin/includes/user.php' );

if( in_array( "administrator", $this_user_roles) ) {
    echo "管理员不可被删除！";
} else {
    if( wp_delete_user( $user_id ) ){
        echo "指定用户已成功删除 :)";
    } else {
        echo "删除用户时出错！";
    }
}
?>















<?php 
// 用户元数据(usermeta)管理----进入指定用户的个人编辑界面看效果，
function admincolin_usermeta_form_field_birthday( $user) { ?>
<h3>It's your Birthday</h3>
<table class="form-table">
    <tr>
        <th>
            <label for="birthday">Birthday</label>
        </th>
    </tr>
    <td>
        <input type="date" 
                class="regular-text ltr" 
                id="birthday"
                name="birthday"
                value="<?php esc_attr(get_user_meta($user->ID,'birthday', true))?>"
                title="Please use YYYY-MM-DD as the date formate."
                pattern="(19[0-9][0-9]|20[0-9])-(1[0-2]|0[1-9])-(3[01][21][0-9]|0[1-9])" required />
        <p class="description">
            Please enter your birthday date.
        </p>
    </td>
</table>
<?php } 

function admincolin_usermeta_form_field_birthday_update($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    //
    return update_user_meta(
        $user_id,
        'birthday',
        $_POST['birthday']
    );
}

add_action(
    'show_user_profile',
    'admincolin_usermeta_form_field_birthday'
);

add_action(
    'edit_user_profile',
    'admincolin_usermeta_form_field_birthday'
);
add_action(
    'personal_options_update',
    'admincolin_usermeta_form_field_birthday_update'
);

add_action(
    'edit_user_profile_update',
    'admincolin_usermeta_form_field_birthday_update'
)

?>









<?php 
//为用户添加元值
// add_user_meta(
//     int $user_id,
//     string $meta_key,
//     mixed $meta_value,
//     bool $unique = false
// );
add_user_meta(
    2,
    'metakeycolin',
    'colinaddmeta',
    true
);



//为用户更新元值信息
// update_user_meta(
//     int $user_id,
//     string $meta_key,
//     mixed $meta_value,
//     mixed $prev_value = ''
// );

update_user_meta(
    2,
    'metakeycolin',
    'colinaddmeta01',
    'colinaddmeta'
);


// 为用户删除元值
// delete_user_meta(
//     int $user_id,
//     string $meta_key,
//     mixed $meta_value = ''
// );

delete_user_meta(
    2,
    'metakeycolin',
    'colinaddmeta01'
);



// 获得用户元值信息
// get_user_meta(
//     int $user_id,
//     string $key = '',
//     bool $single = false
// );

echo 
get_user_meta(
    2,
    'metakeycolin',
     false
);


?>








<?php 
//添加受限权限用户
    function admincolin_simple_role() {
        add_role(
            '一般编辑用户',
            '一般编辑用户',
            array(
                'read'         => true,
                'edit_post'    => true,
                'upload_files' => true,
            ),
        );
    }
    add_action('init', 'admincolin_simple_role');
?>


<?php 
//添加受限权限用户
function admincolin_simple_role_remove() {
    remove_role('simple_role');
}

add_action('init', 'admincolin_simple_role_remove');
?>