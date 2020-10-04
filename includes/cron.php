<?php

function prrecipe_daily_generate_recipe(){

    set_transient(
        'prrecipe_daily_recipe',
        prrecipe_get_random_recipe(),
        DAY_IN_SECONDS
    );

}