<?php
	
	echo '<span class="table table-app-questions-root">';
		
		echo '<span class="table-header">';
				
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item add-question" id="addappid_' . $app->app_id . '">agregar pregunta</a>';
			echo '</span>';
		
			echo '<span class="header-title">Preguntas en la aplicación <i>' . $app->app_name . '</i></span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		
		if ( !empty($app_questions) ) {
			$questioncouter = 0;
			foreach ( $app_questions as $question ) {
				echo '<span class="table-rows' . (($questioncouter % 2)? ' odd':'') . '" id="questionid_' . $question->question_id . '">';
					
					// beg: tools
					echo '<span class="col-title col-tools">';
						echo '<span class="tool"></span>';
						echo '<span class="tool"></span>';
						echo '<span class="tool"></span>';
						// echo '<a href="javascript: void(0);" class="tool edit" title="editar"></a>';
						// echo '<a href="javascript: void(0);" class="tool delete" title="eliminar"></a>';
					echo '</span>';
					// end: tools
				
					echo '<span class="col-title col-counter">' . ( $questioncouter + 1 ) . '</span>';
					echo '<span class="col-title col-names" style="width: 400px;">' . $question->question_text . '</span>';
					
					echo '<span class="clear"></span>';
				echo '</span>';
				$questioncouter++;
			}
		}
			
		else {
			echo '<span class="table-rows empty-row">';
				echo 'Aún no hay preguntas para mostrar';
			echo '</span>';
		}
		
		
	echo '</span>';