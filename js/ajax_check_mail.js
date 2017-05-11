$('.email-ajax').on('keyup', function () {
    // Settings
    var selector = $('.email-ajax-result');

    // Value of input field
    var val = $(this).val();

    // Ajax request
    $.ajax({
        method: "POST",
        url: "ajax/check_mail.php",
        data: {'email': val},
        success: function (data) {
            if (data.message.val != "0") {
                selector.html('Emailadres is al geregistreerd');
                selector.parent('.form-group').removeClass('has-success').addClass('has-error');
            } else {
                selector.html('');
                selector.parent('.form-group').removeClass('has-error').addClass('has-success');
            }
        }
    });
})