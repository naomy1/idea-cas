<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-addgroup .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-addgroup .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-addgroup .form-row .row-field .ftext, .form .form-addgroup .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
			echo '$(\'.form .form-addgroup .form-row .row-field .ftext#edituser-username\').attr(\'disabled\',\'disabled\').addClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_groups\', \'index\', \'.dashboard-container\', \'schoolID=\' + ' . $msg_group_info['group_school_id'] . ' + \'\', \'schoolID=\' + ' . $msg_group_info['group_school_id'] . ' + \'\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 4000);';
	}
	echo '</script>';