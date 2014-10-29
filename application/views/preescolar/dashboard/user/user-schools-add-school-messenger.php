<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	
	echo '$(\'.form .form-add-user-school .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-add-user-school .form-actions .button.submit\').fadeIn(0);});';
	echo '$(\'.form .form-add-user-school .form-row .row-field .ftext, .form .form-add-user-school .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	
	if ( $msg_type == 'success' ) {
		echo 'contentLoader(\'preescolar_profile_user\', \'schools\', \'.dashboard-user-admin\');';
		echo 'setTimeout(function () {closeWindow();}, 2000);';
	}
	echo '</script>';