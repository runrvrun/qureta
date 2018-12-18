/*
 * Copyright (c) 24/04/2013 MyPassion
 * Author: MyPassion
 * This file is made for NEWS
*/



// ----------------------------------------------------  CONTACT FORM
function submitForm(){
	"use strict";
	var msg;
	$.post('plugin/sendmail.php',$('#contactForm').serialize(), function(msg) {
		$(".alertMessage").html(msg);
	});
	// Hide previous response text
	$(msg).remove();
	// Show response message
	contactform.prepend(msg);
}

jQuery(document).ready(function(){

	"use strict";

// -----------------------------------------------------  UI ELEMENTS
	jQuery( "#accordion" ).accordion({
		heightStyle: "content"
	});

	jQuery( "#tabs" ).tabs();

	jQuery( "#tooltip" ).tooltip({
		position:{
			my: "center bottom-5",
			at: "center top"
		}
	});


// -----------------------------------------------------  UI ELEMENTS
	jQuery('#nav ul.sf-menu').mobileMenu({
		defaultText: 'Go to ...',
		className: 'device-menu',
		subMenuDash: '&ndash;'
	});


// -----------------------------------------------------  NOTIFICATIONS CLOSER
	jQuery('span.closer').click(function(e){
		e.preventDefault();
		jQuery(this).parent('.notifications').stop().slideToggle(500);
	});

// -----------------------------------------------------  NAV SUB MENU(SUPERFISH)
	jQuery('#nav ul.sf-menu').superfish({
		delay: 250,
		animation: {opacity:'show', height:'show'},
		speed: 'slow',
		autoArrows: true,
		dropShadows: false
	});
});	
