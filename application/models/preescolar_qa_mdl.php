<?php
	
	
	class Preescolar_qa_mdl extends CI_Model {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 */
		public function __construct () {
			parent::__construct();
		}
		// end: __construct
		
		
		
		
		
		/**
		 * 
		 * qa_delete
		 */
		public function qa_delete ($question_id = 0) {
			$this->db->where('question_id', $question_id);
			$this->db->delete('app_questions');
		}
		// end: qa_delete
		
		
		
		
		
		/**
		 * 
		 * get_question
		 * 
		 * method to get the information about a question identified by ID
		 * 
		 * @param integer $question_id
		 */
		public function get_question ($question_id = 0) {
			return $this->db->get_where('app_questions', array('question_id' => $question_id), 1)->row();
		}
		// end: get_question
		
		
		
		
		
		/**
		 * 
		 * update_question
		 * 
		 * method to update a question
		 */
		public function update_question ($question_id = 0, $update = array()) {
			$this->db->where('question_id', $question_id);
			$this->db->update('app_questions', $update);
		}
		// end: update_question
	}
