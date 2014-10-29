<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secundaria extends CI_Controller {






	/**
	 *
	 * the constructor
	 */
	public function Secundaria () {
		parent::__construct();
	}





	/**
	 *
	 * the indes of the controller
	 */
	public function index () {
		$this->load->view('secundaria/template/template-index');
	}





	/**
	 *
	 * dashboard
	 */
	public function dashboard () {
		if ( $this->input->is_ajax_request() ) {
			if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
				
				$this->load->model('secundaria_users_mdl');
				$this->load->model('secundaria_statistics_mdl');
				
				$usernames = ((($namesRequest = $this->secundaria_users_mdl->get_userData_by_ID($this->session->userdata('cas-secundaria-userid'), 'user_lname, user_fname')) != NULL)?$namesRequest->user_lname . ' ' . $namesRequest->user_fname:'User Not Found');
				$useremail = ((($emailRequest = $this->secundaria_users_mdl->get_userData_by_ID($this->session->userdata('cas-secundaria-userid'), 'user_email')) != NULL)?$emailRequest->user_email:'user@server.com');
			
				$data_dashboard = array(
					'usernames' => $usernames,
					'useremail' => $useremail,
					'enrolled_students'	=> $this->secundaria_statistics_mdl->get_students_counter(),
					'enrolled_teachers'	=> $this->secundaria_statistics_mdl->get_teachers_counter(),
					'enrolled_schools'	=> $this->secundaria_statistics_mdl->get_schools_counter(),
					'enrolled_groups'	=> $this->secundaria_statistics_mdl->get_groups_counter()
				);
				
				switch ( $this->session->userdata('cas-secundaria-userdashboard') ) {
					case 'root':
						$this->load->view('secundaria/dashboard/dashboard-root', $data_dashboard);
						break;
					case 'user':
						$this->load->view('secundaria/dashboard/dashboard-user', $data_dashboard);
						break;
					case 'teacher':
					default :
						$this->load->view('secundaria/dashboard/dashboard-teacher', $data_dashboard);
				}
			}
			else
				$this->load->view('secundaria/form/form-index');
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
			$this->load->view('secundaria/form/form-login');
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
			$this->load->view('secundaria/form/form-registeruser');
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
			$this->load->view('secundaria/form/form-forgotpasswd');
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
			'cas-secundaria-userid'				=> '',
			'cas-secundaria-username'			=> '',
			'cas-secundaria-userdashboard'		=> '',
			'cas-secundaria-logintime'			=> '',
			'cas-secundaria-logged-from-ip'		=> '',
			'cas-secundaria-user-agent'			=> ''
		);
		$this->session->unset_userdata($session_data);
		$this->session->sess_destroy();
		header('location:' . base_url() . '?c=secundaria');
	}

}
