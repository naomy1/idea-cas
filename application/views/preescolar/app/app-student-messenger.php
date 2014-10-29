<?php
	
	echo '<span class="box-' . $msg_type . '">' . $msg_content . '</span>';
	
	echo '<script type="text/javascript">';
	if ( $msg_type != 'success' ) {
		echo '$(\'.button-end-questions-area .spiner-16x16\').fadeOut(0, function () {$(\'.dashboard-container .action-button.end-questions\').fadeIn(0);});';
	}
	else if ( $msg_type == 'success' ){
		$params = 'schoolID=' . $studentInfo['answer_school_id'] . '&schoolCCT=' . $studentInfo['answer_school_cct'] . '&groupID=' . $studentInfo['answer_group_id'] . '';
		echo 'loadWindow(\'preescolar_app\', \'window_system_locked\', \'' . $params . '\', \'' . $params . '\');';
		echo 'lockWindow();';
	}
	echo '</script>';