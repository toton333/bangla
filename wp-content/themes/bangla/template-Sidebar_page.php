<?php 
/*
		Template Name: Sidebar Template
*/
get_header(); ?>

	<div class="internal_page fix">
		<div class="content floatleft fix">
			<!--modal elements-->
		    <div class="thumbnails clearfix">
			    <a href="<?php echo get_template_directory_uri() ?> /img/modal/image-1.jpg" data-lightbox="travel" data-title="hope"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-1.jpg" alt=""></a>
				<a href="<?php echo get_template_directory_uri() ?> /img/modal/image-2.jpg" data-lightbox="travel" data-title="gossip"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-2.jpg" alt=""></a>
				<a href="<?php echo get_template_directory_uri() ?> /img/modal/image-3.jpg" data-lightbox="travel"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-3.jpg" alt=""></a>
	            <a href="<?php echo get_template_directory_uri() ?> /img/modal/image-4.jpg" data-lightbox="travel"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-4.jpg" alt=""></a>
				<a href="<?php echo get_template_directory_uri() ?> /img/modal/image-5.jpg" data-lightbox="travel"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-5.jpg" alt=""></a>
				<a href="<?php echo get_template_directory_uri() ?> /img/modal/image-6.jpg" data-lightbox="travel"><img src="<?php echo get_template_directory_uri() ?> /img/modal/thumb-6.jpg" alt=""></a>
            </div>

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
	
		<?php get_sidebar(); ?>
	
	</div>


<?php get_footer(); ?>