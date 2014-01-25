$(document).ready(function () {
	c("document loaded");

	// add question template - show/hide the options textarea depending on the selected option
	$("select").change(function() {
	    $( "select option:selected" ).each(function() {
			$value = $(this).val();
		    if ($value == 1) {
			    $("textarea").hide();
		    } else if ($value == 2 || $value == 3) {
			    $("textarea").fadeIn();
		    }
	    });
	}).trigger( "change" );

});


// helper function
function c(msg) {
	console.log(msg);
}