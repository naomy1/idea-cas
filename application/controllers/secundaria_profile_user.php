<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secundaria_profile_user extends CI_Controller {






	/**
	 *
	 * the constructor
	 */
	public function __construct () {
		parent::__construct();
		$this->load->model('secundaria_statistics_mdl', 'status');
	}
	
	
	
	
	
	/**
	 *
	 * index
	 * the index of the controller
	 */
	public function index () {
		if ( $this->input->is_ajax_request() ) {
			
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				$this->load->view('secundaria/dashboard/user/user-index');
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: index
	
	
	
	
	
	/**
	 * 
	 * schools
	 * 
	 * function to show the list of schools in the system
	 */
	public function schools () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				$this->load->model('secundaria_schools_mdl');
				
				$data_view = array(
					'userSchools' => $this->secundaria_schools_mdl->getUserSchools($this->session->userdata('cas-secundaria-userid'))
				);
				
				$this->load->view('secundaria/dashboard/user/user-schools', $data_view);
				
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: get_schools
	
	
	
	
	
	/**
	 * 
	 * schools_info
	 * 
	 * method to show schools from user
	 */
	public function schools_info () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				
				
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: schools_info
	
	
	
	
	
	/**
	 * 
	 * window_addme_to_school
	 * 
	 * method to add schools to the profile of user
	 */
	public function window_addme_to_school () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				$this->load->view('secundaria/dashboard/user/user-schools-add-school');
				
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: window_addme_to_school
	
	
	
	
	
	/**
	 * 
	 * window_addme_to_school_attempt
	 * 
	 * method to add schools to the profile of user
	 */
	public function window_addme_to_school_attempt () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				if ( strlen(trim($this->input->post('cct'))) == 10 ) {
				
					$data_window_addme_to_school_attempt  = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde'
					);
					$this->load->model('secundaria_schools_mdl', 'schools');
					if ( $this->schools->cct_exists($this->input->post('cct')) ) {
						
						$school_info = $this->schools->getSchoolInfo_by_cct($this->input->post('cct'), 'school_name, school_id');
						
						if ( !empty($school_info) ) {
							
							$relationship = array(
								'cas_users_user_id'			=> $this->session->userdata('cas-secundaria-userid'),
								'cas_schools_school_id'		=> $school_info->school_id,
								'cas_schools_school_cct'	=> $this->input->post('cct')
							);
							
							if ( $this->schools->makeRelationship($relationship) ) {
								$data_window_addme_to_school_attempt['msg_type']		= 'success';
								$data_window_addme_to_school_attempt['msg_content']		= 'usted ha sido agregado a la escuela<br /><b><i>' . $school_info->school_name . '</i></b>';
							}
							else {
								$data_window_addme_to_school_attempt['msg_type']		= 'error';
								$data_window_addme_to_school_attempt['msg_content']		= 'usted ya pertenece a esta escuela';
							}
						}
						else {
							$data_window_addme_to_school_attempt['msg_type']		= 'error';
							$data_window_addme_to_school_attempt['msg_content']		= 'el CCT que nos proporciono aún no ha sido registrado';
						}
						
					}
					else {
						$data_window_addme_to_school_attempt['msg_type']		= 'error';
						$data_window_addme_to_school_attempt['msg_content']		= 'el CCT que nos proporciono aún no ha sido registrado';
					}
				}
				else {
					$data_window_addme_to_school_attempt['msg_type']		= 'error';
					$data_window_addme_to_school_attempt['msg_content']		= 'debe colocar el CCT de su escuela';
				}
				
				$this->load->view('secundaria/dashboard/user/user-schools-add-school-messenger', $data_window_addme_to_school_attempt);
				
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: window_addme_to_school_attempt
	
	
	
	
	
	/**
	 * 
	 * user_school_info
	 * 
	 * method to show the information about the school selected
	 */
	public function user_school_info () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				$this->load->model('secundaria_schools_mdl', 'schools');
				$this->load->model('secundaria_groups_mdl', 'groups');
				
				$userschoolinfo_data = array(
					'school_info'		=> $this->schools->getSchoolInfo($this->input->post('schoolID')),
					'school_groups'		=> $this->groups->getSchoolGroups($this->input->post('schoolID'))
				);
				
				$this->load->view('secundaria/dashboard/user/user-school-info', $userschoolinfo_data);
				
			}
			else
				$this->load->view('errors/errors-session-ended');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	// end: user_school_info
}
