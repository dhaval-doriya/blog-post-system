
// Summernote
$(function () {
    $('#summernote').summernote()
})

// onImageUpload callback
$('#summernote').summernote({
    callbacks: {
        onImageUpload: function (files) {
            uploadFile(files[0]);
            $summernote.summernote('insertNode', imgNode);
        }
    }
});




//Upload file Function
function uploadFile(file) {

    url = $('#description').data('action')
    data = new FormData();
    data.append("file", file);
    data.append("_token", jQuery('meta[name="csrf-token"]').attr('content'));

    if (file.size > 2000000) {
        toastr.error('Select Image Size < 2MB');
        return false;
    }
    $.ajax({
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $('#summernote').summernote("insertImage", data.url);
        },
        error: function (response) {
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
        console.log();
        if (input.files[0].size > 2000000) {
            toastr.error('Select Image Size < 2MB');
            $('#fileToUpload').val('')
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview_image').attr('src', e.target.result).height(150);
        };
        reader.readAsDataURL(input.files[0]);
    }
}




//Jquery Validtion
$("#blog-update").validate({
    rules: {
        'categories[]': "required",
    },
    messages: {
        'categories[]': {
            required: "Please Select Atlest one Category",
        },
    },
    submitHandler: function (form) {
        form.submit();
    }
});
