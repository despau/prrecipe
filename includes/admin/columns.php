<?php


function prrecipe_add_new_recipe_columns( $columns ){

    $new_columns                =   [];
    $new_columns['cb']          =   '<input type="checkbox" />';
    $new_columns['title']       =   __( 'Title', 'prrecipe' );
    $new_columns['author']      =   __( 'Author', 'prrecipe' );
    $new_columns['categories']  =   __( 'Categories', 'prrecipe' );
    $new_columns['count']       =   __( 'Ratings count', 'prrecipe' );
    $new_columns['rating']      =   __( 'Average Rating', 'prrecipe' );
    $new_columns['date']        =   __( 'Date', 'prrecipe' );

    return $new_columns;

}


function prrecipe_manage_recipe_columns( $column, $post_id ){

    switch( $column ){
        case 'count':
            $recipe_data        =   get_post_meta( $post_id, 'recipe_data', true );
            echo isset($recipe_data['rating_count']) ? $recipe_data['rating_count'] : 0;
            break;
        case 'rating':
            $recipe_data        =   get_post_meta( $post_id, 'recipe_data', true );
            echo isset($recipe_data['rating']) ? $recipe_data['rating'] : 'N/A';
            break;
        default:
            break;
    }

}