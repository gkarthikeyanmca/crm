<?php
acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			if(have_posts()):
				while(have_posts()): the_post();
					$args=array(
							'post_title' => true,
							'post_id'		=> get_the_ID(),
							'submit_value'		=> 'Update Task'
						);
					acf_form($args);
				endwhile;
			endif;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>