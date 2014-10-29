<?php
	
	echo '<span class="history-options">';
		// echo '<a href="javascript: contentLoader(\'secundaria_schools\', \'index\', \'.dashboard-container\');" class="ho-back">Regresar</a>';
		echo '&nbsp;';
	echo '</span>';

	echo '<span class="table table-root-schools-info">';
	
		echo '<span class="table-header">';
			
			// beg: uptions
			echo '<span class="header-options">';
				echo '<a href="' . base_url() . '?c=excel&m=excel_schools" class="option-item addgroup">Todos los Alumnos Nominados (.xlsx)</a>';
				echo '<a href="' . base_url() . '?c=excel&m=excel_max_nominated" class="option-item addgroup">Alumnos con 3 o más Áreas de Desempeño (.xlsx)</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			
			echo '<span class="header-title">Escuelas del sistema</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-identifier">CCT</span>';
			echo '<span class="col-title col-names">Escuela</span>';
			echo '<span class="col-title col-identifier">Usuario</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		if ( !empty($schools) ) {
			$school_counter = 0;
			foreach ( $schools as $school ) {
				echo '<span class="table-rows' . (($school_counter % 2)? ' odd':'') . '" id="schoolid_' . $school->school_id . '">';
					
					echo '<span class="col-title col-tools">';
						echo '<a href="' . base_url() . '?c=excel&m=make_school_excel&schoolID=' . $school->school_id . '" class="tool download" title="descargar archivo"></a>';
						echo '<a href="javascript: void(0);" class="tool edit" title="editar"></a>';
						echo '<a href="javascript: void(0);" class="tool delete" title="eliminar"></a>';
					echo '</span>';
					
					echo '<span class="col-title col-counter">' . ( $school_counter + 1 ) . '</span>';
					echo '<span class="col-title col-identifier">' . $school->school_cct . '</span>';
					echo '<span class="col-title col-names school-name">' . $school->school_name . '</span>';
					$user = $this->users->get_userData_by_ID($school->school_user_id, 'user_fname, user_lname, user_name');
					echo '<span class="col-title col-identifier">' . $user->user_lname . ' ' . $user->user_fname . '</span>';
					
					echo '<span class="clear"></span>';
				echo '</span>';
				$school_counter++;
			}
		}
			
		else {
			echo '<span class="table-rows empty-row">';
				echo 'No se han encontrado escuelas en el sistema';
			echo '</span>';
		}
		
	echo '</span>';