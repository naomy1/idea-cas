<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-editschool-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-editschool-root .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-editschool-root .form-row .row-field .ftext, .form .form-editschool-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'preescolar_profile_root\', \'schools\', \'.dashboard-user-admin\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 6000);';
	}
	echo '</script>';