<?php get_header(); ?>

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


<?php get_footer(); ?>