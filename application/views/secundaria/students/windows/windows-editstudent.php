<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Editar alumno</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-edit-student">';
				
					echo '<span class="form-messenger"></span>';
					
					echo '<input type="hidden" name="editstudent-schoolID" id="editstudent-schoolID" value="' . $editstudent_schoolid . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="editstudent-schoolCCT" id="editstudent-schoolCCT" value="' . $editstudent_schoolcct . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="editstudent-groupID" id="editstudent-groupID" value="' . $editstudent_groupid . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="editstudent-studentID" id="editstudent-studentID" value="' . $editstudent_id . '" style="height: 1px; width: 1px; float: left;" />';
				
					// beg: first name
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre(s)</span>';
						echo '<span class="row-field"><input type="text" id="editstudent-firstname" name="editstudent-firstname" class="ftext" value="' . $editstudent_fname . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: first name
					
					// beg: last name
					echo '<span class="form-row">';
						echo '<span class="row-label">apellido(s)</span>';
						echo '<span class="row-field"><input type="text" id="editstudent-lastname" name="editstudent-lastname" class="ftext" value="' . $editstudent_lname . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: last name
					
					// beg: curp
					echo '<span class="form-row">';
						echo '<span class="row-label">C.U.R.P.</span>';
						echo '<span class="row-field"><input type="text" id="editstudent-curp" name="editstudent-curp" class="ftext" value="' . strtoupper($editstudent_curp) . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: curp
					
					// beg: crosee
					echo '<span class="form-row">';
						echo '<span class="row-label">sexo</span>';
						echo '<span class="row-field">';
							echo '<select name="editstudent-sex" id="editstudent-sex" class="fselect">';
								echo '<option value="H"' . ((strtolower($editstudent_sex) == 'h')? ' selected="selected"' : '') . '>H : Hombre</option>';
								echo '<option value="M"' . ((strtolower($editstudent_sex) == 'm')? ' selected="selected"' : '') . '>M : Mujer</option>';
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: crosee
					
					// beg: actions
					echo '<span class="form-actions">';
						echo '<span class="spinner-16x16"></span>';
						echo '<a href="javascript: void(0);" class="button submit">agregar alumno</a>';
						echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
					echo '</span>';
					// end: actions
				
				echo '</span></span>';
				
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
