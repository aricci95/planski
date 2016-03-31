$(document).ready(function() {
    $("body").click(function (e) {
        if (!$(e.target).hasClass('dropdown')) {
            $(".dropdown-menu").hide();
            $(".dropdownIndex").removeClass('dropdownIndex');
        }
    });

    $(".dropdown").click(function (e) {
        e.preventDefault();

        if ($(".dropdown-menu").css('display') === 'none') {
            $(".dropdown-menu").show();
            $(".onglet").show();
        } else {
            $(".dropdown-menu").hide();
            $(".onglet").hide();
            $(".dropdownIndex").removeClass('dropdownIndex');
        }
    });

    $(".dropdown-menu li").hover(function (e) {
        $(".dropdownIndex").removeClass('dropdownIndex');

        if (!$(e.target).hasClass('dropdownOption')) {
            $(e.target).addClass('dropdownIndex');
        } else {
            $(e.target).closest("li").addClass('dropdownIndex');
        }
    });

    $(".dropdown-menu li").click(function (e) {
        window.location.replace($(e.target).find('.dropdownOption').attr('href'));
    });
});