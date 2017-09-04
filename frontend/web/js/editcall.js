$(document).ready(function() {
        $('.panel-callcenter').each(function(i) {
            if ($.cookie('submenuMark-' + i)) {
                $(this).show();
            }else {
                $(this).hide();
            }
            $(this).prev().click(function() {
                var this_i = $('.panel-callcenter').index($(this).next());
                if ($(this).next().css('display') == 'none') {
                    $(this).next().slideDown(200, function () {
                        cookieSet(this_i);
                    });
                }else {
                    $(this).next().slideUp(200, function () {
                        cookieDel(this_i);
                    });
                }
                return false;
            });
        });

    $('.breadcrumb li a').click(function () {
        $('body').showLoading();
    });

    $('.btn-primary, .btn-success').on('click', function () {
        var $btn = $(this).button('loading')
        function func() {
            $btn.button('reset')
        }

        setTimeout(func, 3000);
    })
});

function cookieSet(index) {
    $.cookie('submenuMark-' + index, 'opened');
}
function cookieDel(index) {
    $.removeCookie('submenuMark-' + index, null);
}