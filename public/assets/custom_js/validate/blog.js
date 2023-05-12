$(document).ready(function () {

    $("#blog-create").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            slug: {
                required: true,
                maxlength: 25,
                minlength: 10,
                phone: phone,
            },
            short_description: {
                required: true,
                minlength: 3,
            },
            description: {
                required: true,
                minlength: 3,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters"
            },
            slug: {
                required: "slug is required",
                maxlength: 25,
                minlength:"Name should At least 3 characters"
            },
            short_description: {
                required: true,
                minlength: 3,
            },
            description: {
                required: true,
                minlength: 3,
            },

        }
    });




    $("#blog-update").validate({
        rules: {
            name: "required",
            slug: "required",
            short_description: "required",
            description: "required",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
