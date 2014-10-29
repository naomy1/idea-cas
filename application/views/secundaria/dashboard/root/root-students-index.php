<?php

	echo '<span class="history-options">';
		echo '<a href="javascript: contentLoader(\'secundaria_profile_root\', \'students_groups\', \'.dashboard-user-admin\', \'schoolID=' . $schoolInfo->school_id . '\', \'schoolID=' . $schoolInfo->school_id . '\');" class="ho-back">Regresar</a>';
		
	echo '</span>';
	
	
	echo '<span class="table table-schools-groups-students-root">';
		
		// beg: header
		echo '<span class="table-header">';
			// beg: uptions
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item upgrade_all_students" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '_grade_' . $groupInfo->group_grade . '">cambiar a todos los alumnos de grado</a>';
				echo '<a href="javascript: void(0);" class="option-item add-student-root" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '_grade_' . $groupInfo->group_grade . '">agregar alumno</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			echo '<span class="header-title">' . strtoupper($schoolInfo->school_cct) . ' - ' . $schoolInfo->school_name . '<br />[Grado: ' . $groupInfo->group_grade . '&deg;, Grupo: ' . strtoupper($groupInfo->group_name) . ']</span>';
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
				echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '_studentid_' . $student->student_id . '">';
					
					echo '<span class="col-title col-tools">';
						echo '<span class="tool"></span>';
						echo '<a href="javascript: void(0);" class="tool edit" title="editar"></a>';
						echo '<a href="javascript: void(0);" class="tool delete" title="eliminar"></a>';
					echo '</span>';
					
					echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-names">' . $student->student_lname . ' ' . $student->student_fname . '</span>';
					echo '<span class="col-title col-identifier col-curp">' . $student->student_curp . '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">Usted no ha registrado ningún alumno</span>';
		echo '</span>';
		// end: list
		
		echo '<span class="clear"></span>';
	echo '</span>';
