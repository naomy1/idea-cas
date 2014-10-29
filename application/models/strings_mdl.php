<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	
	class Strings_mdl extends CI_Model {
		
		
		public function __contruct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * is_email
		 * 
		 * function to vaildate if the email is a valid string
		 * 
		 * @param string $email
		 */
		public function is_email ($email) {
			return preg_match('/[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+/i', $email);
		}
		
		
		
		
		
		/**
		 * 
		 * makePassword
		 * 
		 * function to make password in random
		 * 
		 * @param integer $lenght
		 */
		public function makePassword ($lenght = 10) {
			$string = '';
			$characers = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			for ( $i = 0 ; $i < $lenght ; $i++ ) $string .= $characers[rand(0, (strlen($characers) - 1))];
			return $string;
		}
		
		
		
		
		/**
		 * 
		 * is_curp
		 * 
		 * function to validate if the string is a curp
		 */
		public function is_curp ($curp = '') {
			if ( strlen(trim($curp)) == 18 ) {
				return preg_match('/^([A-Z]{4})([0-9]{6})([A-Z]{6})([0-9A-Z]{2})$/i', $curp);
			}
			else
				return false;

		}
		
		
		
		
		
		/**
		 * 
		 * is_username
		 * 
		 * function to validate if the string have not a special
		 * character or spaces
		 * 
		 * @param string $username
		 */
		public function is_username($username) {
			return preg_match('/^[a-zA-Z0-9\-_]{3,100}$/i', $username);
		}
		
		
		
		
		
		/**
		 * 
		 * get_child_age
		 * 
		 * función que obtiene la edad de un niño a partir de su CURP
		 * 
		 * @param string $curp
		 * @return int
		 */
		function get_child_age ($curp) {
			$get_age = substr($curp, 4, 2);
			if ( (int)$get_age > 13 )
				$get_age = 19 . $get_age;
			else
				$get_age = 20 . $get_age;
			
			$real_age = (int)date('Y') - (int)$get_age;
			
			return $real_age;
		}
		
		
		
		
		
		/**
		 * 
		 * date
		 * 
		 * method to translate the date in to spanish
		 * 
		 * @param Integer $timestam
		 * @param String $format
		 */
		public function date ($timestamp = 0000000000, $format = 'r') {
			
			// beg: english dates
			$date_en = array(
				'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
				'Mon', 'Tues', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun',
				'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
				'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
			);
			// end: english dates
			
			// beg: spanish dates
			$date_es = array(
				'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo',
				'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom',
				'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
				'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
			);
			// end: spanish dates
			
			return str_replace($date_en, $date_es, date($format, $timestamp));
		}
		// end: date
		
	}
