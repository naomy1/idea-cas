<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Agregar Pregunta</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-addquestion-root">';
				
					// beg: form messenger
					echo '<span class="form-messenger"></span>';
					// end: form messenger
				
					echo '<input type="hidden" name="addquestion-app-id" id="addquestion-app-id" style="display: inline-block; float: left; height: 0px; width: 0px;" value="' . $app->app_id . '" />';
					
					// beg: cct
					echo '<span class="form-row">';
						echo '<span class="row-label">pregunta</span>';
						echo '<span class="row-field">';
							echo '<textarea class="ftext" style="height: 150px;" id="addquestion-question-content"></textarea>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: cct
					
					echo '<span class="form-row">';
						echo '<span class="row-label">tipo</span>';
						echo '<span class="row-field">';
							echo '<select name="addquestion-question-type" id="addquestion-question-type" class="fselect">';
								foreach ( $question_type as $type ) {
									echo '<option value="' . $type->type_id . '">' . $type->type_name . '</option>';
								}
							echo '</select>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					
					// beg: actions
					echo '<span class="form-actions">';
						echo '<span class="spinner-16x16"></span>';
						echo '<a href="javascript: void(0);" class="button submit">guardar pregunta</a>';
						echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
					echo '</span>';
					// end: actions
					
				echo '</span></span>';
			
			echo '</span>';
		echo '</span>';
		echo '</td></tr></table>';
	echo '</span>';
