// user-edit
$(document).ready(function() {
    $("#user-edit").validate({
        rules: {
            name: "required",
            phone: "required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
