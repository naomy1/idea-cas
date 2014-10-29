<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-editpasswd .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-editpasswd .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-editpasswd .form-row .row-field .ftext\').removeAttr(\'disabled\').removeClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo 'setTimeout(function () {
			closeWindow();
		}, 4000);';
	}
	echo '</script>';