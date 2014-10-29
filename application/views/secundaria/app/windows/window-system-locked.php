<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			// echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Encuesta concluída</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
				
				echo '<span class="form">';
					echo '<span class="form-unlock-system">';
					
						echo '<span class="form-messenger"></span>';
					
						// beg: userid
						echo '<input type="hidden" name="unlocksystem-schoolID" id="unlocksystem-schoolID" value="' . $schoolID . '" style="height: 1px; width: 1px; float: left;" />';
						echo '<input type="hidden" name="unlocksystem-schoolCCT" id="unlocksystem-schoolCCT" value="' . $schoolCCT . '" style="height: 1px; width: 1px; float: left;" />';
						echo '<input type="hidden" name="unlocksystem-groupID" id="unlocksystem-groupID" value="' . $groupID . '" style="height: 1px; width: 1px; float: left;" />';
						// end: userid
						echo '<span class="bar-success">has terminado tu encuesta, por favor avisa al profesor aplicador que ya haz terminado</span>';
						echo '<span class="box-info">para desbloquear el sistema debe escribir su contraseña de usuario.<br /><br />
													 si desea continuar después con las encuestas de los otros niños de click en el<br />
													 botón "continuar después" si desea continuar con las encuestas de click en "desbloquear"</span>';
						// beg: passwd-actual
						echo '<span class="form-row">';
							echo '<span class="row-label">contraseña</span>';
							echo '<span class="row-field"><input type="password" id="unlocksystem-password" name="unlocksystem-password" class="ftext" /></span>';
							echo '<span class="clear"></span>';
						echo '</span>';
						// end: passwd-actual
						
						// beg: actions
						echo '<span class="form-actions">';
							echo '<span class="spinner-16x16"></span>';
							echo '<a href="javascript: void(0);" class="button submit unlock">desbloquear</a>';
							echo '<a href="javascript: void(0);" class="button submit continue">continuar después</a>';
						echo '</span>';
						// end: actions
					
					echo '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
