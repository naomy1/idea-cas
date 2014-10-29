<?php
	
	
	
	
	foreach ( $editstudent_schools_groups as $groups ) {
		echo '<option value="' . $groups->group_id . '"' . (($groups->group_id == $editstudent_groupid)? ' selected="selected"' : '') . '>' . $groups->group_grade . '&deg; ' . $groups->group_name . '</option>';
	}