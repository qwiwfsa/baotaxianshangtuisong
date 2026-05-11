/* ===============================================
	Open header search
=============================================== */

jQuery(document).ready(function(){
	jQuery('.close-search-form').hide();
});

function spa_salon_open_search_form() {
	jQuery('.header-search .search-form').addClass('is-open');
	jQuery('body').addClass('no-scrolling');
	setTimeout(function(){
    jQuery('.search-form  #header-searchform input#header-s').filter(':visible').focus();
    jQuery('.close-search-form').show();
    jQuery('.search-form #searchform #search').focus();
	}, 100);

	return false;
}

jQuery( ".header-search a.open-search-form").on("click", spa_salon_open_search_form);

/* ===============================================
	Close header search
=============================================== */

function spa_salon_close_search_form() {
	jQuery('.header-search .search-form').removeClass('is-open');
	jQuery('body').removeClass('no-scrolling');
	jQuery('.close-search-form').hide();
}

jQuery( ".header-search a.close-search-form").on("click", spa_salon_close_search_form);

/* ===============================================
	TRAP TAB FOCUS ON MODAL SEARCH
============================================= */

jQuery('.search-form #searchform #search').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9 && !e.shiftKey)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form #searchform :input.search-submit').focus();
  }
 else if (jQuery("this:focus") && (e.which === 9 && e.shiftKey)){
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form a.close-search-form').focus();
  }
});

jQuery('.search-form #searchform :input.search-submit').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9 && !e.shiftKey)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form a.close-search-form').focus();
  }
  else if (jQuery("this:focus") && (e.which === 9 && e.shiftKey)){
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form #searchform #search').focus();
  }
});

jQuery('.search-form a.close-search-form').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9 && !e.shiftKey)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form #searchform #search').focus();
  }
  else if (jQuery("this:focus") && (e.which === 9 && e.shiftKey)){
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.search-form #searchform :input.search-submit').focus();
  }
});

/* ===============================================
	OWL CAROUSEL SLIDER
=============================================== */

jQuery('document').ready(function(){
  var owl = jQuery('.slider .owl-carousel');
    owl.owlCarousel({
    margin:20,
    nav: false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots:false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});

/* ===============================================
  OWL CAROUSEL SPA SERVICES
=============================================== */

jQuery('document').ready(function(){
  var owl = jQuery('.spa-services .owl-carousel');
    owl.owlCarousel({
    margin:20,
    nav: false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots:true,
    navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 3
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});

/* ===============================================
  Scroll Top //
============================================= */

jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 100) {
        jQuery('.scroll-up').fadeIn();
    } else {
        jQuery('.scroll-up').fadeOut();
    }
});

jQuery('a[href="#tobottom"]').click(function () {
    jQuery('html, body').animate({scrollTop: 0}, 'slow');
    return false;
});

/*===============================================
 PRELOADER
=============================================== */

jQuery('document').ready(function($){
  setTimeout(function () {
  jQuery(".cssloader").fadeOut("fast");
},2000);
});

/* ===============================================
  STICKY-HEADER
============================================= */

jQuery(window).scroll(function () {
    var sticky = jQuery('.sticky-header'),
    scroll = jQuery(window).scrollTop();

    if (scroll >= 100) sticky.addClass('fixed-header');
    else sticky.removeClass('fixed-header');
  });
