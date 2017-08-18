$(document).ready(function() {
    $('.list-group').on('click', function() {
        $(this).parent().children('.panel-callcenter').toggle();
    });
});