<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Qa extends CI_Model {
		
		
		
		
		/**
		 * @var 
		 */
		private			$tbl_questions			= 'app_questions',
						$tbl_answers			= 'app_answers';
		// end: var
		
		
		
		
		
		/**
		 * 
		 * __construct
		 * 
		 * The constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		// end: __construct
		
		
		
		
		
		/**
		 * 
		 * get_questions
		 * 
		 * method to get questions identified by school level
		 * 
		 * @param integer school_level
		 * @return Array(Object)
		 */
		public function get_questions($school_level = 3) {
			
			switch ($school_level) {
				case 1: 
					$this->load->model('preescolar_apps_mdl', 'apps');
					break;
				case 2: 
					$this->load->model('primaria_apps_mdl', 'apps');
					break;
				case 3: 
					$this->load->model('secundaria_apps_mdl', 'apps');
					break;
				
			}
			
			$active_app = $this->apps->get_active_app();
			
			if ( !empty($active_app) ) {
				
				$where = array(
					'question_school_level'		=> $school_level,
					'question_app_id'			=> $active_app->app_id
				);
				return $this->db->get_where($this->tbl_questions, $where)->result();
			}
			else
				return array();
		}
		// end: get_questions
		
		
		
		
		
		/**
		 * 
		 * add_question
		 */
		public function add_question ($question = array()) {
			if ( !empty($question) ) {
				
				if  ( $this->db->insert($this->tbl_questions, $question) )
					return true;
				else
					return false;
				
			}
			else
				return false;
		}
		// end: add_question
		
		
		
		
		
		/**
		 * 
		 * get_question_types
		 */
		public function get_question_types ($school_level = 3) {
			$this->db->order_by('type_name', 'asc');
			return $this->db->get_where('app_questions_type', array('type_school_level' => $school_level))->result();
		}
		// end: get_question_types
	}