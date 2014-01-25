$(document).ready(function () {
	c("document loaded");

	// add question template - show/hide the options textarea depending on the selected option
	$("select").change(function() {
	    $( "select option:selected" ).each(function() {
			var $value = $(this).val();
		    if ($value == 1) {
			    $("textarea").hide();
		    } else if ($value == 2 || $value == 3) {
			    $("textarea").fadeIn();
		    }
	    });
	}).trigger( "change" );

	// inject the question id to the Edit and Delete labels
	$(".form-group div").each(function() {
		$this = $(this);
		var $form_id = $this.attr('id');
		if ($form_id !== undefined) {
			var $id = $form_id.replace(/^.+_/, '');
			$this.siblings(".action-label").each(function() {
				var $href = $(this).attr('href');
				var $new_href = $href.slice(0, -1) + $id;
				$(this).attr('href', $new_href);
			});
		}
	});

});


// helper function
function c(msg) {
	console.log(msg);
}