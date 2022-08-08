jQuery(document).ready(function($) {
if (!$("body").hasClass("dokan-theme-ibid")) {
    
    $('form#register').on('submit', function(e){
        $('form#register p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_register_object.ajaxurl,
            data: {
                action: 'register_user',
                'username': $('form#register #reg_username').val(),
                'email': $('form#register #reg_email').val(),
                'password': $('form#register #reg_password').val(),
                'security': $('form#register #security').val() },

            success: function(data){
                $('form#register p.status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_register_object.redirecturl;
                }
            }

        });
        e.preventDefault();
    });
}
});
