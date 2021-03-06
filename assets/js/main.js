(function($){

    // RATE RECIPE
    $("#recipe_rating").bind( 'rated', function(){
        $(this).rateit( 'readonly', true );

        var form        =   {
            action:         'prrecipe_rate_recipe',
            rid:            $(this).data( 'rid' ),
            rating:         $(this).rateit( 'value' )
        };

        $.post( recipe_obj.ajax_url, form, function(data){

        });
    });


    //FOR MEDIA UPLOADER
    var featured_frame       =   wp.media({
        title:  'select or upload media',
        button: {
            text:   'Use this media'
        },
        multiple:   false
    });

    featured_frame.on( 'select', function(){
        var attachment      =   featured_frame.state().get( 'selection' ).first().toJSON();

        //set the src attribute of the button to the attachment url
        $( '#recipe-img-preview' ).attr( 'src', attachment.url );
        $( '#prrecipe_inputImgID' ).val( attachment.id );

    });

    $(document).on( 'click', '#recipe-img-upload-btn', function(e){
        e.preventDefault();

        featured_frame.open();
    } );


    // SUBMIT RECIPE
    $( '#recipe-form' ).on( 'submit', function(e){
        e.preventDefault();

        $(this).hide();

        $( '#recipe-status' ).html(
            '<div class="alert alert-info">Please wait! We are submiting your recipe.</div>'
        );


        var form        =   {
            action:             'prrecipe_submit_user_recipe',
            title:              $( '#prrecipe_inputTitle' ).val(),
            content:            tinymce.activeEditor.getContent(),
            attachment_id:      $( '#prrecipe_inputImgID' ).val( )
        }

        $.post( recipe_obj.ajax_url, form, function(data){

            if(data.status == 2){

                $( '#recipe-status' ).html( '<div class="alert alert-success">Recipe submitted successfully!</div>' );

            } else{

                $( '#recipe-status' ).html( '<div class="alert alert-danger">Unable to submit recipe. Please fill in all fields.</div>' );

                $( "#recipe-form" ).show();

            }

        });

    })


    // SUBMIT REGISTER FORM
    $(document).on( 'submit', '#register-form', function(e){

        e.preventDefault();

        $("#register-status").html(
            '<div class="alert alert alert-info">Please wait!</div>'
        );
        $(this).hide();

        var form                            =   {
            _wpnonce:                           $("#_wpnonce").val(),
            action:                             "prrecipe_create_account",
            name:                               $("#register-form-name").val(),
            username:                           $("#register-form-username").val(),
            email:                              $("#register-form-email").val(),
            pass:                               $("#register-form-password").val(),
            confirm_pass:                       $("#register-form-repassword").val()
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){

            if( data.status == 2 ){
                $("#register-status").html(
                    '<div class="alert alert-success">Account created!</div>'
                );

                location.href               =   recipe_obj.home_url;

            }else{
                $("#register-status").html(
                    '<div class="alert alert-danger">Unable to create an account.</div>'
                );
                $("#register-form").show();
            }

        });

    });


    // SUBMIT LOGIN FORM
    $(document).on( 'submit', '#login-form', function(e){
        e.preventDefault();

        $("#login-status").html('<div class="alert alert-info">Please wait while we log you in.</div>');
        $(this).hide();

        var form                                    =   {
            _wpnonce:                                   $("#_wpnonce").val(),
            action:                                     "prrecipe_user_login",
            username:                                   $("#login-form-username").val(),
            pass:                                       $("#login-form-password").val()
        };

        $.post( recipe_obj.ajax_url, form ).always(function(data){
            if( data.status == 2 ){
                $("#login-status").html('<div class="alert alert-success">Success!</div>');
                location.href                       =   recipe_obj.home_url;
            }else{
                $("#login-status").html(
                    '<div class="alert alert-danger">Unable to login.</div>'
                );
                $("#login-form").show();
            }
        });
    });

})(jQuery);