$(document).ready(function() {
    $("#blog-update").validate({
        rules: {
            name: "required",
            slug: "required",
            short_description: "required",
            description: "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
