jQuery(document).ready(function(){

/* Toggle serach icon at menu */
jQuery('.navbar-default .nav .header-module .search-box-outer a.search-icon').on('click',function(e) {
	e.preventDefault();
   jQuery('.nav .search-box-outer ul.dropdown-menu').toggle('addSerchBox');
 });

jQuery('#carousel-example-generic').carousel({
  pause:"hover",
  keyboard: true
  })

jQuery('#carousel-example-generic a').each(function(){
	  jQuery(this).on('focus', function(){
	  	jQuery('#carousel-example-generic').carousel('pause')
	  })
});
jQuery('a,input').each(function(){
	  jQuery(this).on('focus', function(){
	  	  if(!jQuery(this).closest(".item").length ) {
	  	jQuery('#carousel-example-generic').carousel('cycle')
	     }
	  })
});

});