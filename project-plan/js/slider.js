// Toggle showing the header and footer
$(document).ready(function() {	
$('#header-toggle').click(function() {
    $('#global-header').slideToggle(400);
	$('#global-footer').slideToggle(400);
	$('#comment-wrap').slideToggle(100);
	$(this).text($(this).text() == 'Show Navigation' ? 'Hide Navigation' : 'Show Navigation');
    return false;
  });
});


// Smooth internal scroll
$(document).ready(function(){
	$(".scroll").click(function(event){
		//prevent the default action for the click event
		event.preventDefault();

		//get the full url - like mysitecom/index.htm#home
		var full_url = this.href;

		//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
		var parts = full_url.split("#");
		var trgt = parts[1];

		//get the top offset of the target anchor
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;

		//goto that anchor by setting the body scroll top to anchor top
		$('html, body').animate({scrollTop:target_top}, 500);
	});
});