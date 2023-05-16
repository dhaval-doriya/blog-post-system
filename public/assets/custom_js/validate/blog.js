$(document).ready(function () {

    $("#blog-create").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength:200
            },
            slug: {
                required: true,
                minlength: 3,
                maxlength:200
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
                minlength: 50,
                maxlength: 65000,

            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters",
                maxlength: "The name must not be greater than 200 characters.",
            },
            slug: {
                required: "slug is required",
                minlength: "slug should At least 3 characters",
                maxlength: "The slug must not be greater than 200 characters.",

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
                maxlength: "The short_description must not be greater than 200 characters.",

            },
            description: {
                required: "description is required",
                minlength: "description should At least 50 characters",
                maxlength: "The description must not be greater than 65000 characters.",

            },


        }
    });




    $("#blog-update").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength:200
            },
            slug: {
                required: true,
                minlength: 3,
                maxlength:200
            },
            image: {
                required: false,
            },
            'categories[]': {
                required: true,
            },
            short_description: {
                required: true,
                minlength: 20,
                maxlength:200
            },
            description: {
                required: true,
                minlength: 50,
                maxlength: 65000,

            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name should At least 3 characters",
                maxlength: "The name must not be greater than 200 characters.",
            },
            slug: {
                required: "slug is required",
                minlength: "slug should At least 3 characters",
                maxlength: "The slug must not be greater than 200 characters.",
            },
            image: {
                required: "image is required",
            },
            'categories[]': {
                required: "atleast one categories  required",

            },
            short_description: {
                required: "short description is required",
                minlength: "short description should At least 50 characters",
                maxlength: "The short description must not be greater than 200 characters.",

            },
            description: {
                required: "description is required",
                minlength: "description should At least 50 characters",
                maxlength: "The description must not be greater than 65000 characters.",

            },
        }
    });
});
