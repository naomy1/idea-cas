<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	
	
	class Secundaria_qa extends CI_Controller {
		
		
		
		
		
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
		 * question_delete
		 */
		public function question_delete () {
			
			if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					$this->load->model('secundaria_qa_mdl');
					$this->secundaria_qa_mdl->qa_delete($this->input->post('question_id'));
					
					$question_delete_data = array(
						'question_id' => $this->input->post('question_id')
					);
					
					$this->load->view('secundaria/dashboard/root/root-questions-messenger', $question_delete_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: question_delete
	}
