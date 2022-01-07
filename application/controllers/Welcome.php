<?php

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->library('session');
  	}


	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login()
	{

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
		header("Content-Type: application/json; charset=utf-8");
		$data = json_decode(file_get_contents("php://input"),true);
		
		$this->load->library('session');
		$email = $data['email'];
		$password = md5($data['password']);
		$this->load->model('User_model','proses_login');
		$data['log'] = $this->proses_login->login($email,$password);
		$cek = count($data['log']);
		if($cek > 0) {
		$this->load->model('User_model','proses_login_api');
		$this->proses_login_api->updatetoken($email,$password);
			$newdata = array(
				'success'=>'true',
				'data'=> array(
					'id_user'=> $data['log'][0]['id_user'],
					'username' => $data['log'][0]['username'],
					'id_warung' => $data['log'][0]['id_warung'],
					'email' => $data['log'][0]['email'],
					'password' => $data['log'][0]['password'],
					'status' => $data['log'][0]['status'],
					'token' => $data['log'][0]['token']
				)
			);
			$this->session->set_userdata($newdata);

			echo json_encode($newdata);

		} else {

			$newdata = array(
				'success'=>'failed',
				'data'=>null
			);

			echo json_encode($newdata);

		}
  

	}

	
	public function api_warung()
	{
	 
		$this->load->model('Admin_model','warung');
		$array = $this->warung->datawarung();
		if(count($array) > 0){
			$response = array(
				"data"=>$array
			);
		}else{
			$response = array(
				"data"=>null
			);
		}
		echo json_encode($response);
	
	}
 


	
	public function api_produk($id)
	{
		$id = $this->uri->segment(2);
		$this->load->model('Admin_model','produk');
		$array = $this->produk->getdataproduk($id);
		if(count($array) > 0){
			$response = array(
				"data"=>$array
			);
		}else{
			$response = array(
				"data"=>null
			);
		}
		echo json_encode($response);
	}
 

	
	public function api_pajak()
	{
		$this->load->model('Admin_model','pajak');
		$array = $this->pajak->getdatawarung();
		if(count($array) > 0){
			$response = array(
				"data"=>$array
			);
		}else{
			$response = array(
				"data"=>null
			);
		}
		echo json_encode($response);
	}
 
	public function api_pajak_perwarung()
	{
		$id = $this->uri->segment(2);
		$this->load->model('Admin_model','pajak');
		$array = $this->pajak->getperwarung($id);
		if(count($array) > 0){
			$response = array(
				"data"=>$array
			);
		}else{
			$response = array(
				"data"=>null
			);
		}
		echo json_encode($response);
	}

	public function api_profile()
	{
		$id = $this->uri->segment(2);
		$this->load->model('Admin_model','profile');
		$array = $this->profile->getprofile($id);
		if(count($array) > 0){
			$response = array(
				"data"=>$array
			);
		}else{
			$response = array(
				"data"=>null
			);
		}
		echo json_encode($response);
	}



	public function register()
	{

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
		header("Content-Type: application/json; charset=utf-8");
		$data = json_decode(file_get_contents("php://input"),true);
		
		$username = $data['username'];
		$email = $data['email'];
		$password = md5($data['password']);
		$this->load->model('User_model','proses_registrasi');
		$datareg = $this->proses_registrasi->insert_registrasi($username,$email,$password);
		if($datareg == true) {

			$newdata = array(
				'success'=>'true',
				'data'=> $data
			);

			echo json_encode($newdata);

		} else {

			$newdata = array(
				'success'=>'failed',
				'data'=>null
			);

			echo json_encode($newdata);

		}
  
		

	}


	public function logout(){

		
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
		header("Content-Type: application/json; charset=utf-8");
		$data = json_decode(file_get_contents("php://input"),true);
		
		$email = $data['email'];
		$password = md5($data['password']);


		$this->load->model('User_model','proses_login_api');
		$this->proses_login_api->deletetoken($email,$password);
		session_regenerate_id();
		$this->session->sess_destroy();
		$array = array(
			'logout'=>'true',
			'data'=>null
		);

		echo json_encode($array);
	}
}
