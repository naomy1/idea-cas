<?php
	
	
	echo '<a href="javascript: void(0);" class="window-container-closewindow"></a>';
	echo '<span class="window-container-title">Editar aplicación</span>';
	echo '<span class="window-container-messenger"></span>';
	echo '<span class="window-container-body">';
	
		echo '<span class="form">';
			echo '<span class="form-editapp-root">';
		
			echo '<input type="hidden" name="updateapp-appid" id="updateapp-appid" value="' . $appinfo->app_id . '" style="height: 1px; width: 1px; float: left;" />';
			
			echo '<span class="form-messenger"></span>';
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">nombre</span>';
				echo '<span class="row-field"><input type="text" id="updateapp-appname" name="updateapp-appname" class="ftext" value="' . $appinfo->app_name . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">fecha de activación</span>';
				echo '<span class="row-field"><input type="text" id="updateapp-appdate" name="updateapp-appdate" class="ftext" value="' . date('m/d/Y', $appinfo->app_date_activated) . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: username
			echo '<span class="form-row">';
				echo '<span class="row-label">descripción</span>';
				echo '<span class="row-field"><input type="text" id="updateapp-appdescription" name="updateapp-appdescription" class="ftext" value="' . $appinfo->app_description . '" /></span>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: username
			
			// beg: actions
			echo '<span class="form-actions">';
				echo '<span class="spinner-16x16"></span>';
				echo '<a href="javascript: void(0);" class="button submit">guardar cambios</a>';
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