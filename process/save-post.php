<?php

// get post meta data

function prrecipe_save_post_admin( $post, $post_id, $update ){

    $recipe_data                =   get_metadata( $post_id, 'recipe_data', true );
    $recipe_data                =   empty($recipe_data) ? [] : $recipe_data;
    $recipe_data[ 'rating' ]    =   isset( $recipe_data[ 'rating' ] ) ? absint( $recipe_data[ 'rating' ] ) : 0;
    $recipe_data[ 'rating_count' ]    =   isset($recipe_data[ 'rating_count' ] ) ? absint( $recipe_data[ 'rating_count' ] ) : 0;

    update_metadata( $post_id, 'recipe_data', $recipe_data );

}