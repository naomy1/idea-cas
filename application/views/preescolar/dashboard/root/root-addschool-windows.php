<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Agregar escuela</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-addschool-root">';
				
					// beg: form messenger
					echo '<span class="form-messenger"></span>';
					// end: form messenger
				
					// beg: cct
					echo '<span class="form-row">';
						echo '<span class="row-label">C.C.T.</span>';
						echo '<span class="row-field"><input type="text" id="addschool-cct" name="addschool-cct" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: cct
					
					// beg: nombre
					echo '<span class="form-row">';
						echo '<span class="row-label">nombre del<br />preescolar</span>';
						echo '<span class="row-field"><input type="text" id="addschool-name" name="addschool-name" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: nombre
					
					// beg: dirección
					echo '<span class="form-row">';
						echo '<span class="row-label">dirección</span>';
						echo '<span class="row-field"><input type="text" id="addschool-address" name="addschool-address" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: dirección
					
					// beg: colonia
					echo '<span class="form-row">';
						echo '<span class="row-label">colonia</span>';
						echo '<span class="row-field"><input type="text" id="addschool-colony" name="addschool-colony" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: colonia
					
					// beg: delegación
					echo '<span class="form-row">';
						echo '<span class="row-label">delegación</span>';
						echo '<span class="row-field">';
							echo '<select name="addschool-delegation" id="addschool-delegation" class="fselect">';
								echo '<option value="0" selected="selected">-- Seleccione la delegación a la que pertenece --</option>';
								foreach ( $addschool_delegations as $delegation ) {
									echo '<option value="' . $delegation->del_id . '">' . $delegation->del_name . '</option>';
								}
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: delegación
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">código postal</span>';
						echo '<span class="row-field"><input type="text" id="addschool-zipcode" name="addschool-zipcode" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: teléfono
					echo '<span class="form-row">';
						echo '<span class="row-label">teléfono(s)</span>';
						echo '<span class="row-field"><input type="text" id="addschool-phone" name="addschool-phone" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: teléfono
					
					// beg: zona de supervisión
					echo '<span class="form-row">';
						echo '<span class="row-label">zona de supervisión<br />del jardín de niños</span>';
						echo '<span class="row-field"><input type="text" id="addschool-supervisionzone" name="addschool-supervisionzone" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: zona de supervisión
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">C.A.P.E.P.</span>';
						echo '<span class="row-field"><input type="text" id="addschool-usaer" name="addschool-usaer" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: código postal
					echo '<span class="form-row">';
						echo '<span class="row-label">dirección operativa<br />del C.A.P.E.P.</span>';
						echo '<span class="row-field"><input type="text" id="addschool-usaer-supervisionzone" name="addschool-usaer-supervisionzone" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: código postal
					
					// beg: turno
					echo '<span class="form-row">';
						echo '<span class="row-label">turno</span>';
						echo '<span class="row-field">';
						
							echo '<select name="addschool-turn" id="addschool-turn" class="fselect">';
								echo '<option value="na" selected="selected">-- Seleccione el turno --</option>';
								echo '<option value="m">TM : Turno Matutino</option>';
								echo '<option value="v">TV : Turno Vespertino</option>';
								echo '<option value="tc">TC : Turno Completo</option>';
								echo '<option value="ja">JA : Jornada Ampliada</option>';
							echo '</select>';
						
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: turno
					
					echo '<br /><br /><br />';
					echo '<b>¿Cuántos grupos hay en su escuela?</b><br />';
					
					// beg: 1ro
					echo '<span class="form-row">';
						echo '<span class="row-label">de 1&deg;</span>';
						echo '<span class="row-field"><input type="text" id="addschool-grade-one" name="addschool-grade-one" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: 1ro
					
					// beg: 2do
					echo '<span class="form-row">';
						echo '<span class="row-label">de 2&deg;</span>';
						echo '<span class="row-field"><input type="text" id="addschool-grade-two" name="addschool-grade-two" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: 2do
					
					// beg: 3ro
					echo '<span class="form-row">';
						echo '<span class="row-label">de 3&deg;</span>';
						echo '<span class="row-field"><input type="text" id="addschool-grade-three" name="addschool-grade-three" class="ftext" /></span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: 3ro
					
					// beg: actions
					echo '<span class="form-actions">';
						echo '<span class="spinner-16x16"></span>';
						echo '<a href="javascript: void(0);" class="button submit">agregar escuela</a>';
						echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
					echo '</span>';
					// end: actions
					
				echo '</span></span>';
			
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
