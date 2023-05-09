  // Summernote
  $(function() {
    $('#summernote').summernote()
  })


  // onImageUpload callback
  $('#summernote').summernote({
    callbacks: {
      onImageUpload: function(files) {
        // console.log(files);
        uploadFile(files[0]);
        $summernote.summernote('insertNode', imgNode);
      }
    }
  });


  //Upload file Function
  function uploadFile(file) {
    data = new FormData();
    data.append("file", file);
    data.append("_token", jQuery('meta[name="csrf-token"]').attr('content'));
    $.ajax({
      data: data,
      type: "POST",
      url: "{{route('blog.description')}}",
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
          $('#summernote').summernote("insertImage", data.url);   
      },
      error: function(response) {
        const myJSON = JSON.parse(response['responseText']);
        Swal.fire({
          icon: 'error',
          title: myJSON.errors.file,
          showConfirmButton: false,
          timer: 1000
        })
      }
    });
  }


  //for previewing image after selection of image
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview_image').attr('src', e.target.result).height(150);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }




  $("#blog-create").validate({
    rules: {
      name: "required",
      slug: "required",
      short_description: "required",
      'categories[]': "required",
      image: "required",
    },
    messages: {
      image: {
        required: "Please Select a Image",
      }
    },
    submitHandler: function(form) {
      form.submit();
    }
  });