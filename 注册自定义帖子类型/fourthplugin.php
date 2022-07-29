<?php 
/**
 * @package AdminColin's Forth plugin
 * @version 1.0.0 
*/

/**
 * Plugin name: AdminColin's Forth plugin
 * Description: This is a plugin function test file
 * Version: 1.0.0
 * Author: AdminColin
*/


/**
*注册用户自定义帖子类型--book
*/

function admincolin_pluginprefix_setup_post_type() {
    register_post_type( 'book', ['public' => true] );
}

add_action('init', 'admincolin_pluginprefix_setup_post_type');
/**
 * 激活插件
 */
function admincolin_pluginprefix_activate() {
    admincolin_pluginprefix_setup_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'admincolin_pluginprefix_activate');

/**
 * 停用插件
 */
function admincolin_pluginprefix_deactivate() {
    unregister_post_type('book');
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'admincolin_pluginprefix_deactivate');


/**
 * 卸载插件
 */
function admincolin_pluginprefix_uninstall() {
    echo "删除成功！";
}
register_uninstall_hook(__FILE__, 'admincolin_pluginprefix_uninstall');

//PHP 常用的验证实体的函数：isset(数组，对象等)
//PHP 常用的验证实体的函数：function_exists('函数')
//PHP 常用的验证实体的函数：class_exists('类')
//PHP 常用的验证实体的函数：define(定义常量)

//没有admincolin_init函数时创建该函数
// if ( !function_exists('admincolin_init')) {
//     function admincolin_init() {
//         echo '函数创建成功！函数创建成功！函数创建成功！函数创建成功！';
//         register_setting('admincolin_setting', 'admincolin_option_foo');
//     }

//     admincolin_init();
// }
// add_action('admin_menu','admincolin_init');


//用类来避免命名冲突---面向对象编程
// if (!class_exists('AdminColin_Plugin')) {
//     class AdminColin_Plugin
//     {
//         public static function init() {
//             register_setting('admincolin_seeting', 'admincolin_option_foo');
//             echo "函数init注册成功! 函数init注册成功! 函数init注册成功!";
//         }

//         public static function get_foo() {
//             return get_option('admincolin_option_foo');
//             echo "函数get_foo注册成功! 函数get_foo注册成功! 函数get_foo注册成功!";
//         }
//     }
//     AdminColin_plugin::init();//用类的方法调用类里面的函数
//     AdminColin_Plugin::get_foo();
// }




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










// //限制受限用户删除帖子的权限+随机数(随机数未见效果)
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



// function admincolin_export_user_data_by_email($email_address, $page = 1){
//     $number = 500;//超时限制
//     $page = (int)$page;
//     $export_items = array();
//     $comments = get_comments(
//         array(
//             'author_email' => $email_address,
//             'number'       => $number,
//             'paged'        => $page,
//             'order_by'     => 'comment_ID',
//             'order'        => 'ASC',
//         )
//     );

// foreach ((array) $comments as $comment) {
//     $latitude = get_comment_meta($comment -> comment_ID, 'latitude', true);
//     $longitude = get_comment_meta($comment -> comment_ID, 'longitude', true);

//     if (!empty($latitude)) {
//         $item_id = 'comment-{$comment -> comment_ID}';
//     }
// }

// }

?>







<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function admincolin_settings_init() {
    // Register a new setting for "admincolin" page.
    register_setting( 'admincolin', 'admincolin_options' );
 
    // Register a new section in the "admincolin" page.
    add_settings_section(
        'admincolin_section_developers',
        __( 'The Matrix has you.', 'admincolin' ), 'admincolin_section_developers_callback',
        'admincolin'
    );
 
    // Register a new field in the "wporg_section_developers" section, inside the "admincolin" page.
    add_settings_field(
        'admincolin_field_pill', // As of WP 4.6 this value is used only internally.
                                // Use $args' label_for to populate the id inside the callback.
            __( 'Pill', 'admincolin' ),
        'admincolin_field_pill_cb',
        'admincolin',
        'admincolin_section_developers',
        array(
            'label_for'         => 'admincolin_field_pill',
            'class'             => 'admincolin_row',
            'admincolin_custom_data' => 'custom',
        )
    );
}
 
/**
 * Register our wporg_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'admincolin_settings_init' );
 
 
/**
 * Custom option and settings:
 *  - callback functions
 */
 
 
/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function admincolin_section_developers_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'admincolin' ); ?></p>
    <?php
}
 
/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function admincolin_field_pill_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'admincolin_options' );
    ?>
    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['admincolin_custom_data'] ); ?>"
            name="admincolin_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'red pill', 'admincolin' ); ?>
        </option>
        <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'blue pill', 'admincolin' ); ?>
        </option>
    </select>
    <p class="description">
        <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'admincolin' ); ?>
    </p>
    <p class="description">
        <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'admincolin' ); ?>
    </p>
    <?php
}
 
/**
 * Add the top level menu page.
 */
function admincolin_options_page() {
    add_menu_page(
        'AdminColin',
        'AdminColin Options',
        'manage_options',
        'admincolin',
        'admincolin_options_page_html'
    );
}
 
 
/**
 * Register our wporg_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'admincolin_options_page' );
 
 
/**
 * Top level menu callback function
 */
function admincolin_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // add error/update messages
 
    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'admincolin_messages', 'admincolin_message', __( 'Settings Saved', 'admincolin' ), 'updated' );
    }
 
    // show error/update messages
    settings_errors( 'admincolin_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "admincolin"
            settings_fields( 'admincolin' );
            // output setting sections and their fields
            // (sections are registered for "admincolin", each field is registered to a specific section)
            do_settings_sections( 'admincolin' );
            // output save settings button
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}
?>

















