<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class vehicleCategory extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->User_model->is_logged_in();
		
    }
	
	public function view()
	{		
		$this->load->view('/system/template/header');
		$this->load->view('/system/vehicleCategory/vehicleCategoryView');
		$this->load->view('/system/template/footer');
	}
	
	public function edit()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/vehicleCategory/vehicleCategoryEdit');
		$this->load->view('/system/template/footer');
	}
	
	public function create()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/vehicleCategory/vehicleCategoryCreate');
		$this->load->view('/system/template/footer');
	}
		
	
}
