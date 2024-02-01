<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpAllowance extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->User_model->is_logged_in();
    }
	
	public function view()
	{		
		$this->load->view('/system/template/header');
		$this->load->view('/system/empAllowance/empAllowanceView');
		$this->load->view('/system/template/footer');
	}
	
	public function edit()
	{		
		$this->load->view('/system/template/header');	
		if($this->session->userdata('sys_user_group_name') == "Admin"){
			$this->load->view('/system/empAllowance/empAllowanceEdit');
		}
		else{
			$this->load->view('/system/errors/access_denied');
		}
		
		$this->load->view('/system/template/footer');
	}
	
	public function create()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/empAllowance/empAllowanceCreate');
		$this->load->view('/system/template/footer');
	}
		
	
}
