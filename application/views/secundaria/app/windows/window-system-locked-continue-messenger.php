<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	
	if ( $msg_type != 'success' ) {
		echo '$(\'.form .form-unlock-system .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-unlock-system .form-actions .button.submit\').fadeIn(0);});';
		echo '$(\'.form .form-unlock-system .form-row .row-field .ftext, .form .form-unlock-system .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	elseif ( $msg_type == 'success' ){
		echo 'contentLoader(\'secundaria_schools\', \'index\', \'.dashboard-container\');';
		echo '
			setTimeout(function () {
				closeWindow();
			}, 6000);
		';
	}
	echo '</script>';