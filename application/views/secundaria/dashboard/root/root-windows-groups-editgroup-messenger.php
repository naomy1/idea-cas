<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-editgroup-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-editgroup-root .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-editgroup-root .form-row .row-field .ftext, .form .form-editgroup-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_profile_root\', \'students_groups\', \'.dashboard-user-admin\', \'schoolID=\' + ' . $msg_school_id . ' + \'\', \'schoolID=\' + ' . $msg_school_id . ' + \'\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 4000);';
	}
	echo '</script>';