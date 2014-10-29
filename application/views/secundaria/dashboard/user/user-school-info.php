<?php
	
	echo '<span class="table table-user-schools-info">';
		
		echo '<span class="table-header">';
			
			echo '<span class="header-options">';
				echo '<a href="' . base_url() . '?c=excel&m=make_school_excel&schoolID=' . $school_info->school_id . '" class="option-item download-school-format">Descargar formato</a>';
			echo '</span>';
		
			echo '<span class="header-title">' . $school_info->school_name . '</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
		
		if ( !empty($school_groups) ) {
			$groupcounter = 0;
			foreach ( $school_groups as $group ) {
				echo '<span class="table-rows' . (($groupcounter % 2)? ' odd':'') . '" id="schoolid_' . $school_info->school_id . '">';
					
					echo '<span class="col-title col-names">' . $group->group_grade . '</span>';
					echo '<span class="col-title col-names">' . $group->group_name . '</span>';
					
					echo '<span class="clear"></span>';
				echo '</span>';
				$groupcounter++;
			}
		}
			
		else {
			echo '<span class="table-rows empty-row">';
				echo 'En esta escuela no se han registrado grupos';
			echo '</span>';
		}
		
		
	echo '</span>';