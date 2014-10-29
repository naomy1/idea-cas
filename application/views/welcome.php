<?php
	
	$this->load->view('tpl/tpl-page-top');
				
				echo '<span class="school-levels">';
				
					echo '<a href="' . base_url() . '?c=preescolar" class="level preescolar" id="preescolar">';
						echo '<span class="level-label">Preescolar</span>';
					echo '</a>';
					
					echo '<a href="' . base_url() . '?c=primaria" class="level primaria" id="primaria">';
						echo '<span class="level-label">Primaria</span>';
					echo '</a>';
					
					echo '<a href="' . base_url() . '?c=secundaria" class="level secundaria" id="secundaria">';
						echo '<span class="level-label">Secundaria</span>';
					echo '</a>';
					
				echo '</span>';
				
	$this->load->view('tpl/tpl-page-bottom');