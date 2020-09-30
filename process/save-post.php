<?php

// get post meta data

function prrecipe_save_post_admin( $post, $post_id, $update ){


    $recipe_data                =   get_post_meta( $post_id, 'recipe_data', true );
    $recipe_data                =   empty($recipe_data) ? [] : $recipe_data;
    $recipe_data['rating']    =   isset( $recipe_data['rating'] ) ? absint( $recipe_data['rating'] ) : 0;
    $recipe_data['rating_count']    =   isset($recipe_data['rating_count'] ) ? absint( $recipe_data['rating_count'] ) : 0;

    update_post_meta( $post_id, 'recipe_data', $recipe_data );

}


// function prrecipe_save_post_admin( $post, $post_id, $update ){


//     if($_POST['post_type'] == "recipe"){

//         // Retrieve the values from the form
//         $recipe_rating = $_POST['rating'];
//         $recipe_rating_count = $_POST['rating_count'];

//         // Clean, sanitize and validate the input as appropriate

//         // Save the updated data into the custom post meta database table
//         update_post_meta( $post_id, "rating", $recipe_rating );
//         update_post_meta( $post_id, "rating_count", $recipe_rating_count );

//     }


// }