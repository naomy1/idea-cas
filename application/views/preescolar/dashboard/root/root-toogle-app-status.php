<?php
	
	
	
	
	echo '<script type="text/javascript">setTimeout(function () {';
		echo '$(\'.tool.status\').removeClass(\'activated\').attr(\'title\', \'desactivar\');';
		echo '$(\'.tool.status\').addClass(\'deactivated\').attr(\'title\', \'activar\');';
		if ( !$app_status ) {
			echo '$(\'#appid_' . $app_id . '\').removeClass(\'deactivated\').attr(\'title\', \'activar\');';
			echo '$(\'#appid_' . $app_id . '\').addClass(\'activated\').attr(\'title\', \'desactivar\');';
		}
		
	echo '}, showtimer * 2);</script>';
