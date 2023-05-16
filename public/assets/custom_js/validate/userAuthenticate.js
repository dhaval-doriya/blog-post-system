
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

    //for login page
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            },
        },
        messages: {
            email: {
                required: "email is required",
            },
            password: {
                required: "password is required",
                minlength: "password should At least 8 characters"
            },
        }
    });

    //register
    $("#registerUser").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                maxlength: 20,
                minlength: 10,
                phone: 'phone'
            },
            password: {
                required: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '#password'
            },
        },
        messages: {
            name: {
                minlength: "name should At least 3 characters",
            },
            email: {
                required: "email is required",
            },
            phone: {
                required:  "phone is required",
                maxlength: "The slug must not be greater than 20 characters.",
                minlength: "phone should At least 10 characters",
            },
            password: {
                required: "password is required",
                minlength: "password should At least 8 characters"
            },
            password_confirmation: {
                required: " confirm password is required",
                minlength: " confirm password should At least 8 characters"
            },
        }
    });

    //RESET PASSWORD REQUEST
    $("#passwordReset").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            email: {
                required: "email is required",
            },
        }
    });
    //confirmPassword
    $("#confirmPassword").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            required: "password is required",
            minlength: "password should At least 8 characters"
        }
    });

    //reset-password-form
    $("#resetPassword").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '#password'
            },
        },
        messages: {
            email: {
                required: "email is required",
            },
            password: {
                required: "password is required",
                minlength: "password should At least 8 characters"
            },
            password_confirmation: {
                required: "confirm password is required",
                minlength: "confirm password should At least 8 characters",
                equalTo: "confirm Please ensure your passwords match."
            },

        }
    });

});


