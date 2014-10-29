<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	
	
	
	/**
	 * 
	 * Primaria
	 * 
	 * clase para controlar los datos que se manejan en primarias
	 */
	class Primaria extends CI_Controller {
		
		
		
		
		
		/**
		 * 
		 * the index
		 */
		public function index () {
			$this->load->view('primaria/primaria-index');
		}
		// end: the index
	}
	// end: Primaria	