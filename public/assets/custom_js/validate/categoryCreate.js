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
