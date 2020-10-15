<?php

function prrerecipe_activate_plugin(){

    if( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ){
        wp_die( __( "You ust update WordPress to use this plugin.", "prrecipe") );
    }

    recipe_init();
    flush_rewrite_rules(  );

    global $wpdb;

    // $createSQL      =   "
    // CREATE TABLE `" . $wpdb->prefix . "recipe_ratings` (
    //     `ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    //     `recipe_id` BIGINT(20) UNSIGNED NOT NULL,
    //     `rating` FLOAT(3,2) UNSIGNED NOT NULL,
    //     `user_ip` VARCHAR(50) NOT NULL,
    //     PRIMARY KEY (`ID`)
    // ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";

    $createSQL      =   "
    CREATE TABLE `" . $wpdb->prefix . "AAAABSOLUTEdb` (
        ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        recipe_id bigint(20) UNSIGNED NOT NULL,
        rating float(3,2) UNSIGNED NOT NULL,
        user_ip varchar(50) NOT NULL,
        PRIMARY KEY (ID)
      ) ENGINE=InnoDB " . $wpdb->get_charset_collate() . ";";

    require( ABSPATH . "/wp-admin/includes/upgrade.php" );
    dbDelta( $createSQL );

    //setting transcient. worpdress will create this hook for us.
    wp_schedule_event( time(), 'daily', 'prrecipe_daily_recipe_hook',  );


    $recipe_opts                                =   get_option( 'prrecipe_opts' );

    if( !$recipe_opts ){
        $opts                                   =   [
            'rating_login_required'             =>  1,
            'prrecipe_submission_login_required'  =>  1
        ];

        add_option( 'prrecipe_opts', $opts );

    }


    //set subscribers the capability of uploading media to our recipe posts inline.
    global $wp_roles;

    // add_role( $role:string, $display_name:string, $capabilities:array )
    add_role(
        'recipe_author',
        __( 'Recipe Author', 'prrecipe' ),
        [
            'read'          =>  true,
            'edit_posts'    =>  true,
            'upload_files'  =>   true
        ]
    );
}