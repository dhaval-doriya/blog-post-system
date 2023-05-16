$(document).ready(function () {

    $("#blog-create").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            slug: {
                required: true,
            },
            image: {
                required: true,
            },
            'categories[]': {
                required: true,
            },
            short_description: {
                required: true,
                minlength: 50,
                maxlength:200
            },
            description: {
                required: true,
                minlength: 5,
                maxlength: 65000,

            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters"
            },
            slug: {
                required: "slug is required",
            },
            image: {
                required: "image is required",
            },
            'categories[]': {
                required: "atleast one categories  required",

            },
            short_description: {
                required: "short_description is required",
                minlength: "short_description should At least 50 characters",
                maxlength: "short_description should At least 200 characters",

            },
            description: {
                required: "description is required",
                minlength: "description should At least 5 characters"
            },


        }
    });




    $("#blog-update").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            slug: {
                required: true,
            },
            image: {
                required: false,
            },
            'categories[]': {
                required: true,
            },
            short_description: {
                required: true,
                minlength: 50,
            },
            description: {
                required: true,
                minlength: 5,
                maxlength: 65000,

            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters"
            },
            slug: {
                required: "slug is required",
            },
            image: {
                required: "image is required",
            },
            'categories[]': {
                required: "atleast one categories  required",

            },
            short_description: {
                required: "short_description is required",
                minlength: "short_description should At least 50 characters",
            },
            description: {
                required: "description is required",
                minlength: "description should At least 3 characters"
            },

        }
    });
});
