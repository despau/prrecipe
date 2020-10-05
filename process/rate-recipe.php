<?php

function prrecipe_rate_recipe(){
    global $wpdb;


    $output             =   [ 'status' => 1 ];
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
    $recipe_data        =   get_metadata( $post_ID, 'recipe_data', true );
    $recipe_data['rating_count']++;
    $recipe_data['rating']  =   round($wpdb->get_var(
        "SELECT AVG(`rating`) FROM `" . $wpdb->prefix . "recipe_ratings`
        WHERE recipe_id='" . $post_ID . "'"
    ), 1);



    update_metadata( $post_ID, 'recipe_data', $recipe_data );

    // CUSTOM HOOK THAT DEVELOPERS CAN HOOK INTO
    // The array of parameters will sent to any funcion that hooks into this Hook
    do_action( 'recipe-rated', [
        'post_id'       =>  $post_ID,
        'rating'        =>  $rating_count,
        'user_IP'       =>  $user_IP
    ] );

    $output['status']   =   2;
    wp_send_json( $output );
}