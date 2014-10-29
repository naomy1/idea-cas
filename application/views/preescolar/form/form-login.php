<?php
		// beg: form-login
		echo '<span class="form-login">';
			// beg: form-messenger
			echo '<span class="form-messenger"></span>';
			// end: form-messenger
		
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">usuario</span>';
				echo '<span class="row-field"><input type="text" id="login-username" name="login-username" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: password
			echo '<span class="form-row">';
				echo '<span class="row-label">contraseña</span>';
				echo '<span class="row-field"><input type="password" id="login-password" name="login-password" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: password
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">iniciar sesión</a>';
			echo '</span>';
			// end: actions
		
			echo '<span class="clear"></span>';
			
		echo '</span>';
		// end: form-login