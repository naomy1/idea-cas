<?php
	
	echo '<span class="table table-user-schools">';
	
		echo '<span class="table-header">';
			
			echo '<span class="header-options">';
				echo '<a href="javascript: void(0);" class="option-item add-school">agregar escuela</a>';
			echo '</span>';
		
			echo '<span class="header-title">Usted está inscrito en las siguientes escuelas</span>';
			echo '<span class="clear"></span>';
		echo '</span>';
	
	
		if ( !empty($userSchools) ) {
			$schoolcounter = 0;
			foreach ( $userSchools as $school ) {
				echo '<span class="table-rows' . (($schoolcounter % 2)? ' odd':'') . '" id="schoolid_' . $school->school_id . '">';
					echo '<span class="col-title col-names"><a href="javascript: void(0);" class="school-name">' . $school->school_name . '</a></span>';
					echo '<span class="col-title col-names"><a href="javascript: void(0);" class="school-name">' . $school->school_cct . '</a></span>';
					
					echo '<span class="clear"></span>';
				echo '</span>';
				$schoolcounter++;
			}
		}
			
		else {
			echo '<span class="table-rows empty-row">';
				echo 'Usted no se ha dado de alta en ninguna escuela';
			echo '</span>';
		}
		
	echo '</span>';
