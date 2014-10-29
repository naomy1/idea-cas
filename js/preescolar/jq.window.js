
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
	
	// beg: editstudent_attempt
	$('.form .form-unlock-system .form-actions .button.submit.unlock').unbind('click').click(function () {
		unlockSystemAttempt();
	});
	$('.form .form-unlock-system .form-row .row-field .ftext').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			unlockSystemAttempt();
		}
	});
	
	$('.form .form-unlock-system .form-actions .button.submit.continue').unbind('click').click(function () {
		showMySchools();
	});
	// end: editstudent_attempt
	
	
	
	// beg: add-user-school
	$('.form .form-add-user-school .form-actions .button.submit').unbind('click').click(function () {
		addSchoolRelationship();
	});
	$('.form .form-add-user-school .form-row .row-field .ftext, .form .form-add-user-school .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addSchoolRelationship();
		}
	});
	// end: add-user-school
	
	// beg: root edit-school
	$('.form .form-editschool-root .form-actions .button.submit').unbind('click').click(function () {
		editSchoolAttempt_root();
	});
	$('.form .form-editschool-root .form-row .row-field .ftext, .form .form-editschool-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editSchoolAttempt_root();
		}
	});
	// end: root edit-school
	
	// beg: root edit-question
	$('.form .form-editquestion-root .form-actions .button.submit').unbind('click').click(function () {
		editQuestionAttempt_root();
	});
	// end: root edit-question
	
	// beg: addschool-actions-root
	$('.form .form-addschool-root .form-actions .button.submit').unbind('click').click(function () {
		addSchoolAttepmt_root();
	});
	$('.form .form-addschool-root .form-row .row-field .ftext, .form .form-addschool-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addSchoolAttepmt_root();
		}
	});
	// end: addschool-actions-root
	
	// beg: upgrade_students_root
	$('.form .form-upgrade-schools-students .form-actions .button.submit').unbind('click').click(function () {
		upgrade_all_school_grade_students();
	});
	$('.form .form-upgrade-schools-students .form-row .row-field .ftext, .form .form-upgrade-schools-students .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			upgrade_all_school_grade_students();
		}
	});
	// end: upgrade_students_root
	
	
	
	
	
	// beg: upgrade_students_by_group_root
	$('.form .form-upgrade-schools-students-by-group .form-actions .button.submit').unbind('click').click(function () {
		upgrade_students_by_group_root();
	});
	$('.form .form-upgrade-schools-students-by-group .form-row .row-field .ftext, .form .form-upgrade-schools-students-by-group .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			upgrade_students_by_group_root();
		}
	});
	// end: upgrade_students_by_group_root
	
	// beg: get_school_groups
	edit_student_get_school_groups();
	// end: get_school_groups
	
	
	
	
	
	// beg: upgrade/edit_student
	$('.form .form-edit-student-root .form-actions .button.submit').unbind('click').click(function () {
		editStudentAttepmt_root();
	});
	$('.form .form-edit-student-root .form-row .row-field .ftext, .form .form-edit-student-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editStudentAttepmt_root();
		}
	});
	// end: upgrade/edit_student
	
	// beg: upgrade_groups
	$('.form .form-upgrade-schools-groups .form-actions .button.submit').unbind('click').click(function () {
		upgradegroups_root();
	});
	$('.form .form-upgrade-schools-groups .form-row .row-field .ftext, .form .form-upgrade-schools-groups .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			upgradegroups_root();
		}
	});
	// end: upgrade_groups
	
	
	
	
	
	// beg: addstudent-actions-root
	$('.form .form-add-student-root .form-actions .button.submit').unbind('click').click(function () {
		addStudentAttempt_root();
	});
	$('.form .form-add-student-root .form-row .row-field .ftext, .form .form-add-student-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addStudentAttempt_root();
		}
	});
	// end: addstudent-actions-root
	
	
	
	
	
	// beg: addgroup-actions-root
	$('.form .form-addgroup-root .form-actions .button.submit').unbind('click').click(function () {
		addGroupAttepmt_root();
	});
	$('.form .form-addgroup-root .form-row .row-field .ftext, .form .form-addgroup-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			addGroupAttepmt_root();
		}
	});
	// end: addgroup-actions-root
	
	
	
	
	
	// beg: addgroup-actions-root
	$('.form .form-editgroup-root .form-actions .button.submit').unbind('click').click(function () {
		editGroupAttepmt_root();
	});
	$('.form .form-editgroup-root .form-row .row-field .ftext, .form .form-addgroup-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ){
			editGroupAttepmt_root();
		}
	});
	// end: addgroup-actions-root
	
	
	
	
	
	// beg: update-profile-attempt-root
	$('.form .form-edituserinfo-root .form-actions .button.submit').unbind('click').click(function () {
		editProfileAttempt_root();
	});
	$('.form .form-edituserinfo-root .form-row .row-field .ftext, .form .form-edituserinfo-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 )
			editProfileAttempt_root();
	});
	// end: update-profile-attempt
	
	
	
	
	
	// beg: addapp-root
	$('.form .form-addapp-root .form-row .row-field .ftext#addapp-appdate').datepicker();
	$('.form .form-addapp-root .form-actions .button.submit').unbind('click').click(function () {
		addAppAttempt_root();
	});
	$('.form .form-addapp-root .form-row .row-field .ftext, .form .form-addapp-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ) addAppAttempt_root();
	});
	// end: addapp-root
	
	
	
	
	
	// beg: editapp
	$('.form .form-editapp-root .form-row .row-field .ftext#updateapp-appdate').datepicker();
	$('.form .form-editapp-root .form-actions .button.submit').unbind('click').click(function () {
		editAppAttempt_root();
	});
	$('.form .form-editapp-root .form-row .row-field .ftext, .form .form-editapp-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ) editAppAttempt_root();
	});
	// end: editapp
	
	
	
	
	
	// beg: root add-question
	$('.form .form-addquestion-root .form-actions .button.submit').unbind('click').click(function () {
		addAppQuestionAttempt_root();
	});
	$('.form .form-addquestion-root .form-row .row-field .ftext, .form .form-addquestion-root .form-row .row-field .fselect').unbind('keyup').keyup(function (e) {
		if ( e.keyCode == 13 ) addAppQuestionAttempt_root();
	});
	// end: root add-question
}, showtimer);