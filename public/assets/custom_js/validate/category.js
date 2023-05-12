$(document).ready(function () {
    $("#category-create").validate({
        rules: {
            name: "required",
            slug: "required",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});


//validtion for change password page
$(document).ready(function () {

    $("#category-create").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            slug: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "name should At least 3 characters"
            },
            slug: {
                required: "slug is required",
            },

        }
    });


    $("#category-update").validate({
        rules: {
            name: "required",
            slug: "required",
        },
        messages: {

        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});

