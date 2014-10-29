<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Agregar escuela</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-add-user-school">';
				
					echo '<span class="form-messenger"><span class="bar-info">Para que usted pueda agregar una escuela a su perfil<br />previemante debe estar registrada en el sistema por un profesor</span></span>';
				
					// beg: first name
					echo '<span class="form-row">';
						echo '<span class="row-label">C.C.T.</span>';
						echo '<span class="row-field"><input type="text" id="addschool-cct" name="addschool-cct" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: first name
					
					// beg: actions
					echo '<span class="form-actions">';
						echo '<span class="spinner-16x16"></span>';
						echo '<a href="javascript: void(0);" class="button submit">agregar escuela</a>';
						echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
					echo '</span>';
					// end: actions
				
				echo '</span></span>';
				
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
