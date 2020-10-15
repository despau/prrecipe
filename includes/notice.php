<?php


function prrecipe_admin_notices() {

        if( !get_option( '$pending_recipe_count' ) ){
            return;
        }

    ?>

        <div id="prrecipe-recipe-pending-notice" class="notice notice-warning is-dismissible">

            <p>
                <?php _e( 'You have some recipes awating reviews', 'prrecipe' ); ?>
            </p>

        </div>

    <?php

}