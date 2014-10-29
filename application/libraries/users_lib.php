<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Users_lib {
		
		var $ci = null;
		
		public function __construct () {
			$this->ci = &get_instance();
		}
		
		
		
		
		
		/**
		 * 
		 * setPasswd
		 * 
		 * function to set new password to an user
		 * 
		 * @param integer $userID
		 * @param string md5($password)
		 */
		public function setPasswd ($userID = 0, $password) {
			$this->ci->db->where('user_id', $userID);
			if ( $this->ci->db->update('users', array('user_password' => $password)) )
				return true;
			else
				return false;
		}
		
		
	}
