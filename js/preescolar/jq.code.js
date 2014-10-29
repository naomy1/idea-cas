$(document).ready(function () {
	
	$('.advertices .navegators .message ').fadeTo(0, '0', function () {
		
		var messageBox = $(this);
		
		$('.advertices .navegators .navegator').hover(
			function () {
				var		navItem		= $(this);
				messageBox.stop(true, true).fadeTo(showtimer, '1', function () {
					navItem.stop(true, true).animate({
						'width' : '60px'
					}, showtimer);
				});
			},
			function () {
				var		navItem		= $(this);
				messageBox.stop(true, true).fadeTo(showtimer, '0', function () {
					navItem.stop(true, true).animate({
						'width' : '30px'
					}, showtimer);
				});
			}
		).qtip({
			content: {
				attr: 'title' // Use the TITLE attribute of the area map for the content
			},
			style: {
				classes: 'ui-tooltip-tipsy ui-tooltip-shadow'
			},
			position: {
				my: 'middle left',		// Position my top left
				at: 'middle right'			// at the bottom right of
			},
			show: {
				delay: (showtimer * 2)
			}
		});
	});
	
});
