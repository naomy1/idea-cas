<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
	echo '$(\'.form .form-upgrade-schools-groups .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-upgrade-schools-groups .form-actions .button.submit\').fadeIn(0);});';
	echo '$(\'.form .form-upgrade-schools-groups .form-row .row-field .ftext, .form .form-upgrade-schools-groups .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	elseif ( $msg_type == 'success' ) {
		$params = 'schoolID=' . $msg_data['schoolid'] . '';
		echo 'contentLoader(\'preescolar_profile_root\', \'students_groups\', \'.dashboard-user-admin\', \'' . $params . '\', \'' . $params . '\');';
		echo '
			setTimeout(function () {
				closeWindow();
			}, 6000);
		';
	}
	echo '</script>';