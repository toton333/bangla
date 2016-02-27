<?php 
/*
		Template Name: Welcome Template
*/
get_header(); ?>
<div class="internal_page fix">
		<?php if(has_children() OR $post->post_parent > 0) : ?>
		<nav class="children-links clearfix">
			<span class="parent-link">
				<a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a>
			</span>
			<ul>						
				<?php
				  $args = array(
				  	'child_of' => get_top_ancestor_id(),
				  	'title_li' => ''
				  	);
				 wp_list_pages($args);		 
				 ?>
			</ul>
		</nav>
		<?php endif; ?>

					<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
						<div class="post" id="post-<?php the_ID(); ?>">
															
							<div id="post-title" class="clearfix full">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
											
							</div> <!-- end div .post-title -->
							
							<div class="entry">
							
								<?php the_content(); ?> 

							
							</div> <!-- end div .entry -->
				
								
						</div> <!-- end div .post -->

					<?php endwhile; ?>

					<?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'bangla'); ?></h3>
						</div>
					<?php endif; ?>		
	</div>

			<div class="slider fix">
				<img src="<?php echo get_template_directory_uri(); ?>/img/slider.jpg" alt="" />
			</div>
           
           <?php if(!dynamic_sidebar('call_to_action_widget')) : ?>

			<div class="call_to_action fix">
				
                <h2>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
				<a class="readmore" href="">Learn More</a>


			</div>
           <?php endif; ?>
         
			<div class="promotions fix">
				<?php if(!dynamic_sidebar('promotion_widget')) : ?>
				<div class="single_promotion floatleft fix">
					<span class="glyphicon glyphicon-search"></span>
					<h2>Service Title</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
					<a class="readmore" href="">Learn More</a>
				</div>
				
				<div class="single_promotion floatleft fix">
					<span class="glyphicon glyphicon-cog"></span>
					<h2>Service Title</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
					<a class="readmore" href="">Learn More</a>
				</div>

				<div class="single_promotion floatleft fix">
					<i class="glyphicon glyphicon-check"></i>
					<h2>Service Title</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
					<a class="readmore" href="">Learn More</a>
				</div>	

				<?php endif; ?>			
			</div>
			<div class="services fix">

				<?php if(!dynamic_sidebar('service_widget')) : ?>

				<h1><span>Our Services</span></h1>
				<div class="single_service floatleft fix">
					<img src="<?php echo get_template_directory_uri(); ?>/img/single_service.gif" alt="" />
					<h2>Work title appear here</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer</p>
				</div>
				
				<div class="single_service floatleft fix">
					<img src="<?php echo get_template_directory_uri(); ?>/img/single_service.gif" alt="" />
					<h2>Work title appear here</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer</p>
				</div>

				<div class="single_service floatleft fix">
					<img src="<?php echo get_template_directory_uri(); ?>/img/single_service.gif" alt="" />
					<h2>Work title appear here</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer</p>
				</div>

				<div class="single_service floatleft fix">
					<img src="<?php echo get_template_directory_uri(); ?>/img/single_service.gif" alt="" />
					<h2>Work title appear here</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer</p>
				</div>	
				<?php endif; ?>			
			</div>

			<?php if (is_active_sidebar('header_widget')): ?>

			
				<?php dynamic_sidebar('header_widget') ?>					
			
				
			<?php endif ?>
			
<?php get_footer(); ?>