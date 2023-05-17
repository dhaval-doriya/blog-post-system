
//validtion for change password page
$(document).ready(function () {
    $("#user-create").validate({
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
                phone : phone
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters"
            },
            email: {
                required: "email is required",
            },
            phone: {
                required:  "phone is required",
                maxlength: "The phone must not be greater than 20 characters.",
                minlength: "phone should At least 10 characters",
            },

        }
    });


    $("#user-edit").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            phone: {
                required: true,
                maxlength: 20,
                minlength: 10,
                phone: phone,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters"
            },
            phone: {
                required:  "phone is required",
                maxlength: "The phone must not be greater than 20 characters.",
                minlength: "phone should At least 10 characters",
            },

        }
    });

});

