<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
	echo '$(\'.form .form-edit-student-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-edit-student-root .form-actions .button.submit\').fadeIn(0);});';
	echo '$(\'.form .form-edit-student-root .form-row .row-field .ftext, .form .form-edit-student-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	elseif ( $msg_type == 'success' ) {
		echo 'contentLoader(\'secundaria_profile_root\', \'students_groups_lists\', \'.dashboard-user-admin\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\');';
		
	}
	echo '</script>';