<?php
class Admin_model extends CI_Model {


public function __construct()
{
	parent::__construct();
	$this->load->helper(array('form', 'url','file'));
}


public function getwarung($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from warung where nama_warung like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}
public function insert_warung(){

	$foto = str_replace(" ", "_", $_FILES['foto']['name']);
	$url = base_url('assets/upload/warung/' . $foto);
	if (!empty($foto)) {
		$tujuan_file = realpath(APPPATH . '../assets/upload/warung/');
		$konfigurasi = array(
			'allowed_types' => 'jpg|jpeg|png|bmp|JPG',
			'upload_path' => $tujuan_file,
			'remove_spaces' => true,
			'file_name' => $foto,
		);

		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload('foto');
		$this->upload->data();

		$data = array(
			'nama_warung' => $this->input->post('nama_warung'),
			'pajak_perhari' => $this->input->post('pajak_perhari'),
			'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'foto' => $url,
			'modify' => date('d-m-Y'),
		);
		$this->db->insert('warung', $data);

	} else {

	
		$data = array(
			'nama_warung' => $this->input->post('nama_warung'),
			'pajak_perhari' => $this->input->post('pajak_perhari'),
			'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'modify' => date("Y-m-d"),
		);
		$this->db->insert('warung', $data);

	}


}

public function edit_warung($id)
{
	$sql = $this->db->query("select * from warung where id = '".$id."'");
	$data = $sql->result_array();
	return $data;
}
public function hapus_warung($id)
{
  $this->db->where('id',$id);
  $this->db->delete('warung');
}


public function ubah_warung()
{
	$id = $this->input->post('id');
	$foto = str_replace(" ", "_", $_FILES['foto']['name']);
	$url = base_url('assets/upload/warung/' . $foto);
	if (!empty($foto)) {
		$tujuan_file = realpath(APPPATH . '../assets/upload/warung/');
		$konfigurasi = array(
			'allowed_types' => 'jpg|jpeg|png|bmp|JPG',
			'upload_path' => $tujuan_file,
			'remove_spaces' => true,
			'file_name' => $foto,
		);

		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload('foto');
		$this->upload->data();

		$data = array(
			'nama_warung' => $this->input->post('nama_warung'),
			'pajak_perhari' => $this->input->post('pajak_perhari'),
			'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'foto' => $url,
			'modify' => date('d-m-Y'),
		);

		$this->db->where('id',$id);
		$this->db->update('warung', $data);

	} else {

	
		$data = array(
			'nama_warung' => $this->input->post('nama_warung'),
			'pajak_perhari' => $this->input->post('pajak_perhari'),
			'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'modify' => date('d-m-Y'),
		);

		$this->db->where('id',$id);
		$this->db->update('warung', $data);

	}
}



public function total_warung()
{
	return $this->db->query("select * from warung order by id DESC")->num_rows();
}



public function getdatawarung()
{
	$hari_ini = date("Y-m-d");
	$sql = $this->db->query("select * from warung where modify = '".$hari_ini."'")->result_array();
	$jumlah = count($sql);
	for($i=0;$i<$jumlah;$i++){
	$pajak = (10/100) * $sql[$i]['pajak_perhari']; 
		$row[] = array(
			"id"=> $sql[$i]['id'],
			"nama_warung"=> $sql[$i]['nama_warung'],
			"pajak_perhari"=> $sql[$i]['pajak_perhari'],
			"total_terjual"=> $sql[$i]['total_terjual'],
			"tanggal"=> $sql[$i]['tanggal'],
			"keterangan"=> $sql[$i]['keterangan'],
			"foto"=> $sql[$i]['foto'],
			"alamat"=> $sql[$i]['alamat'],
			"kontak"=> $sql[$i]['kontak'],
			"modify"=> $sql[$i]['modify'],
			"total_pajak"=> $pajak,
		);
				
	}
	return $row;

}


public function getproduk($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from produk where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_produk()
{
	return $this->db->query("select * from produk order by id_produk DESC")->num_rows();
}


public function getbarangmasuk($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from barang_masuk where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_masuk()
{
	return $this->db->query("select * from barang_masuk order by id_produk DESC")->num_rows();
}



public function getbarangkeluar($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from barang_keluar where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_keluar()
{
	return $this->db->query("select * from barang_keluar order by id_produk DESC")->num_rows();
}


} 

