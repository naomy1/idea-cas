<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_sessions_mdl extends CI_Model {
		
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
						'cas-preescolar-userid'				=> $get_userinfo->row()->user_id,
						'cas-preescolar-username'			=> $get_userinfo->row()->user_name,
						'cas-preescolar-userdashboard'		=> $get_userinfo->row()->user_type,
						'cas-preescolar-logintime'			=> time(),
						'cas-preescolar-logged-from-ip'		=> $this->input->ip_address(),
						'cas-preescolar-system-lock'		=> false,
						'cas-preescolar-user-agent'			=> $this->input->user_agent(),
						'cas-preescolar-app-started'		=> false,
						'cas-preescolar-app-school-id'		=> 0,
						'cas-preescolar-app-school-cct'		=> '',
						'cas-preescolar-app-group-id'		=> 0,
						'cas-preescolar-app-student-id'		=> 0,
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
