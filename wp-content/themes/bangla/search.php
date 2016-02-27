<?php 
get_header(); ?>

	<div class="internal_page fix">
		<div class="content floatleft fix">
			<h2>Search Result for : <?php the_search_query(); ?></h2>
		  <div class="article_container">
		  	<?php if(have_posts()) : ?>
	            <?php while (have_posts()) : the_post(); ?>
	              <?php get_template_part('content', get_post_format()) ?>
	            <?php endwhile; ?>
	            <?php 
	            /* this function takes either 'custom' or 'bootstrap' or nothing */
	             custom_pagination(); 
	             ?>
			<?php else : ?>
				<div class="post">
					<h3><?php _e('404 Error&#58; Not Found', 'bangla'); ?></h3>
				</div>
			<?php endif; ?>	
		  </div>			
		</div>
	
		<?php get_sidebar(); ?>
	
	</div>


<?php get_footer(); ?>