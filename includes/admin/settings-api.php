<?php


function prrecipe_settings_api(){

    // register_setting( $option_group:string, $option_name:string, $args:array )
    register_setting( 'prrecipe_opts_group', 'prrecipe_opts', 'prrecipe_opts_sanitize' );

    // add_settings_section( $id:string, $title:string, $callback:callable, $page:string )
    add_settings_section(
        'prrecipe_settings',
        'Recipe Settings',
        'prrecipe_settings_section',
        'prrecipe_opts_sections'
    );

    // add_settings_field( $id:string, $title:string, $callback:callable, $page:string, $section:string, $args:array )
    add_settings_field(
        'rating_login_required',
        'User login required for rating recipes',
        'rating_login_required_input_cb',
        'prrecipe_opts_sections',
        'prrecipe_settings'
    );

    add_settings_field(
        'prrecipe_submission_login_required',
        'User login required for submitting recipes',
        'prrecipe_submission_login_required_input_cb',
        'prrecipe_opts_sections',
        'prrecipe_settings'
    );

}




function prrecipe_settings_section(){
    echo '<p>You can change the recipe settings here.</p>';
}




function rating_login_required_input_cb(){

    $recipe_opts              = get_option( 'prrecipe_opts' );

    ?>
        <select id="rating_login_required" name="prrecipe_opts[rating_login_required]">
            <option value="1">No</option>
            <option value="2"
                <?php echo $recipe_opts['rating_login_required'] == 2 ? 'SELECTED' : '' ?>>Yes</option>
        </select>
    <?php
}




function prrecipe_submission_login_required_input_cb(){

    $recipe_opts                    =   get_option( 'prrecipe_opts' );

    ?>
        <select id='recipe_submission_login_required' name='prrecipe_opts[prrecipe_submission_login_required]'>
            <option value="1">No</option>
            <option value="2"
            <?php echo $recipe_opts['prrecipe_submission_login_required'] == 2 ? 'SELECTED' : ''; ?>>Yes</option>
        </select>
    <?php
}




function prrecipe_opts_sanitize( $input ){
    $input['rating_login_required']             =   absint( $input['rating_login_required'] );
    $input['prrecipe_submission_login_required']  =   absint( $input['prrecipe_submission_login_required'] );
    return $input;
  }