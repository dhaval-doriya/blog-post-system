$(document).ready(function() {

    $("#category-update").validate({
      rules: {
        name: "required",
        slug: "required",
      },
      messages: {

      },
      submitHandler: function(form) {
        form.submit();
      }
    });
  })
