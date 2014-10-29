<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	class Secundaria_students extends CI_Controller {
		
		
		
		
		
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$this->load->model('secundaria_schools_mdl');
					$this->load->model('secundaria_groups_mdl');
					$this->load->model('secundaria_students_mdl');
					$this->load->model('secundaria_apps_mdl', 'apps');
					
					$group_list_data = array(
						'schoolInfo'		=> $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'groupInfo'			=> $this->secundaria_groups_mdl->getGroupInfo($this->input->post('groupID')),
						'groupStudents'		=> $this->secundaria_students_mdl->getGroupStudents($this->input->post('groupID')),
						'ap_active'			=> $this->apps->get_active_app()
					);
					
					$this->load->view('secundaria/students/students-index', $group_list_data);
					
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
		 * window_addstudent
		 * 
		 * function to show the add student form
		 */
		public function window_addstudent () {
			
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$addstudent_data = array(
						'addstudent_schoolid'		=> $this->input->post('schoolID'),
						'addstudent_schoolcct'		=> $this->input->post('schoolCCT'),
						'addstudent_groupid'		=> $this->input->post('groupID'),
						'addstudent_grade'			=> $this->input->post('grade')
					);
					
					$this->load->view('secundaria/students/windows/windows-add-student', $addstudent_data);
					
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					$this->load->model('secundaria_groups_mdl', 'groups');
					$addstudentattempt_info = array(
						'student_id'			=> 'NULL',
						'student_fname'			=> $this->input->post('fname'),
						'student_lname'			=> $this->input->post('lname'),
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_sex'			=> $this->input->post('sex'),
						'student_user_id'		=> $this->session->userdata('cas-secundaria-userid'),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_grade'			=> $this->groups->getGroupInfo($this->input->post('groupID'), 'group_grade')->group_grade,
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 3
					);
					
					$addstudentattempt_chk = array(
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 3,
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
						$this->load->model('secundaria_students_mdl');
						
						if ( !$this->secundaria_students_mdl->student_exists($addstudentattempt_chk) ) {
							
							if ( $this->secundaria_students_mdl->addstudent($addstudentattempt_info) ) {
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
					
					$this->load->view('secundaria/students/windows/windows-add-student-messenger', $addstudentattempt_data);
					
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
		 * deletestudent_attempt
		 * 
		 * function to delete student
		 */
		public function deletestudent_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					$studentID = $this->input->post('studentID');
					$this->load->model('secundaria_students_mdl');
					$this->secundaria_students_mdl->deletestudent($studentID);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: deletestudent_attempt
		
		
		
		
		
		/**
		 * 
		 * window_editstudent
		 * 
		 * function to load the window to edit student
		 */
		public function window_editstudent () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$this->load->model('secundaria_students_mdl');
					
					$studentInfo = $this->secundaria_students_mdl->getStudentInfo($this->input->post('studentID'));
					
					$editstudent_data = array(
						'editstudent_id'		=> $studentInfo->student_id,
						'editstudent_fname'		=> $studentInfo->student_fname,
						'editstudent_lname'		=> $studentInfo->student_lname,
						'editstudent_curp'		=> $studentInfo->student_curp,
						'editstudent_sex'		=> $studentInfo->student_sex,
						'editstudent_schoolid'	=> $studentInfo->student_school_id,
						'editstudent_schoolcct'	=> $studentInfo->student_school_cct,
						'editstudent_groupid'	=> $studentInfo->student_group_id,
					);
					
					$this->load->view('secundaria/students/windows/windows-editstudent', $editstudent_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: window_editstudent
		
		
		
		
		
		/**
		 * 
		 * editstudent_attempt
		 * 
		 * function to attempt to edit student info
		 */
		public function editstudent_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					
					
					$editstudentattempt_info = array(
						'student_fname'			=> $this->input->post('fname'),
						'student_lname'			=> $this->input->post('lname'),
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_sex'			=> $this->input->post('sex')
					);
					
					$editstudentattempt_chk = array(
						'student_curp'			=> strtoupper($this->input->post('curp')),
						'student_school_id'		=> $this->input->post('schoolID'),
						'student_school_cct'	=> $this->input->post('schoolCCT'),
						'student_group_id'		=> $this->input->post('groupID'),
						'student_school_level'	=> 3,
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
						
						$this->load->model('secundaria_students_mdl');
						
						$studentInfo = $this->secundaria_students_mdl->getStudentInfo($this->input->post('studentID'), 'student_id, student_curp');
						
						if ( strtolower($studentInfo->student_curp) == strtolower($editstudentattempt_info['student_curp']) ) {
							if ( $this->secundaria_students_mdl->updateStudent($this->input->post('studentID'), $editstudentattempt_info) ) {
								$editstudentattempt_data['msg_type']		= 'success';
								$editstudentattempt_data['msg_content']		= 'la información del alumno se actualizo correctamente';
							}
							else{
								$editstudentattempt_data['msg_type']		= 'alert';
								$editstudentattempt_data['msg_content']		= 'no se pudo hacer la actualización, intentelo más tarde';
							}
						}
						else {
							$studentInto_curp = $this->secundaria_students_mdl->getStudentInfo_by_curp($editstudentattempt_info['student_curp'], 'student_id, student_curp, student_is_deleted, student_is_down');
							
							if ( $studentInto_curp ) {
								if ( $studentInfo->student_id == $studentInto_curp->student_id ) {
									
									if ( $this->secundaria_students_mdl->updateStudent($this->input->post('studentID'), $editstudentattempt_info) ) {
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
										
										if ( $this->secundaria_students_mdl->updateStudent($this->input->post('studentID'), $editstudentattempt_info) ) {
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
								if ( $this->secundaria_students_mdl->updateStudent($this->input->post('studentID'), $editstudentattempt_info) ) {
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
					
					$this->load->view('secundaria/students/windows/windows-editstudent-messenger', $editstudentattempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: editstudent_attempt
	}
