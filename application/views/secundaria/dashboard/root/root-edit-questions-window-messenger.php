<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-editquestion-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-editquestion-root .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-editquestion-root .form-row .row-field .ftext, .form .form-editquestion-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_profile_root\', \'questions\', \'.dashboard-user-admin\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 3000);';
		
	}
	echo '</script>';