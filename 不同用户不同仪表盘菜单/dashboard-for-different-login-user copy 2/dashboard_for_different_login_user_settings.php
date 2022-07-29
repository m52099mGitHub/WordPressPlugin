<?php if (!defined('ABSPATH') && !current_user_can('manage_options')) {
    exit;
} ?>

<style>
    .config-title {
        padding: 0;
        margin: 0;
        position: relative;
        /* display: table-cell; */
        text-align: center;
        vertical-align: middle;
        width: 1080x;
        border-width: 1px;
        border-color: #DDD;
        border-style: solid;
    }

    .go-author-page {
        padding: 0;
        margin: 0;
        text-align: center;
    }

    .config-box {
        display: inline-block;
        width: 710px;
        border-width: 1px;
        border-color: #DDD;
        border-style: solid;
    }

    #form-table tr th {
        width: 400px;
        text-align: left;
    }

    #form-table tr td {
        float: right;
    }

    #form-table tr td select {
        border: 1px solid black;
        text-align: left;
        width: 150px;
        margin: 10px 0;
        margin-left: 160px;
    }

    #form-table tr td input {
        border: 1px solid black;
        text-align: left;
        width: 150px;
        margin: 10px 0;
        margin-left: 160px;
    }

    #tip {
        display: none;
    }
</style>


<?php
$message = isset($_GET['message']) ? intval($_GET['message']) : '';
// echo gettype($message);
// echo $message . '123';
// var_dump($message);
// print_r($message);

if (current_user_can('manage_options') && isset($_POST['submit-dashboard-for-different-login-user-page']) && wp_verify_nonce(sanitize_text_field($_POST['dashboard_for_different_login_user_nonce_field']), 'dashboardfordifferentloginuser_action')) {

    // var_dump($_POST['userRole']);die;
    // if (current_user_can('manage_options')) {
    //获取表单提交的内容
    _e('<div class="saving-txt"><strong>Saving Please wait...</strong></div>', 'duplicate-page');
    $setdisplayitemforuseroptions = array(
        'userRole' => sanitize_text_field(htmlentities($_POST['userRole'])),
        'postMenu' => sanitize_text_field(htmlentities($_POST['postMenu'])),
        'mediaMenu' => sanitize_text_field(htmlentities($_POST['mediaMenu'])),
        'pageMenu' => sanitize_text_field(htmlentities($_POST['pageMenu'])),
        'commentMenu' => sanitize_text_field(htmlentities($_POST['commentMenu'])),
        'appearanceMenu' => sanitize_text_field(htmlentities($_POST['appearanceMenu'])),
        'pluginMenu' => sanitize_text_field(htmlentities($_POST['pluginMenu'])),
        'userMenu' => sanitize_text_field(htmlentities($_POST['userMenu'])),
        'toolMenu' => sanitize_text_field(htmlentities($_POST['toolMenu'])),
        'settingMenu' => sanitize_text_field(htmlentities($_POST['settingMenu']))
    );
    // print_r($setdisplayitemforuseroptions);
    //存储表单获取的内容（$setdisplayitemforuseroptions）以名称"'当前输入的用户名'_set_display_item_for_user_options"的形式存储到数据库options表中,并返回布尔值
    $saveSettings = update_option($_POST['userRole'] . '_set_display_item_for_user_options', $setdisplayitemforuseroptions);
    // echo gettype($saveSettings);
    // echo "保存值为".$saveSettings."<br>";
    // print_r($saveSettings);
    if ($saveSettings) {
        dashboard_menu_adjust::admincolin_dashboard_refresh_redirect('tools.php?page=dashboard_add_settings_page&message=1');
        // echo "Hello Save 1";
    } else {
        dashboard_menu_adjust::admincolin_dashboard_refresh_redirect('tools.php?page=dashboard_add_settings_page&message=2');
        // echo "Hello Save 2";
    }
}
// else{
//     echo "失败！";
// }
// 获取当前登录用户信息
$currentUserInfo = wp_get_current_user();
// 获取当前登录用户的用户名
$currentUserName = $currentUserInfo->user_login;
//从数据库获取用户的菜单配置信息
$opt = get_option($currentUserName . '_set_display_item_for_user_options');
// 判断设置选项是否获取成功
// if ($opt) {
//     echo '<br>' . "设置选项获取成功" . '<br>' . implode('<br>', $opt);
// } else {
//     echo '<br>' . "设置选项获取失败" . '<br>';
// }

