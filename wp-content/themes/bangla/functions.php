<?php

/* This code for adding stylesheet and js  */

function bangla_scripts() {

	wp_enqueue_style( 'lightbox', get_template_directory_uri(). '/css/lightbox.css' );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.min.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'bangla_scripts' );

/* This code for adding stylesheet and js in admin panel   */

function bangla_admin_scripts() {

	wp_enqueue_style( 'admin-style', get_template_directory_uri(). '/css/admin-style.css' );
	
}

add_action( 'admin_enqueue_scripts', 'bangla_admin_scripts' );

/* This code for wordpress dynamic Menu */

add_action('init', 'wpj_register_menu');
function wpj_register_menu() {
	if (function_exists('register_nav_menu')) {
		register_nav_menu( 'wpj-main-menu', __( 'Main Menu', 'bangla' ) );
		register_nav_menu( 'footer-menu', __( 'Footer Menu', 'bangla' ) );
	}
}


function wpj_default_menu() {
	echo '<ul id="nav">';
	if ('page' != get_option('show_on_front')) {
		echo '<li><a href="'. home_url() . '/">Home</a></li>';
	}
	wp_list_pages('title_li=');
	echo '</ul>';
}

/* This code for wordpress dynamic Widget */

function bangla_widget_areas() {

	register_sidebar( array(
		'name' => __( 'Right Sidebar', 'bangla' ),
		'id' => 'right_sidebar',
		'description' => __( 'This widget will display on sidebar template', 'bangla' ),
		'before_widget' => '<div class="single_sidebar widget fix">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Call to action widget', 'bangla' ),
		'id' => 'call_to_action_widget',
		'description' => __( 'This widget will display on call_to_action_widget id', 'bangla' ),
		'before_widget' => '<div class="call_to_action widget fix">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );

    register_sidebar( array(
		'name' => __( 'Promotional Widget', 'bangla' ),
		'id' => 'promotion_widget',
		'description' => __( 'This widget will display on promotion_widget id', 'bangla' ),
		'before_widget' => '<div class="single_promotion widget floatleft fix">',
		'after_widget' => '</div>',
		'before_title' => '<span style="display:none">',
		'after_title' => '</span>',
	) );

	register_sidebar( array(
		'name' => __( 'Service Widget', 'bangla' ),
		'id' => 'service_widget',
		'description' => __( 'This widget will display on service_widget id', 'bangla' ),
		'before_widget' => '<h1><span>Our Services</span></h1>
				            <div class="single_service widget floatleft fix">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Middle Widget', 'bangla' ),
		'id' => 'footer_middle_widget',
		'description' => __( 'This widget will display on footer_middle_widget id', 'bangla' ),
		'before_widget' => '<div class="footer_middle widget floatleft fix">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Right Widget', 'bangla' ),
		'id' => 'footer_right_widget',
		'description' => __( 'This widget will display on footer_right_widget id', 'bangla' ),
		'before_widget' => '<div class="footer_right_widget widget floatleft fix">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Header Widget', 'bangla' ),
		'id' => 'header_widget',
		'description' => __( 'This widget will display on header_widget id', 'bangla' ),
		'before_widget' => '<div class="header_widget widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>'
	) );





}
add_action('widgets_init', 'bangla_widget_areas');



function demo_loop(){

  $args = array('posts_per_page' => 4, 'post_type' => 'page');

  $query = new wp_query($args);

  if ($query->have_posts()) {
  	while ($query->have_posts()) {
  		$query->the_post();
  		$output .= '<ul><li><a href="' . get_the_permalink() . '">' .the_title('', '', false) . '</a></li></ul>';

  		/*
  		we could use get_the_title also, get_the_title returns a string  and the_title() echos a string by default
  		to use the_title inside php use the third parameter as false as shown above to return the title, instead of
 		echoing by default or if it is set to true.

 		*/
  	}
  }
  return $output;
  
}

add_shortcode('demo_custom_loop', 'demo_loop');

function youtube_function($atts, $content=null){

  $video = '<iframe width="420" height="315" src="//www.youtube.com/embed/'.$content.'?rel=0" frameborder="0" allowfullscreen></iframe>';
  return $video;
}

add_shortcode('youtube', 'youtube_function');





//taxonomi
// get taxonomies terms links (this functions shows categories and tag taxonomies also, not just custom taxonomies)
function custom_taxonomies_terms_links(){
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      $out[] = "<br/>".$taxonomy->label . " : ";
      foreach ( $terms as $term ) {
        $out[] =
          '  <a href="'
        .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
        .    $term->name
        . "</a>";
      }
      $out[] = " ";
    }
  }

  return implode('', $out );
}

//parent page id

function get_top_ancestor_id(){

  global $post;
    if ($post->post_parent) {

    	$ancestors = array_reverse(get_post_ancestors($post->ID));
    	return $ancestors[0];
    	
    }

  return $post->ID;

}
//if has children

function has_children(){

	global $post;
	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);
}

function custom_theme_setup(){

//for featured image
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'my_movies' ) );
add_image_size('small-thumbnail', 180, 120, true );
add_image_size('banner-image', 625, 120, true );

//for post formats
add_theme_support('post-formats', array('aside', 'gallery', 'link'));

}
add_action('after_setup_theme', 'custom_theme_setup');

/* theme customizer */

