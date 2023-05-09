
        // for profile image upload
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    let url =  $('#profileRoute').attr('data-action');
                    $.ajax({
                        url: url,
                        method: 'PUT',
                        dataType: 'JSON',
                        data: {
                            _token: $(this).attr('content'),
                            image: base64data,
                        },
                        success: function(response) {
                            // console.log(response.data);
                            $modal.modal('hide');
                            $('.remove-profile-btn').removeAttr('hidden');
                            $('#uploaded_image').attr('src', response.data);
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                };
            });
        });
