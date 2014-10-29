<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Agregar grupo</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
				
				echo '<span class="form"><span class="form-addgroup-root">';
					
					echo '<span class="form-messenger"></span>';
					
					echo '<input type="hidden" name="addgroup-schoolID" id="addgroup-schoolID" value="' . $addgroup_schoolID . '" style="height: 1px; width: 1px; float: left;" />';
					
					// beg: grado
					echo '<span class="form-row">';
						echo '<span class="row-label">grado del grupo</span>';
						echo '<span class="row-field">';
							echo '<select name="addgroup-grade" id="addgroup-grade" class="fselect">';
								echo '<option value="0">-- Seleccione el grado al que pertenece el grupo --</option>';
								echo '<option value="1">1&deg; grado</option>';
								echo '<option value="2">2&deg; grado</option>';
								echo '<option value="3">3&deg; grado</option>';
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: grado
					
					// beg: nombre del grupo
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre del grupo</span>';
						echo '<span class="row-field"><input type="text" id="addgroup-name" name="addgroup-name" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: nombre del grupo
					
					// beg: actions
					echo '<span class="form-actions">';
						echo '<span class="spinner-16x16"></span>';
						echo '<a href="javascript: void(0);" class="button submit">guardar grupo</a>';
						echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
					echo '</span>';
					// end: actions
					
				echo '</span></span>';
				
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
