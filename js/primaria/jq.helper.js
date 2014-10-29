setTimeout(function () {
	
	
	// beg: selecting tabs
	$('.form .form-tabs .tab').unbind('click').click(function () {
		var thisTab			= $(this),
			tabSection		= thisTab.attr('id');
		$('.form .form-tabs .tab').each(function () {
			$(this).removeClass('selected');
		});
		thisTab.addClass('selected');
		
		switch ( tabSection ) {
			case 'registerme':
				tabContent = 'form_registeruser';
				break;
			case 'forgot-password':
				tabContent = 'form_forgotpasswd';
				break;
			case 'session-start':
			default:
				tabContent = 'form_login';
		}
		
		contentLoader('primaria', tabContent, '.tab-container');
	});
	// end: selecting tabs
	
	
	// beg: login attempt
	$('.form .form-login .form-actions .button.submit').unbind('click').click(function () {
		loginAttempt();
	});
	$('.form .form-login .form-row .row-field .ftext').keyup(function (e) {
		if ( e.keyCode == 13 ) {
			loginAttempt();
		}
	});
	// end: login attempt
	
	// beg: forgotpasswd-attempt
	$('.form .form-forgotpasswd .form-actions .button.submit').unbind('click').click(function () {
		forgotPasswdAttempt();
	});
	$('.form .form-forgotpasswd .form-row .row-field .ftext').keyup(function (e) {
		if ( e.keyCode == 13 ) {
			forgotPasswdAttempt();
		}
	});
	// end: forgotpasswd-attempt
	
	// beg: forgotpasswd-attempt
	$('.form .form-registeruser .form-actions .button.submit').unbind('click').click(function () {
		registerUserAttempt();
	});
	$('.form .form-registeruser .form-row .row-field .ftext, .form .form-registeruser .form-row .row-field .fselect').keyup(function (e) {
		if ( e.keyCode == 13 ) {
			registerUserAttempt();
		}
	});
	// end: forgotpasswd-attempt
	
	
	// beg: user-options
	$('.dashboard-user-options .option-item').unbind('click').click(function () {
		var button = $(this);
		button.parent().find('.list-items').toggle(0);
	});
	// end: user-options
	
	// beg: user-options-items
	$('.dashboard-user-options .options-list .list-items .item-list#user-edit-info').unbind('click').click(function () {
		$('.dashboard-user-options .options-list .list-items').toggle(0);
		loadWindow('primaria_users', 'useredit');
	});
	// end: user-options-items
	
	
	// beg: user-options-items
	$('.dashboard-user-options .options-list .list-items .item-list#user-edit-passwd').unbind('click').click(function () {
		$('.dashboard-user-options .options-list .list-items').toggle(0);
		loadWindow('primaria_users', 'passwdedit');
	});
	// end: user-options-items
	
	// beg: start-system
	$('.dashboard-container .action-button.start-system').unbind('click').click(function () {
		contentLoader('primaria_schools', 'index', '.dashboard-container');
	});
	// end: start-system
	
	
	
	
	// beg: view-school
	$('.table.table-schools .table-rows .col-title.col-tools .tool.view').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('primaria_groups', 'index', '.dashboard-container', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	
	$('.table.table-schools .table-rows .col-title.col-names .names-link').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('primaria_groups', 'index', '.dashboard-container', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	// end: view-school
	
	// beg: edit-school
	$('.table.table-schools .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1],
				schoolName = $(this).parent().parent().find('.col-names .names-link').text();
		loadWindow('primaria_schools', 'editSchool', 'schoolID=' + schoolID + '&schoolName=' + schoolName + '');
	});
	// end: edit-school
	
	// beg: delete-school
	$('.table.table-schools .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1],
				schoolName = $(this).parent().parent().find('.col-names .names-link').text();
		deleteSchoolAttempt(schoolID, schoolName);
	});
	// end: delete-school
	
	// beg: add school
	$('#add-school').unbind('click').click(function () {
		loadWindow('primaria_schools', 'addschool');
	});
	// end: add school
	
	
	// beg: view-group-list
	$('.table.table-schools-groups .table-rows .col-title.col-tools .tool.view, .table.table-schools-groups .table-rows .col-title.col-identifier .names-link').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				params		= 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '';
		contentLoader('primaria_students', 'index', '.dashboard-container', params, params);
	});
	// end: view-group-list
	
	// beg: addgroup
	$('.table.table-schools-groups .table-header .header-options .option-item.addgroup').unbind('click').click(function () {
		var		schoolID = ($(this).attr('id')).split('_')[1];
		loadWindow('primaria_groups','window_addgroup', 'schoolID=' + schoolID + '');
	});
	// end: addgroup
	
	// beg: delete-group
	$('.table.table-schools-groups .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				groupGrade	= $(this).parent().parent().find('.col-title.col-identifier.col-grade .names-link').text(),
				groupName	= $(this).parent().parent().find('.col-title.col-identifier.col-name .names-link').text();
		deleteGroupAttempt(schoolID, schoolCCT, groupID, groupName, groupGrade );
	});
	// end: delete-group
	
	// beg: edit-group
	$('.table.table-schools-groups .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		grouplID = ($(this).parent().parent().attr('id')).split('_')[5];
		loadWindow('primaria_groups', 'window_editgroup', 'groupID=' + grouplID + '');
	});
	// end: edit-group
	
	
	// beg: addstudent
	$('.table.table-schools-groups-students .table-header .header-options .option-item.add-student').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5];
		loadWindow('primaria_students', 'window_addstudent', 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '');
	});
	// end: addstudent
	
	// beg: delete-student
	$('.table.table-schools-groups-students .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				studentID	= ($(this).parent().parent().attr('id')).split('_')[7]
				studentName	= $(this).parent().parent().find('.col-names').text();
		deleteStudentAttempt(schoolID, schoolCCT, groupID, studentID, studentName);
	});
	// end: delete-student
	
	// beg: delete-student
	$('.table.table-schools-groups-students .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				studentID	= ($(this).parent().parent().attr('id')).split('_')[7]
				studentName	= $(this).parent().parent().find('.col-names').text(),
				params		=	'schoolID=' + schoolID +
								'&schoolCCT=' + schoolCCT +
								'&groupID=' + groupID +
								'&studentID=' + studentID +
								'&studentName=' + studentName;
		loadWindow('primaria_students', 'window_editstudent', params, params);
	});
	// end: delete-student
	
	// beg: start the application
	$('.history-options .ho-go.start-tests').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5],
				params		=	'schoolID='		+ schoolID		+
								'&schoolCCT='	+ schoolCCT		+
								'&groupID='		+ groupID		+ '',
				warning		= 	'una vez que haya iniciado las encuestas solo podrá volver atras siactualiza la página o\n' +
								'si algún niño termina una encuesta.\n\n' +
								'Si llega a actualizar ninguno de los cambios será guardado.';
		if ( confirm(warning) ){
			$('.dashboard-user-options').slideUp(showtimer);
			contentLoader('primaria_app', 'index', '.dashboard-container', params, params);
		}
	});
	// end: start the application
	
	// beg: show-student-questions
	$('.table.table-schools-groups-students-app a.table-rows').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5],
				studentID	= ($(this).attr('id')).split('_')[7]
				studentName	= $(this).find('.col-names').text(),
				params		=	'schoolID='		+ schoolID		+
								'&schoolCCT='	+ schoolCCT		+
								'&groupID='		+ groupID		+
								'&studentID='	+ studentID;
		contentLoader('primaria_app', 'app_student', '.dashboard-container', params, params);
	});
	
		// beg: questions slider
		$('#questions').slides({
			preload: true,
			autoHeight: true,
			prev: 'page-prev',
			next: 'page-next',
			autoHeightSpeed: 500
		});
		// end: questions slider
		
		// beg: tootip
		$('.table .table-rows .col-title.col-answer .radio-answer[title]').qtip(
		{
			content: {
				attr: 'title' // Use the TITLE attribute of the area map for the content
			},
			style: {
				classes: 'ui-tooltip-tipsy ui-tooltip-shadow'
			},
			position: {
				my: 'bottom center',		// Position my top left
				at: 'top center'			// at the bottom right of
			}
		});
		// end: tootip
		
	// end: show-student-questions
	
	// beg: save-answers
	$('.table .table-list .end-questions').unbind('click').click(function () {
		saveStudentAnswers();
	});
	$('.table .table-list .end-questions').keyup(function (e) {
		if ( e.keyCode == 13 ) {
			saveStudentAnswers();
		}
	});
	// end: save-answers
	
}, 0);
