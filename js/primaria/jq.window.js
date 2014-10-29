
setTimeout(function () {
	
	// beg: close window
	$('.window-layer .window-container .window-container-closewindow, .form .form-actions .button.cancel').unbind('click').click(function () {
		$('.window-layer').fadeTo(showtimer, '0', function (){
			$(this).remove();
			$('.body-container').fadeTo(showtimer, '1');
		});
	});
	// end: close window
	
	
	// beg: update-profile-attempt
	$('.form .form-edituserinfo .form-actions .button.submit').unbind('click').click(function () {
		editProfileAttempt();
	});
	$('.form .form-edituserinfo .form-row .row-field .ftext, .form .form-edituserinfo .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 )
			editProfileAttempt();
	});
	// end: update-profile-attempt
	
	
	// beg: update-passwd-attempt
	$('.form .form-editpasswd .form-actions .button.submit').unbind('click').click(function () {
		editPasswdAttempt();
	});
	$('.form .form-editpasswd .form-row .row-field .ftext').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editPasswdAttempt();
		}
	});
	// end: update-passwd-attempt
	
	
	// beg: addschool-actions
	$('.form .form-addschool .form-actions .button.submit').unbind('click').click(function () {
		addSchoolAttepmt();
	});
	$('.form .form-addschool .form-row .row-field .ftext, .form .form-addschool .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addSchoolAttepmt();
		}
	});
	// end: addschool-actions
	
	// beg: edit-school
	$('.form .form-editschool .form-actions .button.submit').unbind('click').click(function () {
		editSchoolAttempt();
	});
	$('.form .form-editschool .form-row .row-field .ftext, .form .form-editschool .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editSchoolAttempt();
		}
	});
	// end: edit-school
	
	// beg: addgroup-actions
	$('.form .form-addgroup .form-actions .button.submit').unbind('click').click(function () {
		addGroupAttepmt();
	});
	$('.form .form-addgroup .form-row .row-field .ftext, .form .form-addgroup .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addGroupAttepmt();
		}
	});
	// end: addgroup-actions
	
	// beg: addgroup-actions
	$('.form .form-editgroup .form-actions .button.submit').unbind('click').click(function () {
		editGroupAttepmt();
	});
	$('.form .form-editgroup .form-row .row-field .ftext, .form .form-addgroup .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editGroupAttepmt();
		}
	});
	// end: addgroup-actions
	
	// beg: addstudent-actions
	$('.form .form-add-student .form-actions .button.submit').unbind('click').click(function () {
		addStudentAttepmt();
	});
	$('.form .form-add-student .form-row .row-field .ftext, .form .form-add-student .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addStudentAttepmt();
		}
	});
	// end: addstudent-actions
	
	// beg: editstudent_attempt
	$('.form .form-edit-student .form-actions .button.submit').unbind('click').click(function () {
		editStudentAttepmt();
	});
	$('.form .form-edit-student .form-row .row-field .ftext, .form .form-edit-student .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editStudentAttepmt();
		}
	});
	// end: editstudent_attempt
	
}, showtimer);