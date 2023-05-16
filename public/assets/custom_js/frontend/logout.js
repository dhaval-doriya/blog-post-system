       // for log out alert
       $("body").on("click", ".user-logout", function() {
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
        }).then(function(e) {
            if (e.value === true) {
                $("#user_logout").submit();
            } else {
                e.dismiss;
            }
        }, function(dismiss) {
            return false;
        })
    });
