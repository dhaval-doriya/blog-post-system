$("#change-password").validate({
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
    },
    messages: {
        old_password: {
            required: "password is required",
            minlength: "password must be at least 8 characters",
        },
        password: {
            required: "password is required",
            minlength: "password must be at least 8 characters",
        },
        confirm_password: {
            required: "confirm_password is required",
            minlength: "confirm_password must be at least 8 characters",
        }
    }
});
// old_password
// password
// confirm_password
