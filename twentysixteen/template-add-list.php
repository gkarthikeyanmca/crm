<?php
/*
Template Name: Add New List
*/
acf_form_head();
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			if($_POST){
				$result=wp_insert_term( $_POST['list_name'], 'task_list' );
				if(is_wp_error( $result )){
					echo "Error";
				}
				else{
					print_r($result);
					//update_field('related_task_template', $_POST['related_template'], 'task_list_'.$result['term_id']);
					update_term_meta($result['term_id'], 'related_task_template', $_POST['related_template']);
					if($_GET && isset($_GET['pid'])){
		                //update_term_meta($result['term_id'],'related_project',$_GET['pid']);
		                wp_set_object_terms($_GET['pid'],$result['term_id'],'task_list',true);
		                update_field('task_list_status', 'active', 'task_list_'.$_GET['pid']);
		            }
					echo "List added";

					$term_id=$result['term_id'];

					$template_id=get_field('related_task_template','task_list_'.$term_id);
				    if(have_rows('task_list',$template_id)){
				        while(have_rows('task_list',$template_id)){ the_row();
				            $title=get_sub_field('task');
				            $args=array(
				                'post_type'=>'task',
				                'post_status'=>'publish',
				                'post_title'=>$title
				            );
				            $id=wp_insert_post( $args );
				            //update_post_meta($id,'related_task_list',$term_id);
				            wp_set_object_terms($id,$result['term_id'],'task_list');
				            wp_set_object_terms($id,'pending','task_status');
				        }
				    }
				}
			}
		?>
		<form action="" method="post">
			<p>
				<label>List name</label>
				<div><input type="text" name="list_name" /></div>
			</p>
			<p>
				<label>Related template</label>
				<div>
					<select name="related_template">
						<option value="">--Select Template--</option>
						<?php
							$args=array('post_type'=>'task_template','posts_per_page'=>-1);
							$query=new WP_Query($args);
							if($query->have_posts()):
								while($query->have_posts()): $query->the_post();
									?>
									<option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
						?>
					</select>
				</div>
			</p>
			<p>
				<input type="submit" value="Create List" />
			</p>
		</form>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>