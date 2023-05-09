if (window.location.hash[1] > 1) {
    console.log('object');
    getData(window.location.hash[1] - 1)
}


if (!window.location.hash || window.location.hash[1] == 1) {

    var rowCount = $("#tabledata td").length;
    // alert(rowCount); // Outputs: 4


    if (!rowCount) {

        $('.table').empty();
        $('.table').html(`<h1 class='text-center'>You don't have any Records  <a href='{{ route('blog.all') }}'>Click here to view</a></h1>`)
    }

}
