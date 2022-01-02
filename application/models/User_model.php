<?php

class User_model extends CI_Model {


public function __construct()
{
	parent::__construct();
	$this->load->helper(array('form', 'url','file'));
}


public function login($email,$password)
	{
		$sql = $this->db->query("select * from user where email='".$email."' and password='".$password."'");
		$data = $sql->result_array();
		return $data;
}

public function updatetoken($email,$password)
{
		$id = session_id();
		$sql = $this->db->query("update user set token = '".$id."' where email='".$email."' and password='".$password."'");
		return $sql;
}


public function deletetoken($email,$password)
{
		$sql = $this->db->query("update user set token = '' where email='".$email."' and password='".$password."'");
		return $sql;
}


public function insert_registrasi($username,$email,$password){
	$data = array(
        'username'=>$username,
		'email'=>$email,
		'password'=>$password,
	);
	return $this->db->insert('user',$data);
}


} ?>
