<?php

acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			if(have_posts()):
				while(have_posts()): the_post();
					?>
					<h3><?php the_title(); ?></h3>
					<?php
					$args=array(
						'post_type'=>'task',
						'posts_per_page'=>-1,
						'meta_key'=>'related_task_list',
						'meta_value'=>get_the_ID()
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
										<input type="checkbox" tid="<?php echo get_the_ID(); ?>" sno="<?php echo $count; ?>">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<?php
									}
									else{
										?>
										<input type="checkbox" tid="<?php echo get_the_ID(); ?>" checked>
										<a href="<?php the_permalink(); ?>" style="text-decoration: line-through;"><?php the_title(); ?></a>
										<?php
									}
								?>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
					endif;
				endwhile;
			endif;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>