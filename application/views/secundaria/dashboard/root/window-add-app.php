<?php
	
	
	echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
	echo '<span class="window-container-title">Agregar aplicación</span>';
	echo '<span class="window-container-messenger"></span>';
	echo '<span class="window-container-body">';
	
		echo '<span class="form">';
			echo '<span class="form-addapp-root">';
		
			echo '<span class="form-messenger"></span>';
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">nombre</span>';
				echo '<span class="row-field"><input type="text" id="addapp-appname" name="addapp-appname" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">fecha de activación</span>';
				echo '<span class="row-field"><input type="text" id="addapp-appdate" name="addapp-appdate" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">descripción</span>';
				echo '<span class="row-field"><input type="text" id="addapp-appdescription" name="addapp-appdescription" class="ftext" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">crear aplicación</a>';
				echo '<a href="javascript: void(0);" class="button cancel">cancelar</a>';
			echo '</span>';
			// end: actions
		
			echo '<span class="clear"></span>';
			
			echo '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		echo '<span class="clear"></span>';
	echo '</span>';
	
	echo '<span class="clear"></span>';