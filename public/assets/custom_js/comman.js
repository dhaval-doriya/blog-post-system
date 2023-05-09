
$(document).ready(function () {
    // Select2 Multiple
    $('.select2-multiple').select2({
        placeholder: "Select",
        allowClear: true
    });

    // manage-status
    $(document).on("change", ".manage-status", function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'PATCH',
            url: $(this).attr('data-action'),
            data: {
                _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            success: function (results) {
                if (results.success === true) {
                    toastr.success('Status Changed');
                    // console.log('Status Changed');
                } else {
                    toastr.error('get(error)');

                    console.log('error');
                }
            }, error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Want Wrong',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        });
    })


    // for logout alert
    $("body").on("click", ".user-logout", function () {
        var current_object = $(this);
        swal.fire({
            title: "Are you sure Youn want to Logout?",
            icon: "question",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $("#user_logout").submit();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    });

    //delete anything  like user blog or category //delete
    $(document).on("click", ".remove-user", function () {
        var current_object = $(this);
        swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this Record!",
            icon: 'question',
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes",
            cancelButtonText: "No!",
            reverseButtons: !0

        }).then(function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'DELETE',
                    url: current_object.attr('data-action'),
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: results.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            loadData()
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    });


    //UPDATE STATUS  blog
    $(document).on("click", ".approve-blog", function () {
        text = $(this).data('text');
        var current_object = $(this);

        swal.fire({
            title: text,
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes!",
            cancelButtonText: "No",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'PATCH',
                    url: current_object.attr('data-action'),
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: results.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            loadData();
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });
            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    })





    //check slug code


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $("#name").change(function (e) {
        $("#slug").val(convertToSlug($("#name").val()))
        $("#slug").click()
    })


    $("#slug").click(function (e) {
        e.preventDefault();
        checkSlug()
    });

    $("#slug").change(function (e) {
        e.preventDefault();
        checkSlug()
    });

    function convertToSlug(Text) {
        return Text.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
    }

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
            type: 'POST',
            url: $('#slug').attr('data-action'),
            data: data,
            dataType: 'JSON',
            success: function (results) {
                if (results.success === true) {
                    $("#slug").val(results.slug)
                    $(".error-slug").empty()
                    $(".success-slug").text('This Slug is Available')
                    $("#submit").attr("disabled", false);
                } else {
                    $(".success-slug").empty()
                    $(".error-slug").text(results.message)
                    $("#submit").attr("disabled", true);
                }
            },

            error: function (response) {
                const myJSON = JSON.parse(response['responseText']);
                $(".success-slug").empty()
                $(".error-slug").text(myJSON.errors.slug)
            }
        });
    }



    //load table data ajax
    function loadData() {

        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                console.log(page);
                getData(page);
            }
        } else {
            getData(1);

        }
    }


})
