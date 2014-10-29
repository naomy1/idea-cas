<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_app extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * The constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * the index
		 */
		public function index () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_schools_mdl');
					$this->load->model('preescolar_groups_mdl');
					$this->load->model('preescolar_students_mdl');
					$this->load->model('preescolar_apps_mdl', 'apps');
					
					$index_data = array(
						'schoolInfo' => $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'groupInfo' => $this->preescolar_groups_mdl->getGroupInfo($this->input->post('groupID')),
						'groupStudents' => $this->preescolar_students_mdl->getGroupStudents($this->input->post('groupID'))
					);
					
					$this->load->view('preescolar/app/app-index', $index_data);
					
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
		 * app_student
		 * 
		 * function to show the test from the students panel
		 */
		public function app_student () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_schools_mdl');
					$this->load->model('preescolar_groups_mdl');
					$this->load->model('preescolar_students_mdl');
					$this->load->model('preescolar_apps_mdl');
					
					$active_app = $this->preescolar_apps_mdl->get_active_app();
					
					if ( !empty($active_app) )
						$app_actived_id = $active_app->app_id;
					else
						$app_actived_id = 0;
					
					$appstudent_data = array(
						'schoolInfo'	=> $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'groupInfo'		=> $this->preescolar_groups_mdl->getGroupInfo($this->input->post('groupID')),
						'studentInfo'	=> $this->preescolar_students_mdl->getStudentInfo($this->input->post('studentID')),
						'appQuestions'	=> $this->preescolar_apps_mdl->get_app_questions($app_actived_id)
					);
					
					$this->load->view('preescolar/app/app-student', $appstudent_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: app_student
		
		
		
		
		
		/**
		 * 
		 * app_student_attempt
		 * 
		 * try to save the answers into the database
		 */
		 public function app_student_attempt () {
		 	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_apps_mdl');
					$active_app = $this->preescolar_apps_mdl->get_active_app();
					$appstudentattempt_info = array(
						'answer_id' => 'NULL',
						'answer_student_id' => $this->input->post('studentID'),
						'answer_user_id' => $this->session->userdata('cas-preescolar-userid'),
						'answer_school_id' => $this->input->post('schoolID'),
						'answer_school_cct' => $this->input->post('schoolCCT'),
						'answer_group_id' => $this->input->post('groupID'),
						'answer_app_id' => $active_app->app_id,
						'answer_1' => $this->input->post('answernumber_1'),
						'answer_2' => $this->input->post('answernumber_2'),
						'answer_3' => $this->input->post('answernumber_3'),
						'answer_4' => $this->input->post('answernumber_4'),
						'answer_5' => $this->input->post('answernumber_5'),
						'answer_6' => $this->input->post('answernumber_6'),
						'answer_7' => $this->input->post('answernumber_7'),
						'answer_8' => $this->input->post('answernumber_8'),
						'answer_9' => $this->input->post('answernumber_9'),
						'answer_10' => $this->input->post('answernumber_10'),
						'answer_11' => $this->input->post('answernumber_11'),
						'answer_12' => $this->input->post('answernumber_12'),
						'answer_13' => $this->input->post('answernumber_13'),
						'answer_14' => $this->input->post('answernumber_14'),
						'answer_15' => $this->input->post('answernumber_15'),
						'answer_16' => $this->input->post('answernumber_16'),
						'answer_17' => $this->input->post('answernumber_17'),
						'answer_18' => $this->input->post('answernumber_18'),
						'answer_19' => $this->input->post('answernumber_19'),
						'answer_20' => $this->input->post('answernumber_20'),
						'answer_21' => $this->input->post('answernumber_21'),
						'answer_22' => $this->input->post('answernumber_22'),
						'answer_23' => $this->input->post('answernumber_23'),
						'answer_24' => $this->input->post('answernumber_24'),
						'answer_25' => $this->input->post('answernumber_25'),
						'answer_26' => $this->input->post('answernumber_26'),
						'answer_27' => $this->input->post('answernumber_27'),
						'answer_28' => $this->input->post('answernumber_28'),
						'answer_29' => $this->input->post('answernumber_29'),
						'answer_30' => $this->input->post('answernumber_30'),
						'answer_31' => $this->input->post('answernumber_31'),
						'answer_32' => $this->input->post('answernumber_32'),
						'answer_33' => $this->input->post('answernumber_33'),
						'answer_34' => $this->input->post('answernumber_34'),
						'answer_35' => $this->input->post('answernumber_35'),
						'answer_36' => $this->input->post('answernumber_36'),
						'answer_37' => $this->input->post('answernumber_37'),
						'answer_38' => $this->input->post('answernumber_38'),
						'answer_39' => $this->input->post('answernumber_39'),
						'answer_40' => $this->input->post('answernumber_40'),
						'answer_41' => $this->input->post('answernumber_41'),
						'answer_42' => $this->input->post('answernumber_42'),
						'answer_43' => $this->input->post('answernumber_43'),
						'answer_44' => $this->input->post('answernumber_44'),
						'answer_45' => $this->input->post('answernumber_45')
					);
					
					$appstudentattempt_data = array(
						'msg_type'			=> 'empty',
						'msg_content'		=> 'no message',
						'studentInfo'		=> $appstudentattempt_info
					);
					
					if ( $this->preescolar_apps_mdl->saveanswers($appstudentattempt_info) ) {
						$appstudentattempt_data['msg_type']		= 'success';
						$appstudentattempt_data['msg_content']	= 'tu respuestas se guardaron correctamente';
						
					}
					else {
						$appstudentattempt_data['msg_type']		= 'error';
						$appstudentattempt_data['msg_content']	= 'no se han podido guardar tus respuestas';
					}
					
					$this->load->view('preescolar/app/app-student-messenger', $appstudentattempt_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		 }
		 // end: app_student_attempt
		 
		 
		 
		 
		 
		 /**
		  * 
		  * window_system_locked
		  * 
		  * window to get the password to unlock the system
		  */
		  public function window_system_locked () {
		  	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$systemlocked_data = array(
						'schoolID' => $this->input->post('schoolID'),
						'schoolCCT' => $this->input->post('schoolCCT'),
						'groupID' => $this->input->post('groupID')
					);
					$this->load->view('preescolar/app/windows/window-system-locked', $systemlocked_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		  }
		  // end: window_system_locked
		  
		  
		  
		  
		  
		  /**
		   * 
		   * unlocksystem_attempt
		   * 
		   * function to unlock the system
		   */ 
		   public function unlocksystem_attempt () {
		   	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$unlocksystem_data = array(
						'msg_type'			=> 'empty',
						'msg_content'		=> 'no message',
						'groupInfo'			=> array(
												'student_school_id'		=> $this->input->post('schoolID'),
												'student_school_cct'	=> $this->input->post('schoolCCT'),
												'student_group_id'		=> $this->input->post('groupID')
											)
					);
					
					$this->load->model('preescolar_users_mdl');
					
					$userdata = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'), 'user_passwd');
					
					if ( $userdata->user_passwd == md5($this->input->post('password')) ) {
						$unlocksystem_data['msg_type'] = 'success';
						$unlocksystem_data['msg_content'] = 'espere un momento mientras se desbloquea el sistema';
					}
					else {
						$unlocksystem_data['msg_type'] = 'error';
						$unlocksystem_data['msg_content'] = 'la contraseña no coincide';
					}
					
					$this->load->view('preescolar/app/windows/window-system-locked-messenger', $unlocksystem_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		   }
		   // end: unlocksystem_attempt
		   
		   
		   
		   
		   
		   /**
		   * 
		   * showschools_attempt
		   * 
		   * function to unlock the system
		   */ 
		   public function showschools_attempt () {
		   	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$unlocksystem_data = array(
						'msg_type'			=> 'empty',
						'msg_content'		=> 'no message'
					);
					
					$this->load->model('preescolar_users_mdl');
					
					$userdata = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'), 'user_passwd');
					
					if ( $userdata->user_passwd == md5($this->input->post('password')) ) {
						$unlocksystem_data['msg_type'] = 'success';
						$unlocksystem_data['msg_content'] = 'espere un momento mientras se desbloquea el sistema';
					}
					else {
						$unlocksystem_data['msg_type'] = 'error';
						$unlocksystem_data['msg_content'] = 'la contraseña no coincide';
					}
					
					$this->load->view('preescolar/app/windows/window-system-locked-continue-messenger', $unlocksystem_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		   }
		   // end: unlocksystem_attempt
	}
