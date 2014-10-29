<?php
	
	echo '<span class="table table-schools-groups-students-app">';
	
		// beg: header
		echo '<span class="table-header">';
		
			/*
			// beg: uptions
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item add-student" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '">agregar alumno</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			*/
			
			echo '<span class="header-title">' . strtoupper($schoolInfo->school_cct) . ' - ' . $schoolInfo->school_name . ' [Grado: ' . $groupInfo->group_grade . '&deg;, Grupo: ' . strtoupper($groupInfo->group_name) . ']</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-names">Alumno</span>';
			echo '<span class="col-title col-identifier col-curp">C.U.R.P.</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		// beg: list
		echo '<span class="table-list">';
		$col_counter = 1;
		if ( sizeof($groupStudents) > 0 ) {
			foreach ( $groupStudents as $student ) {
				if ( $student->student_end_app == 'false' ) echo '<a href="javascript: void(0);" class="table-rows' . (($col_counter%2)?'':' odd') . '" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '_studentid_' . $student->student_id . '">';
				else echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '_studentid_' . $student->student_id . '">';

					
					/*
					echo '<span class="col-title col-tools">';
						echo '<a href="javascript: void(0);" class="tool edit" title="editar"></a>';
						echo '<a href="javascript: void(0);" class="tool delete" title="eliminar"></a>';
					echo '</span>';
					*/
					
					echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-names">' . $student->student_lname . ' ' . $student->student_fname . '</span>';
					echo '<span class="col-title col-identifier col-curp">' . $student->student_curp . '</span>';
					echo '<span class="clear"></span>';
					
				if ( $student->student_end_app == 'false' ) echo '</a>';
				else echo '</span>';
				
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">Usted no ha registrado ningún alumno</span>';
		echo '</span>';
		// end: list
		
		echo '<span class="clear"></span>';
	
	echo '</span>';
