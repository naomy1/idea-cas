<?php
	
	echo '<span class="bar-success">La pregunta se ha borrado del sistema</span>';
	
	echo '<script type="text/javascript">';
		echo '$("#questionid_' . $question_id . '").slideUp(showtimer, function (){ $(this).remove(); });';
	echo '</script>';
