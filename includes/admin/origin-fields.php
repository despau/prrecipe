<?php

function prrecipe_origin_add_form_fields(){

    ?>
        <div class="form-field">
            <label><?php _e( 'More Info URL', 'prrecipe' ); ?></label>
            <input type="text" name="prrecipe_more_info_url">
            <p class="description">
                <?php
                    esc_html_e( 'A URL a user can click to learn more information about this origin.', 'prrecipe' );
                ?>
            </p>
        </div>
    <?php

}



function prrecipe_origin_edit_form_fields( $term ){

    $url          = get_term_meta( $term->term_id, "more_info_url", true );

    ?>
    <tr class="form-field">
      <th scope="row" valign="top"><label><?php esc_html_e( 'More Info URL', 'prrecipe' ); ?></label></th>
      <td>
        <input type="text" name="prrecipe_more_info_url" value="<?php echo esc_attr( $url ); ?>">
        <p class="description">
          <?php
          esc_html_e( 'A URL a user can click to learn more information about this origin.', 'prrecipe' );
          ?>
        </p>
      </td>
    </tr>
    <?php

}