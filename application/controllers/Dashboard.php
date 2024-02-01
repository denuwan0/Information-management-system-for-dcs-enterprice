<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->User_model->is_logged_in();
		
		if($this->session->userdata('user_id')  == ''){//$this->session->userdata('logged_in') !== TRUE
			redirect(base_url().'login');
		}
		else{
			if($this->session->userdata('sys_user_group_name') == "Customer"){
				show_404();
				//or redirect to 
			}
			else{
				$this->load->view('/system/template/header');
				$this->load->view('/system/dashboard/dashboard');
				$this->load->view('/system/template/footer');
			}
			
		}
    }
	
	public function index()
	{
		
	}
	
	
}
