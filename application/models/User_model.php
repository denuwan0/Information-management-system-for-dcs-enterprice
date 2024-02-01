<?php

class User_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
	public function is_logged_in(){
		if(!$this->session->userdata('user_id')){		
			
			if($this->session->userdata('sys_user_group_name') == "Customer"){
				show_404();
				//or redirect to 
			}
			else{
				redirect(base_url().'login');
			}			
		
		}
	}
    
}//end user model
