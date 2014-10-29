<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Secundaria_groups extends CI_Controller {
		
		
		
		
		
		/***
		 * the constructor
		 */
		public function __construct () {
			parent::__construct();
		}
		// end: constructor
		
		
		
		
		
		/**
		 * 
		 * the index
		 * 
		 * function to show the main page of the controller
		 */
		public function index () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ) {
					
					$this->load->model('secundaria_schools_mdl');
					$this->load->model('secundaria_groups_mdl');
					
					$index_data = array(
						'schoolInfo' => $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('schoolID')),
						'schoolsGroups' => $this->secundaria_groups_mdl->getSchoolGroups($this->input->post('schoolID'))
					);
					
					$this->load->view('secundaria/groups/groups-index', $index_data);
					
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: the index
		
		
		
		
		
		/**
		 * 
		 * window_addgroup
		 * 
		 * function to load the form to add group
		 */
		 public function window_addgroup () {
		 	if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ){
					
					$addgroup_data = array(
						'addgroup_schoolID' => $this->input->post('schoolID')
					);
					
					$this->load->view('secundaria/groups/windows/windows-groups-addgroup', $addgroup_data);
					
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ){
					
					$this->load->model('secundaria_schools_mdl');
					
					$addgroupattempt_info = array(
						'group_id'				=> NULL,
						'group_name'			=> strtoupper($this->input->post('group_name')),
						'group_grade'			=> $this->input->post('group_grade'),
						'group_school_level'	=> 3,
						'group_user_id'			=> $this->session->userdata('cas-secundaria-userid'),
						'group_school_id'		=> $this->input->post('group_schoolID'),
						'group_school_cct'		=> $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('group_schoolID'), 'school_cct')->school_cct
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
						
						$this->load->model('secundaria_groups_mdl');
						
						$chk_group = array(
							'group_name'			=> strtoupper($this->input->post('group_name')),
							'group_grade'			=> $this->input->post('group_grade'),
							'group_school_level'	=> 3,
							'group_school_id'		=> $this->input->post('group_schoolID'),
							'group_school_cct'		=> $this->secundaria_schools_mdl->getSchoolInfo($this->input->post('group_schoolID'), 'school_cct')->school_cct
						);
						
						if ( !$this->secundaria_groups_mdl->group_exists($chk_group) ) {
							if ( $this->secundaria_groups_mdl->addgroup($addgroupattempt_info) ) {
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
					
					$this->load->view('secundaria/groups/windows/windows-groups-addgroup-messenger', $addgroupattempt_data);
					
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ){
					
					$this->load->model('secundaria_groups_mdl');
					$this->secundaria_groups_mdl->deletegroup($this->input->post('groupID'));
					
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ){
					
					$this->load->model('secundaria_groups_mdl');
					
					$editgroup_data = array(
						'editgroup_groupinfo' => $this->secundaria_groups_mdl->getGroupInfo($this->input->post('groupID'))
					);
					
					$this->load->view('secundaria/groups/windows/windows-groups-editgroup', $editgroup_data);
					
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
				if ( $this->session->userdata('cas-secundaria-userid') && $this->session->userdata('cas-secundaria-username') && $this->session->userdata('cas-secundaria-userdashboard') ){
					
					$this->load->model('secundaria_groups_mdl');
					
					$groupInfo = $this->secundaria_groups_mdl->getGroupInfo($this->input->post('groupID'));
					
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
						
						if ( ($groupexists = $this->secundaria_groups_mdl->group_exists_edit ($editgroup_info)) == 0 ) {
							
							if ( $this->secundaria_groups_mdl->edit_group($this->input->post('groupID'), $editgroup_info) ) {
								
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
					
					$this->load->view('secundaria/groups/windows/windows-groups-editgroup-messenger', $editgroup_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: editgroup_attempt
	}
