<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Secundaria_schools extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * __construct
		 * 
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		
		
		
		
		
		/**
		 * 
		 * index
		 * 
		 * the index page
		 */
		public function index () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$this->load->model('secundaria_schools_mdl');
					$schools_data = array(
						'schools'		=> $this->secundaria_schools_mdl->getUserSchools($this->session->userdata('cas-secundaria-userid'))
					);
					
					$this->load->view('secundaria/dashboard/dashboard-teacher-schools-index', $schools_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		
		
		
		
		
		/**
		 * 
		 * addschool
		 * 
		 * function to load the form to add school
		 */
		public function addschool () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					$this->load->model('secundaria_schools_mdl');
					$addschool_data = array(
						'addschool_delegations' => $this->secundaria_schools_mdl->getDelegations()
					);
					
					$this->load->view('secundaria/schools/windows/windows-addschool', $addschool_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: addschool
		
		
		
		
		
		/**
		 * 
		 * addschool_attempt
		 * 
		 * function to attempt to save school in the database
		 */
		public function addschool_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					$addschoolattempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde',
						'msg_school_added'	=> false
					);
					
					$this->load->model('secundaria_users_mdl');
					$userinfo = $this->secundaria_users_mdl->get_userData_by_ID($this->session->userdata('cas-secundaria-userid'), 'user_crosee');
					$addschoolattempt_info = array (
						'school_id'								=> 'NULL',
						'school_delegation_id'					=> $this->input->post('delegation'),
						'school_user_id'						=> $this->session->userdata('cas-secundaria-userid'),
						'school_cct'							=> $this->input->post('cct'),
						'school_crosee'							=> $userinfo->user_crosee,
						'school_usaer'							=> $this->input->post('usaer'),
						'school_usaer_supervision_zone'			=> $this->input->post('usaer_supervisionzone'),
						'school_turn'							=> $this->input->post('turn'),
						'school_supervision_zone'				=> $this->input->post('supervisionzone'),
						'school_address'						=> $this->input->post('address'),
						'school_colony'							=> $this->input->post('colony'),
						'school_zipcode'						=> $this->input->post('zipcode'),
						'school_level'							=> 3,
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
						
						$this->load->model('secundaria_schools_mdl');
						
						if ( !$this->secundaria_schools_mdl->cct_exists($addschoolattempt_info['school_cct']) ) {
							// si no existe el CCT
							if ( $schoolID = $this->secundaria_schools_mdl->addSchool($addschoolattempt_info) ) {
								
								$relationship_info = array(
									'cas_users_user_id'			=> $addschoolattempt_info['school_user_id'],
									'cas_schools_school_id'		=> $schoolID,
									'cas_schools_school_cct'	=> $addschoolattempt_info['school_cct']
								);
								if ( $this->secundaria_schools_mdl->makeRelationship($relationship_info) ) {
									
									
									
									// creamos grupos en 1er grado
									$this->secundaria_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 1, 'groups' => (int)$this->input->post('grade_one')));
									// creamos grupos en 2do grado
									$this->secundaria_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 2, 'groups' => (int)$this->input->post('grade_two')));
									// creamos grupos en 3er grado
									$this->secundaria_schools_mdl->makeGroups(array('school_id' => $schoolID, 'school_cct' => $addschoolattempt_info['school_cct'], 'grade' => 3, 'groups' => (int)$this->input->post('grade_three')));
									
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
							$this->load->model('secundaria_schools_mdl');
							$schoolInfo = $this->secundaria_schools_mdl->getSchoolInfo_by_cct($addschoolattempt_info['school_cct'], 'school_id');
							
							$relationship_info = array(
								'cas_users_user_id'			=> $addschoolattempt_info['school_user_id'],
								'cas_schools_school_id'		=> $schoolInfo->school_id,
								'cas_schools_school_cct'	=> $addschoolattempt_info['school_cct']
							);
							
							
							if ( $this->secundaria_schools_mdl->makeRelationship($relationship_info) ) {
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
					$this->load->view('secundaria/schools/windows/windows-addschool-messenger', $addschoolattempt_data);
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
		 * deleteSchool
		 * 
		 * function to delete school from database
		 */
		public function deleteSchool_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$schoolID = $this->input->post('schoolID');
					$this->load->model('secundaria_schools_mdl');
					$this->secundaria_schools_mdl->deleteSchool($schoolID);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: deleteSchool
		
		
		
		
		
		/**
		 * 
		 * editSchool
		 * 
		 * function to load the windows with the info of the school
		 */
		public function editSchool () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$this->load->model('secundaria_schools_mdl');
					
					$schoolInfo = $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('schoolID'));
					
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
						'editschool_delegations'				=> $this->secundaria_schools_mdl->getDelegations()
					);
					
					$this->load->view('secundaria/schools/windows/windows-editschool', $editSchool_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end : editSchool
		
		
		
		
		
		/**
		 * 
		 * editSchool_attempt
		 * 
		 * function to attempt to edit school
		 */
		public function editSchool_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					
					$editSchoolAttempt_data = array(
						'msg_type'			=> 'error',
						'msg_content'		=> 'no se ha podido realizar la acción solicitada, por favor intentelo más tarde'
					);
					
					$this->load->model('secundaria_schools_mdl');
					
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
					
					$schoolCCT =  $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('schoolID'), 'school_cct');
					
					
					if ( $schoolCCT->school_cct == $editSchoolAttempt_info['school_cct'] ) {
						if ( $this->secundaria_schools_mdl->updateSchoolInfo($this->input->post('schoolID'), $editSchoolAttempt_info) ) {
							$editSchoolAttempt_data['msg_type']			= 'success';
							$editSchoolAttempt_data['msg_content']		= 'la escuela se ha actualizado correctamente';
						}
						else {
							$editSchoolAttempt_data['msg_type']			= 'error';
							$editSchoolAttempt_data['msg_content']		= 'no se ha podido actualizar la información de la escuela, por favor intentelo más tarde';
						}
					}
					else {
						if ( $this->secundaria_schools_mdl->cct_exists($editSchoolAttempt_info['school_cct']) ){
							$editSchoolAttempt_data['msg_type']			= 'alert';
							$editSchoolAttempt_data['msg_content']		= 'el CCT que proporciono ya existe<br />para pertenecer a esta escuela necesita registrarla';
						}
						else {
							if ( $this->secundaria_schools_mdl->updateSchoolInfo($this->input->post('schoolID'), $editSchoolAttempt_info) ) {
								$editSchoolAttempt_data['msg_type']			= 'success';
								$editSchoolAttempt_data['msg_content']		= 'la escuela se ha actualizado correctamente';
							}
							else {
								$editSchoolAttempt_data['msg_type']			= 'error';
								$editSchoolAttempt_data['msg_content']		= 'no se ha podido actualizar la información de la escuela, por favor intentelo más tarde';
							}
						}
					}
					
					
					$this->load->view('secundaria/schools/windows/windows-editschool-messenger', $editSchoolAttempt_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
	}