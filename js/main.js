
jQuery(function($) {
	var tbSearch = $('.tb-menu-search');
    $('#tb-search-item').click(function(e) {
        e.preventDefault();
        $('.tb-menu-search').addClass('tb-search-active').fadeIn(200);
    });
    $('.tb-close').click(function() {
        $('.tb-menu-search').fadeOut(200);
    });
	$(document).on('keyup',function(evt) {
	    if ($( '#tb-search' ).hasClass('tb-search-active') && evt.keyCode == 27) {
	       $('.tb-menu-search').fadeOut(200);
	    }
	});
});
