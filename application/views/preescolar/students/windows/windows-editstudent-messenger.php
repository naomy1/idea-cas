<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	foreach ($msg_student_info as $key => $value) {
		echo $key . ' => ' . $value - '<br />';
	}
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
	echo '$(\'.form .form-edit-student .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-edit-student .form-actions .button.submit\').fadeIn(0);});';
	echo '$(\'.form .form-edit-student .form-row .row-field .ftext, .form .form-edit-student .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	elseif ( $msg_type == 'success' ) {
		echo 'contentLoader(\'preescolar_students\', \'index\', \'.dashboard-container\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\');';
		echo '
			$(\'.form .form-addschool .form-row, .form .form-addschool .form-actions, .form .form-addschool b, .form .form-addschool br\').slideUp(showtimer);
			setTimeout(function () {
				closeWindow();
			}, 6000);
		';
	}
	echo '</script>';