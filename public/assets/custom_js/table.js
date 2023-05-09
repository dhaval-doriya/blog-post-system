



// search sort pagninate ajax

$(document).ready(function () {

    function clear_icon() {
        $('#id_icon').html('');
        $('#post_title_icon').html('');
    }


    $(document).on('keyup', '#serach', function () {
        var query = $('#serach').val();
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        // var page = $('#hidden_page').val();
        let page = 1;
        var table = $('#hidden_table_name').val();

        fetch_data(table, page, sort_type, column_name, query);
    });

    $(document).on('keydown', '#serach', function () {
        var query = $('#serach').val();
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        // var page = $('#hidden_page').val();
        let page = 1;
        var table = $('#hidden_table_name').val();

        fetch_data(table, page, sort_type, column_name, query);
    });


    $(document).on('click', '.sorting', function () {
        var column_name = $(this).data('column_name');
        var order_type = $(this).data('sorting_type');
        var reverse_order = '';
        if (order_type == 'asc') {
            $(this).data('sorting_type', 'desc');
            reverse_order = 'desc';
            clear_icon();
            $('#' + column_name + '_icon').html(
                '<i class="fa fa-angle-down" aria-hidden="true"></i>'
            );
        }
        if (order_type == 'desc') {
            $(this).data('sorting_type', 'asc');
            reverse_order = 'asc';
            clear_icon();
            $('#' + column_name + '_icon').html(
                '<i class="fa fa-angle-up" aria-hidden="true"></i>'
            );
        }
        $('#hidden_column_name').val(column_name);
        $('#hidden_sort_type').val(reverse_order);
        var page = $('#hidden_page').val();
        var query = $('#serach').val();
        var table = $('#hidden_table_name').val();


        fetch_data(table, page, reverse_order, column_name, query);
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();
        var table = $('#hidden_table_name').val();
        var query = $('#serach').val();
        console.log(page);

        $('li').removeClass('active');
        $(this).parent().addClass('active');
        fetch_data(table, page, sort_type, column_name, query);
    });





    //Hash Change Code
    $(window).on('hashchange', function () {
        if (window.location.hash) {
            loadData()
        }
    });



    //prevent Loading
    $(window).on('load', function () {
        if (location.hash) {
            location.hash = 1
        }
    });


    // if (!window.location.hash || window.location.hash[1] == 1) {
    //     if ($("#tabledata td").length == 1) {
    //         console.log('object');
    //     // //     // if ($('#tabledata').is(':empty')) {
    //         location.reload()
    //     }
    // }


    if (window.location.hash[1] > 1) {
        loadData()
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


});




//get data
function getData(page) {

    var column_name = $('#hidden_column_name').val();
    var sort_type = $('#hidden_sort_type').val();
    var table = $('#hidden_table_name').val();
    var query = $('#serach').val();

    fetch_data(table, page, sort_type, column_name, query);

}


//Main Function

function fetch_data(table, page, sort_type, sort_by, query) {
    $.ajax({
        url: table + "?page=" + page + "&sortby=" + sort_by + "&sorttype=" +
            sort_type + "&query=" + query,
        success: function (data) {
            $("tbody").empty().html(data);
            location.hash = page;
        },
        error: function (res) {
        },
    })
}


