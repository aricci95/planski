$(document).ready(function() {
    $("input:file").change(function () {
       $("form").submit();
    });

    $(".radio_img").click(function (e) {
        e.preventDefault();

        if (!$(e.target).hasClass('radio_img')) {
            var name = $(e.target).attr('data-name');
            var value = $(e.target).attr('data-value');

            $('input[name="' + name + '"][value="' + value + '"]').prop( "checked", true);
            $('.selected[data-name="' + name + '"]').removeClass('selected');
            $(e.target).addClass('selected');

            $.post("profile/change", { name : name, value : value}, function(data) {
                $.gritter.add({
                    text:  'Modification enregistrée.',
                    class_name : 'gritter-ok'
                });
            });
        }
    });

    $(".cursor_img").click(function (e) {
        e.preventDefault();

        if (!$(e.target).hasClass('cursor_img')) {
            var name = $(e.target).attr('data-name');
            var value = $(e.target).attr('data-value');

            $('input[name="' + name + '"][value="' + value + '"]').prop( "checked", true);
            $('.selected[data-name="' + name + '"]').removeClass('selected');
            $('img[data-name="' + $(e.target).attr('data-name') + '"]:lt(' + ($(e.target).attr('data-value')) + ')').removeClass('opacity');
            $('img[data-name="' + $(e.target).attr('data-name') + '"]:gt(' + ($(e.target).attr('data-value') - 1) + ')').addClass('opacity');
            $(e.target).removeClass('opacity');

            $.post("profile/change", { name : name, value : value}, function(data) {
                $.gritter.add({
                    text:  'Modification enregistrée.',
                    class_name : 'gritter-ok'
                });
            });
        }
    });
});