<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preescolar extends CI_Controller {






	/**
	 *
	 * the constructor
	 */
	public function Preescolar () {
		parent::__construct();
	}





	/**
	 *
	 * the indes of the controller
	 */
	public function index () {
		$this->load->view('preescolar/template/template-index');
	}





	/**
	 *
	 * dashboard
	 */
	public function dashboard () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
				
				$this->load->model('preescolar_users_mdl');
				$this->load->model('preescolar_statistics_mdl');
				
				$usernames = ((($namesRequest = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'), 'user_lname, user_fname')) != NULL)?$namesRequest->user_lname . ' ' . $namesRequest->user_fname:'User Not Found');
				$useremail = ((($emailRequest = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'), 'user_email')) != NULL)?$emailRequest->user_email:'user@server.com');
			
				$data_dashboard = array(
					'usernames' => $usernames,
					'useremail' => $useremail,
					'enrolled_students'	=> $this->preescolar_statistics_mdl->get_students_counter(),
					'enrolled_teachers'	=> $this->preescolar_statistics_mdl->get_teachers_counter(),
					'enrolled_schools'	=> $this->preescolar_statistics_mdl->get_schools_counter(),
					'enrolled_groups'	=> $this->preescolar_statistics_mdl->get_groups_counter()
				);
				
				switch ( $this->session->userdata('cas-preescolar-userdashboard') ) {
					case 'root':
						$this->load->view('preescolar/dashboard/dashboard-root', $data_dashboard);
						break;
					case 'user':
						$this->load->view('preescolar/dashboard/dashboard-user', $data_dashboard);
						break;
					case 'teacher':
					default :
						$this->load->view('preescolar/dashboard/dashboard-teacher', $data_dashboard);
				}
			}
			else
				$this->load->view('preescolar/form/form-index');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	
	
	
	
	
	/**
	 * 
	 * form_login
	 */
	public function form_login () {
		if ( $this->input->is_ajax_request() ) {
			$this->load->view('preescolar/form/form-login');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	
	
	
	
	
	/**
	 * 
	 * form_login
	 */
	public function form_registeruser () {
		if ( $this->input->is_ajax_request() ) {
			$this->load->view('preescolar/form/form-registeruser');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}





	/**
	 * 
	 * form_login
	 */
	public function form_forgotpasswd () {
		if ( $this->input->is_ajax_request() ) {
			$this->load->view('preescolar/form/form-forgotpasswd');
		}
		else
			$this->load->view('errors/errors-not-access-allowed');
	}
	
	
	
	
	/**
	 * 
	 * logout
	 */
	public function logout () {
		$session_data = array(
			'cas-preescolar-userid'				=> '',
			'cas-preescolar-username'			=> '',
			'cas-preescolar-userdashboard'		=> '',
			'cas-preescolar-logintime'			=> '',
			'cas-preescolar-logged-from-ip'		=> '',
			'cas-preescolar-user-agent'			=> ''
		);
		$this->session->unset_userdata($session_data);
		$this->session->sess_destroy();
		header('location:' . base_url() . '?c=preescolar');
	}

}
