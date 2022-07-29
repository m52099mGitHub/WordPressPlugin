<?php 
if (!defined('ABSPATH') && !current_user_can('manage_options')) exit; 
// $this -> custom_assets();
?>

<!-- 插件设置页面标题配置 -->
<div class="wrap duplicate_post_and_page_settings">
    <?php 
        // $this -> load_help_desk();
    ?>
    <h1>
        <!-- 显示转义文本：_e() -->
        <?php _e('复制文章页面设置页', 'duplicate-post-and-page')?>
        <a href="https://bdtdl.xyz" target="_blank" class="button button-primary"><?php _e('去作者主页', 'duplicate-post-and-page'); ?></a>
    </h1>
</div>

<?php 
$message = isset($_GET['message']) ? intval($_GET['message']) : '';//isset() 判断当前变量是否存在且不为null
if (current_user_can('manage_options') 
    && isset($_POST['submit_duplicate_post_and_page']) 
    && wp_verify_nonce(sanitize_text_field($_POST['duplicatepostandpage_nonce_field']), 'duplicatepostandpage_action')){
       _e('<div class="saving-txt"><strong>保存中...请稍候...</strong></div>', 'duplicate-post-and-page');
       //获取用户选择的插件配置页配置参数
        $duplicatepostandpageoptions = array(
            //htmlentities() 将所有适用的字符转换为HTML实体

            'duplicate_post_and_page_editor' => sanitize_text_field(htmlentities($_POST['duplicate_post_and_page_editor'])),

            'duplicate_post_and_page_status' => sanitize_text_field(htmlentities($_POST['duplicate_post_and_page_status'])),

            'duplicate_post_and_page_redirect' => sanitize_text_field(htmlentities($_POST['duplicate_post_and_page_redirect'])),

            'duplicate_post_and_page_suffix' => sanitize_text_field(htmlentities($_POST['duplicate_post_and_page_suffix'])),

            'duplicate_post_and_page_postType' => sanitize_text_field(htmlentities($_POST['duplicate_post_and_page_postType']))
        );

       $saveSettings = update_option('duplicate_page_and_post_options', $duplicatepostandpageoptions);

       if ($saveSettings) {
            duplicate_post_and_page::admincolin_redirect('options-general.php?page=duplicate_post_and_page_settings&message=1');
       }
       else {
            duplicate_post_and_page::admincolin_redirect('options-general.php?page=duplicate_post_and_page_settings&message=2');
       }
}


$opt = get_option('duplicate_page_and_post_options');

