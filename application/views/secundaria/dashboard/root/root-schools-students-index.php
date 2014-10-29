<?php

	echo '<span class="table table-schools-students-root">';
	
		// beg: header
		echo '<span class="table-header">';
			// beg: uptions
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item" id="up-grade-schools">cambiar de grado a todos los alumnos</a>';
				echo '<a href="javascript: void(0);" class="option-item" id="add-schools">agregar escuela</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			echo '<span class="header-title">Escuelas registradas en el sistema</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-names">Escuela</span>';
			echo '<span class="col-title col-identifier">C.C.T.</span>';
			echo '<span class="col-title col-identifier">Grupos</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		// beg: table-rows
		$col_counter = 1;
		echo '<span class="table-list">';
		if ( sizeof ( $schools ) > 0 ) {
			foreach ( $schools as $school ) {
				echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="schoolid_' . $school->school_id . '">';
					
					echo '<span class="col-title col-tools">';
						echo '<span class="tool"></span>';
						echo '<span class="tool"></span>';
						echo '<span class="tool"></span>';
					echo '</span>';
					
					echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-names"><a href="javascript: void(0);" class="names-link">' . $school->school_name . '</a></span>';
					echo '<span class="col-title col-identifier">' . $school->school_cct . '</span>';
					echo '<span class="col-title col-identifier">' . $this->secundaria_schools_mdl->school_groups_counter($school->school_id) . '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">Usted no ha registrado ninguna escuela</span>';
		// end: table-rows
		echo '</span>';
		
		echo '<span class="clear"></span>';
	echo '</span>';
	/*
	foreach ( $schools as $school ) {
		echo $school->school_name;
	}
	*/