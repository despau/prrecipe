<?php

function prrecipe_deactivate_plugin(){

    wp_clear_scheduled_hook( 'prrecipe_daily_recipe_hook' );

}