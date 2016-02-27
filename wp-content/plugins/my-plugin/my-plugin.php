<?php
/**
 * Plugin Name: My Plugin.
 * Description: My first testing plugin.
 * Version: 1.0.0
 * Author: Bishan Ghosal
 * Author URI: http://URI_Of_The_Plugin_Author
 * License:GPL2
 */

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', __FILE__	, 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	           
		                
	}

  if(isset($_POST['search_published_posts'], $_POST['post_status'])){
  	   $posts = array();
       global $wpdb;
       $post_status = $_POST['post_status'];
       
       $query = "SELECT ID, post_title FROM $wpdb->posts WHERE post_status = '$post_status'  ";
       $posts = $wpdb->get_results($query);
       update_option('my_plugin', $posts);
       update_option('my_plugin_status', $post_status );
     }else if(get_option('my_plugin')){

      $posts = get_option('my_plugin');

     }
				     

	?>
	<div class="wrap">
	<h4>A database interection plugin</h4>
	<p>Click the button to get all published posts' ID and Title</p>
	<form action="" method="post">
		<p>Select a post status</p>
		<select name="post_status" >
			<option value="publish" <?php if(trim(get_option('my_plugin_status')) == 'publish' ){echo 'selected="selected"';} ?>  >Published</option>
			<option value="inherit" <?php if(trim(get_option('my_plugin_status')) == 'inherit' ){echo 'selected="selected"';} ?>   >Inherited</option>
			<option value="draft" <?php if(trim(get_option('my_plugin_status')) == 'draft' ){echo 'selected="selected"';} ?>   >Drafted</option>
		</select>
		<input type="submit" name="search_published_posts" value="search" class="button-primary">
	</form>
	<br/>
	<table class="widefat">
		<thead>
			<tr><th>Post ID</th><th>Post Title</th></tr>
		</thead>
		<tfoot>
			<tr><th>Post ID</th><th>Post Title</th></tr>
		</tfoot>
		<tbody>
			<?php
			       if (empty($posts)) {
			       	echo '<tr><td> No Result Found</td></tr>';
			       }else{
			       
			       	foreach ($posts as $post) {
			       		echo '<tr>';
			       		echo '<td>' . $post->ID . '</td>';
			       		echo '<td>' . $post->post_title . '</td>';
			       		echo '</tr>';
			       	}
			       	
	              }
			?>
			
		</tbody>
	</table>
	</div>
<?php }
?>