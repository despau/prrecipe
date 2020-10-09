<?php


function prrecipe_dashboard_widgets(){

    //(id, title, function)
    wp_add_dashboard_widget(
        'prrecipe_latest_recipe_rating_widget',
        'Latest Recipe Ratings',
        'prrecipe_latest_recipe_rating_display'
      );
    }

    //the function
    function prrecipe_latest_recipe_rating_display(){
      global $wpdb;

      $latest_ratings       = $wpdb->get_results(
        "SELECT * FROM `" . $wpdb->prefix . "recipe_ratings` ORDER BY `ID` DESC LIMIT 5"
      );

      echo '<ul>';

        foreach($latest_ratings as $rating){
            $title              =   get_the_title( $rating->recipe_id );
            $permalink          =   get_the_permalink( $rating->recipe_id );
            $rating_count       =   $rating->rating;

            ?>
                <li>
                    <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                    received a rating of <?php echo $rating_count; ?>
                </li>
            <?php
        }

      echo '</ul>';

}