function bangla_customize_register( $wp_customize ) {

   //settings
   $wp_customize->add_setting( 'bangla_theme_color' , array(
    'default'     => '#037EC4',
    'transport'   => 'refresh'
) );

   $wp_customize->add_setting( 'bangla_widget_color' , array(
    'default'     => '#B8BBC4',
    'transport'   => 'refresh'
) );


   

  //sections
$wp_customize->add_section( 'bangla_standard_colors' , array(
    'title'      => __( 'Standard Colors', 'bangla' ),
    'priority'   => 30
) );

   //controls
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bangla_theme_color_control', array(
	'label'        => __( 'Theme Color', 'bangla' ),
	'section'    => 'bangla_standard_colors',
	'settings'   => 'bangla_theme_color'
) ) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bangla_widget_color_control', array(
  'label'        => __( 'Widget Color', 'bangla' ),
  'section'    => 'bangla_standard_colors',
  'settings'   => 'bangla_widget_color'
) ) );



}
add_action( 'customize_register', 'bangla_customize_register' );


/* bangla customize css  */

function bangla_customize_css(){?>

<style type="text/css">
	.mainmenu{
      background: <?php echo get_theme_mod('bangla_theme_color'); ?>  ;
	}
	#nav li:hover > a {
		color:#fff;background:<?php echo adjustColorLightenDarken(get_theme_mod('bangla_theme_color'), 50) ; ?>;
	}
	#nav li.current-menu-item a:link, 
	#nav li.current-menu-item a:visited,
	#nav li.current-page-ancestor a:link,
	#nav li.current-page-ancestor a:visited {

		color:#fff;background:<?php echo adjustColorLightenDarken(get_theme_mod('bangla_theme_color'), 50) ; ?>;
		cursor:default;
	}
	.page-numbers a:hover,
	.page-numbers.current,
	.page-numbers.current:hover{

		color:#fff; background: <?php echo get_theme_mod('bangla_theme_color'); ?> ;
	}

  .widget{

     background: <?php echo get_theme_mod('bangla_widget_color'); ?> ;
     border: 1px solid <?php echo adjustColorLightenDarken(get_theme_mod('bangla_widget_color'), -10); ?> ;
  }
  body{
    background: <?php echo get_theme_mod('bangla_widget_color'); ?> ;
  }

</style>


<?php }
add_action('wp_head', 'bangla_customize_css');

if ( ! function_exists( 'bangla_content_nav' ) ) :
/*
pagination for single post
 */
function bangla_content_nav( $html_id ) {
	
	$html_id = esc_attr( $html_id );
 ?>
		<nav id="<?php echo $html_id; ?>" class="nav-single" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'bangla' ); ?></h3>
			<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bangla' ) . '</span> %title' ); ?></span>
      <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bangla' ) . '</span>' ); ?></span>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php 
}
endif;

/* custom_pagination, a better solution than default */
function custom_pagination($style = FALSE) {

	if ($style == 'bootstrap') {
		$type = 'array';
	} else if($style == 'custom') {
		$type = 'list';
	}else{
		$type = 'plain';
	}
	
    global $wp_query, $custom_query; //need to match custom query variable's name
    if ($custom_query) {
    	$total = $custom_query->max_num_pages;
    } else {
    	$total = $wp_query->max_num_pages;
    }
    
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $total,
            'type'  => $type,
            'prev_next'   => TRUE,
			'prev_text'    => __('«'),
			'next_text'    => __('»'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination">';
            foreach ( $pages as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul>';
        }else{
        	echo $pages;
        }
}



/* 
 Lighten and darken a color.
 $percentage_adjuster should be between -255 and 255. Negative = darker, positive = lighter 
 */


function adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    else if(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));

        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);

    }
}


/* code for creating a new wp option in wp_options table in the wordpress database  */

if (get_option('bangla_theme_options')) {
	$theme_options = get_option('bangla_theme_options');
} else {
	add_option('bangla_theme_options', array(
		'sidebar2_on' => true,
		'footer_text' => 'MADE BY DAXTERSPEED!'
	));
	$theme_options = get_option('bangla_theme_options');
}

/* Code for creating submenu(in appearence page) and page after we click it  */
add_action('admin_menu', 'theme_page_add');
function theme_page_add() {
	add_submenu_page('themes.php', 'Bangla Theme Options', 'Bangla Theme Options', 8, 'themeoptions', 'bangla_theme_page_options');
}

function bangla_theme_page_options() {

	global $theme_options;
	
	if ($_POST['sidebar_checkbox']) {
		$checkbox_post_value = true;
	} else {
		$checkbox_post_value = false;
	}
	
	$new_values = array(
		'footer_text' => htmlentities($_POST['footer_text'], ENT_QUOTES),
		'sidebar2_on' => $checkbox_post_value
	);
	
	update_option('bangla_theme_options', $new_values);
	
	$theme_options = $new_values;

  echo '<div class="wrap">';
  echo '<h2>Theme Options</h2>';
 ?>
  
<form action="themes.php?page=themeoptions" method="post">

<label for="footer_text">Footer Text: </label><input name="footer_text" id="footer_text" value="<?php echo $theme_options['footer_text']; ?>" /><br /><br />

<?php

if ($theme_options['sidebar2_on']) {
	$checkbox_text = ' checked="checked"';
}

?>

<label for="sidebar_checkbox">Sidebar 2 On: </label><input name="sidebar_checkbox" id="sidebar_checkbox" value="on" type="checkbox" <?php echo $checkbox_text; ?>/><br /><br />

<input type="submit" value="Update Options" name="submit" />

</form>

<?php
  echo '</div>';

}
