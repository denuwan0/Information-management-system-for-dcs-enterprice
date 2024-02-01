<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
		
		//$this->User_model->is_logged_in();
		if($this->session->userdata('user_id') !== "" && $this->session->userdata('otp_verify') && $this->session->userdata('token')){
			redirect(base_url().'dashboard');
		}		
    }
	
	public function index()
	{
		$this->load->view('/system/login/login');		
	}

	public function otp()
	{
		if($this->session->userdata('user_id') &&  $this->session->userdata('otp_verify') == ""  &&  $this->session->userdata('token') == "" ){	
			$this->load->view('/system/login/otp');
		}		
		else{					
			redirect(base_url().'login');	
		}
					
	}	
		
	public function forgotPassword()
	{
		$this->load->view('/system/login/forgotPassword');		
	}
	
	public function recoverPassword()
	{			
		$this->load->view('/system/login/recoverPassword');		
	}
		
}