if (!empty($message) && $message == 1) {
    // echo "Hello 123";
    _e(
        '<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated">
                <p><strong>授权成功:)!</strong></p>
                <button class="notice-dismiss button-custom-dismiss" type="button">
                    <span class="screen-reader-text">忽略提醒</span>
                </button>
         </div>',
        'dashboard-for-different-login-user'
    );
} elseif (!empty($message) && $message == 2) {
    // echo "Hello 456";
    _e(
        '<div class="error settings-error notice is-dismissible" id="setting-error-settings_updated">
                <p><strong>授权失败:(!</strong></p>
                <button class="notice-dismiss button-custom-dismiss" type="button">
                    <span class="screen-reader-text">忽略提醒</span>
                </button>
            </div>',
        'dashboard-for-different-login-user'
    );
}

$opt = get_option($currentUserName . '_set_display_item_for_user_options');
// print_r($opt);
// //获取输入的用户名
$userNameInput = $opt['userRole'];
$userInfo = new WP_User($userNameInput);
    //获取用户ID
    $userId = $userInfo->ID;
    //获取用户的角色信息
    $userRole = $userInfo->roles;
    //获取用户等级信息
    $userLevel = $userInfo->user_level;




?>

<div class="wrap duplicate_page_settings">
    <!-- 插件设置页标题 -->
    <div style="width: 1080px; height:30px;"></div>
    <div class="config-title">
        <h1>
            <?php _e('用户仪表盘界面授权', 'dashboard-for-different-login-user'); ?>
        </h1>
        <p class="go-author-page">
            <a href="https://wpscale.cn" target="_blank" class="button button-primary"><?php _e('Go To Author Page', 'dashboard-for-different-login-user') ?></a>
        </p>
        <div id="config-box" class="config-box">
            <div id="form-content">
                <form action="" method="post" name="dashboard_for_different_login_user_form">
                    <?php
                    wp_nonce_field('dashboardfordifferentloginuser_action', 'dashboard_for_different_login_user_nonce_field');
                    ?>
                    <table id="form-table">
                        <tr>
                            <th style="border: 1px;">
                                <h3 style="padding:0; margin:0;"><?php _e('请输入用户名', 'dashboard-for-different-login-user') ?>User Name</h3>
                                <span style="margin-left: 20px;font-size: 12px; color: red;">必须是已注册用户</span>
                            </th>
                            <td>
                                <input id="userRole" name="userRole" type="text" value="请输入已注册用户名">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <h3 style="padding:0; margin:0;"><?php _e('请选择(不)显示)', 'dashboard-for-different-login-user') ?>Menu Display Settings</h3>
                            </th>
                        </tr>
                        <tr>
                            <th>1. <?php _e('文章', 'dashboard-for-different-login-user') ?>Post Menu</th>
                            <td>
                                <select name="postMenu" id="post-menu">
                                    <option value="No_Display" <?php echo (isset($opt['postMenu'])
                                                                    && $opt['postMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['postMenu'])
                                                                    && $opt['postMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>2. <?php _e('媒体', 'dashboard-for-different-login-user') ?>Media(Upload) Menu</th>
                            <td>
                                <select name="mediaMenu" id="media-menu">
                                    <option value="No_Display" <?php echo (isset($opt['mediaMenu'])
                                                                    && $opt['mediaMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['mediaMenu'])
                                                                    && $opt['mediaMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>3. <?php _e('页面', 'dashboard-for-different-login-user') ?>Page Menu</th>
                            <td>
                                <select name="pageMenu" id="page-menu">
                                    <option value="No_Display" <?php echo (isset($opt['pageMenu'])
                                                                    && $opt['pageMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['pageMenu'])
                                                                    && $opt['pageMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>4. <?php _e('评论', 'dashboard-for-different-login-user') ?>Comment Menu</th>
                            <td>
                                <select name="commentMenu" id="comment-menu">
                                    <option value="No_Display" <?php echo (isset($opt['commentMenu'])
                                                                    && $opt['commentMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['commentMenu'])
                                                                    && $opt['commentMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>5. <?php _e('外观', 'dashboard-for-different-login-user') ?>Appearance Menu</th>
                            <td>
                                <select name="appearanceMenu" id="appearance-menu">
                                    <option value="No_Display" <?php echo (isset($opt['appearanceMenu'])
                                                                    && $opt['appearanceMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['appearanceMenu'])
                                                                    && $opt['appearanceMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>6. <?php _e('插件', 'dashboard-for-different-login-user') ?>Plugin Menu</th>
                            <td>
                                <select name="pluginMenu" id="plugin-menu">
                                    <option value="No_Display" <?php echo (isset($opt['pluginMenu'])
                                                                    && $opt['pluginMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['pluginMenu'])
                                                                    && $opt['pluginMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>7. <?php _e('用户', 'dashboard-for-different-login-user') ?>User Menu</th>
                            <td>
                                <select name="userMenu" id="user-menu">
                                    <option value="No_Display" <?php echo (isset($opt['userMenu'])
                                                                    && $opt['userMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['userMenu'])
                                                                    && $opt['userMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>8. <?php _e('工具', 'dashboard-for-different-login-user') ?>Tool Menu</th>
                            <td>
                                <select name="toolMenu" id="tool-menu">
                                    <option value="No_Display" <?php echo (isset($opt['toolMenu'])
                                                                    && $opt['toolMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['toolMenu'])
                                                                    && $opt['toolMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>9. <?php _e('设置', 'dashboard-for-different-login-user') ?>Setting Menu</th>
                            <td>
                                <select name="settingMenu" id="setting-menu">
                                    <option value="No_Display" <?php echo (isset($opt['settingMenu'])
                                                                    && $opt['settingMenu'] == 'No_Display') ? "selected = 'selected'" : ''; ?>><?php _e('不显示'); ?>(No-Display)</option>
                                    <option value="Yes_Display" <?php echo (isset($opt['settingMenu'])
                                                                    && $opt['settingMenu'] == 'Yes_Display') ? "selected = 'selected'" : ''; ?>><?php _e('显示'); ?>(Yes-Display)</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <p style="float: right;">
                        <input class="button button-primary" name="submit-dashboard-for-different-login-user-page" type="submit" value="<?php _e('保存', 'dashboard-for-different-login-user') ?>">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // var userNameInput = document.getElementById('userRole').value;
    // alert(userNameInput);
</script>