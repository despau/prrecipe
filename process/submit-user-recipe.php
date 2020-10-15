<?php

function prrecipe_submit_user_recipe() {

    $output             =   [ 'status' => 1 ];

    if( empty( $_POST[ 'title' ] ) ){

        wp_send_json( $output );

    }

    global $wpdb;
    $title                          =   sanitize_text_field( $_POST['title'] );
    $content                        =   wp_kses_post( $_POST['content'] );
    $recipe_data                    =   [];
    $recipe_data['rating']          =   0;
    $recipe_data['rating_count']    =   0;

    $post_id                        =   wp_insert_post([
        'post_content'                =>  $content,
        'post_name'                   =>  $title,
        'post_title'                  =>  $title,
        'post_status'                 =>  'pending',
        'post_type'                   =>  'recipe'
    ]);

    update_post_meta( $post_id, 'recipe_data', $recipe_data );

    //lets check if the attachment id is empty
    if( isset( $_POST[ 'attachment_id' ] ) && !empty( $_POST[ 'attachment_id' ] ) ){

        //we need access to the post thumbnail function from  wp-admin/includes/image.php
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        set_post_thumbnail( $post_id, absint( $_POST[ 'attachment_id' ] ) );

    }

    // Update Recipe Pending Notice
    $pending_recipe_count           = $wpdb->get_var(
        "SELECT COUNT(*) FROM `" . $wpdb->posts ."`
            WHERE posts_status='pending' AND post_type='recipe'"
    );

    //add a new recipe option if there is more than 5 pending recipes
    if( $pending_recipe_count >= 5 ){
        update_option( 'prrecipe_pending_recipe_notice', 1);
    }

    $output['status']               =   2;

    wp_send_json($output);

}