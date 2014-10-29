<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_schools_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * getUserSchools
		 * 
		 * function to get user schools identified by the userID
		 */
		public function getUserSchools ( $userID = 0 ) {
			
			$userSchools = array();
			
			
			$relationship = $this->getUserSchoolsRelationship($userID);
			$i = 1;
			foreach ( $relationship as $school ) {
				if ( $schoolinfo = $this->getSchoolInfo($school->cas_schools_school_id) ){
					$userSchools[$i] = $schoolinfo;
					$i++;
				}
			}
			
			return $userSchools;
			
		}
		
		
		
		
		
		/**
		 * 
		 * getUserSchoolsRelationship
		 * 
		 * function to get the relationship into the schools and users based on the userID
		 * 
		 * @param Integer $userID
		 * @return object
		 */
		public function getUserSchoolsRelationship ( $userID = 0 ) {
			return $this->db->get_where('users_schools', array('cas_users_user_id' => $userID))->result();
		}
		
		
		
		
		
		/**
		 * 
		 * getSchoolInfo
		 * 
		 * function to get the school info by ID
		 * 
		 * @param Integer $schoolID
		 * @return object
		 */
		public function getSchoolInfo ( $schoolID = 0, $select = '*' ) {
			$this->db->select($select);
			return $this->db->get_where('schools', array('school_id' => $schoolID, 'school_level' => 1), 1)->row();
		}
		
		
		
		
		
		/**
		 * 
		 * getSchoolInfo_by_cct
		 * 
		 * function to get the school info by cct
		 * 
		 * @param Integer $cct
		 * @return object
		 */
		public function getSchoolInfo_by_cct ( $cct = '', $select = '*' ) {
			$this->db->select($select);
			return $this->db->get_where('schools', array('school_cct' => $cct, 'school_level' => 1), 1)->row();
		}
		
		
		
		
		
		/**
		 * 
		 * getDelegations
		 * 
		 * function to get the list of delegations
		 * 
		 * @return object
		 */
		public function getDelegations () {
			$this->db->order_by('del_name');
			return $this->db->get('schools_delegations')->result();
		}
		
		
		
		
		
		/**
		 * 
		 * cct_exists
		 * 
		 * function to check if the cct exists
		 * 
		 * @param string $cct
		 * @return boolean
		 */
		public function cct_exists ($cct = '') {
			if ( $cct_exists = $this->db->get_where('schools', array('school_cct' => $cct)) ) {
				
				if ( $cct_exists->num_rows() == 0 )
					return false;
				else
					return true;
			}
			else
				return true;
		}
		
		
		
		
		
		/**
		 * 
		 * addSchool
		 * 
		 * function to add a school to the database
		 * 
		 * @param array $school
		 * 
		 * @return boolean
		 */
		public function addSchool ($school = array()) {
			
			if ( $this->db->insert('schools', $school) ){
				return $this->db->insert_id();
			}
			else
				return false;
			
		}
		
		
		
		
		
		/**
		 * 
		 * makeRelationship
		 * 
		 * function to make the relationshin bwtween users and schools
		 * 
		 * @param array $relationship
		 */
		public function makeRelationship ($relationship = array()) {
			if ( $chk_relationship = $this->db->get_where('users_schools', $relationship) ) {
				if ( $chk_relationship->num_rows() == 0 )
					if ( $this->db->insert('users_schools', $relationship) )
						return true;
					else
						return false;
				else
					return false;
			}
			else
				return false;
		}
		
		
		
		
		
		/**
		 * 
		 * makeGroups
		 * 
		 * function to make groups in the school
		 * 
		 * @param array $group
		 */
		public function makeGroups ($group = array()) {
			for ($i = 0 ; $i < $group['groups'] ; $i++) {
				
				$group_name = '';
				switch ( $i ) {
					case 0  : $group_name = 'A';	break;
					case 1  : $group_name = 'B';	break;
					case 2  : $group_name = 'C';	break;
					case 3  : $group_name = 'D';	break;
					case 4  : $group_name = 'E';	break;
					case 5  : $group_name = 'F';	break;
					case 6  : $group_name = 'G';	break;
					case 7  : $group_name = 'H';	break;
					case 8  : $group_name = 'I';	break;
					case 9  : $group_name = 'J';	break;
					case 10 : $group_name = 'K';	break;
					case 11 : $group_name = 'L';	break;
					case 12 : $group_name = 'M';	break;
					case 13 : $group_name = 'N';	break;
					case 14 : $group_name = 'O';	break;
					case 15 : $group_name = 'P';	break;
					case 16 : $group_name = 'Q';	break;
					case 17 : $group_name = 'R';	break;
					case 18 : $group_name = 'S';	break;
					case 19 : $group_name = 'T';	break;
					case 20 : $group_name = 'U';	break;
					case 21 : $group_name = 'V';	break;
					case 22 : $group_name = 'W';	break;
					case 23 : $group_name = 'X';	break;
					case 24 : $group_name = 'Y';	break;
					case 25 : $group_name = 'Z';	break;
				}
				
				$groups_info = array(
					'group_id' => 'NULL',
					'group_name' => $group_name,
					'group_grade' => $group['grade'],
					'group_user_id' => $this->session->userdata('cas-preescolar-userid'),
					'group_school_id' => $group['school_id'],
					'group_school_cct' => $group['school_cct'],
					'group_school_level' => 1
				);
				
				$this->db->insert('schools_groups', $groups_info);
			}
		}
		// end : makeGroups
		
		
		
		
		/**
		 * 
		 * school_groups_counter
		 * 
		 * function to get the number of groups in a school
		 * 
		 * @param integer $schoolID
		 */
		public function school_groups_counter ($schoolID = 0) {
			return $this->db->get_where('schools_groups', array('group_school_id' => $schoolID))->num_rows();
		}
		// end: school_groups_counter
		
		
		
		
		
		/**
		 * 
		 * school_groups_students_counter
		 * 
		 * function to get the number of groups in a school
		 * 
		 * @param integer $schoolID
		 */
		public function school_groups_students_counter ($schoolID = 0) {
			return $this->db->get_where('schools_groups_students', array('student_school_id' => $schoolID))->num_rows();
		}
		// end: school_groups_students_counter
		
		
		
		
		
		/**
		 * 
		 * deleteSchool
		 * 
		 * function to delete school and all the groups and students registered in the 
		 * system
		 * 
		 * @param integer $schoolID
		 */
		public function deleteSchool($schoolID = 0) {
			$schoolInfo = $this->getSchoolInfo($schoolID);
			
			if ( $schoolInfo->school_user_id == $this->session->userdata('cas-preescolar-userid') ) {
				$this->db->delete('schools', array('school_id' => $schoolID));
				$this->db->delete('schools_groups', array('group_school_id' => $schoolID));
				$this->db->delete('schools_groups_students', array('student_school_id' => $schoolID));
				$this->db->delete('app_answers', array('answer_school_id' => $schoolID));
			}
			$this->db->delete('users_schools', array('cas_schools_school_id' => $schoolID));
			
		}
		// end : deleteSchool
		
		
		
		
		
		/**
		 * 
		 * rootDeleteSchool
		 * 
		 * function to delete school and all the groups and students registered in the 
		 * system
		 * 
		 * @param integer $schoolID
		 */
		public function rootDeleteSchool ($schoolID = 0) {
			$this->db->delete('schools', array('school_id' => $schoolID));
			$this->db->delete('schools_groups', array('group_school_id' => $schoolID));
			$this->db->delete('schools_groups_students', array('student_school_id' => $schoolID));
			$this->db->delete('app_answers', array('answer_school_id' => $schoolID));
			$this->db->delete('users_schools', array('cas_schools_school_id' => $schoolID));
			
		}
		// end : rootDeleteSchool
		
		
		
		
		
		/**
		 * 
		 * updateSchoolInfo
		 * 
		 * function to undate the school information in the data base
		 * 
		 * @param integer $schoolID
		 * @param array $schoolInfo
		 */
		public function updateSchoolInfo ($schoolID = 0, $schoolInfo = array()) {
			$this->db->where('school_id', $schoolID);
			if ( $this->db->update('schools', $schoolInfo) ){
				
				// beg: update groups cct
				$update_groups = array('group_school_cct' => $schoolInfo['school_cct']);
				$this->db->where('group_school_id', $schoolID);
				$this->db->update('schools_groups', $update_groups);
				// end: update groups cct
				
				// beg: update groups students cct
				$update_groups_students = array('student_school_cct' => $schoolInfo['school_cct']);
				$this->db->where('student_school_id', $schoolID);
				$this->db->update('schools_groups_students', $update_groups_students);
				// end: update groups students cct
				
				// beg: update answers app cct
				$update_app_answers = array('answer_school_cct' => $schoolInfo['school_cct']);
				$this->db->where('answer_school_id', $schoolID);
				$this->db->update('app_answers', $update_app_answers);
				// end: update answers app cct
				
				// beg: update relationship cct
				$update_user_school_relationship = array('cas_schools_school_cct' => $schoolInfo['school_cct']);
				$this->db->where('cas_schools_school_id', $schoolID);
				$this->db->update('users_schools', $update_user_school_relationship);
				// end: update relationship cct
				
				return true;
			}
			else
				return false;
		}
		// end: updateSchoolInfo
		
		
		
		
		
		/**
		 * 
		 * getAllSchools
		 */
		public function getAllSchools ($select = '*') {
			$this->db->select($select);
			$this->db->order_by('school_cct', 'asc');
			$this->db->where('school_level', 1);
			return $this->db->get('schools')->result();
		}
		// end: getAllSchools
		
		
		
		
		
		/**
		 * 
		 * upgrade_all_schools
		 */
		public function upgrade_all_schools ($from = 0, $to = 0) {
			$this->db->select('group_id, group_grade, group_name, group_school_id');
			$groups_from	= $this->db->get_where('schools_groups', array('group_grade' => $from))->result();
			$groups_to		= $this->db->get_where('schools_groups', array('group_grade' => $to))->result();
			
			foreach ( $groups_from as $group_from ) {
				
				foreach ( $groups_to as $group_to ) {
					
					if ( strtolower($group_from->group_name) == strtolower($group_to->group_name) && $group_from->group_school_id == $group_to->group_school_id ) {
						// echo 'sí se cambia al alumno del groupid = ' . $group_from->group_id . ', groupname = ' . $group_from->group_name . ', groupgrade = ' . $group_from->group_grade . ' al groupid = ' . $group_to->group_id . ', groupname = ' . $group_to->group_name . ', groupgrade = ' . $group_to->group_grade . '<br />';
						$where = array(
							'student_grade'			=> $group_from->group_grade,
							'student_group_id'		=> $group_from->group_id
						);
						$update_student = array(
							'student_grade'			=> $group_to->group_grade,
							'student_group_id'		=> $group_to->group_id
						);
						$this->db->where($where);
						$this->db->update('schools_groups_students', $update_student);
						break;
					}
					
				}
				
			}
			
			return TRUE;
		}
		// end: upgrade_all_schools		
		
		
		
		
		/**
		 * 
		 * upgrade_group_students
		 */
		// end: 
	}