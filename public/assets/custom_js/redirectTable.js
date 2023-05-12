if (window.location.hash[1] > 1) {
    console.log('object');
    getData(window.location.hash[1] - 1)
}


if (!window.location.hash || window.location.hash[1] == 1) {

    var rowCount = $("#tabledata td").length;
    // var query = $('#serach').val();

    if (!rowCount) {

        $('#tabledata').empty();

        $('#tabledata').html(`<td colspan="7" class='text-center'> <h2>You don't have any Records <p onclick=location.reload()  class='btn btn-' >Click Here   </p>  </h2> </td>`)
    }

}
