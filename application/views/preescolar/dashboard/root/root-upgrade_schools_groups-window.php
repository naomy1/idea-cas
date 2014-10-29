<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Cambiar de grado a todos los grupos</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-upgrade-schools-groups">';
					
					echo '<input type="hidden" style="display: inline-block; float: left; height: 1px; width: 1px;" name="upgrade_schoolid" id="upgrade_schoolid" value="' . $schoolid . '" />';
				
					echo '<span class="form-messenger"></span>';
					
					// beg: crosee
					echo '<span class="form-row">';
						echo '<span class="row-label">de:</span>';
						echo '<span class="row-field">';
							echo '<select name="upgrade_group_from" id="upgrade_group_from" class="fselect">';
								foreach ( $school_groups as $groups ) {
									echo '<option value="' . $groups->group_id . '">' . $groups->group_grade . '&deg; ' . $groups->group_name . '</option>';
								}
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					
					echo '<span class="form-row">';
						echo '<span class="row-label">a:</span>';
						echo '<span class="row-field">';
							echo '<select name="upgrade_group_to" id="upgrade_group_to" class="fselect">';
								foreach ( $school_groups as $groups ) {
									echo '<option value="' . $groups->group_id . '">' . $groups->group_grade . '&deg; ' . $groups->group_name . '</option>';
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
