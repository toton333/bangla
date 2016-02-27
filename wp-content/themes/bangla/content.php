		
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
		<div id="post-title-<?php the_ID(); ?>" class="clearfix full">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php  the_title(); ?></a></h2>			
		</div> <!-- end div .post-title -->

		<span class="<?php if(has_post_thumbnail() ){?> thumb  <?php  } ?>" >

		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>

		</span>
		
		<?php the_excerpt(); ?> 
	    
		
		<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>
		
	</div> <!-- end div #post -->

