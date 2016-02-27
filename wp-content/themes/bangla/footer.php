			<div class="footer_top fix">
				<div class="footer_left floatleft fix">
                  
					<h2><span>From the blog</span></h2>
					<?php 

					$args = array('posts_per_page' => 4, 'post_type' =>'post');
					//$args = array('posts_per_page' => 4, 'post_type' =>'page', 'order'=>'ASC', ); for pages with chronoligal order
					//by default it is listed in reverser chronological order

					$query = new wp_query($args);


					 while($query->have_posts()) : $query->the_post();


					 ?>
       
				       <a href="<?php the_permalink(); ?>" class="list-group-item">
				         <h4 class="list-group-item-heading"><?php the_title(); ?></h4>
				         <p class="list-group-item-text text-muted">Posted by <?php the_author(); ?> on <?php the_time('F jS, Y'); ?></p>
				       </a>

    				<?php endwhile; wp_reset_postdata(); ?>

                    
				</div>
				
				<div class="footer_middle floatleft fix">
					<?php if(!dynamic_sidebar('footer_middle_widget')) : ?>
					<h2><span>Our Services</span></h2>
					<ul>
						<li><a href="">Single Service</a></li>
						<li><a href="">Single Service</a></li>
						<li><a href="">Single Service</a></li>
						<li><a href="">Single Service</a></li>
						<li><a href="">Single Service</a></li>
					</ul>
				   <?php endif; ?>
				</div>
				
				<div class="footer_right floatright fix">
					<?php if(!dynamic_sidebar('footer_right_widget')) : ?>
					<h2><span>Contact Us</span></h2>
					<p>Address line one, Address Line Two<br/>City, State, Zip</p>
					<p>Email: info@perfectpointmarketing.com<br/>Phone: 6546544565</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="footer_bottom fix">
				<div class="footer_bottom_left floatleft fix">
					<p>&copy; 2013 Template Name, All Right Reserved.<br/>Website Designed by <a href="">Perfect Point Marketing</a></p>
				</div>
				
				
				<div class="footer_bottom_right floatright fix">

					<?php
					if (function_exists('wp_nav_menu')) {
						wp_nav_menu(array('theme_location' => 'footer-menu', 'menu_id' => 'nav', 'fallback_cb' => 'wpj_default_menu'));
					}
					else {
						wpj_default_menu();
					}
					?>

				</div>
				

			</div>
		</div>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectnav.min.js"></script>
		<script type="text/javascript">
			domready(function(){
				selectnav('nav', {
					label: '--- Navigation --- '
				});
				prettyPrint()
			})
		</script>		
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
		<?php wp_footer(); ?>
	</body>
</html>