<?php 
if (!defined('ABSPATH') && !current_user_can('manage_options')) exit; 
// $this -> custom_assets();
?>

<!-- 插件设置页面标题配置 -->
<div class="wrap exchange_post_page_type_settings">
    <?php 
        // $this -> load_help_desk();
    ?>
    <h1>
        <!-- 显示转义文本：_e() -->
        <?php _e('交换文章和页面类型', 'exchange-post-page-type')?>
        <a href="https://bdtdl.xyz" target="_blank" class="button button-primary"><?php _e('去作者主页', 'exchange-post-page-type'); ?></a>
    </h1>
</div>


<?php 
$message = isset($_GET['message']) ? intval($_GET['message']) : '';//isset() 判断当前变量是否存在且不为null
if (current_user_can('manage_options') 
    && isset($_POST['submit_duplicate_post_and_page']) 
    && wp_verify_nonce(sanitize_text_field($_POST['duplicatepostandpage_nonce_field']), 'duplicatepostandpage_action')){
       _e('<div class="saving-txt"><strong>保存中...请稍候...</strong></div>', 'exchange-post-page-type');
       //获取用户选择的插件配置页配置参数
        $duplicatepostandpageoptions = array(
            'exchange_post_page_type_postType' => sanitize_text_field(htmlentities($_POST['exchange_post_page_type_postType']))
        );

       $saveSettings = update_option('exchange_post_page_type_options', $duplicatepostandpageoptions);

       if ($saveSettings) {
        exchange_post_and_page_type::admincolin_redirect('options-general.php?page=exchange_post_page_type_settings&message=1');
       }
       else {
        exchange_post_and_page_type::admincolin_redirect('options-general.php?page=exchange_post_page_type_settings&message=2');
       }
}


$opt = get_option('exchange_post_page_type_options');

if (!empty($message) && $message == 1) {
    _e(
        '<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated">
            <p><strong>配置保存成功!</strong></p>
            <button class="notice-dismiss button-custom-dismiss" type="button">
                <span class="screen-reader-text">忽略提醒</span>
            </button>
        </div>
    ', 'exchange-post-page-type');
}

elseif (!empty($message) && $message == 2) {
    _e(
        '<div class="error settings-error notice is-dismissible" id="setting-error-settings_updated">
            <p><strong>配置保存失败:(!</strong></p>
            <button class="notice-dismiss button-custom-dismiss" type="button">
                <span class="screen-reader-text">忽略提醒</span>
            </button>
        </div>
    ', 'exchange-post-page-type');
}
?>


<div id="poststuff">
    <div id="body" class="metabox-holder columns-2">
        <div id="post-body-content" style="position: relative;">
            <form action="#" method="post" name="exchange_post_page_type_form">
                <?php 
                    wp_nonce_field('duplicatepostandpage_action', 'duplicatepostandpage_nonce_field'); 
                ?>
                <table class="form-table">
                    <tbody> 
                        <tr>
                            <th scope="row">
                                <label for="exchange_post_page_type_postType">
                                    <?php _e('选择新帖子的类型', 'exchange-post-page-type'); ?>
                                </label>
                            </th>
                            <td>
                                <select name="exchange_post_page_type_postType" id="exchange_post_page_type_postType">
                                    <option value="post" <?php echo (isset($opt['exchange_post_page_type_postType']) 
                                    && $opt['exchange_post_page_type_postType'] == 'post') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('文章类型', 'exchange-post-page-type'); ?>
                                    </option>

                                    <option value="page" <?php echo (isset($opt['exchange_post_page_type_postType']) 
                                    && $opt['exchange_post_page_type_postType'] == 'page') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('页面类型', 'exchange-post-page-type'); ?>
                                    </option>
                                </select>
                                <p>
                                    <?php _e('请选择新帖子的类型.<strong>默认：</strong>文章类型', 'exchange-post-page-type'); ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" value="<?php _e('保存更改', 'exchange-post-page-type'); ?>" class="button button-primary" id="submit" name="submit_duplicate_post_and_page">
                </p>
            </form>
        </div>
    </div>
</div>