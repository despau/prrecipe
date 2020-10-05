<?php


function prrecipe_create_account(){

    $output             =   [ 'status' => 1 ];
    $nonce              =   isset( $_POST[ '_wnonce' ] ) ? $_POST[ '_wnonce' ] : '';

    if ( !wp_verify_nonce( $nonce, 'recipe_auth' ) ){

        wp_send_json( $output );

    }

    if( !isset($_POST['username'], $_POST['email'], $_POST['pass'], $_POST['confirm_pass']) ){

        wp_send_json($output);

      }

      $name                   =   sanitize_text_field( $_POST['name'] );
      $username               =   sanitize_text_field( $_POST['username'] );
      $email                  =   sanitize_email( $_POST['email'] );
      $pass                   =   sanitize_text_field( $_POST['pass'] );
      $confirm_pass           =   sanitize_text_field( $_POST['confirm_pass'] );

      if( username_exists($username) || email_exists($email) || $pass != $confirm_pass || !is_email($email) ){

        $output['yeet'] = 2;

        wp_send_json($output);

      }


      // CREATE THE USER
      $user_id                =   wp_insert_user([

        'user_login'          =>  $username,
        'user_pass'           =>  $pass,
        'user_email'          =>  $email,
        'user_nicename'       =>  $name

      ]);

      // CHECK FOR ERROR
      if( is_wp_error($user_id) ){

        wp_send_json($output);

      }

      // EMAIL THE USER/ADMIN/BOTH TO RECIEVE EMAIL FROM WP ABOUT THEIR SUCCESFULL ACCOUNT CREATION
      wp_new_user_notification( $user_id, null, 'user' );

      // GET THE NEW USER
      $user                   =   get_user_by( 'id', $user_id );

      //SET NEW USER AS CURRENT USER
      wp_set_current_user( $user_id, $user->user_login );

      //SET AUTH COOKIE FOR CURRENT USER
      wp_set_auth_cookie( $user_id );

      // Log the user IN
      do_action( 'wp_login', $user->user_login, $user );

      $output['status']       = 2;

      wp_send_json($output);

}