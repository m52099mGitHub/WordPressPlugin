jQuery(window).on('load',function() {
    jQuery('.admincolinmrs').delay(10000).slideDown('slow');
});
jQuery(document).ready(function () {
    jQuery('.close_admincolin_help').on('click', function (e) {
        var what_to_do = jQuery(this).data('ct');
        var nonce = dt_params.nonce
        jQuery.ajax({
            type: "post",
            url: dt_params.ajax_url,
            data: {
                action: "mk_admincolin_close_admincolin_help",
                what_to_do: what_to_do,
                nonce:nonce
            },
            success: function (response) {
                jQuery('.admincolinmrs').slideUp('slow');
            }
        });
    });
});
jQuery(document).ready(function() {
    var admin_post_and_page_url = "options-general.php?page=duplicate_post_and_page_settings";
    window.history.replaceState({}, document.title, admin_post_and_page_url);
});
jQuery(document).on('click', '.button-custom-dismiss', function(e) {
    jQuery(this).parent().hide();
})