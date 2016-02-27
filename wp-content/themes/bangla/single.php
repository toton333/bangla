<?php 

get_header(); ?>

	<div class="internal_page fix">
		<div class="content floatleft fix">
					<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>

                       <!-- pagination for single post -->
                       <?php  bangla_content_nav('nav-top'); ?>
                       <!-- .nav-single -->

						<div class="post" id="post-<?php the_ID(); ?>">

							<?php the_post_thumbnail('banner-image'); ?>

							
															
							<div id="post-title" class="clearfix full">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
							</div> <!-- end div .post-title -->
							
							<div class="entry">
							
								<?php the_content(); ?> 

							
							</div> <!-- end div .entry -->
				
								
						</div> <!-- end div .post -->

                        <!-- pagination for long post with page break added in dashboard text editor -->
						<?php wp_link_pages(); ?>

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