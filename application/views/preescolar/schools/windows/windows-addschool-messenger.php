<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-addschool .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-addschool .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-addschool .form-row .row-field .ftext, .form .form-addschool .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'preescolar_schools\', \'index\', \'.dashboard-container\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 6000);';
	}
	
	if ( $msg_school_added ) {
		echo '
			$(\'.form .form-addschool .form-row, .form .form-addschool .form-actions, .form .form-addschool b, .form .form-addschool br\').slideUp(showtimer);
			setTimeout(function () {
				closeWindow();
			}, 6000);
		';
	}
	echo '</script>';