( function ($) {

/* ---------------------------------------------- /*
         * Navbar menu sticky
         /* ---------------------------------------------- */
            $(window).bind('scroll', function () {
                 if ($(window).scrollTop() > 200) {
                $('.navbar').addClass('stickymenu1');
                $('.navbar').slideDown();
            } else {
                $('.navbar').removeClass('stickymenu1');
                $('.navbar').attr('style','');
            }
        });
 }) ( jQuery);