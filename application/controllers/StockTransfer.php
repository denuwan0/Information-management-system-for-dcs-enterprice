<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockTransfer extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->User_model->is_logged_in();
    }
	
	public function view()
	{		
		$this->load->view('/system/template/header');
		$this->load->view('/system/stockTransfer/stockTransferView');
		$this->load->view('/system/template/footer');
	}
	
	public function edit()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/stockTransfer/stockTransferEdit');
		$this->load->view('/system/template/footer');
	}
	
	public function create()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/stockTransfer/stockTransferCreate');
		$this->load->view('/system/template/footer');
	}
		
	public function accept()
	{		
		$this->load->view('/system/template/header');		
		$this->load->view('/system/stockTransfer/stockTransferAccept');
		$this->load->view('/system/template/footer');
	}
}
