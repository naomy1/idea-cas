<?php
	
	echo '<h1>Bienvenido</h1>';
	
	echo 'Bienvenido al sistema de administración para miembros del equipo CAS.<br /><br />';
	
	echo 'En este espacio usted podrá generar los reportes necesarios para cada una de las escuelas.<br /><br /><br /><br />';
	
	echo '<h1>Datos Generales</h1>';
	echo '<div style="text-align: center;">';
		echo '<span class="known-data"><span>' . $this->status->get_students_counter() . '</span>alumnos</span>';
		echo '<span class="known-data"><span>' . $this->status->get_teachers_counter() . '</span>profesores</span>';
		echo '<span class="known-data"><span>' . $this->status->get_schools_counter() . '</span>escuelas</span>';
		echo '<span class="known-data"><span>' . $this->status->get_groups_counter() . '</span>grupos</span>';
		echo '<span class="clear"></span>';
		echo '<span class="known-data"><span>' . $this->status->get_answers_counter() . '</span>encuestas contestadas</span>';
	echo '</div>';
	
	echo '<span class="clear"></span>';
	
	
