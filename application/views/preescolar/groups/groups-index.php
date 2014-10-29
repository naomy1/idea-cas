<?php
	
	
	echo '<span class="history-options">';
		echo '<a href="javascript: contentLoader(\'preescolar_schools\', \'index\', \'.dashboard-container\');" class="ho-back">Regresar</a>';
	echo '</span>';
	
	
	echo '<span class="table table-schools-groups">';
		
		// beg: header
		echo '<span class="table-header">';
		
			// beg: uptions
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item addgroup" id="schoolid_' . $schoolInfo->school_id . '">agregar grupo</a>';
				echo '<span class="clear"></span>';
			echo '</span>';
			// end: options
			
			echo '<span class="header-title">' . strtoupper($schoolInfo->school_cct) . ' - ' . $schoolInfo->school_name . '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: header
		
		// beg: titles
		echo '<span class="table-titles">';
			// echo '<span class="col-title col-counter">#</span>';
			echo '<span class="col-title col-identifier">Grado</span>';
			echo '<span class="col-title col-identifier">Grupo</span>';
			echo '<span class="col-title col-identifier">Alumnos</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		// end: titles
		
		echo '<span class="table-list">';
		$col_counter = 1;
		if ( sizeof($schoolsGroups) > 0 ) {
			foreach ( $schoolsGroups as $group ) {
				echo '<span class="table-rows' . (($col_counter%2)?'':' odd') . '" id="schoolid_' . $schoolInfo->school_id . '_schoolcct_' . $schoolInfo->school_cct . '_groupid_' . $group->group_id . '">';
					
					echo '<span class="col-title col-tools">';
						echo '<span class="tool"></span>';
						echo '<a href="javascript: void(0);" class="tool view" title="ver"></a>';
						echo '<a href="javascript: void(0);" class="tool edit" title="editar"></a>';
						// echo '<a href="javascript: void(0);" class="tool delete" title="eliminar"></a>';
					echo '</span>';
					
					// echo '<span class="col-title col-counter">' . $col_counter . '</span>';
					echo '<span class="col-title col-identifier col-grade"><a href="javascript: void(0);" class="names-link">' . $group->group_grade . '</a></span>';
					echo '<span class="col-title col-identifier col-name"><a href="javascript: void(0);" class="names-link">' . $group->group_name . '</a></span>';
					echo '<span class="col-title col-identifier col-groups">' . $this->preescolar_groups_mdl->groupStudentsCounter($group->group_id) . '</span>';
					echo '<span class="clear"></span>';
				echo '</span>';
				$col_counter++;
			}
		}
		else
			echo '<span class="table-rows empty-row">Usted no ha registrado ningún grupo</span>';
		echo '</span>';
		
		echo '<span class="clear"></span>';
	echo '</span>';
