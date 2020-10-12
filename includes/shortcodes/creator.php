<?php

function prrecipe_recipe_creator_shortcode(){

    //lets grab the recipe_options
    $recipe_option          =   get_option( 'prrecipe_opts' );

    if( !is_user_logged_in(  ) && $recipe_option[ 'prrecipe_submission_login_required' ] == 2 ){
        //if both return true, then user is required to login.
        return 'You must be logged in to submit a recipe';
    }

    $creatorHTML            =   file_get_contents( 'creator-template.php', true );

    $editorHTML             =   prrecipe_generate_content_editor();

    $creatorHTML            =   str_replace( 'CONTENT_EDITOR', $editorHTML, $creatorHTML );

    global $wp_roles;

	var_dump($wp_roles);

    return $creatorHTML;

}



function prrecipe_generate_content_editor(){

    ob_start();

    wp_editor( '', 'recipecontenteditor' );

    $editor_contents            = ob_get_clean();

    return $editor_contents;

}