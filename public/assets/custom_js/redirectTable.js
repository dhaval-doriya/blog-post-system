if (window.location.hash[1] > 1) {
    console.log('object');
    getData(window.location.hash[1] - 1)
}


if (!window.location.hash || window.location.hash[1] == 1) {

    var rowCount = $("#tabledata td").length;
    // var query = $('#serach').val();

    if (!rowCount) {

        $('#tabledata').empty();

        $('#tabledata').html(`<td colspan="7" class='text-center'>You don't have any Records <button onclick=location.reload()  class='btn btn-' >Click Here  Reload </button>   </td>`)
    }

}
