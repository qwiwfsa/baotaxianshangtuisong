(function ($) {
  "use strict";
  //Loading AOS animation with css class

  //fade animation
  $(".sky-enterprise-fade-up").attr({
    "data-aos": "fade-up",
  });
  $(".sky-enterprise-fade-down").attr({
    "data-aos": "fade-down",
  });
  $(".sky-enterprise-fade-left").attr({
    "data-aos": "fade-left",
  });
  $(".sky-enterprise-fade-right").attr({
    "data-aos": "fade-right",
  });
  $(".sky-enterprise-fade-up-right").attr({
    "data-aos": "fade-up-right",
  });
  $(".sky-enterprise-fade-up-left").attr({
    "data-aos": "fade-up-left",
  });
  $(".sky-enterprise-fade-down-right").attr({
    "data-aos": "fade-down-right",
  });
  $(".sky-enterprise-fade-down-left").attr({
    "data-aos": "fade-down-left",
  });

  //slide animation
  $(".sky-enterprise-slide-left").attr({
    "data-aos": "slide-left",
  });
  $(".sky-enterprise-slide-right").attr({
    "data-aos": "slide-right",
  });
  $(".sky-enterprise-slide-up").attr({
    "data-aos": "slide-up",
  });
  $(".sky-enterprise-slide-down").attr({
    "data-aos": "slide-down",
  });

  //zoom animation
  $(".sky-enterprise-zoom-in").attr({
    "data-aos": "zoom-in",
  });
  $(".sky-enterprise-zoom-in-up").attr({
    "data-aos": "zoom-in-up",
  });
  $(".sky-enterprise-zoom-in-down").attr({
    "data-aos": "zoom-in-down",
  });
  $(".sky-enterprise-zoom-in-left").attr({
    "data-aos": "zoom-in-left",
  });
  $(".sky-enterprise-zoom-in-right").attr({
    "data-aos": "zoom-in-right",
  });
  $(".sky-enterprise-zoom-out").attr({
    "data-aos": "zoom-out",
  });
  $(".sky-enterprise-zoom-out-up").attr({
    "data-aos": "zoom-out-up",
  });
  $(".sky-enterprise-zoom-out-down").attr({
    "data-aos": "zoom-out-down",
  });
  $(".sky-enterprise-zoom-out-left").attr({
    "data-aos": "zoom-out-left",
  });
  $(".sky-enterprise-zoom-out-right").attr({
    "data-aos": "zoom-out-right",
  });

  //flip animation
  $(".sky-enterprise-flip-up").attr({
    "data-aos": "flip-up",
  });
  $(".sky-enterprise-flip-down").attr({
    "data-aos": "flip-down",
  });
  $(".sky-enterprise-flip-left").attr({
    "data-aos": "flip-left",
  });
  $(".sky-enterprise-flip-right").attr({
    "data-aos": "flip-right",
  });

  //animation ease attributes
  $(".sky-enterprise-linear").attr({
    "data-aos-easing": "linear",
  });
  $(".sky-enterprise-ease").attr({
    "data-aos-easing": "ease",
  });
  $(".sky-enterprise-ease-in").attr({
    "data-aos-easing": "ease-in",
  });
  $(".sky-enterprise-ease-in-back").attr({
    "data-aos-easing": "ease-in-back",
  });
  $(".sky-enterprise-ease-out").attr({
    "data-aos-easing": "ease-out",
  });
  $(".sky-enterprise-ease-out-back").attr({
    "data-aos-easing": "ease-out-back",
  });
  $(".sky-enterprise-ease-in-out-back").attr({
    "data-aos-easing": "ease-in-out-back",
  });
  $(".sky-enterprise-ease-in-shine").attr({
    "data-aos-easing": "ease-in-shine",
  });
  $(".sky-enterprise-ease-out-shine").attr({
    "data-aos-easing": "ease-out-shine",
  });
  $(".sky-enterprise-ease-in-out-shine").attr({
    "data-aos-easing": "ease-in-out-shine",
  });
  $(".sky-enterprise-ease-in-quad").attr({
    "data-aos-easing": "ease-in-quad",
  });
  $(".sky-enterprise-ease-out-quad").attr({
    "data-aos-easing": "ease-out-quad",
  });
  $(".sky-enterprise-ease-in-out-quad").attr({
    "data-aos-easing": "ease-in-out-quad",
  });
  $(".sky-enterprise-ease-in-cubic").attr({
    "data-aos-easing": "ease-in-cubic",
  });
  $(".sky-enterprise-ease-out-cubic").attr({
    "data-aos-easing": "ease-out-cubic",
  });
  $(".sky-enterprise-ease-in-out-cubic").attr({
    "data-aos-easing": "ease-in-out-cubic",
  });
  $(".sky-enterprise-ease-in-quart").attr({
    "data-aos-easing": "ease-in-quart",
  });
  $(".sky-enterprise-ease-out-quart").attr({
    "data-aos-easing": "ease-out-quart",
  });
  $(".sky-enterprise-ease-in-out-quart").attr({
    "data-aos-easing": "ease-in-out-quart",
  });

  setTimeout(function () {
    AOS.init({
      once: true,
      duration: 1200,
    });
  }, 100);

  $(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    var sky_enterpriseStickyMenu = $(".sky-enterprise-sticky-menu");
    var sky_enterpriseStickyNavigation = $(".sky-enterprise-sticky-navigation");

    if (sky_enterpriseStickyMenu.length && scrollTop > 0) {
      sky_enterpriseStickyMenu.addClass("sticky-menu-enabled sky-enterprise-zoom-in-up");
    } else {
      sky_enterpriseStickyMenu.removeClass("sticky-menu-enabled");
    }
  });
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 100) {
      jQuery(".sky-enterprise-scrollto-top a").fadeIn();
    } else {
      jQuery(".sky-enterprise-scrollto-top a").fadeOut();
    }
  });
  jQuery(".sky-enterprise-scrollto-top a").click(function () {
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
})(jQuery);
