<?php
		// beg: form-forgotpasswd
		echo '<span class="form-forgotpasswd">';
			
			// beg: form-messenger
			echo '<span class="form-messenger"></span>';
			// end: form-messenger
		
			// beg: usermail
			echo '<span class="form-row">';
				echo '<span class="row-label">correo electrónico</span>';
				echo '<span class="row-field"><input type="text" id="forgotpasswd-usermail" name="forgotpasswd-usermail" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: usermail
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">enviar contraseña</a>';
			echo '</span>';
			// end: actions
			
			echo '<span class="clear"></span>';
			
		echo '</span>';
		// end: form-forgotpasswd