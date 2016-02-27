<?php
/*
Template Name: Movies
*/

 get_header(); ?>
 <?php the_post(); ?>

	<div class="internal_page fix">
		<?php the_content(); ?>
        <?php get_sidebar(); ?>
					<?php 
					$mymovie = array('post_type' =>'my_movies');
					$query = new wp_query($mymovie);
					if($query->have_posts()) : ?><?php while($query->have_posts())  : $query->the_post(); 
					?>

					<div class="row">

	                    <div class="col-md-6">
						    <div class="post" id="post-<?php the_ID(); ?>">
															
								<div id="post-title" class="clearfix full">
									<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
								</div> <!-- end div .post-title -->

                           
                            
                             
									<div><?php the_post_thumbnail('thumbnail'); ?></div>
								    <span>
								    	Date: <?php 

								    	the_field('year');
								    	?>
								    </span>
									<span> | Rating: <?php the_field('my_rating'); ?></span>
                                  
                                  <!--code for displaying taxonomy-->


                                   <?php echo custom_taxonomies_terms_links(); ?>




                                  <!--
									<span>
									 | Genres & Languages:
									  <?php
									       $taxes = array('genre', 'languages');

											$terms = get_the_terms( $post->ID , $taxes );

											foreach ( $terms as $term ) {

											echo $term->name,' . ';

											}

											?>
									</span>
                                   -->
									<p><?php the_field('description') ?><p>

							</div> <!-- end div .post -->

	                    </div><!--end of div. col-md-6-->

					</div> <!-- end div .row -->
				
								
						

					<?php endwhile; ?>

					<?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'bangla'); ?></h3>
						</div>
					<?php endif; wp_reset_postdata(); ?>		
	</div>


<?php get_footer(); ?>