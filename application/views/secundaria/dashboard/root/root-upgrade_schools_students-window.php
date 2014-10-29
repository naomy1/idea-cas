<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Cambiar de grado a todos los alumnos</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-upgrade-schools-students">';
				
					echo '<span class="form-messenger"></span>';
					
					// beg: crosee
					echo '<span class="form-row">';
						echo '<span class="row-label">de:</span>';
						echo '<span class="row-field">';
							echo '<select name="grade-from" id="grade-from" class="fselect">';
								echo '<option value="1">1&deg;</option>';
								echo '<option value="2">2&deg;</option>';
								echo '<option value="3">3&deg;</option>';
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					
					echo '<span class="form-row">';
						echo '<span class="row-label">a:</span>';
						echo '<span class="row-field">';
							echo '<select name="grade-to" id="grade-to" class="fselect">';
								echo '<option value="1" selected="selected">1&deg;</option>';
								echo '<option value="2">2&deg;</option>';
								echo '<option value="3">3&deg;</option>';
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
				
				echo '</span></span>';
				
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
