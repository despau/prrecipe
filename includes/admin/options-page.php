<?php

function prrecipe_plugin_opts_page(){

    $recipe_opts            = get_option( 'prrecipe_opts' );

    ?>

        <div class="wrap">

            <div class="card-body">

                <h3 class="card-title"><?php _e('Recipe Settings', 'prrecipe' ); ?></h3>

                <?php

                if( isset($_GET['status']) && $_GET['status'] == 1 ){
                    ?><div class="alert alert-success">Options updated successfully!</div><?php
                }

                ?>

                <form method="POST" action="admin-post.php">

                    <input type="hidden" name="action" value="prrecipe_save_options">

                    <?php wp_nonce_field( 'prrecipe_options_verify' ); ?>

                    <div class="form-group">

                        <label><?php _e('User login required for rating recipes', 'prrecipe'); ?></label>

                        <select class="form-control" name="prrecipe_rating_login_required">
                            <option value="1">No</option>
                            <option value="2"
                                <?php echo $recipe_opts['rating_login_required'] == 2 ? 'SELECTED' : '' ?>>Yes</option>
                        </select>

                    </div>

                    <div class="form-group">

                        <label><?php _e('User login required for submitting recipes', 'prrecipe'); ?></label>

                        <select class="form-control" name="prrecipe_submission_login_required">
                            <option value="1">No</option>
                            <option value="2"
                                <?php echo $recipe_opts['prrecipe_submission_login_required'] == 2 ? 'SELECTED' : '' ?>>Yes</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php _e('Update', 'prrecipe'); ?></button>
                    </div>

                </form>

            </div>

            <!-- TO SEPARATE CUSTOM FORM FROM SETTINGS API FORM -->
            <hr>

            <form action="options.php" method="post" >

                <!-- post to OPTIONS.PHP when using the SETTINGS API -->
                <?php

                    settings_fields( 'prrecipe_opts_group' );
                    do_settings_sections( 'prrecipe_opts_sections' );
                    submit_button();

                    //reember to enqueue this through the admin init

                ?>

            </form>

        </div>

    <?php

}