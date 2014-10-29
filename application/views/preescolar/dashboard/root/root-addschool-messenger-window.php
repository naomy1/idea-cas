<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-addschool-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-addschool-root .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-addschool-root .form-row .row-field .ftext, .form .form-addschool-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'preescolar_profile_root\', \'students\', \'.dashboard-user-admin\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 6000);';
	}
	
	if ( $msg_school_added ) {
		echo '
			$(\'.form .form-addschool-root .form-row, .form .form-addschool-root .form-actions, .form .form-addschool-root b, .form .form-addschool-root br\').slideUp(showtimer);
			setTimeout(function () {
				closeWindow();
			}, 6000);
		';
	}
	echo '</script>';