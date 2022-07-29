jQuery(document).ready(function() {
    var dashboard_for_different_login_user_url = "tools.php?page=dashboard_add_settings_page";
    window.history.replaceState({}, document.title, dashboard_for_different_login_user_url);
});
jQuery(document).on('click', '.button-custom-dismiss', function(e) {
    jQuery(this).parent().hide();
})