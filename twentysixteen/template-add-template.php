<?php
/*
Template Name: Add New Template
*/
acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			$args=array(
					'post_title' => true,
					'post_id'		=> 'new_post',
					'new_post'		=> array(
						'post_type'		=> 'task_template',
						'post_status'		=> 'publish'
					),
					'submit_value'		=> 'Create a new template',
					'updated_message' => __("Template Created", 'acf'),
				);
			acf_form($args);
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>