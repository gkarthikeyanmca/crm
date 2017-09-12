<?php

acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			$term = get_queried_object();
			echo "<h3>".$term->name."</h3>";
			if(have_posts()):
				while(have_posts()): the_post();					
					if(get_post_type()=='task'):
						$count=0;
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
					endif;
				endwhile;
			endif;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>