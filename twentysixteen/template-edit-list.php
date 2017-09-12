<?php
/*
Template Name: Edit List
*/
acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			$args=array(
				'post_title' => true,
				'post_id'		=> $_GET['id'],
				'submit_value'		=> 'Update List'
			);
			acf_form($args);
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>