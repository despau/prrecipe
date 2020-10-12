<?php

function prrecipe_rate_recipe(){

    global $wpdb;


    $output             =   [ 'status' => 1 ];

    //lets grab the recipe_options
    $recipe_option      =   get_option( 'prrecipe_opts' );

    if( !is_user_logged_in(  ) && $recipe_option[ 'rating_loging_required' ] ){
        //if both return true, then user is required to login. kill the script
        wp_send_json( $output );
    }


    $post_ID            =   absint( $_POST['rid'] );
    $rating             =   round( $_POST['rating'], 1 );
    $user_IP            =   $_SERVER['REMOTE_ADDR'];

    $rating_count       =   $wpdb->get_var(
        "SELECT COUNT(*) FROM `" . $wpdb->prefix . "recipe_ratings`
        WHERE recipe_id='" . $post_ID . "' AND user_ip='" . $user_IP . "'"
    );

    if( $rating_count > 0 ){
        wp_send_json( $output );
    }

    // Insert Rating into database
    $wpdb->insert(
        $wpdb->prefix . 'recipe_ratings',
        [
            'recipe_id' =>  $post_ID,
            'rating'    =>  $rating,
            'user_ip'   =>  $user_IP
        ],
        [ '%d', '%f', '%s' ]
    );

    // Update Recipe Metadata
    $recipe_data        =   get_post_meta( $post_ID, 'recipe_data', true );
    $recipe_data['rating_count']++;
    $recipe_data['rating']  =   round($wpdb->get_var(
        "SELECT AVG(`rating`) FROM `" . $wpdb->prefix . "recipe_ratings`
        WHERE recipe_id='" . $post_ID . "'"
    ), 1);



    update_post_meta( $post_ID, 'recipe_data', $recipe_data );

    // CUSTOM HOOK THAT DEVELOPERS CAN HOOK
    // The array of parameters will sent to any funcion that hooks into this Hook
    do_action( 'recipe-rated', [
        'post_id'       =>  $post_ID,
        'rating'        =>  $rating_count,
        'user_IP'       =>  $user_IP
    ] );

    $output['status']   =   2;
    wp_send_json( $output );
}