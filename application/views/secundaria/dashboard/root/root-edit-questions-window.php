<?php
	
	echo '<span class="window-layer">';
		echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" valign="middle" align="center">';
		echo '<span class="window-container">';
			echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
			echo '<span class="window-container-title">Editar Pregunta</span>';
			echo '<span class="window-container-messenger"></span>';
			echo '<span class="window-container-body">';
			
				echo '<span class="form"><span class="form-editquestion-root">';
				
					// beg: form messenger
					echo '<span class="form-messenger"></span>';
					// end: form messenger
				
					echo '<input type="hidden" name="editquestion-question-id" id="editquestion-question-id" style="display: inline-block; float: left; height: 0px; width: 0px;" value="' . $question->question_id . '" />';
					
					// beg: cct
					echo '<span class="form-row">';
						echo '<span class="row-label">Pregunta</span>';
						echo '<span class="row-field">';
							echo '<textarea class="ftext" style="height: 150px;" id="editquestion-question-content">' . $question->question_text . '</textarea>';
						echo '</span>';
						echo '<span class="clear"></span>';
					echo '</span>';
					// end: cct
					
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
