<?php 
get_header(); ?>

	<div class="internal_page fix">
		<div class="content floatleft fix">
		  <div class="article_container">
            
             <h1 class="archive_title">
	             <?php if (have_posts()) : ?>
					    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
							<?php _e('Archive for the', 'brightpage'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category', 'brightpage'); ?>									
						<?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>
							<?php _e('Archive for the', 'brightpage'); ?> <?php single_tag_title(); ?> Tag
						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							<?php _e('Archive for', 'brightpage'); ?> <?php the_time('F jS, Y'); ?>										
					 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							<?php _e('Archive for', 'brightpage'); ?> <?php the_time('F, Y'); ?>									
						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							<?php _e('Archive for', 'brightpage'); ?> <?php the_time('Y'); ?>										
					  	<?php /* If this is a search */ } elseif (is_search()) { ?>
							<?php _e('Search Results', 'brightpage'); ?>							
					  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							<?php 
							the_post(); 
							_e('Archive for ' , 'brightpage'); 
							echo get_the_author();
							rewind_posts();
							?>										
						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<?php _e('Blog Archives', 'brightpage'); ?>										
				<?php } ?>	
             </h1>

             <?php while (have_posts()) : the_post(); ?>
	              <?php get_template_part('content', get_post_format()) ?>
	         <?php endwhile; ?>

	         <?php 
	         /* this function takes either 'custom' or 'bootstrap' or nothing */
	          custom_pagination('bootstrap'); 
	          ?>

             <?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'Brightpage'); ?></h3>
						</div>
			 <?php endif; ?>

		  </div>			
		</div>
	
		<?php get_sidebar(); ?>
	
	</div>


<?php get_footer(); ?>