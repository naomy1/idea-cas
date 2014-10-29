<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Editar mi contraseña</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
				
				
				echo '<span class="form">';
					echo '<span class="form-editpasswd">';
					
						echo '<span class="form-messenger"></span>';
					
						// beg: userid
						echo '<input type="hidden" name="editpasswd-userid" id="editpasswd-userid" value="' . $editpasswd_userid . '" style="height: 1px; width: 1px; float: left;" />';
						// end: userid
						
						// beg: passwd-actual
						echo '<span class="form-row">';
							echo '<span class="row-label">contraseña actual</span>';
							echo '<span class="row-field"><input type="password" id="editpasswd-actual" name="editpasswd-actual" class="ftext" /></span>';
							echo '<span class="clear"></span>';
						echo '</span>';
						// end: passwd-actual
						
						// beg: passwd-new
						echo '<span class="form-row">';
							echo '<span class="row-label">contraseña nueva</span>';
							echo '<span class="row-field"><input type="password" id="editpasswd-new" name="editpasswd-new" class="ftext" /></span>';
							echo '<span class="clear"></span>';
						echo '</span>';
						// end: passwd-new
						
						// beg: passwd-repeatnew
						echo '<span class="form-row">';
							echo '<span class="row-label">repita contraseña<br />nueva</span>';
							echo '<span class="row-field"><input type="password" id="editpasswd-renew" name="editpasswd-renew" class="ftext" /></span>';
							echo '<span class="clear"></span>';
						echo '</span>';
						// end: passwd-repeatnew
						
						// beg: actions
						echo '<span class="form-actions">';
							echo '<span class="spinner-16x16"></span>';
							echo '<a href="javascript: void(0);" class="button submit">guardar cambios</a>';
							echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
						echo '</span>';
						// end: actions
					
					echo '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
			
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
