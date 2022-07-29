<?php 
//注册自定义的Admin菜单

// function admin_options_page () {
// 	echo plugin_dir_url(__FILE__);
// 	add_menu_page(
// 		'Admin',
// 		'Admin Options',
// 		'manage_options',
// 		'admin',
// 		plugin_dir_url(__FILE__). 'logo.png', 20
// 	);
// }
// add_action('admin_menu', 'admin_options_page');
?>


<?php 
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
