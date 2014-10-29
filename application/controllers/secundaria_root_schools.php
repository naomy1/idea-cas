<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_root_schools extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 */
		public function __construct () {
			parent::__construct();
			$this->load->model('secundaria_schools_mdl',		'schools');
		}
		// end: __construct
		
		
		
		
		
		/**
		 * 
		 * school_delete
		 * 
		 * method to delete school
		 */
		public function school_delete () {
			if ( $this->input->is_ajax_request() ) {
				
				$schoolid = $this->input->post('school_id');
				
				$school_delete_data = array(
					'msg_type'			=> 'empty',
					'msg_content'		=> 'no hay mensaje para mostrar',
					'school_id'			=> $schoolid
				);
				
				if ( is_numeric($schoolid) && substr_count($schoolid, '.') == 0 ) {
					$this->schools->rootDeleteSchool($schoolid);
					$school_delete_data['msg_type']			= 'success';
					$school_delete_data['msg_content']		= 'la escuela ha sido borrada del sistema';
				}
				else {
					$school_delete_data['msg_type']			= 'error';
					$school_delete_data['msg_content']		= 'el ID de la escuela no es válido';
				}
				
				
				$this->load->view('secundaria/dashboard/root/root-schools-delete', $school_delete_data);
				
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: school_delete
		
		
		
		
		
		/**
		 * 
		 * edit_school
		 */
		
		// end: edit_school
	}
