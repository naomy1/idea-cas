<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_users_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * get_userData_by_email
		 * 
		 * function to get the data of one user by his email
		 * 
		 * @param string $email
		 * @param string $select
		 * @return object
		 */
		
		public function get_userData_by_email ($email = '', $select = '*') {
			$select = ((strlen(trim($select)) == 0)?'*':$select);
			$this->db->select($select);
			if ( $result = $this->db->get_where('users', array('user_email' => $email), 1) )
				if ( $result->num_rows() == 1 )
					return $result->row();
				else
					return NULL;
			else
				return NULL;
		}
		// end: get_userData_by_email
		
		
		
		
		
		/**
		 * 
		 * get_userData_by_ID
		 * 
		 * function to get the data of one user by his email
		 * 
		 * @param string $userID
		 * @param string $select
		 * @return object
		 */
		public function get_userData_by_ID ($userID = '', $select = '*') {
			$select = ((strlen(trim($select)) == 0)?'*':$select);
			$this->db->select($select);
			if ( $result = $this->db->get_where('users', array('user_id' => $userID), 1) )
				if ( $result->num_rows() == 1 )
					return $result->row();
				else
					return NULL;
			else
				return NULL;
		}
		// end: get_userData_by_email
		
		
		
		
		
		/**
		 * 
		 * username_exists
		 * 
		 * function to check if the username exists in the system
		 * 
		 * @param string $username
		 * @return boolean
		 */
		public function username_exists ($username = '') {
			if ( strlen(trim($username)) > 0 )
				if ( $userexists = $this->db->get_where('users', array('user_name' => $username)) )
					if ( $userexists->num_rows() == 0 )
						return false;
					else
						return true;
				else
					return true;
			else
				return true;
		}
		// end: username_exists
		
		
		
		
		
		/**
		 * 
		 * email_exists
		 * 
		 * function to check if the email exists in the system
		 * 
		 * @param string $email
		 * @return boolean
		 */
		public function email_exists ($email = '', $level = 3) {
			if ( strlen(trim($email)) > 0 )
				if ( $emailexists = $this->db->get_where('users', array('user_email' => $email, 'user_school_level' => $level)) )
					if ( $emailexists->num_rows() == 0 )
						return false;
					else
						return true;
				else
					return true;
			else
				return true;
		}
		// end: email_exists
		
		
		
		
		
		/**
		 * 
		 * curp_exists
		 * 
		 * function to check if CURP exists in the system
		 * 
		 * @param string $curp
		 * @param Integer $level
		 * @return boolean
		 */
		public function curp_exists ($curp = '', $level = 3) {
			if ( strlen(trim($curp)) == 18 )
				if ( $curpexists = $this->db->get_where('users', array('user_curp' => strtoupper($curp), 'user_school_level' => $level)) )
					if ( $curpexists->num_rows() == 0 )
						return false;
					else
						return true;
				else
					return true;
			else
				return true;
		}
		// end: curp_exists
		
		
		
		
		
		/**
		 * 
		 * create_user
		 * 
		 * function to register a user in the system
		 * 
		 * @param array $userdata
		 * @return boolean
		 */
		public function create_user ($userdata = array()) {
			
			if ( !empty($userdata) ){
				
				$insert = array(
					'user_id'						=> 'NULL',
					'user_name'						=> $userdata['user_username'],
					'user_passwd'					=> md5($userdata['user_password']),
					'user_passwd_key'				=> base64_encode($userdata['user_password']),
					'user_fname'					=> $userdata['user_firstname'],
					'user_lname'					=> $userdata['user_lastname'],
					'user_email'					=> $userdata['user_useremail'],
					'user_curp'						=> strtoupper($userdata['user_usercurp']),
					'user_usaer'					=> $userdata['user_userusaer'],
					'user_usaer_supervision_zone'	=> $userdata['user_userusaerzone'],
					'user_crosee'					=> $userdata['user_usercrosee'],
					'user_type'						=> 'teacher',
					'user_school_level'				=> 3,
					'user_date_created'				=> date('Y-m-d H:i:s'),
					'user_date_last_login'			=> date('Y-m-d H:i:s'),
					'user_date_updated'				=> date('Y-m-d H:i:s'),
					'user_from_last_login'			=> $this->input->ip_address(),
					'user_from_registered'			=> $this->input->ip_address()
				);
				if ( $this->db->insert('users',$insert) ) {
					
					$this->load->model('secundaria_sessions_mdl');
					
					$this->secundaria_sessions_mdl->make_session($insert['user_name']);
					
					return true;
				}
				else
					return false;
				
			}
			else
				return false;
		}
		// end: create_user
		
		
		
		
		
		/**
		 * 
		 * updateUserData
		 * 
		 * function to update the user data in the database
		 * 
		 * @param array $userinfo
		 */
		public function updateUserData ($userID = 0, $userinfo = array()) {
			
			if ( !empty($userinfo) ) {
				
				/**
				 * 
				 * El sistema busca el Id de usuario
				 */
				$userinfo['user_date_updated'] = date('Y-m-d H:i:s');
				$this->db->where('user_id', $userID);
				if ( $this->db->update('users', $userinfo) ) {
					
					// beg: updating school crosee
					if ( isset($userinfo['user_crosee']) ) {
						$user_schools = array('school_crosee' => $userinfo['user_crosee']);
						$this->db->where('school_user_id', $userID);
						$this->db->update('schools', $user_schools);
					}
					// end: updating school crosee
					
					return 200; // status 200 : OK
				}
				else
					return 409; // status 409 : conflict
				
			}
			else
				return 409; // status 409 : conflict
		}
		// end: updateuserData
		
		
		
		
		
		/**
		 * 
		 * getAllUsers
		 * 
		 * function to get all users from the  database
		 */
		public function getallUsers ($select = '*', $type = 'teacher') {
			$this->db->select($select);
			return $this->db->get_where('users', array('user_school_level' => 3, 'user_type' => $type))->result();
		}
		// end: getAllUsers
		
		
		
		
		
		/**
		 * 
		 * get_users
		 */
		public function get_users ($select = '*') {
			$this->db->select($select);
			$this->db->order_by('user_lname', 'asc');
			return $this->db->get_where('users', array('user_school_level' => 3))->result();
		}
		// end: get_users
		
		
		
		
		
		/**
		 * delete_user
		 */
		public function delete_user ($userid = 0) {
			$this->db->delete('users', array('user_id' => $userid));
		}
		// end: delete_user
	}
