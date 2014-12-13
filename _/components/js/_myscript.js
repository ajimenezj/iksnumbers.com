$(function() {

	//highlight the current nav
	$("#home a:contains('Home')").parent().addClass('active');
	$("#WesternUnion a:contains('Western union payment')").parent().addClass('active');
	$("#contact a:contains('Contact us')").parent().addClass('active');

	//make menus drop automatically
	$('ul.nav li.dropdown').hover(function() {
		$('.dropdown-menu', this).fadeIn();
	}, function() {
		$('.dropdown-menu', this).fadeOut('fast');
	});//hover

}); //jQuery is loaded