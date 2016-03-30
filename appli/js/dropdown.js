$(document).ready(function() {
    $("body").click(function (e) {
        if (!$(e.target).hasClass('dropdown')) {
            $(".dropdown-menu").hide();
        }
     });

    $(".dropdown").click(function (e) {
        e.preventDefault();

        if ($(".dropdown-menu").css('display') === 'none') {
            $(".dropdown-menu").show();
        } else {
            $(".dropdown-menu").hide();
        }
     });
});