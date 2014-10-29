<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
		echo '$(\'.form .form-login .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-login .form-actions .button.submit\').fadeIn(0);});';
		echo '$(\'.form .form-login .form-row .row-field .ftext\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else {
		echo 'contentLoader(\'secundaria\',\'dashboard\');';
	}
	echo '</script>';
