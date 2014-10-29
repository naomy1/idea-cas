<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-addquestion-root .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-addquestion-root .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-addquestion-root .form-row .row-field .ftext, .form .form-addquestion-root .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		$params = 'appid=' . $appid . '';
		echo 'contentLoader(\'secundaria_profile_root\', \'apps_view\', \'.dashboard-user-admin\', \'' . $params . '\', \'' . $params . '\');';
		echo '$(\'.form .form-addquestion-root .ftext, .form .form-addquestion-root .fselect\').val(\'\');';
		echo 'unlockFormFields();';
		echo '
		setTimeout(function () {
			$(\'.form .form-addquestion-root .spinner-16x16\').fadeOut(0, function () {
				$(\'.form .form-addquestion-root .form-actions .button.submit\').fadeIn(0);
			});
		}, showtimer);
		';
		
	}
	echo '</script>';