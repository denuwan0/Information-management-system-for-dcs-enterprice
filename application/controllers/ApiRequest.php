<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiRequest extends CI_Controller {
		
	
	//------------------ Reference ---------------------//	
	//$data['agent'] = $response;
		
	/* //GET - single user
	$get_endpoint = '/api/users/2';
	
	$response = perform_http_request('GET', $rest_api_base_url . $get_endpoint);
	
	$data['user'] = $response;
	
	//POST - create new user
	$post_endpoint = '/api/users';
	
	$request_data = json_encode(array("name" => "Soumitra", "job" => "Blog Author", "avatar" => "https://roytuts.com/about/"));
	
	$response = perform_http_request('POST', $rest_api_base_url . $post_endpoint, $request_data);
	
	$data['new_user'] = $response;
	
	//PUT - update user
	$put_endpoint = '/api/users';
	
	$request_data = json_encode(array("name" => "Soumitra", "job" => "Roy Tutorials Author", "avatar" => "https://roytuts.com/about/"));
	
	$response = perform_http_request('PUT', $rest_api_base_url . $put_endpoint, $request_data);
	
	$data['update_user'] = $response; */
	
	//View
	//return view('consume_rest_api', $data);
	//return json_encode($data);
	
		
	//------------------ Reference ---------------------//
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		
	}
	
	public $rest_api_base_url = 'http://localhost/API/';
	//public $rest_api_base_url = 'https://mitproject.xyz/API/';
	
	//------------------ Agent ---------------------//
	
	//https://localhost/OP/ApiRequest/Agent
	//https://localhost:5001/api/Agent	
    public function authenticate() {
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$request_data = json_encode(array("username" => $username, "password" => $password));
						
		
		
		$post_endpoint = 'SysUser/authenticate';		
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);				
		
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		
		
		
		
		
		//var_dump($response);
		
		if(!$phparray["error"]){
			$this->session->set_userdata($phparray);
			$data = array(
				'error'	=>	false,
				'message'	=>	"success"
			);
			
			echo json_encode($data);
		}
		else{
			echo $response;
		}
		
		
		
    }
	
	public function otpGen() {
		
		$user_id = $this->session->userdata('user_id');
		
		$request_data = json_encode(array("user_id" => $user_id));
						
		//$this->rest_api_base_url = 'http://localhost/API/';
		
		$post_endpoint = 'SysUser/otpGen';
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);
		
		//var_dump($response);
		
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		
		echo json_encode($phparray);
    }
	
	public function restCodeGen() {
		
		$resetMethodDisplay = $this->input->post('resetMethodDisplay');
		$inputMethodVal = $this->input->post('inputMethodVal');
				
		$request_data = json_encode(array("resetMethodDisplay" => $resetMethodDisplay, "inputMethodVal" => $inputMethodVal));
						
		//$this->rest_api_base_url = 'http://localhost/API/';
		
		$post_endpoint = 'SysUser/restCodeGen';
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);
		
		//var_dump($response);
						
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		
		echo json_encode($phparray);
    }
	
	public function resetPass() {
		
		$otp_code = $this->input->post('otp_code');
		$password = $this->input->post('password');
		$confirmPassword = $this->input->post('confirmPassword');
		$user_id = $this->input->post('user_id');
				
		$request_data = json_encode(array("otp_code" => $otp_code, "password" => $password, "confirmPassword" => $confirmPassword, "user_id" => $user_id));
						
		//$this->rest_api_base_url = 'http://localhost/API/';
		
		$post_endpoint = 'SysUser/resetPass';
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);
		
		//var_dump($response);
						
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		
		echo json_encode($phparray);
    }
	
	public function otpVerify() {
		
		$user_id = $this->session->userdata('user_id');
		$otp_code = $this->input->post('otp_code');
		
		$request_data = json_encode(array("user_id" => $user_id, "otp_code" => $otp_code));
						
		//$this->rest_api_base_url = 'http://localhost/API/';
		
		$post_endpoint = 'SysUser/verifyOtp';
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);
		
				
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		//var_dump($phparray);
		
		$request_data = json_encode($phparray);
		
		$post_endpoint2 = 'Notify/get_all_close_to_expire';
		$response2 = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint2,  $request_data);
		
				
		//var_dump($request_data);
		
		$this->session->set_userdata($phparray);
		
		echo json_encode($phparray);
    }
	
	public function logout() {
		
		$user_id = $this->session->userdata('user_id');
		
		$request_data = json_encode(array("user_id" => $user_id));
						
		//$this->rest_api_base_url = 'http://localhost/API/';
		
		$post_endpoint = 'SysUser/logout';
		
		$response = perform_http_request('POST', $this->rest_api_base_url . $post_endpoint, $request_data);
				
		$phpObj = json_decode($response);
		$phparray = (array) $phpObj;
		
		$this->session->set_userdata($phparray);
				
		$data = array(
			'error'	=>	false,
			'message'	=>	"success"
		);
		
		echo json_encode($data);
    }
	
}