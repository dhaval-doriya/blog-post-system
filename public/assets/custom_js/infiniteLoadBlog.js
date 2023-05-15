var page = 1;

let dataloaded = true

$(window).on('scroll', () => {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20) && dataloaded) {
        page++;
        loadBlogs(page);
    }
});


function loadBlogs(page) {
     dataloaded = false;
    $.ajax({
        url: "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            $('.auto-load').show();
        },
        success: function (results) {
            if (results === '') {
                $('.auto-load').html("<h1> We don't have more blogs to display :( </h1>");
                dataloaded = false;
                return;
            }
            $('.auto-load').hide();
            $('#blog-list').append(results);
             dataloaded = true;


        },

        error: function (response) {
            console.log('Server error occured');

        }
    });

}
