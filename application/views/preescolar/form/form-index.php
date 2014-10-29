<?php
	
	echo '<table cellpadding="0" cellspacing="0" border="0" height="400" width="100%"><tr><td height="400" width="100%" align="center" valign="middle">';
	echo '<span class="form" style="margin-top: 40px; margin-bottom: 40px;">';

		// beg: tabs
		echo '<span class="form-tabs">';
			echo '<a href="javascript: void(0);" class="tab selected" id="session-start">iniciar sesión</a>';
			echo '<a href="javascript: void(0);" class="tab" id="registerme">registrarme</a>';
			echo '<a href="javascript: void(0);" class="tab" id="forgot-password">recuperar contraseña</a>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: tabs
		
		// beg: tab containter
		echo '<span class="tab-container">';
			echo '<span class="form-loader"></span>';
		echo '</span>';
		echo '<span class="clear"></span>';
		// end: tab container
		echo '<script type="text/javascript">';
			echo 'contentLoader(\'preescolar\', \'form_login\', \'.tab-container\');';
		echo '</script>';
		
	echo '</span>';
	
	
	echo '</td></tr></table>';