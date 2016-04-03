$(document).ready(function() {

    $("div .crew").mouseenter(function (e) {
        $(e.target).find('.join').show();
    });

    $("div .crew").mouseleave(function (e) {
        $(e.target).find('.join').hide();
    });
});