<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	
	echo '$(\'.form .form-add-student .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-add-student .form-actions .button.submit\').fadeIn(0);});';
	echo '$(\'.form .form-add-student .form-row .row-field .ftext, .form .form-add-student .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	
	if ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_students\', \'index\', \'.dashboard-container\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\', \'schoolID=\' + ' . $msg_student_info['student_school_id'] . ' + \'&schoolCCT=\' + "' . $msg_student_info['student_school_cct'] . '" + \'&groupID=\' + ' . $msg_student_info['student_group_id'] . ' + \'\');';
		echo '$(\'.form .form-add-student .form-row .row-field .ftext, .form .form-add-student .form-row .row-field .fselect\').val(\'\');';
	}
	echo '</script>';