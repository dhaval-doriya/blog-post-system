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
    //     "checkSlug", checkSlug(), "Slug is not available"
    // );





    function checkSlug() {
        $("#submit").attr("disabled", true);

        let data = {
            _token: $(this).attr('content'),
            slug: $("#slug").val(),
        }

        if ($('#slug').attr('data-id')) {
            data.id = $('#slug').attr('data-id');
        }

        $.ajax({

            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            type: 'POST',
            url: $('#slug').attr('data-action'),
            data: data,
            dataType: 'JSON',
            success: function (results) {
                console.log(results);
                if (results.success === true) {
                    // $("#slug").val(results.slug)
                    // $(".error-slug").empty()
                    // $(".success-slug").text('This Slug is Available')
                    // $("#submit").attr("disabled", false);
                } else {
                    // $(".success-slug").empty()
                    // $(".error-slug").text(results.message)
                    // $("#submit").attr("disabled", true);
                }
            },

            error: function (response) {
                // const myJSON = JSON.parse(response['responseText']);
                // $(".success-slug").empty()
                // $(".error-slug").text(myJSON.errors.slug)
            }
        });
    }



});
