<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-editgroup .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-editgroup .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-editgroup .form-row .row-field .ftext, .form .form-editgroup .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_groups\', \'index\', \'.dashboard-container\', \'schoolID=\' + ' . $msg_school_id . ' + \'\', \'schoolID=\' + ' . $msg_school_id . ' + \'\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 4000);';
	}
	echo '</script>';