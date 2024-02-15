<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpBonus extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->User_model->is_logged_in();
    }
	
	public function view()
	{		
		$this->load->view('/system/template/header');
		$this->load->view('/system/empBonus/empBonusView');
		$this->load->view('/system/template/footer');
	}
	
	public function edit()
	{		
		$this->load->view('/system/template/header');	
		if($this->session->userdata('sys_user_group_name') == "Admin" || $this->session->userdata('sys_user_group_name') == "Manager"){
			$this->load->view('/system/empBonus/empBonusEdit');
		}
		else{
			$this->load->view('/system/errors/access_denied');
		}
		
		$this->load->view('/system/template/footer');
	}
	
	public function create()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/empBonus/empBonusCreate');
		$this->load->view('/system/template/footer');
	}
		
	
}
