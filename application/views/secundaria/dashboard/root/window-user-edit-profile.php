<?php
	
	
	echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
	echo '<span class="window-container-title">Editar mi información</span>';
	echo '<span class="window-container-messenger"></span>';
	echo '<span class="window-container-body">';
	
		echo '<span class="form">';
			echo '<span class="form-edituserinfo-root">';
			
			echo '<input type="hidden" name="edituser-userid" id="edituser-userid" value="' . $edituser_userid . '" style="height: 1px; width: 1px; float: left;" />';
		
			echo '<span class="form-messenger"></span>';
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">usuario</span>';
				echo '<span class="row-field"><input type="text" id="edituser-username" name="edituser-username" class="ftext disabled" value="' . $edituser_username . '" disabled="disabled" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">nombre(s)</span>';
				echo '<span class="row-field"><input type="text" id="edituser-firstname" name="edituser-firstname" class="ftext" value="' . $edituser_firstname . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">apellido(s)</span>';
				echo '<span class="row-field"><input type="text" id="edituser-lastname" name="edituser-lastname" class="ftext" value="' . $edituser_lastname . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">correo electrónico</span>';
				echo '<span class="row-field"><input type="text" id="edituser-usermail" name="edituser-usermail" class="ftext" value="' . $edituser_usermail . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">C.U.R.P.</span>';
				echo '<span class="row-field"><input type="text" id="edituser-usercurp" name="edituser-usercurp" class="ftext" value="' . $edituser_usercurp . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">U.S.A.E.R.</span>';
				echo '<span class="row-field"><input type="text" id="edituser-userusaer" name="edituser-userusaer" class="ftext" value="' . $edituser_userusaer . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">Zona de supervisión<br />U.S.A.E.R.</span>';
				echo '<span class="row-field"><input type="text" id="edituser-userusaerzone" name="edituser-userusaerzone" class="ftext" value="' . $edituser_userusaerzone . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: crosee
			echo '<span class="form-row">';
				echo '<span class="row-label">C.R.O.S.E.E.</span>';
				echo '<span class="row-field">';
					echo '<select name="edituser-usercrosee" id="edituser-usercrosee" class="fselect">';
						echo '<option value="1"' . (($edituser_usercrosee == 1)?' selected="selected"':'') . '>C.R.O.S.E.E. 1</option>';
						echo '<option value="2"' . (($edituser_usercrosee == 2)?' selected="selected"':'') . '>C.R.O.S.E.E. 2</option>';
						echo '<option value="3"' . (($edituser_usercrosee == 3)?' selected="selected"':'') . '>C.R.O.S.E.E. 3</option>';
						echo '<option value="4"' . (($edituser_usercrosee == 4)?' selected="selected"':'') . '>C.R.O.S.E.E. 4</option>';
						echo '<option value="5"' . (($edituser_usercrosee == 5)?' selected="selected"':'') . '>C.R.O.S.E.E. 5</option>';
					echo '</select>';
				echo '</span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: crosee
			
			// beg: crosee
			echo '<span class="form-row">';
				echo '<span class="row-label">tipo de usuario</span>';
				echo '<span class="row-field">';
					echo '<select name="edituser-usertype" id="edituser-usertype" class="fselect">';
						echo '<option value="teacher"' . (($edituser_usertype == 'teacher')?' selected="selected"':'') . '>Profesor</option>';
						echo '<option value="user"' . (($edituser_usertype == 'user')?' selected="selected"':'') . '>Equipo CAS / Enlace Técnico</option>';
						echo '<option value="root"' . (($edituser_usertype == 'root')?' selected="selected"':'') . '>Administrador</option>';
					echo '</select>';
				echo '</span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: crosee
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">guardar cambios</a>';
				echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
			echo '</span>';
			// end: actions
		
			echo '<span class="clear"></span>';
			
			echo '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		echo '<span class="clear"></span>';
	echo '</span>';
	
	echo '<span class="clear"></span>';