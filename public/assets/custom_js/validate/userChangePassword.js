
//validtion for change password page
$(document).ready(function () {

    $("#change-password").validate({
        rules: {

            old_password: {
                required: true,
                minlength: 8,
            },
            password: {
                required: true,
                minlength: 8,
            },
            confirm_password: {
                required: true,
                minlength: 8,
                equalTo: '#password'
            },
        },
        messages: {
            old_password: {
                required: "password is required",
                minlength: "password should At least 8 characters"
            },
            password: {
                required: "new password is required",
                minlength: "new password should At least 8 characters"
            },
            confirm_password: {
                required: " confirm password is required",
                minlength: " confirm password should At least 8 characters"
            },

        }
    });



    // $('#password').on('input', function () {
    //     checkpass();
    // });
    // $('#confirm_password').on('input', function () {
    //     checkcpass();
    // });
    // $('#old_password').on('input', function () {
    //     checkcpass();
    // });


});


