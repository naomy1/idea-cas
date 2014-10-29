<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Preescolar_users extends CI_Controller {
		
		
		
		
		
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
		 * the index
		 */
		public function index () {
			$this->load->view('errors/errors-nndsaa');
		}
		
		
		
		
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
					$useredit_info = $this->preescolar_users_mdl->get_userData_by_ID($this->session->userdata('cas-preescolar-userid'));
					$useredit_data = array(
						'edituser_userid'			=> $useredit_info->user_id,
						'edituser_username'			=> $useredit_info->user_name,
						'edituser_firstname'		=> $useredit_info->user_fname,
						'edituser_lastname'			=> $useredit_info->user_lname,
						'edituser_usermail'			=> $useredit_info->user_email,
						'edituser_usercurp'			=> $useredit_info->user_curp,
						'edituser_userusaer'		=> $useredit_info->user_usaer,
						'edituser_userusaerzone'	=> $useredit_info->user_usaer_supervision_zone,
						'edituser_usercrosee'		=> $useredit_info->user_crosee
					);
					$this->load->view('preescolar/window/window-user-edit-profile', $useredit_data);
					
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
						'user_crosee'						=> $this->input->post('usercrosee')
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
					
					$this->load->view('preescolar/window/window-user-edit-profile-messenger', $usereditattempt_data);
					
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
		 * passwdedit
		 * 
		 * function to get the edit password form
		 */
		public function passwdedit () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$passwdedit_data = array(
						'editpasswd_userid' => $this->session->userdata('cas-preescolar-userid')
					);
					
					$this->load->view('preescolar/window/window-user-edit-passwd', $passwdedit_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		// end: passwdedit
		
		
		
		
		
		/**
		 * 
		 * passwdedit_attempt
		 * function to attempt to save the new password
		 */
		public function passwdedit_attempt () {
			if ( $this->input->is_ajax_request() ) {
				if ( $this->session->userdata('cas-preescolar-userid') && $this->session->userdata('cas-preescolar-username') && $this->session->userdata('cas-preescolar-userdashboard') ) {
					
					$this->load->model('preescolar_users_mdl');
					$userpasswd = $this->preescolar_users_mdl->get_userData_by_ID($this->input->post('userid'), 'user_passwd');
					
					$passwdeditattempt_data = array(
						'msg_type'			=> 'alert',
						'msg_content'		=> 'no se ha podido actualizar su contraseña'
					);
					
					if ( $userpasswd->user_passwd != md5($this->input->post('passwd_actual')) ) {
						$passwdeditattempt_data['msg_type']		= 'error';
						$passwdeditattempt_data['msg_content']	= 'debe dar una contraseña correcta';
					}
					elseif ( strlen(trim($this->input->post('passwd_new'))) < 3 ) {
						$passwdeditattempt_data['msg_type']		= 'error';
						$passwdeditattempt_data['msg_content']	= 'las contraseñas es demasiado corta';
					}
					elseif ( $this->input->post('passwd_new') != $this->input->post('passwd_renew') ) {
						$passwdeditattempt_data['msg_type']		= 'error';
						$passwdeditattempt_data['msg_content']	= 'las contraseñas no coinciden';
					}
					elseif ( $userpasswd->user_passwd == md5($this->input->post('passwd_actual')) && strlen(trim($this->input->post('passwd_new'))) >= 3 && $this->input->post('passwd_new') == $this->input->post('passwd_renew') ) {
						$passwdeditattempt_info = array(
							'user_passwd' => md5($this->input->post('passwd_new'))
						);
						
						if ( $this->preescolar_users_mdl->updateUserData($this->input->post('userid'), $passwdeditattempt_info) == 200 ) {
							$passwdeditattempt_data['msg_type']		= 'success';
							$passwdeditattempt_data['msg_content']	= 'su contraseña ha sido actualizada correctamente';
						}
						else {
							$passwdeditattempt_data['msg_type']		= 'alert';
							$passwdeditattempt_data['msg_content']	= 'no se ha podido actualizar su contraseña';
						}
						
					}
					
					$this->load->view('preescolar/window/window-user-edit-passwd-messenger', $passwdeditattempt_data);
				}
				else
					$this->load->view('errors/errors-session-ended');
			}
			else
				$this->load->view('errors/errors-nndsaa');
		}
		 

	}