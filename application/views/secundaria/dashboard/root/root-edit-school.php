<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Editar escuela "' . $editschool_name . '"</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-editschool-root">';
				
					// beg: form messenger
					echo '<span class="form-messenger"></span>';
					// end: form messenger
				
					echo '<input type="hidden" name="editschool-schoolid" id="editschool-schoolid" style="display: inline-block; float: left; height: 0px; width: 0px;" value="' . $editschool_id . '" />';
					
					// beg: cct
					echo '<span class="form-row">';
						echo '<span class="row-label">C.C.T.</span>';
						echo '<span class="row-field"><input type="text" id="editschool-cct" name="editschool-cct" class="ftext" value="' . $editschool_cct . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: cct
					
					// beg: nombre
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre</span>';
						echo '<span class="row-field"><input type="text" id="editschool-name" name="editschool-name" class="ftext" value="' . $editschool_name . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: nombre
					
					// beg: dirección
					echo '<span class="form-row">';
						echo '<span class="row-label">dirección</span>';
						echo '<span class="row-field"><input type="text" id="editschool-address" name="editschool-address" class="ftext" value="' . $editschool_address . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: dirección
					
					// beg: colonia
					echo '<span class="form-row">';
						echo '<span class="row-label">colonia</span>';
						echo '<span class="row-field"><input type="text" id="editschool-colony" name="editschool-colony" class="ftext"  value="' . $editschool_colony . '"/></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: colonia
					
					// beg: delegación
					echo '<span class="form-row">';
						echo '<span class="row-label">delegación</span>';
						echo '<span class="row-field">';
							echo '<select name="editschool-delegation" id="editschool-delegation" class="fselect">';
								foreach ( $editschool_delegations as $delegation ) {
									echo '<option value="' . $delegation->del_id . '"' . (($editschool_delegation == $delegation->del_id )?' selected="selected"':'') . '>' . $delegation->del_name . '</option>';
								}
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: delegación
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">código postal</span>';
						echo '<span class="row-field"><input type="text" id="editschool-zipcode" name="editschool-zipcode" class="ftext" value="' . $editschool_zipcode . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: teléfono
					echo '<span class="form-row">';
						echo '<span class="row-label">teléfono(s)</span>';
						echo '<span class="row-field"><input type="text" id="editschool-phone" name="editschool-phone" class="ftext" value="' . $editschool_phone . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: teléfono
					
					// beg: zona de supervisión
					echo '<span class="form-row">';
						echo '<span class="row-label">zona de supervisión<br />de la escuela</span>';
						echo '<span class="row-field"><input type="text" id="editschool-supervisionzone" name="editschool-supervisionzone" class="ftext" value="' . $editschool_supervisionzone . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: zona de supervisión
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">U.S.A.E.R.</span>';
						echo '<span class="row-field"><input type="text" id="editschool-usaer" name="editschool-usaer" class="ftext" value="' . $editschool_usaer . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">zona de supervisión<br />de la U.S.A.E.R.</span>';
						echo '<span class="row-field"><input type="text" id="editschool-usaer-supervisionzone" name="editschool-usaer-supervisionzone" class="ftext" value="' . $editschool_usaer_supervisionzone . '" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: turno
					echo '<span class="form-row">';
						echo '<span class="row-label">turno</span>';
						echo '<span class="row-field">';
							echo '<select name="editschool-turn" id="editschool-turn" class="fselect">';
								echo '<option value="m"' . ((strtolower($editschool_turn) == 'm')?' selected="selected"':'') . '>TM : Turno Matutino</option>';
								echo '<option value="v"' . ((strtolower($editschool_turn) == 'v')?' selected="selected"':'') . '>TV : Turno Vespertino</option>';
								echo '<option value="tc"' . ((strtolower($editschool_turn) == 'tc')?' selected="selected"':'') . '>TC : Turno Completo</option>';
								echo '<option value="ja"' . ((strtolower($editschool_turn) == 'ja')?' selected="selected"':'') . '>JA : Jornada Ampliada</option>';
							echo '</select>';
						
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: turno
					
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
