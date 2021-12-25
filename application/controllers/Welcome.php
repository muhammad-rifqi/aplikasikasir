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

			$newdata = array(
				'success'=>'true',
				'data'=> array(
					'id_user'=> $data['log'][0]['id_user'],
					'username' => $data['log'][0]['username'],
					'email' => $data['log'][0]['email'],
					'password' => $data['log'][0]['password'],
				)
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
}
