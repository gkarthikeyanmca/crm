<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			if(have_posts()):
				while(have_posts()): the_post();
					?>
					<h2><?php the_title(); ?></h2>
					<p><?php the_field('project_description'); ?></p>
					<a href="<?php echo home_url().'/add-list?pid='.get_the_ID(); ?>">Add List</a>
					<?php
						$terms = wp_get_object_terms( get_the_ID(),  'task_list' );
						$term_query = new WP_Term_Query( $args );
						if( !empty( $terms ) && !is_wp_error( $terms ) ){
							foreach($terms as $term){								
								?>
								<h3><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></h3>
								<?php
								$args=array(
									'post_type'=>'task',
									'posts_per_page'=>-1,
									'tax_query'=>array(
										array(
											'taxonomy' => 'task_list',
											'field'    => 'term_id',
											'terms'    => $term->term_id,
										),
									)
								);
								$query1=new WP_Query($args);

								if($query1->have_posts()):
									$count=0;
									while($query1->have_posts()): $query1->the_post();
										?>
										<div>
											<?php
												$term=get_term(get_field('status'));
												if($term->name != 'Completed'){
													$count++;
													?>
													<input type="checkbox" class="task-item" tid="<?php echo get_the_ID(); ?>" sno="<?php echo $count; ?>">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													<?php
												}
												else{
													?>
													<input type="checkbox" class="task-item" tid="<?php echo get_the_ID(); ?>" checked>
													<a href="<?php the_permalink(); ?>" style="text-decoration: line-through;"><?php the_title(); ?></a>
													<?php
												}
											?>
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
								endif;
							}
						}
					?>
					<p><h3></h3></p>
					<?php
				endwhile;
			endif;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>