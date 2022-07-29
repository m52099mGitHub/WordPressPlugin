<?php 
/**
 * Plugin Name: Database Test
 * Description: This is a test environment for wordpress database operation
 * Author: Colin Hong
 * Version: 1.0.0
 * Author URI:https://bdtdl.xyz
 * 
 *
 * 
*/





// 在WordPress后台评论处添加一个子菜单
add_action('admin_menu', 'comments_submenu');
function comments_submenu() {
    add_comments_page(__('数据保存'), __('数据保存'), 'read', 'my-unique-identifier-datasave', 'add_comments_submenu');
}

// WordPress后台评论处菜单page
function add_comments_submenu(){
   if($_POST['test_upload_hidden'] == 'upload') {
       update_option('test_input_c',$_POST['test_insert_options']); //更新你添加的数据库
?>
     <div id="message" style="background-color: green; color: #ffffff;">保存成功 !</div>
<?php
   }
?>


<?php 
    function test_get_options() {
        if ($_POST['test_download_hidden'] = 'download') {
            $getoptions = get_option('test_input_c');
            print_r($getoptions);
        }
    }
?>


  <div>
      <h2>添加数据</h2>
      <form action="" method="post" id="my_plugin_test_form">
          <h3>
              <label for="test_insert_options">输入测试数据:</label>
              <input type="text" id="test_insert_options" name="test_insert_options" value="<?php  echo esc_attr(get_option('test_input_c')); ?>"  />
          </h3>
          <p>
              <input type="submit" name="submit" value="保存" class="button button-primary" />
              <input type="hidden" name="test_upload_hidden" value="upload"  />
          </p>
      </form>
  </div>



  <div>
      <h2>加载数据</h2>
      <form action="" method="post" id="my_plugin_get_form">
          <h3>
              <label for="test_get_options">加载的测试数据:</label>
              <input type="text" id="test_get_options" name="test_get_options" value="<?php  echo esc_attr(get_option('test_input_c')); ?>"  />
          </h3>
          <p>
              <input type="submit" name="submit" value="加载" class="button button-primary" />
              <input type="hidden" name="test_download_hidden" value="download"  />
          </p>
      </form>
  </div>



<?php
}

























?>