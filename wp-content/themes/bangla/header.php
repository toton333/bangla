<!DOCTYPE html>
<html>
	<head>
		<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
		
		
		<!-- Bootstrap -->
		<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/menu.css" rel="stylesheet" media="screen">
		
		<!-- Main CSS -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
		
		<!-- Responsive Framework -->
		<link href="<?php echo get_template_directory_uri(); ?>/responsive.css" rel="stylesheet" media="screen">



		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> >
		<div class="column fix">
			<div class="header_top fix">
				<p>Email: info@perfectpointmarketing.com | Call: 545-654-4654</p>
			</div>
			<div class="header fix">
				<div class="logo floatleft fix">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" />
				</div>
				<div class="header-search">
					<?php get_search_form(); ?>
				</div >
				<div class="mainmenu floatright fix">

					<?php
					if (function_exists('wp_nav_menu')) {
						wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_id' => 'nav', 'fallback_cb' => 'wpj_default_menu'));
					}
					else {
						wpj_default_menu();
					}
					?>

				</div>
			</div>