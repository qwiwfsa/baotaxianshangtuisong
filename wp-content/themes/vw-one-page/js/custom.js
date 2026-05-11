function vw_one_page_menu_open_nav() {
	window.vw_one_page_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_one_page_menu_close_nav() {
	window.vw_one_page_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},  
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_one_page_currentfocus=null;
  	vw_one_page_checkfocusdElement();
	var vw_one_page_body = document.querySelector('body');
	vw_one_page_body.addEventListener('keyup', vw_one_page_check_tab_press);
	var vw_one_page_gotoHome = false;
	var vw_one_page_gotoClose = false;
	window.vw_one_page_responsiveMenu=false;
 	function vw_one_page_checkfocusdElement(){
	 	if(window.vw_one_page_currentfocus=document.activeElement.className){
		 	window.vw_one_page_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_one_page_check_tab_press(e) {
		"use strict";
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_one_page_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_one_page_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_one_page_gotoHome = true;
			} else {
				vw_one_page_gotoHome = false;
			}

		}else{

			if(window.vw_one_page_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_one_page_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_one_page_responsiveMenu){
				if(vw_one_page_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_one_page_gotoClose = true;
				} else {
					vw_one_page_gotoClose = false;
				}
			
			}else{

			if(window.vw_one_page_responsiveMenu){
			}}}}
		}
	 	vw_one_page_checkfocusdElement();
	}
});

(function( $ ) {

	jQuery('document').ready(function($){
	    setTimeout(function () {
    		jQuery("#preloader").fadeOut("slow");
	    },1000);
	});

	$(window).scroll(function(){
	  	var sticky = $('.header-sticky'),
			scroll = $(window).scrollTop();

	  	if (scroll >= 100) sticky.addClass('header-fixed');
	  	else sticky.removeClass('header-fixed');
	});

	$(document).ready(function () {
		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});

		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});
	
})( jQuery );

jQuery(document).ready(function () {
  	function vw_one_page_search_loop_focus(element) {
	  var vw_one_page_focus = element.find('select, input, textarea, button, a[href]');
	  var vw_one_page_firstFocus = vw_one_page_focus[0];  
	  var vw_one_page_lastFocus = vw_one_page_focus[vw_one_page_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function vw_one_page_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === vw_one_page_firstFocus) {
	        vw_one_page_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === vw_one_page_lastFocus) {
	        vw_one_page_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	vw_one_page_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});

/*sticky copyright*/
window.addEventListener('scroll', function() {
  var sticky = document.querySelector('.copyright-sticky');
  if (!sticky) return;

  var scrollTop = window.scrollY || document.documentElement.scrollTop;
  var windowHeight = window.innerHeight;
  var documentHeight = document.documentElement.scrollHeight;

  var isBottom = scrollTop + windowHeight >= documentHeight-100;

  if (scrollTop >= 100 && !isBottom) {
    sticky.classList.add('copyright-fixed');
  } else {
    sticky.classList.remove('copyright-fixed');
  }
});