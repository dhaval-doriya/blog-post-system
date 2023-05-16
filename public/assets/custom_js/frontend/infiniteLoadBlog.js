var page = 1;

let dataLoaded = true

$(window).on('scroll', () => {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 15) && dataLoaded) {
        page++;
        loadBlogs(page);
    }
});


function loadBlogs(page) {
    dataLoaded = false;
    $.ajax({
        url: "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            $('.auto-load').show();
        },
        success: function (results) {
            if (results === '') {
                $('.auto-load').html("<h1> We don't have more blogs to display :( </h1> <br><button onclick='topFunction()' id='myBtn' title='Go to top'>Scroll Top</button>");
                dataLoaded = false;
                return;
            }
            $('.auto-load').hide();
            $('#blog-list').append(results);
            dataLoaded = true;


        },

        error: function (response) {
            console.log('Server error occured');

        }
    });

}


function topFunction() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
