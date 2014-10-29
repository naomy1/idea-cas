<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Editar grupo</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
				
				echo '<span class="form"><span class="form-editgroup">';
					
					echo '<span class="form-messenger"></span>';
					
					echo '<input type="hidden" name="editgroup-groupID" id="editgroup-groupID" value="' . $editgroup_groupinfo->group_id . '" style="height: 1px; width: 1px; float: left;" />';
					
					// beg: grado
					echo '<span class="form-row">';
						echo '<span class="row-label">grado del grupo</span>';
						echo '<span class="row-field">';
							echo '<select name="editgroup-grade" id="editgroup-grade" class="fselect">';
								echo '<option value="1"' . (($editgroup_groupinfo->group_grade == '1')?' selected="selected"':'') . '>1&deg; grado</option>';
								echo '<option value="2"' . (($editgroup_groupinfo->group_grade == '2')?' selected="selected"':'') . '>2&deg; grado</option>';
								echo '<option value="3"' . (($editgroup_groupinfo->group_grade == '3')?' selected="selected"':'') . '>3&deg; grado</option>';
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: grado
					
					// beg: nombre del grupo
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre del grupo</span>';
						echo '<span class="row-field"><input type="text" id="editgroup-name" name="editgroup-name" class="ftext" value="' . strtoupper($editgroup_groupinfo->group_name) . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: nombre del grupo
					
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
