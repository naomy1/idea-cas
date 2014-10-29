<?php
	
	// echo '<br /><br /><br />';	
	// echo '<div align="right"><a href="javascript: contentLoader(\'secundaria_app\',\'app_student\', \'.dashboard-container\',\'' . $params . '\',\'' . $params . '\');">reload</a><br /><br /></div>';
	
	echo '<input type="hidden" style="display: inline-block; height: 1px; width: 1px; float: left;" id="studentID" name="studentID" value="' . $studentInfo->student_id . '" />';
	echo '<input type="hidden" style="display: inline-block; height: 1px; width: 1px; float: left;" id="schoolID" name="schoolID" value="' . $schoolInfo->school_id . '" />';
	echo '<input type="hidden" style="display: inline-block; height: 1px; width: 1px; float: left;" id="schoolCCT" name="schoolCCT" value="' . $schoolInfo->school_cct . '" />';
	echo '<input type="hidden" style="display: inline-block; height: 1px; width: 1px; float: left;" id="groupID" name="groupID" value="' . $groupInfo->group_id . '" />';
	
	echo '<span class="table app-student-questions">';
		
		// beg: header
		echo '<span class="table-header">';
			echo '<span class="header-title">Cuestionario para ' . $studentInfo->student_lname . ' ' . $studentInfo->student_fname . '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-question">Pregunta</span>';
			echo '<span class="col-title col-answer">';
				echo '<span class="answer-item">muy bien</span>';
				echo '<span class="answer-item">bien</span>';
				echo '<span class="answer-item">suficiente</span>';
				echo '<span class="answer-item">nada</span>';
			echo '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		
		// beg: list
		echo '<span class="table-list">';
		echo '<div id="questions">';
			echo '<div class="slides_container">';
				$col_counter = 1;
				
				if ( sizeof($appQuestions) > 0 ) {
					
					echo '<div>';
					foreach ( $appQuestions as $question ) {
						echo '<span class="table-rows question-item ' . (($col_counter%2)?'':' odd') . '" id="questionid_' . $question->question_id . '_questionnumber_' . $col_counter . '">';
		
							echo '<span class="col-title col-answer">';
								echo '<span class="answer-item"><input type="radio" name="question_' . $question->question_id . '" id="questionid_' . $question->question_id . '_questionnumber_' . $col_counter . '_questioncounter_1" class="radio-answer" title="muy bien" value="1" /></span>';
								echo '<span class="answer-item"><input type="radio" name="question_' . $question->question_id . '" id="questionid_' . $question->question_id . '_questionnumber_' . $col_counter . '_questioncounter_2" class="radio-answer" title="bien" value="2" /></span>';
								echo '<span class="answer-item"><input type="radio" name="question_' . $question->question_id . '" id="questionid_' . $question->question_id . '_questionnumber_' . $col_counter . '_questioncounter_3" class="radio-answer" title="suficiente" value="3" /></span>';
								echo '<span class="answer-item"><input type="radio" name="question_' . $question->question_id . '" id="questionid_' . $question->question_id . '_questionnumber_' . $col_counter . '_questioncounter_4" class="radio-answer" title="nada" value="4" /></span>';
								echo '<span class="clear"></span>';
							echo '</span>';
							
							echo '<span class="col-title col-counter">' . $col_counter . '</span>';
							echo '<span class="col-title col-question">' . $question->question_text . '</span>';
							echo '<span class="clear"></span>';
							
						echo '</span>';
						$col_counter++;
						if ( $col_counter == 16 || $col_counter == 31 ) {
							echo '</div>';
							echo '<div>';
						}
					}
					echo '</div>';
				}
				else
					echo '<span class="table-rows empty-row">No existe ninguna pregunta disponible para este alumno o no hay ninguna aplicación en curso</span>';
				
				// beg: last-slide
				
				if ( !empty($appQuestions) ) {
					echo '<div><span style="display: block; height: 400px;">';
						
						echo '<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%"><tr><td height="100%" width="100%" align="center" valign="middle">';
					
							echo '<span class="app-messenger" style="max-height: 200px; overflow: auto;"></span>';
							
							echo '<span class="clear"></span>';
					
							echo 'Si estás seguro de que has completado todas las preguntas por favor da click en finalizar para que puedas concluir con<br />tu encuesta y después sigue las indicaciones de tu profesor';
							
							echo '<span class="centered button-end-questions-area">';
								echo '<a href="javascript: void(0);" class="action-button end-questions">Finalizar mi encuesta</a>';
							echo '</span>';
						
						echo '</td></tr></table>';
						
					echo '</span></div>';
				}
				// end: last-slide
				
				
			echo '</div>';
			
			echo '<span class="prev-nex-pagination">';
				echo '<a href="javascript: void(0);" class="page-prev">&lsaquo; &lsaquo; anterior</a>';
				echo '<a href="javascript: void(0);" class="page-next">siguitente &rsaquo; &rsaquo;</a>';
			echo '</span>';
			
		echo '</div>';
		echo '</span>';
		// end: list
		
		
		echo '<span class="clear"></span>';
	echo '</span>';
	
	/*
	foreach ( $appQuestions as $question ) {
		echo $question->question_text . '<br /><br />';
	}
	*/
