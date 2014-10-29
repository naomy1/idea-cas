<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_statistics_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * get_students_counter
		 * function to get the count of the students
		 */
		public function get_students_counter () {
			$filter = array(
				'student_school_level' => 1,
				'student_is_deleted' => 'false',
				'student_is_down' => 'false'
			);
			return $this->db->get_where('schools_groups_students ', $filter)->num_rows();
		}
		// end: get_students_counter
		
		
		
		
		
		/**
		 * 
		 * get_teachers_counter
		 * function to get the count of the students
		 */
		public function get_teachers_counter () {
			return $this->db->get_where('users ', array('user_type' => 'teacher', 'user_school_level' => 1))->num_rows();
		}
		// end: get_teachers_counter
		
		
		
		
		
		/**
		 * 
		 * get_teachers_counter
		 * function to get the count of the students
		 */
		public function get_schools_counter () {
			return $this->db->get_where('schools ', array('school_level' => 1))->num_rows();
		}
		// end: get_teachers_counter
		
		
		
		
		
		/**
		 * 
		 * get_teachers_counter
		 * function to get the count of the students
		 */
		public function get_groups_counter () {
			return $this->db->get_where('schools_groups ', array('group_school_level' => 1))->num_rows();
		}
		// end: get_teachers_counter
		
		
		
		
		
		/**
		 * 
		 * get_teachers_counter
		 * function to get the count of the students
		 */
		public function get_answers_counter () {
			$this->db->where('answer_school_level', 1);
			return $this->db->get('app_answers ')->num_rows();
		}
		// end: get_teachers_counter
		
	}
