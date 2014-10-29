<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	
		echo 'markFields(\'.ftext,.fselect\', \'unmark\');';
		
		if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-registeruser .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-registeruser .form-actions .button.submit\').fadeIn(0);});';
			echo 'unlockFormFields();';
			echo 'markFields(\'' . $msg_field_marked . '\');';
		}
		else {
			echo 'contentLoader(\'secundaria\',\'dashboard\');';
		}
		
	echo '</script>';
