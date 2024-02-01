<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
    }
	
	public function index()
	{
		$this->session->unset_userdata(0);
		$this->session->sess_destroy();
		redirect(base_url().'login/', 'refresh');
	}
	
		
	
}
