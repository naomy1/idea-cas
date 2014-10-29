<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-upgrade-schools-students-by-group .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-upgrade-schools-students-by-group .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-upgrade-schools-students-by-group .form-row .row-field .ftext, .form .form-upgrade-schools-students-by-group .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		
		$data = 'schoolID=' . $msg_data['schoolid'] . '&schoolCCT=' . $msg_data['schoolcct'] . '&groupID=' . $msg_data['groupid'] . '';
		echo 'contentLoader(\'preescolar_profile_root\', \'students_groups_lists\', \'.dashboard-user-admin\', \'' . $data . '\', \'' . $data . '\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 3000);';
	}
	echo '</script>';