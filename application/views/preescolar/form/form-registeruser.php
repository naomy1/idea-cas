<?php
		// beg: form-login
		echo '<span class="form-registeruser">';
			// beg: form-messenger
			echo '<span class="form-messenger"></span>';
			// end: form-messenger
		
			// beg: firstname
			echo '<span class="form-row">';
				echo '<span class="row-label">nombre(s)</span>';
				echo '<span class="row-field"><input type="text" id="register-firstnames" name="register-firstnames" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: firstname
			
			// beg: lastname
			echo '<span class="form-row">';
				echo '<span class="row-label">apellido(s)</span>';
				echo '<span class="row-field"><input type="text" id="register-lastnames" name="register-lastnames" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: lastname
			
			// beg: email
			echo '<span class="form-row">';
				echo '<span class="row-label">correo electrónico</span>';
				echo '<span class="row-field"><input type="text" id="register-useremail" name="register-useremail" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: email
			
			// beg: curp
			echo '<span class="form-row">';
				echo '<span class="row-label">C.U.R.P.</span>';
				echo '<span class="row-field"><input type="text" id="register-usercurp" name="register-usercurp" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: curp
			
			// beg: usaer
			echo '<span class="form-row">';
				echo '<span class="row-label">C.A.P.E.P.</span>';
				echo '<span class="row-field"><input type="text" id="register-userusaer" name="register-userusaer" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: usaer
			
			// beg: zonasupervisionusaer
			echo '<span class="form-row">';
				echo '<span class="row-label">Zona supervisión<br />C.A.P.E.P.</span>';
				echo '<span class="row-field"><input type="text" id="register-userusaerzone" name="register-userusaerzone" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: zonasupervisionusaer
			
			// beg: crosee
			echo '<span class="form-row">';
				echo '<span class="row-label">dirección operativa</span>';
				echo '<span class="row-field">';
					echo '<select name="register-usercrosee" id="register-usercrosee" class="fselect">';
						echo '<option value="0" selected="selected">-- Seleccione la dirección operativa a la que pertenece --</option>';
						echo '<option value="1">dirección operativa 1</option>';
						echo '<option value="2">dirección operativa 2</option>';
						echo '<option value="3">dirección operativa 3</option>';
						echo '<option value="4">dirección operativa 4</option>';
						echo '<option value="5">dirección operativa 5</option>';
					echo '</select>';
				echo '</span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: crosee
			
			echo '<span class="form-h-break"></span>';
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">usuario</span>';
				echo '<span class="row-field"><input type="text" id="register-username" name="register-username" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: password
			echo '<span class="form-row">';
				echo '<span class="row-label">contraseña</span>';
				echo '<span class="row-field"><input type="password" id="register-password" name="register-password" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: password
			
			// beg: passwordotravez
			echo '<span class="form-row">';
				echo '<span class="row-label">confirme contraseña</span>';
				echo '<span class="row-field"><input type="password" id="register-repasswd" name="register-repasswd" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: passwordotravez
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">registrarme</a>';
			echo '</span>';
			// end: actions
		
			echo '<span class="clear"></span>';
			
		echo '</span>';
		// end: form-login
		echo '<span class="clear"></span>';