<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Secundaria_sessions extends CI_Controller {
		
		
		
		
		
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
		 * login_attempt
		 * 
		 * function to try to login in the system
		 */
		public function login_attempt () {
			
			if ( $this->input->is_ajax_request() ) {
				
				$loginattempt_data = array(
					'msg_type'		=> 'empty',
					'msg_content'	=> 'no message'
				);
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$this->load->model('secundaria_sessions_mdl');
				
				
				
				/**
				 * 
				 * user validation to see if the user exists in the DB
				 * 
				 * all the codes are from the http status code
				 * 
				 * @see http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
				 */
				
				switch ( $validateCode =  $this->secundaria_sessions_mdl->user_validate($username, $password, 3) ) {
					
					// the validation is ok
					case 200 :
						switch ( $sessionCode = $this->secundaria_sessions_mdl->make_session($username) ) {
							
							// the session made ok
							case 200:
								$loginattempt_data['msg_type']		= 'success';
								$loginattempt_data['msg_content']	= 'espere un momento mientras se carga su sesión';
								break;
							
							// the system can not find the username
							case 404:
							default:
								$loginattempt_data['msg_type']		= 'error';
								$loginattempt_data['msg_content']	= $sessionCode . ' no se ha podido iniciar su sesión';
						}
						
						break;
					
					// the system can not find the username
					case 404 :
						$loginattempt_data['msg_type']		= 'error';
						$loginattempt_data['msg_content']	= $validateCode . ' el nombre de usuario o contraseña no coinciden';
						break;
					
					// the user data is wrong
					case 406 :
						$loginattempt_data['msg_type']		= 'alert';
						$loginattempt_data['msg_content']	= $validateCode . ' el nombre de usuario o contraseña no coinciden';
						break;
					
					// if the system return anything not recognized in the status code
					default:
						$loginattempt_data['msg_type']		= 'alert';
						$loginattempt_data['msg_content']	= $validateCode . ' el nombre de usuario o contraseña no coinciden';
				}
				
				$this->load->view('secundaria/form/form-login-messenger', $loginattempt_data);
				
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
			
		}
		// end: login attempt
		
		
		
		
		
		/**
		 * 
		 * forgotpasswd_attempt
		 * 
		 * function to attempt to get the password from the user list identified
		 * by an email
		 */
		public function forgotpasswd_attempt () {
			if ( $this->input->is_ajax_request() ) {
				
				$forgotpasswdattempt_data = array(
					'msg_type'		=> 'empty',
					'msg_content'	=> 'no message'
				);
				
				$usermail = $this->input->post('usermail');
				
				$this->load->model('secundaria_users_mdl');
				
				
				// chek for the user exists
				if ( ($userinfo = $this->secundaria_users_mdl->get_userData_by_email($usermail, 'user_passwd_key, user_name, user_fname, user_lname')) != NULL ) {
					
					// making the message
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					
					// Additional headers
					$headers .= 'To: "' . $userinfo->user_fname . ' ' . $userinfo->user_lname . '" <' . $usermail . '>' . "\r\n" .
					'From: "Recuperación de contraseña : Sistema Idea-CAS" <dudastecnicas.cas@sepdf.gob.mx>' . "\r\n" .
					'Reply-To: dudastecnicas.cas@sepdf.gob.mx' . "\r\n" .
    				'X-Mailer: PHP/' . phpversion();
					
					/*$usermsg = '
					<b>Estimado(a) ' . $userinfo->user_fname . ' ' . $userinfo->user_lname . '</b>
					
					Usted ha hecho una solicitud de recuperación de contraseña en el Sistema IdeA-CAS de la Dirección de Educación Pública.
					
					Sus datos son los soguientes:
					
					<table cellpadding="0" cellspacing="0"><tr><td>usuario</td><td><b>' . $userinfo->user_name . '</b></td></tr><tr><td>contraseña</td><td><b>' . base64_decode($userinfo->user_passwd_key) . '</b></td></tr></table>
					
					http://educacionespecial.sepdf.gob.mx/cas/
					';
					*/
					
					$usermsg = '
						<h1>Recupere su contraseña</h1>
						Perdió su contraseña en el sistema IdeA-CAS de la Dirección de Educación Especial?<br /><br />
						
						Está recibiendo este correo electrónico ya que su contraseña fue solicitada desde el sistema de recuperación de contraseñas de IdeA-CAS.<br /><br />
						
						<h3>Sus datos son:</h3>
						<table cellpadding="5" cellspacing="5" border="0">
							<tr>
								<td>usuario</td>
								<td><b>' . $userinfo->user_name . '</b></td>
							</tr>
							<tr>
								<td>contraseña</td>
								<td><b>' . base64_decode($userinfo->user_passwd_key) . '</b></td>
							</tr>
						</table>
						<br /><br />
						educacionespecial.sepdf.gob.mx/cas/
						<br /><br />
						Gracias.<br />
						Equipo de Desarrollo Web de la DEE
						<br /><br />
						<span style="font-size: 10px;">Dirección de Educación Especial. Calzada de Tlalpan 515. Colonia Álamos. Delegación Benito Juárez, México, Distrito Federal.<br />C.P. 03400 Teléfonos 3601-8400 extensiones 44216 y 44217. Contacto: dee@sep.gob.mx</span>
					';
					
					// sending the email
					// the message was sent successfuly
					
					$this->load->library('email');
					
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					
					$this->email->initialize($config);
					
					$this->email->from('dudastecnicas.cas@sepdf.gob.mx', 'Dudas Técnicas del Sistema IdeA-CAS');
					$this->email->to($usermail);
					
					$this->email->subject('Recuperación de contraseña : Sistema IdeA-CAS');
					$this->email->message($usermsg);
					
					// if ( @mail($usermail, 'Recuperación de contraseña : Sistema IdeA-CAS', $usermsg, $headers) ) {
					if ( $this->email->send() ) {
						$forgotpasswdattempt_data['msg_type']		= 'success';
						$forgotpasswdattempt_data['msg_content']	= 'su contraseña ha sido enviada a su correo electrónico';
					}
					
					// fail to send the message
					else {
						$forgotpasswdattempt_data['msg_type']		= 'error';
						$forgotpasswdattempt_data['msg_content']	= 'El sistema no pudo enviar el mensaje';
					}
				}
				
				// the email wasn't found
				else {
					$forgotpasswdattempt_data['msg_type']		= 'error';
					$forgotpasswdattempt_data['msg_content']	= 'el correo que nos proporciono no ha sido registrado';
				}
				
				// loading the view
				$this->load->view('secundaria/form/form-forgotpasswd-messenger', $forgotpasswdattempt_data);
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		
		
		
		
		
		/**
		 * 
		 * registeruser_attempt
		 * 
		 * function to attempt to register user in the system
		 */
		public function registeruser_attempt () {
			if ( $this->input->is_ajax_request() ) {
				
				$registeruser_data = array(
					'msg_type'			=> 'empty',
					'msg_content'		=> 'no message',
					'msg_field_marked'	=> ''
				);
				
				
				
				
				$registeruser_info = array(
					'user_firstname' => $this->input->post('firstnames'),
					'user_lastname' => $this->input->post('lastnames'),
					'user_useremail' => $this->input->post('useremail'),
					'user_usercurp' => $this->input->post('usercurp'),
					'user_userusaer' => $this->input->post('userusaer'),
					'user_userusaerzone' => $this->input->post('userusaerzone'),
					'user_usercrosee' => $this->input->post('usercrosee'),
					'user_username' => $this->input->post('username'),
					'user_password' => $this->input->post('password'),
					'user_repasswd' => $this->input->post('repasswd')
				);
				
				
				if ( strlen(trim($registeruser_info['user_firstname'])) == 0 ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'debe colocar su(s) nombre(s)';
					$registeruser_data['msg_field_marked']	= '#register-firstnames';
				}
				elseif ( strlen(trim($registeruser_info['user_lastname'])) == 0 ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'debe colocar su(s) apellido(s)';
					$registeruser_data['msg_field_marked']	= '#register-lastnames';
				}
				elseif ( !$this->strings_mdl->is_email($registeruser_info['user_useremail']) ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'su correo electrónico es incorrecto';
					$registeruser_data['msg_field_marked']	= '#register-useremail';
				}
				elseif ( !$this->strings_mdl->is_curp($registeruser_info['user_usercurp']) ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'su C.U.R.P. es incorrenta';
					$registeruser_data['msg_field_marked']	= '#register-usercurp';
				}
				elseif ( strlen(trim($registeruser_info['user_userusaer'])) == 0 ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'debe colocar la U.S.A.E.R. a la que pertenece';
					$registeruser_data['msg_field_marked']	= '#register-userusaer';
				}
				elseif ( strlen(trim($registeruser_info['user_userusaerzone'])) == 0 ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'debe colocar la zona a la que pertenece la U.S.A.E.R.';
					$registeruser_data['msg_field_marked']	= '#register-userusaerzone';
				}
				elseif ( $registeruser_info['user_usercrosee'] == '0' ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'debe seleccionar la C.R.O.S.E.E. a la que pertenece';
					$registeruser_data['msg_field_marked']	= '#register-usercrose';
				}
				elseif ( !$this->strings_mdl->is_username($registeruser_info['user_username']) ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'el nombre de usario no es valido para el sistema';
					$registeruser_data['msg_field_marked']	= '#register-username';
				}
				elseif ( strlen(trim($registeruser_info['user_password'])) < 3) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'su contraseña es demasiado corta';
					$registeruser_data['msg_field_marked']	= '#register-password, #register-repasswd';
				}
				elseif ( $registeruser_info['user_password'] != $registeruser_info['user_repasswd'] ) {
					$registeruser_data['msg_type']			= 'error';
					$registeruser_data['msg_content']		= 'la contraseña no coincide';
					$registeruser_data['msg_field_marked']	= '#register-password, #register-repasswd';
				}
				elseif ( strlen(trim($registeruser_info['user_firstname'])) > 0 && strlen(trim($registeruser_info['user_lastname'])) > 0 && $this->strings_mdl->is_email($registeruser_info['user_useremail']) && $this->strings_mdl->is_curp($registeruser_info['user_usercurp']) && strlen(trim($registeruser_info['user_userusaer'])) > 0 && strlen(trim($registeruser_info['user_userusaerzone'])) > 0 && $registeruser_info['user_usercrosee'] > '0' && $this->strings_mdl->is_username($registeruser_info['user_username']) && strlen(trim($registeruser_info['user_password'])) > 3 && $registeruser_info['user_password'] == $registeruser_info['user_repasswd'] ) {
					$this->load->model('secundaria_users_mdl');
					if ( !$this->secundaria_users_mdl->username_exists($registeruser_info['user_username']) )
						if ( !$this->secundaria_users_mdl->email_exists($registeruser_info['user_useremail']) )
							if ( !$this->secundaria_users_mdl->curp_exists ($registeruser_info['user_usercurp'], 3) )
								if ( $this->secundaria_users_mdl->create_user($registeruser_info) ){
									
									$usermail = $registeruser_info['user_useremail'];
									
									$registeruser_data['msg_type']			= 'success';
									$registeruser_data['msg_content']		= 'registro correcto, espere un momento por favor';
									$registeruser_data['msg_field_marked']	= '';
									$usermsg = '
										<h1>Bienvenido</h1>
										Bienvenido al Sistema de la Dirección de Educación Especial para la Nominación de Alumnos.<br /><br />
										
										Está recibiendo este correo electrónico ya que se ha hecho un registro a su nombre en el sistema IdeA-CAS.<br /><br />
										
										<h3>Sus datos son:</h3>
										<table cellpadding="5" cellspacing="5" border="0">
											<tr>
												<td>usuario</td>
												<td><b>' . $registeruser_info['user_username'] . '</b></td>
											</tr>
											<tr>
												<td>contraseña</td>
												<td><b>' . $registeruser_info['user_password'] . '</b></td>
											</tr>
										</table>
										<br /><br />
										educacionespecial.sepdf.gob.mx/cas/
										<br /><br />
										Gracias.<br />
										Equipo de Desarrollo Web de la DEE
										<br /><br />
										<span style="font-size: 10px;">Dirección de Educación Especial. Calzada de Tlalpan 515. Colonia Álamos. Delegación Benito Juárez, México, Distrito Federal.<br />C.P. 03400 Teléfonos 3601-8400 extensiones 44216 y 44217. Contacto: dee@sep.gob.mx</span>
									';
									
									// sending the email
									// the message was sent successfuly
									
									$this->load->library('email');
									
									$config['charset'] = 'utf-8';
									$config['mailtype'] = 'html';
									
									$this->email->initialize($config);
									
									$this->email->from('dudastecnicas.cas@sepdf.gob.mx', 'Dudas Técnicas del Sistema IdeA-CAS');
									$this->email->to($usermail);
									
									$this->email->subject('Registro de usuario : Sistema IdeA-CAS');
									$this->email->message($usermsg);
									
									// if ( @mail($usermail, 'Recuperación de contraseña : Sistema IdeA-CAS', $usermsg, $headers) ) {
									if ( !$this->email->send() ) {
										$registeruser_data['msg_content']	.= '<br />El sistema no pudo enviar el mensaje a su correo electrónico';
									}
								}
								else {
									$registeruser_data['msg_type']			= 'alert';
									$registeruser_data['msg_content']		= 'no se pudo llevar a cabo el registro';
									$registeruser_data['msg_field_marked']	= '';
								}
							else {
								$registeruser_data['msg_type']			= 'alert';
								$registeruser_data['msg_content']		= 'la C.U.R.P. que proporciono ya está en uso';
								$registeruser_data['msg_field_marked']	= '#register-usercurp';
							}
						else {
							$registeruser_data['msg_type']			= 'alert';
							$registeruser_data['msg_content']		= 'el correo electrónico que eligio ya está en uso';
							$registeruser_data['msg_field_marked']	= '#register-useremail';
						}
					else{
						$registeruser_data['msg_type']			= 'alert';
						$registeruser_data['msg_content']		= 'el nombre de usuario que eligio ya está en uso';
						$registeruser_data['msg_field_marked']	= '#register-username';
					}
				}
				
				$this->load->view('secundaria/form/form-registeruser-messenger', $registeruser_data);
				
			}
			else
				$this->load->view('errors/errors-not-access-allowed');
		}
		// end: registeruser_attempt
		
		
	}