
//validtion for change password page
$(document).ready(function () {
    $("#storeUser").validate({
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
                maxlength: 25,
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
                required: "Phone is required",
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
                maxlength: 25,
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
                required: "Phone is required",
            },

        }
    });

});

