<?php
	
	
	echo '<span class="history-options">';
		// echo '<a href="javascript: contentLoader(\'secundaria_profile_root\', \'students_groups\', \'.dashboard-user-admin\', \'schoolID=' . $schoolInfo->school_id . '\', \'schoolID=' . $schoolInfo->school_id . '\');" class="ho-back">Regresar</a>';
		
	echo '</span>';
	
	
	
	
	
	echo '<span class="table table-schools-groups-users-root">';
		
		
		
		
		
		// beg: header
		echo '<span class="table-header">';
			// beg: uptions
			echo '<span class="header-options">';
				// echo '<a href="javascript: void(0);" class="option-item upgrade_all_students" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '">cambiar a todos los alumnos de grado</a>';
				// echo '<a href="javascript: void(0);" class="option-item add-student-root" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $groupInfo->group_id . '">agregar alumno</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			echo '<span class="header-title">Usuarios registrados en secundaria</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		
		
		
		
		// beg: titles
		echo '<span class="table-titles">';
			echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-names">Nombre</span>';
			echo '<span class="col-title col-identifier col-curp">Usuario</span>';
			echo '<span class="col-title col-identifier col-curp">Tipo</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		
		
		
		
		// beg: list
		echo '<span class="table-list">';
		
		$col_counter = 1;
		if ( sizeof($users) > 0 ) {
			foreach ( $users as $user ) {
				echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="tablerow-userid_' . $user->user_id . '">';
					
					echo '<span class="col-title col-tools">';
						if ( $this->session->userdata('cas-secundaria-userid') != $user->user_id ) {
							echo '<span class="tool"></span>';
							echo '<a href="javascript: void(0);" class="tool edit" title="editar" id="isereditid_' . $user->user_id . '"></a>';
							echo '<a href="javascript: void(0);" class="tool delete" title="eliminar" id="iserdeleteid_' . $user->user_id . '"></a>';
						}
						else {
							echo '<span class="tool"></span>';
							echo '<span class="tool"></span>';
							echo '<span class="tool"></span>';
						}
					echo '</span>';
					
					echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-names">' . $user->user_lname . ' ' . $user->user_fname . '</span>';
					echo '<span class="col-title col-identifier col-curp">' . $user->user_name . '</span>';
					switch ( $user->user_type ) {
						case 'root':
							$usertype = 'Administrador';
							break;
						case 'user':
							$usertype = 'Equipo CAS / Enlace Técnico';
							break;
						case 'teacher':
						default:
							$usertype = 'Profesor';
					}
					echo '<span class="col-title col-identifier col-curp">' . $usertype . '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">Usted no ha registrado ningún usuario</span>';
		echo '</span>';
	echo '</span>';
