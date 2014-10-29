<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_apps_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * variables
		 */
		private $db_table						= 'app_questions';
		// end: variables
		
		/**
		 * @var $tbl_apps
		 */
		private $tbl_apps						= 'app';
		// end: $tbl_apps
		
		
		
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		// end: __construct
		
		
		
		
		
		/**
		 * getStudentsAppQuestions
		 * 
		 * function to get the question to secundaria
		 */
		public function getStudentsAppQuestions () {
			$this->db->order_by('question_type_id','asc');
			return $this->db->get_where($this->db_table, array('question_school_level' => 3))->result();
		}
		// end: getStudentsAppQuestions
		
		
		
		
		
		/**
		 * 
		 * saveanswers
		 * 
		 * save the answers to the database
		 */
		 public function saveanswers ($answers = array()) {
		 	$answers['answer_school_level'] = 3;
		 	if ( $this->db->insert('app_answers', $answers) ){
		 		$this->db->where('student_id', $answers['answer_student_id']);
		 		$this->db->update('schools_groups_students', array('student_end_app' => 'true'));
		 		return true;
			}
			else
				return false;
		 }
		 
		 
		 
		 
		 
		 
		 /**
		  * 
		  * get_apps
		  */
		 public function get_apps () {
		 	$this->db->order_by('app_date_activated', 'desc');
			$this->db->where('app_school_level', 3);
		 	return $this->db->get($this->tbl_apps)->result();
		 }
		 // end: get_apps
		 
		 
		 
		 
		 
		 /**
		  * 
		  * get_app
		  */
		 public function get_app ($appid = 0) {
		 	return $this->db->get_where($this->tbl_apps, array('app_id' => $appid), 1)->row();
		 }
		 // end: get_app
		 
		 
		 
		 
		 
		 /**
		  * add_app
		  */
		 public function add_app ($add_app = array()) {
			if ( !empty($add_app) ) {
				$this->db->insert($this->tbl_apps, $add_app);
				return TRUE;
			}
			else
				return FALSE;
		 }
		 // end: add_app
		 
		 
		 
		 
		 
		 /**
		  * update_app
		  */
		 public function update_app ($appid = 0, $update = array()) {
		 	if ( !empty($update) ) {
		 		$this->db->where('app_id', $appid);
		 		if ( $this->db->update($this->tbl_apps, $update) )
					return TRUE;
				else
					return FALSE;
		 	}
			else
				return FALSE;
		 }
		 // end: update_app
		 
		 
		 
		 
		 
		 /**
		  * 
		  * get_active_app
		  */
		 public function get_active_app () {
		 	$where = array(
		 		'app_is_active' => TRUE,
		 		'app_school_level' => 3,
		 		'app_date_activated <=' => time()
			);
			return $this->db->get_where($this->tbl_apps, $where, 1)->row();
		 }
		 // end: get_active_app
		 
		 
		 
		 
		 
		 /**
		  * 
		  * delete_app
		  */
		 public function delete_app ($appid = 0) {
		 	
			// deleting app
		 	$this->db->where('app_id', $appid);
			$this->db->delete('app');
			
			// deleting app questions
			$this->db->where('question_app_id', $appid);
			$this->db->delete('app_questions');
			
			// deleting app answers
			$this->db->where('answer_app_id', $appid);
			$this->db->delete('app_answers');
		 }
		 // end: delete_app
		 
		 
		 
		 
		 
		 /**
		  * 
		  * get_app_questions
		  */
		 public function get_app_questions ($appid = 0) {
		 	$this->db->where('question_app_id', $appid);
			return $this->db->get('app_questions')->result();
		 }
		 // end: get_app_questions
	}