if (!empty($message) && $message == 1) {
    _e(
        '<div class="updated settings-error notice is-dismissible" id="setting-error-settings_updated">
            <p><strong>配置保存成功!</strong></p>
            <button class="notice-dismiss button-custom-dismiss" type="button">
                <span class="screen-reader-text">忽略提醒</span>
            </button>
        </div>
    ', 'duplicate-post-and-page');
}

elseif (!empty($message) && $message == 2) {
    _e(
        '<div class="error settings-error notice is-dismissible" id="setting-error-settings_updated">
            <p><strong>配置保存失败:(!</strong></p>
            <button class="notice-dismiss button-custom-dismiss" type="button">
                <span class="screen-reader-text">忽略提醒</span>
            </button>
        </div>
    ', 'duplicate-post-and-page');
}
?>


<div id="poststuff">
    <div id="body" class="metabox-holder columns-2">
        <div id="post-body-content" style="position: relative;">
            <form action="#" method="post" name="duplicate_post_and_page_form">
                <?php 
                    wp_nonce_field('duplicatepostandpage_action', 'duplicatepostandpage_nonce_field'); 
                ?>
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="duplicate_post_and_page_editor">
                                    <?php _e('选择编辑器', 'duplicate-post-and-page'); ?>
                                </label>
                            </th>
                            <td>
                                <select name="duplicate_post_and_page_editor" id="duplicate_post_and_page_editor">
                                    <option value="all" <?php echo (isset($opt['duplicate_post_and_page_editor']) 
                                    && $opt['duplicate_post_and_page_editor'] == 'all') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('所有编辑器', 'duplicate-post-and-page'); ?>
                                    </option>

                                    <option value="classic" <?php echo (isset($opt['duplicate_post_and_page_editor']) 
                                    && $opt['duplicate_post_and_page_editor'] == 'classic') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('经典编辑器', 'duplicate-post-and-page'); ?>
                                    </option>

                                    <option value="gutenberg" <?php echo (isset($opt['duplicate_post_and_page_editor']) 
                                    && $opt['duplicate_post_and_page_editor'] == 'gutenberg') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('古腾堡编辑器', 'duplicate-post-and-page'); ?>
                                    </option>
                                </select>
                                <p>
                                    <?php _e('请选择新帖子默认使用的编辑器.<strong>默认：</strong>经典编辑器', 'duplicate-post-and-page'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                    <label for="duplicate_post_and_page_postType">
                                        <?php _e('选择新帖子的类型', 'duplicate-post-and-page'); ?>
                                    </label>
                            </th>
                            <td>
                                <select name="duplicate_post_and_page_postType" id="duplicate_post_and_page_postType">
                                    <option value="post" <?php echo (isset($opt['duplicate_post_and_page_postType']) 
                                    && $opt['duplicate_post_and_page_postType'] == 'post') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('文章类型', 'duplicate-post-and-page'); ?>
                                    </option>

                                    <option value="page" <?php echo (isset($opt['duplicate_post_and_page_postType']) 
                                    && $opt['duplicate_post_and_page_postType'] == 'page') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('页面类型', 'duplicate-post-and-page'); ?>
                                    </option>

                                    <option value="attachment" <?php echo (isset($opt['duplicate_post_and_page_postType']) 
                                    && $opt['duplicate_post_and_page_postType'] == 'attachment') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('附件类型', 'duplicate-post-and-page'); ?>
                                    </option>
                                    <option value="revision" <?php echo (isset($opt['duplicate_post_and_page_postType']) 
                                    && $opt['duplicate_post_and_page_postType'] == 'revision') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('修订类型', 'duplicate-post-and-page'); ?>
                                    </option>
                                    <option value="menu" <?php echo (isset($opt['duplicate_post_and_page_postType']) 
                                    && $opt['duplicate_post_and_page_postType'] == 'gutenberg') ? "selected = 'selected'" : ''; ?>>
                                    <?php _e('菜单类型', 'duplicate-post-and-page'); ?>
                                    </option>
                                </select>
                                <p>
                                    <?php _e('请选择新帖子的类型.<strong>默认：</strong>文章类型', 'duplicate-post-and-page'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="duplicate_post_and_page_status">
                                    <?php _e('选择复制后新帖子的状态', 'duplicate-post-and-page'); ?>
                                </label>
                            </th>
                            <td>
                                <select name="duplicate_post_and_page_status" id="duplicate_post_and_page_status">
                                    <option value="draft" <?php echo ($opt['duplicate_post_and_page_status'] == 'draft') ? "selected = 'selected'" : ''; ?>><?php _e('草稿', 'duplicate-post-and-page'); ?></option>
                                
                                    <option value="publish" <?php echo ($opt['duplicate_post_and_page_status'] == 'publish') ? "selected = 'selected'" : ''; ?>><?php _e('发布', 'duplicate-post-and-page'); ?></option>
                                
                                    <option value="private" <?php echo ($opt['duplicate_post_and_page_status'] == 'private') ? "selected = 'selected'" : ''; ?>><?php _e('私有', 'duplicate-post-and-page'); ?></option>
                                
                                    <option value="pending" <?php echo ($opt['duplicate_post_and_page_status'] == 'pending') ? "selected = 'selected'" : ''; ?>><?php _e('待审核', 'duplicate-post-and-page'); ?></option>
                                </select>

                                <p><?php _e("请选择复制后新帖子的状态 . <strong>默认： </strong>) 草稿", "duplicate-post-and-page"); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="duplicate_post_and_page_redirect">
                                    <?php _e('点击<strong>复制此文件</strong>后默认重定向至', 'duplicate-post-and-page'); ?>
                                </label>
                                <td>
                                    <select name="duplicate_post_and_page_redirect" id="duplicate_post_and_page_redirect">

                                        <option value="to_list" <?php echo($opt['duplicate_post_and_page_redirect'] == 'to_list') ? "selected='selected'" : ''; ?>><?php _e('文章列表页', 'duplicate-post-and-page'); ?></option>

                                        <option value="to_page" <?php echo($opt['duplicate_post_and_page_redirect'] == 'to_page') ? "selected='selected'" : ''; ?>><?php _e('页面列表页', 'duplicate-post-and-page'); ?></option>
                                    </select>
                                    <p>
                                        <?php _e('请选择点击 复制此文件 后要重定向的页面<strong>默认：</strong>文章列表页','duplicate-post-and-page'); ?>
                                    </p>
                                </td>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="duplicate_post_and_page_suffix">
                                    <?php _e('请填写复制后新帖子的后缀', 'duplicate-post-and-page'); ?>
                                </label>
                            </th>
                            <td>
                                <input type="text" class="regular-text" value="<?php echo !empty($opt['duplicate_post_and_page_suffix']) ? esc_attr($opt['duplicate_post_and_page_suffix']) : ''; ?>" id="duplicate_post_and_page_suffix" name="duplicate_post_and_page_suffix">
                                <p>
                                    <?php 
                                    _e('请添加复制后帖子的后缀, 留空将以"复制"作为后缀', 'duplicate-post-and-page');
                                     ?>
                                </p>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" value="<?php _e('保存更改', 'duplicate-post-and-page'); ?>" class="button button-primary" id="submit" name="submit_duplicate_post_and_page">
                </p>
            </form>
        </div>
    </div>
</div>