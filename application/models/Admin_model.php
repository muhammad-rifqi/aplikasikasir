<?php
class Admin_model extends CI_Model {


public function __construct()
{
	parent::__construct();
	$this->load->helper(array('form', 'url','file'));
}


public function getwarung()
{
	$sql = $this->db->query("select * from warung")->result_array();
	return $sql;

}


} 

