<?php
	
	echo '<span class="bar-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
			echo '$(\'.form .form-edituserinfo .form-actions .spinner-16x16\').fadeOut(0, function (){$(\'.form .form-edituserinfo .form-actions .button.submit\').fadeIn(0);});';
			echo '$(\'.form .form-edituserinfo .form-row .row-field .ftext, .form .form-edituserinfo .form-row .row-field .fselect\').removeAttr(\'disabled\').removeClass(\'disabled\');';
			echo '$(\'.form .form-edituserinfo .form-row .row-field .ftext#edituser-username\').attr(\'disabled\',\'disabled\').addClass(\'disabled\');';
	}
	else if ( $msg_type == 'success' ){
		echo '$(\'.dashboard-user-options .option-item .menu-usernames\').html(\'' . $msg_user_lname . ' ' . $msg_user_fname . ' (<i>' . $this->session->userdata('cas-secundaria-username') . '</i>)\');';
		echo 'setTimeout(function () {
			closeWindow();
		}, 4000);';
	}
	echo '</script>';