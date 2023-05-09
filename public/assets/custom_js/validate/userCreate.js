$("#storeUser").submit(function() {
    Swal.fire({
      title: 'Please Wait !',
      html: 'From is submitting', // add html attribute if you want or remove
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading()
      },
    });
    $('#submit').attr('disabled', 'disabled');
  });
