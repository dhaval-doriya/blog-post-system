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


    // /^[a-zA-Z]+$/
    jQuery.validator.addMethod(
        "checkName",
        function (value, element) {
            const regexp = /^[a-zA-Z]+$/;

            return this.optional(element) || value.match(regexp);
        },
        "Please Enter a Valid Name."
    );


    // jQuery.validator.addMethod(
    //     "checkSlug",
    //     function (value, element) {
    //         checkSlug(value)
    //         // return this.optional(element) || checkSlug(value);
    //     },
    //     "Slug is not available"
    // );


    //ajax request for slug check
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // })

    // function checkSlug(value) {
    //     // $("#submit").attr("disabled", true);
    //     // let isSuccess = false;
    //     let data = {
    //         _token: $('meta[name="csrf-token"]').attr('content'),
    //         slug: $("#slug").val(),

    //     }
    //     if ($('#slug').attr('data-id')) {
    //         data.id = $('#slug').attr('data-id');
    //     }
    //     $.ajax({
    //         type: 'POST',
    //         url: $('#slug').attr('data-action'),
    //         data: data,
    //         // dataType: 'JSON',
    //         dataType:"html",

    //         success: function (results) {
    //             console.log(results);
    //             return results;
    //             // isSuccess = results === "true" ? false : true
    //             if (results !== '') {
    //                 $("#submit").attr("disabled", true);
    //                 return false;
    //             } else {
    //                 $("#submit").attr("disabled", false);
    //                 return true;
    //             }
    //         },

    //         error: function (response) {
    //             return false;

    //             // console.log(response);

    //         }

    //     });
    //     // return isSuccess;
    // }

});
