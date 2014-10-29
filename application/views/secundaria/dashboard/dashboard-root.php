<?php
	
	echo '<span class="dashboard-user-options">';
	
		echo '<span class="options-list"><span class="list-items">';
			echo '<a href="javascript: void(0);" class="item-list" id="user-edit-info">editar mi información</a>';
			echo '<a href="javascript: void(0);" class="item-list" id="user-edit-passwd">cambiar contraseña</a>';
			echo '<a href="' . base_url() . '?c=secundaria&m=logout" class="item-list">cerrar sesión</a>';
		echo '</span></span>';
		
		echo '<a href="javascript: void(0);" class="option-item">';
			echo '<span class="menu-arrow"></span>';
			echo '<span class="menu-usernames">' . $usernames . ' (<i>' . $this->session->userdata('cas-secundaria-username') . '</i>)</span>';
		echo '</a>';
		echo '<span class="clear"></span>';
	echo '</span>';
	
	echo '<span class="dashboard-messenger"></span>';
	
	echo '<span class="dashboard-container container">';

		echo '<span class="row">';
			
			
			echo '<span class="threecol user-menu">';
			
				echo '<h3>NAVEGACIÓN</h3>';
				
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-start selected">estadísticas</a>';
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-schools">escuelas</a>';
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-students">alumnos</a>';
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-questions">encuestas</a>';
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-users">usuarios</a>';
				echo '<a href="javascript: void(0);" class="menu-item dashboard-root-apps">Aplicaciones</a>';
				
			
			echo '</span>';
			
			echo '<span class="ninecol dashboard-user-admin last">';
				echo '<span class="dashboard-user-admin-spinner"></span>';
			echo '</span>';
			
			echo '<span class="clear"></a>';
		echo '</span>';
		
	echo '</span>';
	echo '<span class="clear"></a>';
	
	echo '<script type="text/javascript">contentLoader(\'secundaria_profile_root\', \'index\', \'.dashboard-user-admin\');</script>';
