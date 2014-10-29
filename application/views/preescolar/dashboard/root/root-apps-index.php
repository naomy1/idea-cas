<?php
	
	
	echo '<span class="history-options">';
		// echo '<a href="javascript: contentLoader(\'preescolar_profile_root\', \'students_groups\', \'.dashboard-user-admin\', \'schoolID=' . $schoolInfo->school_id . '\', \'schoolID=' . $schoolInfo->school_id . '\');" class="ho-back">Regresar</a>';
		
	echo '</span>';
	
	
	
	
	
	echo '<span class="table table-apps-root">';
		
		
		
		
		
		// beg: header
		echo '<span class="table-header">';
			// beg: uptions
			echo '<span class="header-options">';
				// echo '<a href="javascript: void(0);" class="option-item upgrade_all_students" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '">cambiar a todos los alumnos de grado</a>';
				echo '<a href="javascript: void(0);" class="option-item add-app">agregar aplicación</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			echo '<span class="header-title">Aplicaciones</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		
		
		
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-names">Nombre</span>';
			echo '<span class="col-title col-identifier col-curp">Descripción</span>';
			echo '<span class="col-title col-identifier col-curp">Fecha activación</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		
		
		
		
		// beg: list
		echo '<span class="table-list">';
		
		$col_counter = 1;
		if ( sizeof($apps) > 0 ) {
			foreach ( $apps as $app ) {
				echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="tableappid_' . $app->app_id . '">';
					
					echo '<span class="col-title col-tools">';
						echo '<a href="javascript: void(0);" class="tool status ' . (($app->app_is_active == TRUE)? 'activated': 'deactivated') . '" title="' . (($app->app_is_active == TRUE)? 'desactivar': 'activar') . '" id="appid_' . $app->app_id . '"></a>';
						echo '<a href="javascript: void(0);" class="tool edit" title="editar" id="editappid_' . $app->app_id . '"></a>';
						echo '<a href="javascript: void(0);" class="tool delete" title="eliminar" id="deleteappid_' . $app->app_id . '"></a>';
					echo '</span>';
					
					echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-app-name col-names"><a href="javascript: void(0);" class="names-link">' . $app->app_name . '</a></span>';
					echo '<span class="col-title col-identifier col-curp">' . $app->app_description . '</span>';
					echo '<span class="col-title col-identifier col-curp">' . $this->strings_mdl->date($app->app_date_activated, 'F d - Y') . '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">No se ha registrado ninguna aplicación</span>';
		echo '</span>';
	echo '</span>';
