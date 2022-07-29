<?php 
/**
 * @package AdminColin's Fiveth plugin
 * @version 1.0.0 
*/

/**
 * Plugin name: AdminColin's Fiveth plugin
 * Description: This is a plugin function test file
 * Version: 1.0.0
 * Author: AdminColin
*/



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





	








