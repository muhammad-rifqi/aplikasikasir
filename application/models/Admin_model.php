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
	$sql = $this->db->query("select * from warung where tanggal = '".$hari_ini."'")->result_array();
	$jumlah = count($sql);
	if($jumlah > 0){
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
	}else{
		$row = array();
	}
	return $row;

}


public function datawarung()
{
	
	$sql = $this->db->query("select * from warung ")->result_array();
	return $sql;

}


//end warung


public function getproduk($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from produk where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_produk()
{
	return $this->db->query("select * from produk order by id_produk DESC")->num_rows();
}



//end produk


public function getbarangmasuk($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from barang_masuk where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_masuk()
{
	return $this->db->query("select * from barang_masuk order by id_produk DESC")->num_rows();
}


public function proses_tambah_barang_warung(){

	$foto = str_replace(" ", "_", $_FILES['foto']['name']);
	$url = base_url('assets/upload/foto/' . $foto);
	if (!empty($foto)) {
		$tujuan_file = realpath(APPPATH . '../assets/upload/foto/');
		$konfigurasi = array(
			'allowed_types' => 'jpg|jpeg|png|JPG|PNG',
			'upload_path' => $tujuan_file,
			'remove_spaces' => true,
			'file_name' => $foto,
		);

		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload('foto');
		$this->upload->data();

		$data = array(
			'id_warung' => $this->input->post('nama_warung'),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga' => $this->input->post('harga'),
			'stok' => $this->input->post('stok') ,
			'keterangan' => $this->input->post('keterangan'),
			'foto' => $url,
			'tanggal_update' => date('Y-m-d'),
		);
		$this->db->insert('barang_masuk', $data);

	} else {

	
		$data = array(
			'id_warung' => $this->input->post('nama_warung'),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga' => $this->input->post('harga'),
			'stok' => $this->input->post('stok') ,
			'keterangan' => $this->input->post('keterangan'),
			'tanggal_update' => date('Y-m-d'),
		);
		$this->db->insert('barang_masuk', $data);

	}
}


public function hapus_barang_masuk($id)
{
  $this->db->where('id_barang_masuk',$id);
  $this->db->delete('barang_masuk');
}



public function edit_barang_masuk($id)
{
	$sql = $this->db->query("select * from barang_masuk where id_barang_masuk = '".$id."'");
	$data = $sql->result_array();
	return $data;
}

public function update_barang_warung(){

	$id = $this->input->post('id_barang_masuk');
	$foto = str_replace(" ", "_", $_FILES['foto']['name']);
	$url = base_url('assets/upload/foto/' . $foto);
	if (!empty($foto)) {
		$tujuan_file = realpath(APPPATH . '../assets/upload/foto/');
		$konfigurasi = array(
			'allowed_types' => 'jpg|jpeg|png|JPG|PNG',
			'upload_path' => $tujuan_file,
			'remove_spaces' => true,
			'file_name' => $foto,
		);

		$this->load->library('upload', $konfigurasi);
		$this->upload->do_upload('foto');
		$this->upload->data();

		$data = array(
			'id_warung' => $this->input->post('nama_warung'),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga' => $this->input->post('harga'),
			'stok' => $this->input->post('stok') ,
			'keterangan' => $this->input->post('keterangan'),
			'foto' => $url,
			'tanggal_update' => date('Y-m-d'),
		);
		$this->db->where('id_barang_masuk',$id);
		$this->db->update('barang_masuk', $data);

	} else {

	
		$data = array(
			'id_warung' => $this->input->post('nama_warung'),
			'nama_produk' => $this->input->post('nama_produk'),
			'harga' => $this->input->post('harga'),
			'stok' => $this->input->post('stok') ,
			'keterangan' => $this->input->post('keterangan'),
			'tanggal_update' => date('Y-m-d'),
		);
		$this->db->where('id_barang_masuk',$id);
		$this->db->update('barang_masuk', $data);

	}
}


//end baarang masuk

public function getbarangkeluar($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from barang_keluar where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_keluar()
{
	return $this->db->query("select * from barang_keluar order by id_produk DESC")->num_rows();
}


public function insert_barang_keluar(){

	$sql = $this->db->query("insert into barang_keluar(id_produk,jumlah)values('".$this->input->post('id_produk')."','".$this->input->post('jumlah')."')");
	if($sql == true){
	$response = "success";
	}else{
	$response = "failed";
	}
	echo $response;

}

} 

