<?php
	
	echo '<span class="dashboard-user-options">';
	
		echo '<span class="options-list"><span class="list-items">';
			echo '<a href="javascript: void(0);" class="item-list" id="user-edit-info">editar mi información</a>';
			echo '<a href="javascript: void(0);" class="item-list" id="user-edit-passwd">cambiar contraseña</a>';
			echo '<a href="' . base_url() . '?c=preescolar&m=logout" class="item-list">cerrar sesión</a>';
		echo '</span></span>';
		
		echo '<a href="javascript: void(0);" class="option-item">';
			echo '<span class="menu-arrow"></span>';
			echo '<span class="menu-usernames">' . $usernames . ' (<i>' . $this->session->userdata('cas-preescolar-username') . '</i>)</span>';
		echo '</a>';
		echo '<span class="clear"></span>';
	echo '</span>';
	
	echo '<span class="dashboard-messenger"></span>';
	
	echo '<span class="dashboard-container container">';

		echo '<span class="row">';
			
			// beg: welcome message
			echo '<span class="ninecol">';
				
				echo '<h1>Bienvenido al sistema IdeA-CAS</h1>';
				echo 'Bienvenido al Sistema de la Dirección de Educación Especial para la Nominación de Alumnos. Este sitio tiene como propósito conocer los intereses de las niñas y los niños de manera mas precisa.<br /><br />';
				echo 'Para ingresar al sistema dar clic en el botón comenzar.';
				echo '<span class="centered">';
					echo '<a href="javascript: void(0);" class="action-button start-system">&rsaquo; &rsaquo; &rsaquo; &rsaquo; Iniciar el sistema &rsaquo; &rsaquo; &rsaquo; &rsaquo;</a>';
				echo '</span>';
				
				echo '<span class="content-breaker"></span>';
				
				echo '<h1>Dudas Técnicas</h1>';
				
				echo 'Para cualquier duda, comentario o aclaración sirvase llamar al siguiente teléfono:<br />';
				echo '36-84-10-00, Ext. 44219<br /><br />';
				
				echo 'También puede escribir a nuestro correo electrónico:<br />';
				echo '<a href="mailto:dudastecnicas.cas@sepdf.gob.mx">dudastecnicas.cas@sepdf.gob.mx</a>';
				
			echo '</span>';
			// end: welcome message
			
			// beg: general data
			echo '<span class="threecol last">';
				
				echo '<span class="general-data-block"><span class="bgb-counter">' . $enrolled_students . '</span>alumnos</span>';
				echo '<span class="general-data-block"><span class="bgb-counter">' . $enrolled_teachers . '</span>profesores</span>';
				echo '<span class="general-data-block"><span class="bgb-counter">' . $enrolled_schools . '</span>escuelas</span>';
				echo '<span class="general-data-block"><span class="bgb-counter">' . $enrolled_groups . '</span>grupos</span>';
				
			echo '</span>';
			// end: general data
			echo '<span class="clear"></a>';
		echo '</span>';
		
	echo '</span>';
	echo '<span class="clear"></a>';
