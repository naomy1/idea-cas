<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_sessions_mdl extends CI_Model {
		
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * user_validate
		 * 
		 * method to validate if an user is in the database
		 * 
		 * @param string $username
		 * @param string $password
		 * @return integer
		 */
		public function user_validate ($username = '', $password = '', $schoolLevel = 0) {
			
			if ( $get_userinfo = $this->db->get_where('users', array('user_name' => $username, 'user_passwd' => md5($password), 'user_school_level' => $schoolLevel), 1) )
				if ( $get_userinfo->num_rows() == 1  )
					return 200;		// http status code 200 : OK or Success
				else
					return 404;		// http status code 404 : Not found
			else
				return 406;			// http status code 406 : Not Acceptable
		}
		
		
		
		
		
		/**
		 * 
		 * make_session
		 * 
		 * function to make a session with the user information
		 * 
		 * @param string username
		 * @return integer
		 */
		public function make_session ($username = '') {
			$this->db->select('user_id, user_name, user_type');
			if ( $get_userinfo = $this->db->get_where('users', array('user_name' => $username), 1) ) 
				if ( $get_userinfo->num_rows() == 1 ) {
					
					// beg: making the session vars
					$session_data = array(
						'cas-secundaria-userid'				=> $get_userinfo->row()->user_id,
						'cas-secundaria-username'			=> $get_userinfo->row()->user_name,
						'cas-secundaria-userdashboard'		=> $get_userinfo->row()->user_type,
						'cas-secundaria-logintime'			=> time(),
						'cas-secundaria-logged-from-ip'		=> $this->input->ip_address(),
						'cas-secundaria-system-lock'		=> false,
						'cas-secundaria-user-agent'			=> $this->input->user_agent(),
						'cas-secundaria-app-started'		=> false,
						'cas-secundaria-app-school-id'		=> 0,
						'cas-secundaria-app-school-cct'		=> '',
						'cas-secundaria-app-group-id'		=> 0,
						'cas-secundaria-app-student-id'		=> 0,
					);
					$this->session->set_userdata($session_data);
					// end: making the session vars
					
					// beg: updating login info
					$update = array(
						'user_date_last_login' => date('Y-m-d H:i:s'),
						'user_from_last_login' => $this->input->ip_address()
					);
					$this->db->where('user_id', $get_userinfo->row()->user_id);
					$this->db->update('users', $update);
					// end: updating login info
					
					return 200;		// http status code 200 : OK or Success
				}
				else
					return 404;		// http status code 404 : Not found 
		}
		
	}
