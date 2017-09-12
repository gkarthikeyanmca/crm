<?php
/*
Plugin Name: LJD CRM
*/

function crm_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( 'Projects' ),
        'has_archive'=>true
    );
    register_post_type( 'project', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Tasks' ),
        'has_archive'=>true
    );
    register_post_type( 'task', $args );

    $args = array(
        'public'    => true,
        'label'     => __( 'Task Templates' ),
        'has_archive'=>true
    );
    register_post_type( 'task_template', $args );

    register_taxonomy(
		'task_status',
		'task',
		array(
			'label' => __( 'Status' ),
			'rewrite' => array( 'slug' => 'status' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'project_status',
		'project',
		array(
			'label' => __( 'Status' ),
			'rewrite' => array( 'slug' => 'status' ),
			'hierarchical' => true,
		)
	);

    register_taxonomy(
        'task_list',
        array('task','project'),
        array(
            'label' => __( 'Task List' ),
            'rewrite' => array( 'slug' => 'task-list' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'crm_post_type' );

function load_taks_from_same_list( $args, $field, $post_id ) {
    $terms=wp_get_object_terms($post_id, 'task_list');
    if ( ! empty( $terms ) ) {
        if ( ! is_wp_error( $terms ) ) {
            foreach( $terms as $term ) {

                $args1 = array(
                    'post_type' => 'task',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'task_list',
                            'field'    => 'slug',
                            'terms'    => $term->slug,
                        ),
                    ),
                );

                $query1=new WP_Query($args1);
                if($query1->have_posts()):
                    $ids=array();
                    while($query1->have_posts()): $query1->the_post();
                        if(get_the_ID()!=$post_id){
                            $ids[]=get_the_ID();
                        }
                    endwhile;
                    //wp_reset_postmeta();
                endif;
                break;
            }

            $args['post__in']=$ids;
        }
    }
    
    // return*/
    return $args;    
}

add_filter('acf/fields/relationship/query', 'load_taks_from_same_list', 10, 3);

?>