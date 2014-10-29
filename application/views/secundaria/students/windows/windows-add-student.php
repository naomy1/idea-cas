<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Agregar alumno</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-add-student">';
				
					echo '<span class="form-messenger"></span>';
					
					echo '<input type="hidden" name="addstudent-schoolID" id="addstudent-schoolID" value="' . $addstudent_schoolid . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="addstudent-schoolCCT" id="addstudent-schoolCCT" value="' . $addstudent_schoolcct . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="addstudent-groupID" id="addstudent-groupID" value="' . $addstudent_groupid . '" style="height: 1px; width: 1px; float: left;" />';
					echo '<input type="hidden" name="addstudent-grade" id="addstudent-grade" value="' . $addstudent_grade . '" style="height: 1px; width: 1px; float: left;" />';
				
					// beg: first name
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre(s)</span>';
						echo '<span class="row-field"><input type="text" id="addstudent-firstname" name="addstudent-firstname" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: first name
					
					// beg: last name
					echo '<span class="form-row">';
						echo '<span class="row-label">apellido(s)</span>';
						echo '<span class="row-field"><input type="text" id="addstudent-lastname" name="addstudent-lastname" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: last name
					
					// beg: curp
					echo '<span class="form-row">';
						echo '<span class="row-label">C.U.R.P.</span>';
						echo '<span class="row-field"><input type="text" id="addstudent-curp" name="addstudent-curp" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: curp
					
					// beg: crosee
					echo '<span class="form-row">';
						echo '<span class="row-label">sexo</span>';
						echo '<span class="row-field">';
							echo '<select name="addstudent-sex" id="addstudent-sex" class="fselect">';
								echo '<option value="0" selected="selected">-- seleccione el sexo del niño --</option>';
								echo '<option value="H">H : Hombre</option>';
								echo '<option value="M">M : Mujer</option>';
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
