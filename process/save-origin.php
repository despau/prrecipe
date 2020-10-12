<?php

function prrecipe_save_origin_meta( $term_id ){

    if( !isset($_POST['prrecipe_more_info_url']) ){
        return;
      }

      //each taxonomy is also a term. so they have metadata
      update_term_meta( $term_id, 'more_info_url', esc_url($_POST['prrecipe_more_info_url']) );
      echo 'More INFO URL NOT FOUND';

}