<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->view('mail/mail-form');
	}
	// end: index
	
	
	
	
	
	/**
	 * 
	 * send_mail
	 * 
	 * function to send mail
	 */
	public function send_mail () {
		
		$subject = $this->input->post('subject');
		
		$this->load->model('secundaria_users_mdl');
		
		$users = $this->secundaria_users_mdl->getallUsers('user_fname, user_lname, user_email, user_name');
		
		if ( sizeof($users) > 0 ) {
			$this->load->library('email');
			$this->email->from('dudastecnicas.cas@sepdf.gob.mx', 'Dudas Técnicas Sistema IdeA-CAS');
			foreach ( $users as $user ) {
			
				$message = "Estimado(a) " . $user->user_lname . " " . $user->user_fname . " (" . $user->user_name . ")\n\n\n" . $this->input->post('message');
				$this->email->to($user->user_email); 
				$this->email->subject($subject);
				$this->email->message($message); 
				$this->email->send();
				// echo $this->email->print_debugger();
				
				echo '<br /><br /><br /><br />';
				
			}
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */