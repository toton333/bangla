<?php
/**
 * Plugin Name: Ajax Testing.
 * Plugin URI: http://localhost/bangla
 * Description: A brief description of how to use ajax in admin panel.
 * Version: 1.0.0
 * Author: Bishan Ghosal
 * Author URI: http://localhost/bangla
 * License: GPL2
 */

add_action('admin_menu', 'bangla_plugin_menu');

function bangla_plugin_menu() {
	global $add_settings;
	$add_settings = add_options_page(__('Admin Ajax Testing', 'bangla'), __('Ajax Testing', 'bangla'), 'manage_options', 'admin-ajax-testing', 'bangla_render_admin');
}

function bangla_render_admin(){
?>
<div class="wrap">
	<h2><?php _e('Admin Ajax Testing'); ?></h2>
	<form action="" method="POST" id="bangla-ajax-form"  >
		<div>
			<input id="post_type" type="text">
			<input id="submit-button" type="submit" class="button-primary" value="<?php _e('Get Results', 'bangla'); ?>" >	
			<img id="bangla_loading" src="<?php echo admin_url('/images/loading.gif'); ?>" alt="" style="display:none">		
		</div>		
	</form>  

    <div id="bangla_results"></div>
</div>

<?php

}

function bangla_load_scripts($hook){

	global $add_settings;
	if ($hook =! $add_settings) {
		return;
	}

wp_enqueue_script('bangla-ajax', plugin_dir_url(__FILE__).'js/bangla-ajax.js', array('jquery')  );
wp_localize_script('bangla-ajax', 'ajax_object', array('bangla_nonce' => wp_create_nonce('the-bangla-nonce')));
}
add_action('admin_enqueue_scripts', 'bangla_load_scripts');

function bangla_ajax_callback(){
    
    if(!isset($_POST['bangla_nonce']) || !wp_verify_nonce($_POST['bangla_nonce'], 'the-bangla-nonce'))
    	die('Permission Denied.');


   if (isset($_POST['post_type']) && !empty($_POST['post_type'])) {
   	$post_type = $_POST['post_type'];
   	$posts = get_posts(array('post_type'=> $post_type, 'posts_per_page' => 2));
	if ($posts) {
		echo '<ol>';
		foreach ($posts as $post) {
			echo '<li><a href="'.get_permalink($post->ID).'" >'.$post->post_title.'</a>';
		}
		echo '</ol>';
		
	} else {
		echo 'No Results Found';
	}
   } else {
   	echo 'Please insert a post type';
   }
   
	
	
	wp_die();
}

add_action('wp_ajax_bangla_get_results', 'bangla_ajax_callback');

/*
How to get post informations outside loop
1. $post->ID, $post->post_title, $post->post_content etc . 
reference :http://codex.wordpress.org/Class_Reference/WP_Post

2. $post->post_author returns the author's id, use this inside get_the_author_meta('display_name', $post->post_author) to get different information of author.

3.get_post_field($field, $id) , here $field can be post_type, post_status, post_content, post_title or any fields of the posts table in database.

*/