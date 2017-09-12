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
		<h3>All Projects <a href="<?php echo home_url().'/add-project'; ?>" class="button-primary" style="float:right;">Create New Project</a></h3>
		<?php
			if(have_posts()):
				while(have_posts()): the_post();
					?>
					<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
					<?php
				endwhile;
			endif;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>