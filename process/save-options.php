<?php

function prrecipe_save_options(){

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit;

    if( !current_user_can( 'edit_theme_options' ) ){
        wp_die( __( 'You are not allowed to be on this page.', 'prrecipe' ) );
      }

      check_admin_referer( 'prrecipe_options_verify' );

      $recipe_opts                                      =   get_option( 'prrecipe_opts' );
      $recipe_opts['rating_login_required']             =   absint($_POST['prrecipe_rating_login_required']);
      $recipe_opts['prrecipe_submission_login_required']  =   absint($_POST['prrecipe_submission_login_required']);

      update_option( 'prrecipe_opts', $recipe_opts );
      wp_redirect( admin_url('admin.php?page=prrecipe_plugin_opts&status=1') );

}