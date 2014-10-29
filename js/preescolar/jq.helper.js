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
		
		contentLoader('preescolar', tabContent, '.tab-container');
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
		loadWindow('preescolar_users', 'useredit');
	});
	// end: user-options-items
	
	
	// beg: user-options-items
	$('.dashboard-user-options .options-list .list-items .item-list#user-edit-passwd').unbind('click').click(function () {
		$('.dashboard-user-options .options-list .list-items').toggle(0);
		loadWindow('preescolar_users', 'passwdedit');
	});
	// end: user-options-items
	
	// beg: start-system
	$('.dashboard-container .action-button.start-system').unbind('click').click(function () {
		contentLoader('preescolar_schools', 'index', '.dashboard-container');
	});
	// end: start-system
	
	
	
	
	// beg: view-school
	$('.table.table-schools .table-rows .col-title.col-tools .tool.view').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('preescolar_groups', 'index', '.dashboard-container', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	
	$('.table.table-schools .table-rows .col-title.col-names .names-link').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('preescolar_groups', 'index', '.dashboard-container', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	// end: view-school
	
	// beg: edit-school
	$('.table.table-schools .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1],
				schoolName = $(this).parent().parent().find('.col-names .names-link').text();
		loadWindow('preescolar_schools', 'editSchool', 'schoolID=' + schoolID + '&schoolName=' + schoolName + '');
	});
	// end: edit-school
	
	// beg: add school
	$('#add-school').unbind('click').click(function () {
		loadWindow('preescolar_schools', 'addschool');
	});
	// end: add school
	
	
	// beg: view-group-list
	$('.table.table-schools-groups .table-rows .col-title.col-tools .tool.view, .table.table-schools-groups .table-rows .col-title.col-identifier .names-link').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				params		= 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '';
		contentLoader('preescolar_students', 'index', '.dashboard-container', params, params);
	});
	// end: view-group-list
	
	// beg: addgroup
	$('.table.table-schools-groups .table-header .header-options .option-item.addgroup').unbind('click').click(function () {
		var		schoolID = ($(this).attr('id')).split('_')[1];
		loadWindow('preescolar_groups','window_addgroup', 'schoolID=' + schoolID + '');
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
		loadWindow('preescolar_groups', 'window_editgroup', 'groupID=' + grouplID + '');
	});
	// end: edit-group
	
	
	// beg: addstudent
	$('.table.table-schools-groups-students .table-header .header-options .option-item.add-student').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5];
				grade		= ($(this).attr('id')).split('_')[7];
		loadWindow('preescolar_students', 'window_addstudent', 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '&grade=' + grade + '');
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
	
	// beg: edit-student
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
		loadWindow('preescolar_students', 'window_editstudent', params, params);
	});
	// end: edit-student
	
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
			contentLoader('preescolar_app', 'index', '.dashboard-container', params, params);
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
		contentLoader('preescolar_app', 'app_student', '.dashboard-container', params, params);
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
	// end: save-answers
	
	
	// beg: USERS-AREA users-index
	$('.dashboard-container .user-menu .menu-item.dashboard-start').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_user', 'index', '.dashboard-user-admin');
	});
	// end: USERS-AREA users-index
	
	// beg: USERS-AREA users-schools
	$('.dashboard-container .user-menu .menu-item.dashboard-schools').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_user', 'schools', '.dashboard-user-admin');
	});
	// end: USERS-AREA users-schools
	
	
	
	
	
	// beg: addschool to user
	$('.table.table-user-schools .table-header .header-options .option-item.add-school').unbind('click').click(function () {
		loadWindow('preescolar_profile_user', 'window_addme_to_school');
	});
	// end: addschool to user
	
	
	// beg: view-group-list
	$('.table.table-user-schools .school-name').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				params		= 'schoolID=' + schoolID + '';
		contentLoader('preescolar_profile_user', 'user_school_info', '.dashboard-user-admin', params, params);
	});
	// end: view-group-list
	
	// beg: ROOT-AREA root-index
	$('.dashboard-container .user-menu .menu-item.dashboard-root-start').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'index', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-index
	
	// beg: ROOT-AREA root-schools
	$('.dashboard-container .user-menu .menu-item.dashboard-root-schools').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'schools', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-schools
	
	// beg: ROOT-AREA root-students
	$('.dashboard-container .user-menu .menu-item.dashboard-root-students').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'students', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-students
	
	// beg: ROOT-AREA root-questions
	$('.dashboard-container .user-menu .menu-item.dashboard-root-questions').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'questions', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-questions
	
	// beg: ROOT-AREA root-users
	$('.dashboard-container .user-menu .menu-item.dashboard-root-users').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'users', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-users
	
	// beg: ROOT-AREA root-apps
	$('.dashboard-container .user-menu .menu-item.dashboard-root-apps').unbind('click').click(function () {
		var		thisTab = $(this);
		$('.dashboard-container .user-menu .menu-item').removeClass('selected');
		thisTab.addClass('selected');
		contentLoader('preescolar_profile_root', 'apps', '.dashboard-user-admin');
		$('.messenger').slideUp(showtimer);
	});
	// end: ROOT-AREA root-apps
	
	// beg: ROOT-AREA root-delete-school
	$('.table-root-schools-info .tool.delete').unbind('click').click(function () {
		var		edit_button			= $(this),
				edit_school_id		= (edit_button.parent().parent().attr('id')).split('_')[1],
				edit_school_name	= edit_button.parent().parent().find('.col-title.col-names.school-name').text(),
				edit_school_bg		= $('#schoolid_' + edit_school_id).css('background-color');
		$('#schoolid_' + edit_school_id).css('background-color', '#ed1c24');
		if ( confirm('¿Desea elminiar la escuela "' + edit_school_name + '"?\n\nTodos los grados, grupos, alumnos y encuestas contestadas\nserán borradas permanentemente del sistema.\n\nESTE CAMBIO NO SE PUEDE DESHACER') ) {
			removeSchool(edit_school_id);
		}
		else {
			$('#schoolid_' + edit_school_id).css('background-color', edit_school_bg);
		}
	});
	// end: ROOT-AREA root-delete-school
	
	// beg: ROOT-AREA root-edit-school
	$('.table-root-schools-info .tool.edit').unbind('click').click(function () {
		var		edit_button			= $(this),
				edit_school_id		= (edit_button.parent().parent().attr('id')).split('_')[1],
				params				= 'schoolid=' + edit_school_id;
		loadWindow('preescolar_profile_root', 'window_edit_school', params, params);
	});
	// end: ROOT-AREA root-edit-school
	
	// beg: root-area root-delete-question
	$('.table-root-questions .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		button			= $(this),
				question_id		= (button.parent().parent().attr('id')).split('_')[1],
				question_txt	= button.parent().parent().find('.col-title.col-names').text(),
				question_bg		= $('#questionid_' + question_id + '').css('background-color');
		$('#questionid_' + question_id + '').css({'background-color' : '#ed1c24', 'color' : '#fff'});
		if ( confirm('¿Realmente desea eliminar la pregunta : "' + question_txt + '"?\n\nESTE CAMBIO NO SE PUEDE DESHACER.') ) {
			deleteQuestion(question_id);
		}
		else
			$('#questionid_' + question_id + '').css({'background-color': question_bg, 'color':'#404a4f'});
	});
	// end: root-area root-delete-question
	
	// beg: ROOT-AREA root-edit-question
	$('.table-root-questions .tool.edit').unbind('click').click(function () {
		var		edit_button			= $(this),
				edit_question_id	= (edit_button.parent().parent().attr('id')).split('_')[1],
				params				= 'question_id=' + edit_question_id;
		loadWindow('preescolar_profile_root', 'window_edit_question', params, params);
	});
	// end: ROOT-AREA root-edit-question
	
	// beg: view-school-root
	$('.table.table-schools-students-root .table-rows .col-title.col-tools .tool.view').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('preescolar_groups', 'students_groups', '.dashboard-user-admin', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	
	$('.table.table-schools-students-root .table-rows .col-title.col-names .names-link').unbind('click').click(function () {
		var		schoolID = ($(this).parent().parent().attr('id')).split('_')[1];
		contentLoader('preescolar_profile_root', 'students_groups', '.dashboard-user-admin', 'schoolID=' + schoolID + '', 'schoolID=' + schoolID + '');
	});
	// end: view-school-root
	
	// beg: view-group-list-root
	$('.table.table-schools-groups-root .table-rows .col-title.col-tools .tool.view, .table.table-schools-groups-root .table-rows .col-title.col-identifier .names-link').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				params		= 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '';
		contentLoader('preescolar_profile_root', 'students_groups_lists', '.dashboard-user-admin', params, params);
	});
	// end: view-group-list-root
	
	
	
	// beg: user-options-items-root
	$('#up-grade-schools').unbind('click').click(function () {
		loadWindow('preescolar_profile_root', 'upgrade_schools_students');
	});
	// end: user-options-items-root
	
	// beg: user-options-items-root
	$('.up-grade-groups').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1];
				params		= 'schoolid=' + schoolID + '';
		loadWindow('preescolar_profile_root', 'upgrade_schools_groups', params, params);
	});
	// end: user-options-items-root
	
	// beg: edit-student-root
	$('.table.table-schools-groups-students-root .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				studentID	= ($(this).parent().parent().attr('id')).split('_')[7],
				studentName	= $(this).parent().parent().find('.col-names').text(),
				params		=	'schoolID=' + schoolID +
								'&schoolCCT=' + schoolCCT +
								'&groupID=' + groupID +
								'&studentID=' + studentID +
								'&studentName=' + studentName;
		
		loadWindow('preescolar_profile_root', 'edit_student', params, params);
	});
	// end: edit-student-root
	
	// beg: upgrade_all_students-of-group-root
	$('.upgrade_all_students').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5],
				grade		= ($(this).attr('id')).split('_')[7],
				params		= 'schoolid=' + schoolID + '&schoolcct=' + schoolCCT + '&groupid=' + groupID + '&grade=' + grade + '';
		loadWindow('preescolar_profile_root', 'upgrade_schools_groups_students', params, params);
	});
	// end: upgrade_all_students-of-group-root
	
	// beg: add-school-root
	$('#add-schools').unbind('click').click(function () {
		loadWindow('preescolar_profile_root', 'add_school');
	});
	// end: add-school-root
	
	// beg: addgroup-student-root
	$('.table-schools-groups-students-root .add-student-root').unbind('click').click(function () {
		var		schoolID	= ($(this).attr('id')).split('_')[1],
				schoolCCT	= ($(this).attr('id')).split('_')[3],
				groupID		= ($(this).attr('id')).split('_')[5],
				params		= 'schoolID=' + schoolID + '&schoolCCT=' + schoolCCT + '&groupID=' + groupID + '';
		loadWindow('preescolar_profile_root', 'window_addstudent', params, params);
	});
	// end: addgroup-student-root
	
	// beg: delete-student
	$('.table.table-schools-groups-students-root .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				studentID	= ($(this).parent().parent().attr('id')).split('_')[7]
				studentName	= $(this).parent().parent().find('.col-names').text();
		deleteStudentAttempt_root(schoolID, schoolCCT, groupID, studentID, studentName);
	});
	// end: delete-student
	
	// beg: addgroup-root
	$('.table-schools-groups-root .addgroup-root').unbind('click').click(function () {
		var		schoolID = ($(this).attr('id')).split('_')[1];
		loadWindow('preescolar_profile_root','window_addgroup', 'schoolID=' + schoolID + '');
	});
	// end: addgroup-root
	
	
	
	
	
	// beg: delete-group-root
	$('.table.table-schools-groups-root .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		schoolID	= ($(this).parent().parent().attr('id')).split('_')[1],
				schoolCCT	= ($(this).parent().parent().attr('id')).split('_')[3],
				groupID		= ($(this).parent().parent().attr('id')).split('_')[5],
				groupGrade	= $(this).parent().parent().find('.col-title.col-identifier.col-grade .names-link').text(),
				groupName	= $(this).parent().parent().find('.col-title.col-identifier.col-name .names-link').text();
		deleteGroupAttempt_root(schoolID, schoolCCT, groupID, groupName, groupGrade );
	});
	// end: delete-group-root
	
	
	
	
	
	// beg: edit-group-root
	$('.table.table-schools-groups-root .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var		grouplID = ($(this).parent().parent().attr('id')).split('_')[5];
		loadWindow('preescolar_profile_root', 'window_editgroup', 'groupID=' + grouplID + '');
	});
	// end: edit-group-root
	
	
	
	
	
	// beg: user-edit-root
	$('.table.table-schools-groups-users-root .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var			userid		= ($(this).attr('id')).split('_')[1],
					params		= 'userid=' + userid + '';
		loadWindow('preescolar_profile_root', 'useredit', params, params);
	});
	// end: user-options-items
	
	
	
	
	
	// beg: user-delete-root
	$('.table.table-schools-groups-users-root .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var			userid		= ($(this).attr('id')).split('_')[1],
					username	= $(this).parent().parent().find('.col-names').text();
		// alert(username);
		delete_user_attempt(userid, username);
	});
	// end: user-delete-items
	
	
	
	
	
	// beg: user-edit-root
	$('.table-apps-root .add-app').unbind('click').click(function () {
		loadWindow('preescolar_profile_root', 'window_add_app');
	});
	// end: user-options-items
	
	
	
	
	
	// beg: toggle app status
	$('.table.table-apps-root .table-list .table-rows .col-title.col-tools .tool.status').unbind('click').click(function () {
		var			appid		= ($(this).attr('id')).split('_')[1];
		toggleAppStatus(appid);
	});
	// end: toggle app status
	
	
	
	
	
	// beg: update-app
	$('.table.table-apps-root .table-list .table-rows .col-title.col-tools .tool.edit').unbind('click').click(function () {
		var			appid		= ($(this).attr('id')).split('_')[1],
					params		= 'appid=' + appid + '';
		loadWindow('preescolar_profile_root', 'window_update_app', params, params);
	});
	// end: update-app
	
	
	
	
	
	// beg: delete-app
	$('.table.table-apps-root .table-rows .col-title.col-tools .tool.delete').unbind('click').click(function () {
		var		appid		= ($(this).attr('id')).split('_')[1],
				appName		= $(this).parent().parent().find('.col-title.col-app-name.col-names .names-link').text();
		deleteAppAttempt(appid, appName);
	});
	// end: delete-app
	
	
	
	
	// beg: view-app
	$('.table.table-apps-root .table-rows .col-title.col-names .names-link').unbind('click').click(function () {
		var		appid		= ($(this).parent().parent().attr('id')).split('_')[1],
				params		= 'appid=' + appid + '';
		contentLoader('preescolar_profile_root', 'apps_view', '.dashboard-user-admin', params, params);
	});
	// end: view-app
	
	
	
	
	
	// beg: add-app-question
	// beg: user-edit-root
	$('.table-app-questions-root .add-question').unbind('click').click(function () {
		var			appid		= ($(this).attr('id')).split('_')[1],
					params		= 'appid=' + appid + '';
		loadWindow('preescolar_profile_root', 'window_add_app_question', params, params);
	});
	// end: user-options-items
	// end: add-app-question
}, 0);
