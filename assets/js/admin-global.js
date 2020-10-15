(function($){
    $(document).on( "click", "#prrecipe-recipe-pending-notice .notice-dismiss",  function(e){
        e.preventDefault();

        $.post( ajaxurl, {
            action:         'prrecipe_dismiss_pending_recipe_notice'
        });
    });
})(jQuery);