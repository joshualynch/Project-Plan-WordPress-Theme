/**
* plugin: jquery.anyDropDown.js
* author: kt.cheung @ Brandammo
* website: www.brandammo.co.uk
* version: 1.0
* date: 25th mar 2011
* description: simple jquery drop down menu with easing, toggle any element using any element
**/

(function($){

  $.fn.anyDropDown = function(options) {  
  
	//set up default options 
	var defaults = {
		dropDownElem: '.navigate-header', //the class name for your drop down
		dropDownMenuElem: '.navigate', //the class name for the drop down menu
		slideDownEasing: 'easeInOutCirc', //easing method for slideDown
		slideUpEasing: 'easeInOutCirc', //easing method for slideUp
		slideDownDuration: 500, //easing duration for slideDown
		slideUpDuration: 500, //easing duration for slideUp
		closeMessage: 'Hide Navigation'
	}; 
  	
	var opts = $.extend({}, defaults, options); 	
	
	var closedText;
	var dropDown;
	
    return this.each(function() {  
	  var $this = $(this);
	  $this.find(opts.dropDownMenuElem).css('display', 'none');
	  $this.find(opts.dropDownElem).css('cursor','pointer').toggle(showDropDown, hideDropDown);
	  
	  dropDown = $this;
	  closedText = $(opts.dropDownElem).html();
	  
    });
		
	function showDropDown(){
		dropDown.find(opts.dropDownMenuElem).slideDown({duration:opts.slideDownDuration, easing:opts.slideDownEasing});
		dropDown.find(opts.dropDownElem).html(opts.closeMessage);
	}
	
	function hideDropDown(){
		dropDown.find(opts.dropDownMenuElem).slideUp({duration:opts.slideUpDuration, easing:opts.slideUpEasing});//hides the current dropdown
		dropDown.find(opts.dropDownElem).html(closedText);
	}
	
  };
})(jQuery);
