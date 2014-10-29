<?php
	echo '<!DOCTYPE html>';
	echo '<html lang="en">';
		echo '<head>';
			echo '<meta charset="utf-8" />';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
			echo '<title>Sistema de Identificación de Alumnos IdeA-CAS (secundarias)</title>';
			echo '<meta name="description" content="Sistema que ayuda a la Dirección de Educación Especial (DEE) a realizar un sondeo y poder identificar alumnos que tengan capacidades sobresalientes en preescolar, primaria y secundaria." />';
			echo '<meta name="author" content="Jorge Alberto Jaime Coria" />';
			echo '<meta name="viewport" content="width=device-width; initial-scale=1.0" />';
			echo '<link rel="shortcut icon" href="/favicon.ico" />';
			echo '<link rel="apple-touch-icon" href="/apple-touch-icon.png" />';
			
			echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/stylesheet.css" />';
			
		echo '</head>';
		echo '<body>';
			
			echo '<span class="wrapper body-container">';
			
			/**
			echo '<span class="advertices"><span class="navegators">';
				echo '<span class="message">Para una mejor experiencia en este sitio le recomendamos usar : </span>';
				echo '<a href="http://www.mozilla.org/" target="_blank" class="navegator firefox" title="Mozilla Firefox"></a>';
				echo '<a href="http://www.google.com/chrome" target="_blank" class="navegator googlechrome" title="Google Chrome"></a>';
				echo '<a href="http://www.opera.com/" target="_blank" class="navegator opera" title="Opera Web Browser"></a>';
				echo '<a href="http://support.apple.com/kb/DL1531" target="_blank" class="navegator safari" title="Safari"></a>';
			echo '</span></span>'
			*/
		
			echo '<span class="body-messenger"></span>';
			// beg: banner
			echo '<span class="banner">';
				echo '<span class="banner-title">';
					/*
					echo 'Sistema de Identificación de Alumnos IdeA-CAS';
					echo '<span class="system-title">Secundarias</span>';
					*/
				echo '</span>';
			echo '</span>';
			// end: banner
			
			// beg: system-container
			echo '<span class="system-container">';
				echo '<span class="container-loader"></span>';
			echo '</span>';
			echo '<span class="clear"></span>';
			// end: system-container
			
			// beg: footer
			echo '<span class="footer"><span class="credits">dee (sepdf) - 2012<br>web development team</span>Dirección de Educación Especial. Calzada de Tlalpan 515. Colonia Álamos. Delegación Benito Juárez, México, Distrito Federal.<br>C.P. 03400 Teléfonos 3601-8400 extensiones 44216 y 44217. Contacto: <a href="mailto:dee@sep.gob.mx">dee@sep.gob.mx</a></span>';
			// end: footer
		
		echo '</span></body>';
		
		if ( $this->agent->is_browser('Safari') ) echo '<script type="text/javascript">if (top.location != location) top.location = self.location;</script>';
		echo '<script type="text/javascript">var __BASEPATH = "' . base_url() . '", showtimer = 200;</script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/lib/jq.core.js"></script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/lib/jq.slides.js"></script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/lib/jq.qtip.js"></script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/lib/jq.ui.js"></script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/secundaria/jq.functions.js"></script>';
		echo '<script type="text/javascript" src="' . base_url() . 'js/secundaria/jq.code.js"></script>';
		echo '<script type="text/javascript">$(document).ready(function () {contentLoader(\'secundaria\', \'dashboard\');});</script>';
		
		
	echo '</html>';