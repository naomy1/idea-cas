<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Preescolar_profile_root extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 */
		public function __construct () {
			parent::__construct();
			$this->load->model('preescolar_statistics_mdl',		'status');
			$this->load->model('preescolar_schools_mdl',		'schools');
			$this->load->model('preescolar_groups_mdl',			'groups');
			$this->load->model('preescolar_students_mdl',		'students');
			$this->load->model('preescolar_users_mdl',			'users');
			$this->load->model('preescolar_apps_mdl',			'apps');
			$this->load->model('qa');
		}
		// end: construct
		
		
		
		
		
		/**
		 * 
		 * index
		 */
		public function index () {
			
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$this->load->view('preescolar/dashboard/root/root-index');
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
		 */
		public function schools () {
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$schools_data = array(
						'schools' => $this->schools->getAllSchools()
					);
					
					$this->load->view('preescolar/dashboard/root/root-schools', $schools_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: schools
		
		
		
		
		
		/**
		 * 
		 * questions
		 */
		public function questions () {
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$questions_data = array(
						'questions' => $this->qa->get_questions(1)
					);
					
					$this->load->view('preescolar/dashboard/root/root-questions', $questions_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: questions
		
		
		
		
		
		/**
		 * 
		 * app
		 */
		public function apps () {
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$apps_data = array(
						'apps' => $this->apps->get_apps()
					);
					
					$this->load->view('preescolar/dashboard/root/root-apps-index', $apps_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: app
		
		
		
		
		
		/**
		 * 
		 * users
		 */
		public function users () {
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$users_data = array(
						'users' => $this->users->get_users()
					);
					
					$this->load->view('preescolar/dashboard/root/root-users', $users_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: users
		
		
		
		
		
		/**
		 * 
		 * window_edit_school
		 * 
		 * method to show window to edit a school
		 */
		public function window_edit_school () {
			if ( $this->input->is_ajax_request() ) {
				
				$schoolInfo = $this->schools->getSchoolInfo($this->input->post('schoolid'));
					
					$editSchool_data = array(
						'editschool_id'							=> $schoolInfo->school_id,
						'editschool_cct'						=> $schoolInfo->school_cct,
						'editschool_name'						=> $schoolInfo->school_name,
						'editschool_address'					=> $schoolInfo->school_address,
						'editschool_colony'						=> $schoolInfo->school_colony,
						'editschool_delegation'					=> $schoolInfo->school_delegation_id,
						'editschool_zipcode'					=> $schoolInfo->school_zipcode,
						'editschool_phone'						=> $schoolInfo->school_phone,
						'editschool_supervisionzone'			=> $schoolInfo->school_supervision_zone,
						'editschool_usaer'						=> $schoolInfo->school_usaer,
						'editschool_usaer_supervisionzone'		=> $schoolInfo->school_usaer_supervision_zone,
						'editschool_turn'						=> strtolower($schoolInfo->school_turn),
						'editschool_delegations'				=> $this->schools->getDelegations()
					);
					
					$this->load->view('preescolar/dashboard/root/root-edit-school', $editSchool_data);
				
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_edit_school
		
		
		
		
		
		/**
		 * 
		 * edit_school_attempt
		 * 
		 * method to attempt to edit school
		 */
		public function edit_school_attempt () {
			
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					
					$editSchoolAttempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde'
					);
					
					$this->load->model('preescolar_schools_mdl');
					
					$editSchoolAttempt_info = array(
						'school_delegation_id'				=> $this->input->post('delegation'),
						'school_cct'						=> $this->input->post('cct'),
						'school_usaer'						=> $this->input->post('usaer'),
						'school_usaer_supervision_zone'		=> $this->input->post('usaer_supervisionzone'),
						'school_turn'						=> strtolower($this->input->post('turn')),
						'school_supervision_zone'			=> $this->input->post('supervisionzone'),
						'school_address'					=> $this->input->post('address'),
						'school_colony'						=> $this->input->post('colony'),
						'school_zipcode'					=> $this->input->post('zipcode'),
						'school_phone'						=> $this->input->post('phone'),
						'school_name'						=> $this->input->post('name')
					);
					
					$schoolCCT =  $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('schoolID'), 'school_cct');
					
					
					if ( $schoolCCT->school_cct == $editSchoolAttempt_info['school_cct'] ) {
						if ( $this->preescolar_schools_mdl->updateSchoolInfo($this->input->post('schoolID'), $editSchoolAttempt_info) ) {
							$editSchoolAttempt_data['msg_type']			= 'success';
							$editSchoolAttempt_data['msg_content']		= 'la escuela se ha actualizado correctamente';
						}
						else {
							$editSchoolAttempt_data['msg_type']			= 'error';
							$editSchoolAttempt_data['msg_content']		= 'no se ha podido actualizar la información de la escuela, por favor intentelo más tarde';
						}
					}
					else {
						if ( $this->preescolar_schools_mdl->cct_exists($editSchoolAttempt_info['school_cct']) ){
							$editSchoolAttempt_data['msg_type']			= 'alert';
							$editSchoolAttempt_data['msg_content']		= 'el CCT que proporciono ya existe';
						}
						else {
							if ( $this->preescolar_schools_mdl->updateSchoolInfo($this->input->post('schoolID'), $editSchoolAttempt_info) ) {
								$editSchoolAttempt_data['msg_type']			= 'success';
								$editSchoolAttempt_data['msg_content']		= 'la escuela se ha actualizado correctamente';
							}
							else {
								$editSchoolAttempt_data['msg_type']			= 'error';
								$editSchoolAttempt_data['msg_content']		= 'no se ha podido actualizar la información de la escuela, por favor intentelo más tarde';
							}
						}
					}
					
					
					$this->load->view('preescolar/dashboard/root/root-edit-school-messenger', $editSchoolAttempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: edit_school_attempt
		
		
		
		
		
		/**
		 * 
		 * window_add_app_question
		 */
		public function window_add_app_question () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_qa_mdl');
					$window_add_question_data = array(
						'app'				=> $this->apps->get_app($this->input->post('appid')),
						'question_type'		=> $this->qa->get_question_types(1)
					);
					
					$this->load->view('preescolar/dashboard/root/root-add-questions-window', $window_add_question_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_add_app_question
		
		
		
		
		
		/**
		 * 
		 * window_add_app_question_attempt
		 */
		public function window_add_app_question_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$window_edit_question_attempt_data = array(
						'msg_type'		=> 'empty',
						'msg_content'	=> 'error',
						'appid'			=> $this->input->post('appid')
					);
					
					if ( strlen(trim($this->input->post('app_question_text'))) <= 0 ) {
						$window_edit_question_attempt_data['msg_type']		= 'error';
						$window_edit_question_attempt_data['msg_content']	= 'no puede guardar preguntas vacías';
					}
					else {
						
						$window_add_app_question_attempt_data = array(
							'question_school_level'		=> 1,
							'question_app_id'			=> $this->input->post('appid'),
							'question_text'				=> $this->input->post('app_question_text'),
							'question_type_id'			=> $this->input->post('app_question_type')
						);
						$this->load->model('preescolar_qa_mdl');
						$this->qa->add_question($window_add_app_question_attempt_data);
						$window_edit_question_attempt_data['msg_type']		= 'success';
						$window_edit_question_attempt_data['msg_content']	= 'la pregunta se agrego correctamente';
					}
					
					$this->load->view('preescolar/dashboard/root/root-add-questions-window-messenger', $window_edit_question_attempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_add_app_question_attempt
		
		
		
		
		
		/**
		 * 
		 * window_edit_question
		 * 
		 * method to show the window to edit question
		 */
		public function window_edit_question () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_qa_mdl');
					$window_edit_question_data = array(
						'question' => $this->preescolar_qa_mdl->get_question($this->input->post('question_id'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-edit-questions-window', $window_edit_question_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_edit_question
		
		
		
		
		
		/**
		 * 
		 * window_edit_question_attempt
		 * 
		 * method to attempt to edit a question
		 */
		public function window_edit_question_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$window_edit_question_attempt_data = array(
						'msg_type'		=> 'empty',
						'msg_content'	=> 'error'
					);
					
					if ( strlen(trim($this->input->post('question_content'))) <= 0 ) {
						$window_edit_question_attempt_data['msg_type']		= 'error';
						$window_edit_question_attempt_data['msg_content']	= 'no puede guardar preguntas vacías';
					}
					else {
						
						$question_update = array(
							'question_text' => $this->input->post('question_content')
						);
						$this->load->model('preescolar_qa_mdl');
						$this->preescolar_qa_mdl->update_question($this->input->post('question_id'), $question_update);
						$window_edit_question_attempt_data['msg_type']		= 'success';
						$window_edit_question_attempt_data['msg_content']	= 'la pregunta se actualizó correctamente';
					}
					
					$this->load->view('preescolar/dashboard/root/root-edit-questions-window-messenger', $window_edit_question_attempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_edit_question_attempt
		
		
		
		
		
		/**
		 * 
		 * students
		 */
		public function students () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_schools_mdl');
					$schools_data = array(
						'schools'		=> $this->preescolar_schools_mdl->getAllSchools()
					);
					
					$this->load->view('preescolar/dashboard/root/root-schools-students-index', $schools_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: students
		
		
		
		
		
		/**
		 * 
		 * students_groups
		 */
		public function students_groups () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_schools_mdl');
					$this->load->model('preescolar_groups_mdl');
					
					$index_data = array(
						'schoolInfo' => $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'schoolsGroups' => $this->preescolar_groups_mdl->getSchoolGroups($this->input->post('schoolID'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-groups-index', $index_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: students_groups
		
		
		
		
		
		/**
		 * 
		 * students_groups_lists
		 */
		public function students_groups_lists () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_schools_mdl');
					$this->load->model('preescolar_groups_mdl');
					$this->load->model('preescolar_students_mdl');
					
					$group_list_data = array(
						'schoolInfo' => $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'groupInfo' => $this->preescolar_groups_mdl->getGroupInfo($this->input->post('groupID')),
						'groupStudents' => $this->preescolar_students_mdl->getGroupStudents($this->input->post('groupID')),
					);
					
					$this->load->view('preescolar/dashboard/root/root-students-index', $group_list_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: students_groups_lists
		
		
		
		
		
		/**
		 * 
		 * upgrade_schools_students
		 */
		public function upgrade_schools_students () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_students-window');
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: upgrade_schools_students
		
		
		
		
		
		/**
		 * 
		 * upgrade_schools_students_attempt
		 */
		public function upgrade_schools_students_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$upgrade_schools_students_attempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde'
					);
					
					if ( $this->schools->upgrade_all_schools($this->input->post('upgrade_from'), $this->input->post('upgrade_to')) ) {
						$upgrade_schools_students_attempt_data['msg_type']		= 'success';
						$upgrade_schools_students_attempt_data['msg_content']	= 'se ha cambiado de grado a todos los alumnos';
					}

					else {
						$upgrade_schools_students_attempt_data['msg_type']		= 'error';
						$upgrade_schools_students_attempt_data['msg_content']	= 'no se han podido cambiar de grado a los alumnos';
					}
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_students-window-messenger', $upgrade_schools_students_attempt_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: upgrade_schools_students_attempt
		
		
		
		
		
		/**
		 * 
		 * upgrade_schools_groups
		 */
		public function upgrade_schools_groups () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$upgrade_schools_groups_data = array(
						'schoolid'			=> $this->input->post('schoolid'),
						'school_groups'		=> $this->groups->getSchoolGroups($this->input->post('schoolid'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_groups-window', $upgrade_schools_groups_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: upgrade_schools_groups
		
		
		
		
		
		/**
		 * upgrade_schools_groups_attempt
		 */
		public function upgrade_schools_groups_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$upgrade_schools_groups_students_attempt_data = array(
						'msg_type'			=>	'error',
						'msg_content'		=>	'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_data'			=>	array(
														'schoolid'		=> $this->input->post('schoolid')
												)
					);
					
					if ( $this->groups->upgrade_grade_groups_school($this->input->post('schoolid'), $this->input->post('group_from'), $this->input->post('group_to')) ) {
						$upgrade_schools_groups_students_attempt_data['msg_type']	= 'success';
						$upgrade_schools_groups_students_attempt_data['content']	= 'se han cambiado los alumnos satisfactoriamente';
					}
					else {
						$upgrade_schools_groups_students_attempt_data['msg_type']	= 'error';
						$upgrade_schools_groups_students_attempt_data['content']	= 'no se han podido actualizar los datos de los alumnos, por favor intentelo más tarde';
					}
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_groups-window-messenger', $upgrade_schools_groups_students_attempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: upgrade_schools_groups_attempt
		
		
		
		
		
		/**
		 * 
		 * edit_student
		 */
		public function edit_student () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					
					
					$this->load->model('preescolar_students_mdl');
					
					$studentInfo = $this->preescolar_students_mdl->getStudentInfo($this->input->post('studentID'));
					
					$editstudent_data = array(
						'editstudent_id'				=> $studentInfo->student_id,
						'editstudent_fname'				=> $studentInfo->student_fname,
						'editstudent_lname'				=> $studentInfo->student_lname,
						'editstudent_curp'				=> $studentInfo->student_curp,
						'editstudent_sex'				=> $studentInfo->student_sex,
						'editstudent_schoolid'			=> $studentInfo->student_school_id,
						'editstudent_schoolcct'			=> $studentInfo->student_school_cct,
						'editstudent_groupid'			=> $studentInfo->student_group_id,
						'editstudent_grade'				=> $studentInfo->student_grade,
						'editstudent_schools'			=> $this->schools->getAllSchools('school_id, school_cct, school_name'),
						'editstudent_schools_groups'	=> $this->groups->getSchoolGroups($studentInfo->student_school_id)
					);
					$this->load->view('preescolar/dashboard/root/root-windows-editstudent', $editstudent_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: edit_student
		
		
		
		
		
		/**
		 * 
		 * edit_student_get_school_groups
		 */
		public function edit_student_get_school_groups () {
			$edit_student_get_school_groups_data = array(
				'editstudent_schools_groups' => $this->groups->getSchoolGroups($this->input->post('schoolid'))
			);
			$this->load->view('preescolar/dashboard/root/root-windows-editstudent-messenger-groups', $edit_student_get_school_groups_data);
		}
		// end: edit_student_get_school_groups
		
		
		
		
		
		/**
		 * 
		 * editstudent_attempt
		 * 
		 * function to attempt to edit student info
		 */
		public function editstudent_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					
					
					$editstudentattempt_info = array(
						'student_fname'			=> $this->input->post('fname'),
						'student_lname'			=> $this->input->post('lname'),
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_sex'			=> $this->input->post('sex'),
						'student_school_id'		=> $this->input->post('new_school'),
						'student_group_id'		=> $this->input->post('new_group')
					);
					
					$editstudentattempt_chk = array(
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 1,
						'student_is_deleted'	=> 'false',
						'student_is_down'		=> 'false'
					);
					
					$editstudentattempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_student_info'	=> $editstudentattempt_chk
					);
					
					if ( strlen(trim($editstudentattempt_info['student_fname'])) == 0 ) {
						$editstudentattempt_data['msg_type']		= 'error';
						$editstudentattempt_data['msg_content']		= 'debe dar el(los) nombre(s) del alumno';
					}
					elseif ( strlen(trim($editstudentattempt_info['student_lname'])) == 0 ) {
						$editstudentattempt_data['msg_type']		= 'error';
						$editstudentattempt_data['msg_content']		= 'debe dar el(los) nombre(s) del alumno';
					}
					if ( !$this->strings_mdl->is_curp($editstudentattempt_info['student_curp']) ) {
						$editstudentattempt_data['msg_type']		= 'error';
						$editstudentattempt_data['msg_content']		= 'debe dar la curp del alumno';
					}
					elseif ( strlen(trim($editstudentattempt_info['student_fname'])) > 0 && strlen(trim($editstudentattempt_info['student_lname'])) > 0 && $this->strings_mdl->is_curp($editstudentattempt_info['student_curp']) ) {
						
						$this->load->model('preescolar_students_mdl');
						
						$studentInfo = $this->preescolar_students_mdl->getStudentInfo($this->input->post('studentID'), 'student_id, student_curp');
						
						if ( strtolower($studentInfo->student_curp) == strtolower($editstudentattempt_info['student_curp']) ) {
							if ( $this->students->updateStudent_root($this->input->post('studentID'), $editstudentattempt_info) ) {
								$editstudentattempt_data['msg_type']		= 'success';
								$editstudentattempt_data['msg_content']		= 'la información del alumno se actualizo correctamente';
							}
							else{
								$editstudentattempt_data['msg_type']		= 'alert';
								$editstudentattempt_data['msg_content']		= 'no se pudo hacer la actualización, intentelo más tarde';
							}
						}
						else {
							$studentInto_curp = $this->preescolar_students_mdl->getStudentInfo_by_curp($editstudentattempt_info['student_curp'], 'student_id, student_curp, student_is_deleted, student_is_down');
							
							if ( $studentInto_curp ) {
								if ( $studentInfo->student_id == $studentInto_curp->student_id ) {
									
									if ( $this->students->updateStudent_root($this->input->post('studentID'), $editstudentattempt_info) ) {
										$editstudentattempt_data['msg_type']		= 'success';
										$editstudentattempt_data['msg_content']		= 'la información del alumno se actualizo correctamente';
									}
									else{
										$editstudentattempt_data['msg_type']		= 'alert';
										$editstudentattempt_data['msg_content']		= 'no se pudo hacer la actualización, intentelo más tarde';
									}
	
								}
								else {
									if ( $studentInto_curp->student_is_deleted != 'false' || $studentInto_curp->student_is_down != 'false' ) {
										
										if ( $this->preescolar_students_mdl->updateStudent_root($this->input->post('studentID'), $editstudentattempt_info) ) {
											$editstudentattempt_data['msg_type']		= 'success';
											$editstudentattempt_data['msg_content']		= 'la información del alumno se actualizo correctamente';
										}
										else{
											$editstudentattempt_data['msg_type']		= 'alert';
											$editstudentattempt_data['msg_content']		= 'no se pudo hacer la actualización, intentelo más tarde';
										}
										
									}
									else {
										$editstudentattempt_data['msg_type']		= 'info';
										$editstudentattempt_data['msg_content']		= 'la curp "' . $editstudentattempt_info['student_curp'] . '" ya ha sido registrada';
									}
								}
							}
							else {
								if ( $this->preescolar_students_mdl->updateStudent_root($this->input->post('studentID'), $editstudentattempt_info) ) {
									$editstudentattempt_data['msg_type']		= 'success';
									$editstudentattempt_data['msg_content']		= 'la información del alumno se actualizo correctamente';
								}
								else{
									$editstudentattempt_data['msg_type']		= 'alert';
									$editstudentattempt_data['msg_content']		= 'no se pudo hacer la actualización, intentelo más tarde';
								}
							}
						}
						
					}
					
					$this->load->view('preescolar/dashboard/root/root-windows-editstudent-messenger', $editstudentattempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: editstudent_attempt
		
		
		
		
		
		/**
		 * 
		 * upgrade_schools_students
		 */
		public function upgrade_schools_groups_students () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					
					
					$upgrade_schools_groups_students_data = array(
						'schoolid'		=> $this->input->post('schoolid'),
						'schoolcct'		=> $this->input->post('schoolcct'),
						'groupid'		=> $this->input->post('groupid'),
						'grade'			=> $this->input->post('grade'),
						'school_groups'	=> $this->groups->getSchoolGroups($this->input->post('schoolid'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_groups_students-window', $upgrade_schools_groups_students_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: upgrade_schools_students
		
		
		
		
		
		/**
		 * 
		 * upgrade_schools_groups_students_attempt
		 */
		public function upgrade_schools_groups_students_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$upgrade_schools_groups_students_attempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_data'			=> array(
														'schoolid'		=> $this->input->post('schoolid'),
														'schoolcct'		=> $this->input->post('schoolcct'),
														'groupid'		=> $this->input->post('groupid'),
														'grade'			=> $this->input->post('grade')
													)
					);
					
					if ( $this->groups->upgrade_grade_group($this->input->post('groupid_from'), $this->input->post('groupid_to')) ) {
						$upgrade_schools_groups_students_attempt_data['msg_type']	= 'success';
						$upgrade_schools_groups_students_attempt_data['content']	= 'se han cambiado los alumnos satisfactoriamente';
					}
					else {
						$upgrade_schools_groups_students_attempt_data['msg_type']	= 'error';
						$upgrade_schools_groups_students_attempt_data['content']	= 'no se han podido actualizar los datos de los alumnos, por favor intentelo más tarde';
					}
					
					$this->load->view('preescolar/dashboard/root/root-upgrade_schools_groups_students-window-messenger', $upgrade_schools_groups_students_attempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
				
		}
		// end: upgrade_schools_groups_students_attempt
		
		
		
		
		
		/**
		 * 
		 * add-school-root
		 */
		public function add_school () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$addschool_data = array(
						'addschool_delegations' => $this->schools->getDelegations()
					);
					$this->load->view('preescolar/dashboard/root/root-addschool-windows', $addschool_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: add-school-root
		
		
		
		
		
		/**
		 * 
		 * addschool_attempt
		 * 
		 * function to attempt to save school in the database
		 */
		public function addschool_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$addschoolattempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_school_added'	=> false
					);
					
					$this->load->model('preescolar_users_mdl');
					$userinfo = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'), 'user_crosee');
					$addschoolattempt_info = array (
						'school_id'								=> 'NULL',
						'school_delegation_id'					=> $this->input->post('delegation'),
						'school_user_id'						=> $this->session->userdata('cas-preescolar-userid'),
						'school_cct'							=> $this->input->post('cct'),
						'school_crosee'							=> $userinfo->user_crosee,
						'school_usaer'							=> $this->input->post('usaer'),
						'school_usaer_supervision_zone'			=> $this->input->post('usaer_supervisionzone'),
						'school_turn'							=> $this->input->post('turn'),
						'school_supervision_zone'				=> $this->input->post('supervisionzone'),
						'school_address'						=> $this->input->post('address'),
						'school_colony'							=> $this->input->post('colony'),
						'school_zipcode'						=> $this->input->post('zipcode'),
						'school_level'							=> 1,
						'school_phone'							=> $this->input->post('phone'),
						'school_name'							=> $this->input->post('name')
					);
					// beg: validations
					if ( strlen(trim($addschoolattempt_info['school_cct'])) < 10 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar el C.C.T. de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_name'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar el nombre de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_address'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar la dirección de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_colony'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar la colonia de la escuela';
					}
					elseif ( $addschoolattempt_info['school_delegation_id'] == '0' ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe seleccionar la delegación de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_zipcode'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar el código postal de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_phone'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar el(los) teléfono(s) de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_supervision_zone'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar la zona de supervisión de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_usaer'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar la U.S.A.E.R. de la escuela';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_usaer_supervision_zone'])) == 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe dar la zona de supervisión de la U.S.A.E.R. de la escuela';
					}
					elseif ( $addschoolattempt_info['school_turn'] == 'na' ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'debe seleccionar el turno en que trabaja la escuela';
					}
					elseif ( !is_numeric($this->input->post('grade_one')) || substr_count($this->input->post('grade_one'), '.') > 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'el número de grupos en 1er grado debe ser un número entero';
					}
					elseif ( !is_numeric($this->input->post('grade_two')) || substr_count($this->input->post('grade_two'), '.') > 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'el número de grupos en 2do grado debe ser un número entero';
					}
					elseif ( !is_numeric($this->input->post('grade_three')) || substr_count($this->input->post('grade_three'), '.') > 0 ) {
						$addschoolattempt_data['msg_type']		= 'error';
						$addschoolattempt_data['msg_content']	= 'el número de grupos en 3er grado debe ser un número entero';
					}
					elseif ( strlen(trim($addschoolattempt_info['school_cct'])) == 10 && strlen(trim($addschoolattempt_info['school_name'])) > 0 && strlen(trim($addschoolattempt_info['school_address'])) > 0 && strlen(trim($addschoolattempt_info['school_colony'])) > 0 && $addschoolattempt_info['school_delegation_id'] != '0' && strlen(trim($addschoolattempt_info['school_zipcode'])) > 0 && strlen(trim($addschoolattempt_info['school_phone'])) > 0 && strlen(trim($addschoolattempt_info['school_supervision_zone'])) > 0 && strlen(trim($addschoolattempt_info['school_usaer'])) > 0 && strlen(trim($addschoolattempt_info['school_usaer_supervision_zone'])) > 0 && $addschoolattempt_info['school_turn'] != 'na' && is_numeric($this->input->post('grade_one')) && substr_count($this->input->post('grade_one'), '.') == 0 && is_numeric($this->input->post('grade_two')) && substr_count($this->input->post('grade_two'), '.') == 0 && is_numeric($this->input->post('grade_three')) && substr_count($this->input->post('grade_three'), '.') == 0 ) {
						
						$this->load->model('preescolar_schools_mdl');
						
						if ( !$this->preescolar_schools_mdl->cct_exists($addschoolattempt_info['school_cct']) ) {
							// si no existe el CCT
							if ( $schoolID = $this->preescolar_schools_mdl->addSchool($addschoolattempt_info) ) {
								
								$relationship_info = array(
									'cas_users_user_id'			=> $addschoolattempt_info['school_user_id'],
									'cas_schools_school_id'		=> $schoolID,
									'cas_schools_school_cct'	=> $addschoolattempt_info['school_cct']
								);
								if ( $this->preescolar_schools_mdl->makeRelationship($relationship_info) ) {
									
									
									
									// creamos grupos en 1er grado
									$this->preescolar_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 1, 'groups' => (int)$this->input->post('grade_one')));
									// creamos grupos en 2do grado
									$this->preescolar_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 2, 'groups' => (int)$this->input->post('grade_two')));
									// creamos grupos en 3er grado
									$this->preescolar_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 3, 'groups' => (int)$this->input->post('grade_three')));
									
									$addschoolattempt_data['msg_type']		= 'success';
									$addschoolattempt_data['msg_content']	= 'su escuela ha sido agregada satisfactoriamente';
								}
								else {
									$addschoolattempt_data['msg_type']		= 'info';
									$addschoolattempt_data['msg_content']	= 'la escuela fue agregada pero no se pudo establecer la relación entre usted y la escuela';
								}
							}
							else {
								$addschoolattempt_data['msg_type']		= 'error';
								$addschoolattempt_data['msg_content']	= 'no se ha podido completar el registro, intentelo nuevamente';
							}
						}
						else {
							$this->load->model('preescolar_schools_mdl');
							$schoolInfo = $this->preescolar_schools_mdl->getSchoolInfo_by_cct($addschoolattempt_info['school_cct'], 'school_id');
							
							$relationship_info = array(
								'cas_users_user_id'			=> $addschoolattempt_info['school_user_id'],
								'cas_schools_school_id'		=> $schoolInfo->school_id,
								'cas_schools_school_cct'	=> $addschoolattempt_info['school_cct']
							);
							
							
							if ( $this->preescolar_schools_mdl->makeRelationship($relationship_info) ) {
								$addschoolattempt_data['msg_type']		= 'success';
								$addschoolattempt_data['msg_content']	= 'su escuela ha sido agregada satisfactoriamente';
							}
							else {
								$addschoolattempt_data['msg_type']			= 'info';
								$addschoolattempt_data['msg_content']		= 'usted ya pertenece a esta escuela';
								$addschoolattempt_data['msg_school_added']	= true;
							}
							
						}
					}
					// end: validations
					$this->load->view('preescolar/dashboard/root/root-addschool-messenger-window', $addschoolattempt_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: addschool_attempt
		
		
		
		
		
		/**
		 * 
		 * add_school_group_student
		 */
		public function add_school_group_student () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
						
					$add_school_group_data = array(
						'addstudent_schoolid'		=> $this->input->post('schoolID'),
						'addstudent_schoolcct'		=> $this->input->post('schoolCCT'),
						'addstudent_groupid'		=> $this->input->post('groupID')
					);
					
					$this->load->view('preescolar/dashboard/root/root-addschool-addgroup-addstudent-window.php', $add_school_group_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: add_school_group_student
		
		
		
		
		
		/**
		 * 
		 * window_addstudent
		 * 
		 * function to show the add student form
		 */
		public function window_addstudent () {
			
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$addstudent_data = array(
						'addstudent_schoolid'		=> $this->input->post('schoolID'),
						'addstudent_schoolcct'		=> $this->input->post('schoolCCT'),
						'addstudent_groupid'		=> $this->input->post('groupID'),
						'addstudent_grade'			=> $this->input->post('grade')
					);
					
					$this->load->view('preescolar/dashboard/root/windows-add-student', $addstudent_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
			
		}
		// end: window_addstudent
		
		
		
		
		/**
		 * 
		 * addstudent_attempt
		 * 
		 * function to attempt to save the student in the database
		 */
		public function addstudent_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$addstudentattempt_info = array(
						'student_id'			=> 'NULL',
						'student_fname'			=> $this->input->post('fname'),
						'student_lname'			=> $this->input->post('lname'),
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_sex'			=> $this->input->post('sex'),
						'student_user_id'		=> $this->session->userdata('cas-preescolar-userid'),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_grade'			=> $this->groups->getGroupInfo($this->input->post('groupID'), 'group_grade')->group_grade,
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 1
					);
					
					$addstudentattempt_chk = array(
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 1,
						'student_is_deleted'	=> 'false',
						'student_is_down'		=> 'false'
					);
					
					$addstudentattempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_student_info'	=> $addstudentattempt_chk
					);
					
					if ( strlen(trim($addstudentattempt_info['student_fname'])) == 0 ){
						$addstudentattempt_data['msg_type']		= 'error';
						$addstudentattempt_data['msg_content']	= 'debe dar el(los) nombre(s) del alumno';
					}
					elseif ( strlen(trim($addstudentattempt_info['student_lname'])) == 0 ){
						$addstudentattempt_data['msg_type']		= 'error';
						$addstudentattempt_data['msg_content']	= 'debe dar el(los) apellido(s) del alumno';
					}
					elseif ( !$this->strings_mdl->is_curp($addstudentattempt_info['student_curp']) ){
						$addstudentattempt_data['msg_type']		= 'error';
						$addstudentattempt_data['msg_content']	= 'debe dar una C.U.R.P. válida';
					}
					elseif ( $addstudentattempt_info['student_sex'] == '0' ){
						$addstudentattempt_data['msg_type']		= 'error';
						$addstudentattempt_data['msg_content']	= 'debe seleccionar el sexo del alumno';
					}
					elseif ( strlen(trim($addstudentattempt_info['student_fname'])) > 0 && strlen(trim($addstudentattempt_info['student_lname'])) > 0 && $this->strings_mdl->is_curp($addstudentattempt_info['student_curp']) && $addstudentattempt_info['student_sex'] != '0' ) {
						$this->load->model('preescolar_students_mdl');
						
						if ( !$this->preescolar_students_mdl->student_exists($addstudentattempt_chk) ) {
							
							if ( $this->preescolar_students_mdl->addstudent($addstudentattempt_info) ) {
								$addstudentattempt_data['msg_type']		= 'success';
								$addstudentattempt_data['msg_content']	= 'el alumno "' . $addstudentattempt_info['student_fname'] . ' ' . $addstudentattempt_info['student_lname'] . '" ha sido agregado correctamente';
							}
							else {
								$addstudentattempt_data['msg_type']		= 'error';
								$addstudentattempt_data['msg_content']	= 'el sistema no pudo registrar al alumno';
							}
						}
						else {
							$addstudentattempt_data['msg_type']		= 'info';
							$addstudentattempt_data['msg_content']	= 'el alumno "' . $addstudentattempt_info['student_fname'] . ' ' . $addstudentattempt_info['student_lname'] . '" ya está registrado en el sistema';
						}
					}
					
					$this->load->view('preescolar/dashboard/root/windows-add-student-messenger', $addstudentattempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: addstudent_attempt
		
		
		
		
		
		/**
		 * 
		 * window_addgroup
		 * 
		 * function to load the form to add group
		 */
		 public function window_addgroup () {
		 	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ){
					
					$addgroup_data = array(
						'addgroup_schoolID' => $this->input->post('schoolID')
					);
					
					$this->load->view('preescolar/dashboard/root/root-windows-groups-addgroup', $addgroup_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		 }
		 // end: window_addgroup
		 
		 
		 
		 
		 
		 /**
		  * 
		  * addgroup_attempt
		  * 
		  * function to add group
		  */
		  public function addgroup_attempt () {
		  	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ){
					
					$this->load->model('preescolar_schools_mdl');
					
					$addgroupattempt_info = array(
						'group_id'				=> NULL,
						'group_name'			=> strtoupper($this->input->post('group_name')),
						'group_grade'			=> $this->input->post('group_grade'),
						'group_school_level'	=> 1,
						'group_user_id'			=> $this->session->userdata('cas-preescolar-userid'),
						'group_school_id'		=> $this->input->post('group_schoolID'),
						'group_school_cct'		=> $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('group_schoolID'), 'school_cct')->school_cct
					);
					
					$addgroupattempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_group_info'	=> $addgroupattempt_info
					);
					
					if ( $addgroupattempt_info['group_grade'] == '0' ) {
						$addgroupattempt_data['msg_type']		= 'error';
						$addgroupattempt_data['msg_content']	= 'debe seleccionar el grado al que pertenecerá el grupo';
					}
					elseif ( strlen(trim($addgroupattempt_info['group_name'])) < 1 ) {
						$addgroupattempt_data['msg_type']		= 'error';
						$addgroupattempt_data['msg_content']	= 'debe dar el nombre del grupo';
					}
					elseif ( $addgroupattempt_info['group_grade'] != '0' && strlen(trim($addgroupattempt_info['group_name'])) >= 1 ) {
						
						$this->load->model('preescolar_groups_mdl');
						
						$chk_group = array(
							'group_name'			=> strtoupper($this->input->post('group_name')),
							'group_grade'			=> $this->input->post('group_grade'),
							'group_school_level'	=> 1,
							'group_school_id'		=> $this->input->post('group_schoolID'),
							'group_school_cct'		=> $this->preescolar_schools_mdl->getSchoolInfo($this->input->post('group_schoolID'), 'school_cct')->school_cct
						);
						
						if ( !$this->preescolar_groups_mdl->group_exists($chk_group) ) {
							if ( $this->preescolar_groups_mdl->addgroup($addgroupattempt_info) ) {
								$addgroupattempt_data['msg_type']		= 'success';
								$addgroupattempt_data['msg_content']	= 'el grupo se ha agregado satisfactoriamente';
							}
							else {
								$addgroupattempt_data['msg_type']		= 'error';
								$addgroupattempt_data['msg_content']	= 'no se pudo guardar el grupo';
							}
						}
						else{
							$addgroupattempt_data['msg_type']		= 'alert';
							$addgroupattempt_data['msg_content']	= 'el grupo ya existe';
						}
					}
					
					$this->load->view('preescolar/dashboard/root/root-windows-groups-addgroup-messenger', $addgroupattempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		  }
		  // end: addgroup_attempt
		  
		  
		  
		  
		  
		  /**
		 * 
		 * deletegroup_attempt
		 * 
		 * function to delete a group
		 */
		 public function deletegroup_attempt () {
		 	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ){
					
					$this->load->model('preescolar_groups_mdl');
					$this->preescolar_groups_mdl->deletegroup($this->input->post('groupID'));
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		 }
		//end: deletegroup_attempt
		
		
		
		
		
		/**
		 * 
		 * window_editgroup
		 * 
		 * function to load the window to edit group
		 */
		public function window_editgroup ($groupID = 0) {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ){
					
					$this->load->model('preescolar_groups_mdl');
					
					$editgroup_data = array(
						'editgroup_groupinfo' => $this->preescolar_groups_mdl->getGroupInfo($this->input->post('groupID'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-windows-groups-editgroup', $editgroup_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window-editgroup
		
		
		
		
		
		/**
		 * 
		 * editgroup_attempt
		 * 
		 * function to attempt to save new data in the data base
		 */
		public function editgroup_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ){
					
					$this->load->model('preescolar_groups_mdl');
					
					$groupInfo = $this->preescolar_groups_mdl->getGroupInfo($this->input->post('groupID'));
					
					$editgroup_info = array(
						'group_name'		=> $this->input->post('name'),
						'group_grade'		=> $this->input->post('grade'),
						'group_school_id'	=> $groupInfo->group_school_id
					);
					
					$editgroup_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_school_id'		=> $groupInfo->group_school_id
					);
					
					if ( strtolower($editgroup_info['group_name']) == strtolower($groupInfo->group_name) && $editgroup_info['group_grade'] == $groupInfo->group_grade ) {
						$editgroup_data['msg_type']		= 'success';
						$editgroup_data['msg_content']	= 'el grupo se actualizo correctamente';
					}
					elseif ( strlen(trim($editgroup_info['group_name'])) == 0 ) {
						$editgroup_data['msg_type']		= 'error';
						$editgroup_data['msg_content']	= 'debe dar el nombre del grupo';
					}
					elseif ( strlen(trim($editgroup_info['group_name'])) > 0 ) {
						
						if ( ($groupexists = $this->preescolar_groups_mdl->group_exists_edit ($editgroup_info)) == 0 ) {
							
							if ( $this->preescolar_groups_mdl->edit_group($this->input->post('groupID'), $editgroup_info) ) {
								
								$editgroup_data['msg_type']		= 'success';
								$editgroup_data['msg_content']	= 'el grupo se actualizo correctamente';
								
							}
							else {
								$editgroup_data['msg_type']		= 'error';
								$editgroup_data['msg_content']	= 'no se pudieron guardar los cambios, intentelo más tarde';
							}
							
						}
						else {
							$editgroup_data['msg_type']		= 'alert';
							$editgroup_data['msg_content']	= 'el grupo "' . $editgroup_info['group_grade'] . '&deg; ' . strtoupper($editgroup_info['group_name']) . '" ya está registrado en esta escuela';
						}
						
					}
					
					$this->load->view('preescolar/dashboard/root/root-windows-groups-editgroup-messenger', $editgroup_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: editgroup_attempt
		
		
		
		
		
		/**
		 * 
		 * useredit
		 * 
		 * function to get all the user data that can be edited
		 */
		public function useredit () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_users_mdl');
					$useredit_info = $this->preescolar_users_mdl->get_userData_by_ID($this->input->post('userid'));
					$useredit_data = array(
						'edituser_userid'			=> $useredit_info->user_id,
						'edituser_username'			=> $useredit_info->user_name,
						'edituser_firstname'		=> $useredit_info->user_fname,
						'edituser_lastname'			=> $useredit_info->user_lname,
						'edituser_usermail'			=> $useredit_info->user_email,
						'edituser_usercurp'			=> $useredit_info->user_curp,
						'edituser_userusaer'		=> $useredit_info->user_usaer,
						'edituser_userusaerzone'	=> $useredit_info->user_usaer_supervision_zone,
						'edituser_usercrosee'		=> $useredit_info->user_crosee,
						'edituser_usertype'			=> $useredit_info->user_type
					);
					$this->load->view('preescolar/dashboard/root/window-user-edit-profile', $useredit_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		
		
		
		
		
		/**
		 * 
		 * useredit_attempt
		 * 
		 * function to get the data from the user edit form and try to
		 * edit the user info in the database
		 */
		public function useredit_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$usereditattempt_data = array(
						'msg_type'			=> 'empty',
						'msg_content'		=> 'no message',
						'msg_user_lname'	=> $this->input->post('lastname'),
						'msg_user_fname'	=> $this->input->post('firstname')
					);
					
					$usereditattempt_info = array(
						'user_fname'						=> $this->input->post('firstname'),
						'user_lname'						=> $this->input->post('lastname'),
						'user_email'						=> $this->input->post('useremail'),
						'user_curp'							=> $this->input->post('usercurp'),
						'user_usaer'						=> $this->input->post('userusaer'),
						'user_usaer_supervision_zone'		=> $this->input->post('userusaerzone'),
						'user_crosee'						=> $this->input->post('usercrosee'),
						'user_type'							=> $this->input->post('usertype')
					);
					
					$useredit_can_update = false;
					
					if ( strlen(trim($usereditattempt_info['user_fname'])) == 0 ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar su(s) nombre(s)';
					}
					elseif ( strlen(trim($usereditattempt_info['user_lname'])) == 0 ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar su(s) apellido(s)';
					}
					elseif ( !$this->strings_mdl->is_email($usereditattempt_info['user_email']) ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar un correo electrónico válido';
					}
					elseif ( !$this->strings_mdl->is_curp($usereditattempt_info['user_curp']) ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar una C.U.R.P. válida';
					}
					elseif ( strlen(trim($usereditattempt_info['user_usaer'])) == 0 ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar la usaer a la que pertenece';
					}
					elseif ( strlen(trim($usereditattempt_info['user_usaer_supervision_zone'])) == 0 ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe colocar la zona de supervisión a la que pertenece';
					}
					elseif ( $usereditattempt_info['user_crosee'] == '0' ) {
						$usereditattempt_data['msg_type']		= 'error';
						$usereditattempt_data['msg_content']	= 'debe seleccionar la C.R.O.S.E.E. a la que pertenece';
					}
					elseif ( strlen(trim($usereditattempt_info['user_fname'])) > 0 && strlen(trim($usereditattempt_info['user_lname'])) > 0 && $this->strings_mdl->is_email($usereditattempt_info['user_email']) && $this->strings_mdl->is_curp($usereditattempt_info['user_curp']) && strlen(trim($usereditattempt_info['user_usaer'])) > 0 && strlen(trim($usereditattempt_info['user_usaer_supervision_zone'])) > 0 && $usereditattempt_info['user_crosee'] > '0' ) {
						
						$this->load->model('preescolar_users_mdl');
						
						$userinfo = $this->preescolar_users_mdl->get_userData_by_ID($this->input->post('userid'));
						
						// if the email and the curp are equal to the old data the other data can be update
						if ( $userinfo->user_email == $usereditattempt_info['user_email'] && strtolower($userinfo->user_curp) == strtolower($usereditattempt_info['user_curp']) ) {
							
							// update
							if ( $this->preescolar_users_mdl->updateUserData($this->input->post('userid'), $usereditattempt_info) == 200 ) {
								$usereditattempt_data['msg_type']		= 'success';
								$usereditattempt_data['msg_content']	= 'su información ha sido actualizada correctamente';
							}
							else {
								$usereditattempt_data['msg_type']		= 'alert';
								$usereditattempt_data['msg_content']	= 'no se ha podido actualizar su información';
							}
						}
						else {
							
							// update
							if ( !$this->preescolar_users_mdl->email_exists($usereditattempt_info['user_email']) && !$this->preescolar_users_mdl->curp_exists($usereditattempt_info['user_curp']) ) {
								if ( $this->preescolar_users_mdl->updateUserData($this->input->post('userid'), $usereditattempt_info) == 200 ) {
									$usereditattempt_data['msg_type']		= 'success';
									$usereditattempt_data['msg_content']	= 'su información ha sido actualizada correctamente';
								}
								else {
									$usereditattempt_data['msg_type']		= 'alert';
									$usereditattempt_data['msg_content']	= 'no se ha podido actualizar su información';
								}
							}
							
							// no update
							elseif ( $userinfo->user_email != $usereditattempt_info['user_email'] && $this->preescolar_users_mdl->email_exists($usereditattempt_info['user_email']) ) {
								$usereditattempt_data['msg_type']		= 'error';
								$usereditattempt_data['msg_content']	= 'el correo ya ha sido registrado por otro usuario';
							}
							
							// no update
							elseif ( $userinfo->user_curp != $usereditattempt_info['user_curp'] && $this->preescolar_users_mdl->curp_exists($usereditattempt_info['user_curp']) ) {
								$usereditattempt_data['msg_type']		= 'error';
								$usereditattempt_data['msg_content']	= 'la C.U.R.P. ya ha sido registrada por otro usuario';
							}
							
							// update
							elseif ( $userinfo->user_email == $usereditattempt_info['user_email'] && $userinfo->user_curp != $usereditattempt_info['user_curp'] && !$this->preescolar_users_mdl->curp_exists($usereditattempt_info['user_curp']) ) {
								if ( $this->preescolar_users_mdl->updateUserData($this->input->post('userid'), $usereditattempt_info) == 200 ) {
									$usereditattempt_data['msg_type']		= 'success';
									$usereditattempt_data['msg_content']	= 'su información ha sido actualizada correctamente';
								}
								else {
									$usereditattempt_data['msg_type']		= 'alert';
									$usereditattempt_data['msg_content']	= 'no se ha podido actualizar su información';
								}
							}
							
							// update
							elseif ( $userinfo->user_curp == $usereditattempt_info['user_curp'] && $userinfo->user_email != $usereditattempt_info['user_email'] && !$this->preescolar_users_mdl->email_exists($usereditattempt_info['user_email']) ) {
								if ( $this->preescolar_users_mdl->updateUserData($this->input->post('userid'), $usereditattempt_info) == 200 ) {
									$usereditattempt_data['msg_type']		= 'success';
									$usereditattempt_data['msg_content']	= 'su información ha sido actualizada correctamente';
								}
								else {
									$usereditattempt_data['msg_type']		= 'alert';
									$usereditattempt_data['msg_content']	= 'no se ha podido actualizar su información';
								}
							}
							
						}
					}
					
					$this->load->view('preescolar/dashboard/root/window-user-edit-profile-messenger', $usereditattempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: useredit_attempt
		
		
		
		
		
		/**
		 * 
		 * delete_user
		 */
		public function delete_user ( ) {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->users->delete_user($this->input->post('userid'));
					
					
					// beg: updating the system
					$this->db->where('app_user_id', $this->input->post('userid'));
					$this->db->update('app', array('app_user_id' => $this->session->userdata('cas-preescolar-userid')));
					
					$this->db->where('answer_user_id', $this->input->post('userid'));
					$this->db->update('app_answers', array('answer_user_id' => $this->session->userdata('cas-preescolar-userid')));
					
					$this->db->where('question_user_id', $this->input->post('userid'));
					$this->db->update('app_questions', array('question_user_id' => $this->session->userdata('cas-preescolar-userid')));
					
					$this->db->where('school_user_id', $this->input->post('userid'));
					$this->db->update('schools', array('school_user_id' => $this->session->userdata('cas-preescolar-userid')));
					
					$this->db->where('group_user_id', $this->input->post('userid'));
					$this->db->update('schools_groups', array('group_user_id' => $this->session->userdata('cas-preescolar-userid')));
					
					$this->db->where('student_user_id', $this->input->post('userid'));
					$this->db->update('schools_groups_students', array('student_user_id' => $this->session->userdata('cas-preescolar-userid')));
					// end: updating the system
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: delete_user
		
		
		
		
		
		/**
		 * 
		 * window_add_app
		 */
		public function window_add_app () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					$this->load->view('preescolar/dashboard/root/window-add-app');
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: window_add_app
		
		
		
		
		
		/**
		 * 
		 * window_add_app_attempt
		 */
		public function window_add_app_attempt () {
			$add_app_data = array(
				'app_id'				=> 'NULL',
				'app_user_id'			=> $this->session->userdata('cas-preescolar-userid'),
				'app_name'				=> $this->input->post('app_name'),
				'app_description'		=> $this->input->post('app_description'),
				'app_is_active'			=> 0,
				'app_date_created'		=> date('Y-m-d H:i:s'),
				'app_school_level'		=> 1,
				'app_date_activated'	=> strtotime($this->input->post('app_date')),
				'app_date_started'		=> date('Y-m-d H:i:s')
			);
			
			$add_app_messages = array(
				'msg_type'			=> 'empty',
				'msg_content'		=> 'no message'
			);
			
			if ( strlen(trim($add_app_data['app_name'])) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe colocar el nombre de la aplicación';
			}
			elseif ( strlen(trim($this->input->post('app_date'))) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe seleccionar la fecha de activación';
			}
			elseif ( strlen(trim($add_app_data['app_description'])) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe agregar una breve descripción de los datos';
			}
			elseif ( strlen(trim($add_app_data['app_name'])) > 0 && strlen(trim($this->input->post('app_date'))) > 0 && strlen(trim($add_app_data['app_description'])) > 0 ) {
				if ( $this->apps->add_app($add_app_data) ) {
					$add_app_messages['msg_type'] = 'success';
					$add_app_messages['msg_content'] = 'la aplicación se agrego correctamente';
				}
				else {
					$add_app_messages['msg_type'] = 'error';
					$add_app_messages['msg_content'] = 'la aplicación no se pudo agregar al sistema, por favor intentelo más tarde';
				}
			}
			
			$this->load->view('preescolar/dashboard/root/windows-add-app-messenger', $add_app_messages);
		}
		// end: window_add_app_attempt
		
		
		
		
		
		/**
		 * 
		 * window_update_app
		 */
		public function window_update_app () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$window_update_app_data = array(
						'appinfo' => $this->apps->get_app($this->input->post('appid'))
					);
					
					$this->load->view('preescolar/dashboard/root/window-update-app', $window_update_app_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: window_update_app
		
		
		
		
		
		/**
		 * 
		 * window_update_app_attempt
		 */
		public function window_update_app_attempt () {
			$add_app_data = array(
				'app_name'				=> $this->input->post('app_name'),
				'app_description'		=> $this->input->post('app_description'),
				'app_is_active'			=> 0,
				'app_date_activated'	=> strtotime($this->input->post('app_date'))
			);
			
			$add_app_messages = array(
				'msg_type'			=> 'empty',
				'msg_content'		=> 'no message'
			);
			
			if ( strlen(trim($add_app_data['app_name'])) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe colocar el nombre de la aplicación';
			}
			elseif ( strlen(trim($this->input->post('app_date'))) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe seleccionar la fecha de activación';
			}
			elseif ( strlen(trim($add_app_data['app_description'])) <= 0 ) {
				$add_app_messages['msg_type'] = 'error';
				$add_app_messages['msg_content'] = 'debe agregar una breve descripción de los datos';
			}
			elseif ( strlen(trim($add_app_data['app_name'])) > 0 && strlen(trim($this->input->post('app_date'))) > 0 && strlen(trim($add_app_data['app_description'])) > 0 ) {
				if ( $this->apps->update_app($this->input->post('app_id'), $add_app_data) ) {
					$add_app_messages['msg_type'] = 'success';
					$add_app_messages['msg_content'] = 'la aplicación se actualizo correctamente';
				}
				else {
					$add_app_messages['msg_type'] = 'error';
					$add_app_messages['msg_content'] = 'la aplicación no se pudo actualizar, por favor intentelo más tarde';
				}
			}
			
			$this->load->view('preescolar/dashboard/root/window-update-app-messenger', $add_app_messages);
		}
		// end: window_update_app_attempt
		
		
		
		
		
		/**
		 * 
		 * toggle_app_status
		 */
		public function toggle_app_status () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$appinfo = $this->apps->get_app($this->input->post('appid'));
					
					if ( $appinfo->app_is_active ) {
						$this->db->where(array('app_id' => $this->input->post('appid'), 'app_school_level' => 1));
						$this->db->update('app', array('app_is_active' => FALSE));
						
					}
					else {
						$this->db->where(array('app_school_level' => 1));
						$this->db->update('app', array('app_is_active' => FALSE));
						$this->db->where(array('app_id' => $this->input->post('appid'), 'app_school_level' => 1));
						$this->db->update('app', array('app_is_active' => TRUE));
						
					}
					
					$toggle_app_status_data = array(
						'app_id'		=> $appinfo->app_id,
						'app_status'	=> $appinfo->app_is_active
					);
					
					$this->load->view('preescolar/dashboard/root/root-toogle-app-status', $toggle_app_status_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: toggle_app_status
		
		
		
		
		
		/**
		 * delete_app
		 */
		public function delete_app () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					
					$this->apps->delete_app($this->input->post('appid'));
					
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: delete_app
		
		
		
		
		
		/**
		 * 
		 * apps_view
		 */
		public function apps_view () {
			if ( $this->input->is_ajax_request() ) {
			
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {					
					$apps_view_data = array(
						'app_questions'		=> $this->apps->get_app_questions($this->input->post('appid')),
						'app'				=> $this->apps->get_app($this->input->post('appid'))
					);
					
					$this->load->view('preescolar/dashboard/root/root-app-view', $apps_view_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: apps_view
	}