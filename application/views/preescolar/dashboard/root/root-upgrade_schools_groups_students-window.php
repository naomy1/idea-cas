<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Cambiar de grado a todos los estudiantes</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-upgrade-schools-students-by-group">';
					
					echo '<input type="hidden" style="display: inline-block; float: left; height: 1px; width: 1px;" name="grade_group_schoolid" id="grade_group_schoolid" value="' . $schoolid . '" />';
					echo '<input type="hidden" style="display: inline-block; float: left; height: 1px; width: 1px;" name="grade_group_schoolcct" id="grade_group_schoolcct" value="' . $schoolcct . '" />';
					echo '<input type="hidden" style="display: inline-block; float: left; height: 1px; width: 1px;" name="grade_group_groupid" id="grade_group_groupid" value="' . $groupid . '" />';
					echo '<input type="hidden" style="display: inline-block; float: left; height: 1px; width: 1px;" name="grade_group_grade" id="grade_group_grade" value="' . $grade . '" />';
					
					echo '<span class="form-messenger"></span>';
					
					// beg: crosee
					echo '<span class="form-row">';
						echo '<span class="row-label">de:</span>';
						echo '<span class="row-field">';
							echo '<select name="grade_group_from" id="grade_group_from" class="fselect disabled" disabled="disabled">';
								foreach ( $school_groups as $groups ) {
									echo '<option value="' . $groups->group_id . '"' . (($groups->group_id == $groupid )?' selected="selected"':'') . '>' . $groups->group_grade . '&deg; ' . $groups->group_name . '</option>';
								}
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					
					echo '<span class="form-row">';
						echo '<span class="row-label">a:</span>';
						echo '<span class="row-field">';
							echo '<select name="grade_group_to" id="grade_group_to" class="fselect">';
								foreach ( $school_groups as $groups ) {
									echo '<option value="' . $groups->group_id . '"' . (($groups->group_id == $groupid )?' disabled="disabled"':'') . '>' . $groups->group_grade . '&deg; ' . $groups->group_name . '</option>';
								}
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
