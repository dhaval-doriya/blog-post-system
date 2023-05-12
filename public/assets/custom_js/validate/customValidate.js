$(document).ready(function () {
    //phone
    jQuery.validator.addMethod(
        "phone",
        function (value, element) {
            const regexp = /^([0-9\s\-\+\(\)]*)$/;
            return this.optional(element) || value.match(regexp);
        },
        "Please Enter a Valid Phone Number."
    );

    //email
    jQuery.validator.addMethod(
        "email",
        function (value, element) {
            const regexp = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
            return this.optional(element) || value.match(regexp);
        },
        "Please Enter a Valid Email Address."
    );
});
