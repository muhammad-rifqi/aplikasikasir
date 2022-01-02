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


public function getwarungdetail($id)
{
	
	$sql = $this->db->query("SELECT * from warung where id = '".$id."'")->result_array();
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
			//'pajak_perhari' => $this->input->post('pajak_perhari'),
			//'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'foto' => $url,
			'modify' => date('Y-m-d'),
		);
		$query = $this->db->insert('warung', $data);
		if($query){
			$email = strtolower(str_replace(" ","",$this->input->post('nama_warung'))).'@localhost';
			$d = array(
				'username' => $this->input->post('nama_warung'),
				'email' => $email,
				'password' => md5('12345')
			);

			return $this->db->insert('user', $d);
		}


	} else {

	
		$data = array(
			'nama_warung' => $this->input->post('nama_warung'),
			//'pajak_perhari' => $this->input->post('pajak_perhari'),
			//'total_terjual' => $this->input->post('total_terjual'),
			'tanggal' => $this->input->post('tanggal') ,
			'keterangan' => $this->input->post('keterangan'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'modify' => date('Y-m-d'),
		);
		$query = $this->db->insert('warung', $data);

		if($query){
			$email = strtolower(str_replace(" ","",$this->input->post('nama_warung'))).'@localhost';
			$d = array(
				'username' => $this->input->post('nama_warung'),
				'email' => $email,
				'password' => md5('12345')
			);

			return $this->db->insert('user', $d);
		}
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
			'modify' => date('Y-m-d'),
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
			'modify' =>date('Y-m-d'),
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
	$sql = $this->db->query("select warung.id as id, warung.nama_warung as nama_warung,sum(barang_keluar.harga) as total_harga, count(barang_keluar.id_produk) as jumlah_barang, sum(barang_keluar.jumlah) as item,barang_keluar.tanggal_update as tanggal , barang_keluar.id_barang_keluar from warung left join barang_keluar on warung.id = barang_keluar.id_warung where barang_keluar.tanggal_update = '".$hari_ini."' group by warung.id")->result_array();
	$jumlah = count($sql);
	if($jumlah > 0){
	for($i=0;$i<$jumlah;$i++){
		$pajak = (10/100) * $sql[$i]['total_harga']; 
		$row[] = array(
			"id"=> $sql[$i]['id'],
			"nama_warung"=> $sql[$i]['nama_warung'],
			"pajak_hari_ini"=> $pajak,
			"total_terjual"=> $sql[$i]['jumlah_barang'],
			"items"=>$sql[$i]['item'],
			"tanggal"=> $sql[$i]['tanggal'],
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



public function getdataproduk($id)
{
	
	$sql = $this->db->query("select * from produk where id_warung = '".$id."'")->result_array();
	return $sql;

}



//end produk


public function getbarangmasuk($limit,$start,$keyword)
{
	
	$sql = $this->db->query("select * from barang_masuk where nama_produk like '%".$keyword."%' and status_produk = '1' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_masuk()
{
	return $this->db->query("select * from barang_masuk order by id_produk DESC")->num_rows();
}


public function proses_tambah_barang_masuk(){

	$foto = end(explode(".", $_FILES["foto"]["name"]));
	$url = base_url('assets/upload/foto/' . time().'.'.$foto);
	if (!empty($foto)) {
		$tujuan_file = realpath(APPPATH . '../assets/upload/foto/');
		$konfigurasi = array(
			'allowed_types' => 'jpg|jpeg|png|JPG|PNG',
			'upload_path' => $tujuan_file,
			'remove_spaces' => true,
			'file_name' => time().'.'.$foto,
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
			'status_produk' => 1,
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
			'status_produk' => 1,
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

public function update_barang_masuk(){

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
			'status_produk' => 1,
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
			'status_produk' => 1,
		);
		$this->db->where('id_barang_masuk',$id);
		$this->db->update('barang_masuk', $data);

	}
}

public function insert_to_produk(){
	$ambil = $this->db->query("select * from barang_masuk where id_barang_masuk = '".$this->input->post('id_barang_masuk')."'")->result_array();
	$cek = $this->db->query("select * from produk where kode_produk = '".$this->input->post('id_barang_masuk')."'")->result_array();
	$tgl = date('Y-m-d');
	$jml = count($cek);
	if($jml > 0){
		$sql = $this->db->query("update produk set  stok='".($ambil[0]['stok']+$cek[0]['stok'])."',tanggal_update='".$tgl."' where kode_produk='".$ambil[0]['id_barang_masuk']."'");
	}else{
		$sql = $this->db->query("insert into produk(id_warung,kode_produk,nama_produk,harga,stok,keterangan,foto,tanggal_update)values('".$ambil[0]['id_warung']."','".$ambil[0]['id_barang_masuk']."','".$ambil[0]['nama_produk']."','".$ambil[0]['harga']."','".$ambil[0]['stok']."','".$ambil[0]['keterangan']."','".$ambil[0]['foto']."','".$tgl."')");
	}

	if($sql == true){
		$this->db->query("update barang_masuk set status_produk = '2' where id_barang_masuk='".$this->input->post('id_barang_masuk')."'");
		$response = "success";
		}else{
		$response = "failed";
		}
		echo $response;

}


//end baarang masuk

public function getbarangkeluar($limit,$start,$keyword)
{
	
	$sql = $this->db->query("SELECT * from barang_keluar where nama_produk like '%".$keyword."%' limit ".$limit.", ".$start."");
	return $sql;

}


public function total_barang_keluar()
{
	return $this->db->query("select * from barang_keluar order by id_produk DESC")->num_rows();
}


public function insert_barang_keluar(){

	$tgl = date("Y-m-d");
	$ambil = $this->db->query("select * from produk where id_produk = '".$this->input->post('id_produk')."'")->result_array();
	if(empty($this->input->post('jumlah')) || $this->input->post('jumlah') > $ambil[0]['stok'] ){
		$response = "failed , invalid amount ";
	}else{
		$this->db->query("insert into barang_keluar(id_warung,id_produk,nama_produk,harga,jumlah,keterangan,foto,tanggal_update)values('".$ambil[0]['id_warung']."','".$ambil[0]['kode_produk']."','".$ambil[0]['nama_produk']."','".$ambil[0]['harga']."','".$this->input->post('jumlah')."','".$ambil[0]['keterangan']."','".$ambil[0]['foto']."','".$tgl."')");
		$this->db->query("update produk set stok ='".($ambil[0]['stok']-$this->input->post('jumlah'))."' where id_produk = '".$this->input->post('id_produk')."'");
		$response = "success";
	}
	echo $response;
}

public function proses_hapus_barang_keluar($id){

	$this->db->where('id_barang_keluar',$id);
	$this->db->delete('barang_keluar');

}


//end barang keluar


public function getpajak()
{
	$hari_ini = date("Y-m-d");
	$sql = $this->db->query("SELECT 
							warung.id
							,warung.nama_warung
							,sum(barang_keluar.harga) AS total_harga
							, count(barang_keluar.id_produk) AS jumlah_barang
							,barang_keluar.id_barang_keluar
							,sum(barang_keluar.jumlah) as item 
							FROM 
							warung 
							LEFT JOIN barang_keluar ON warung.id = barang_keluar.id_warung WHERE barang_keluar.tanggal_update = '".$hari_ini."' group by warung.id")->result_array();
	return $sql;
}


public function proses_hapus_produk($id){

	$this->db->where('id_produk',$id);
	$this->db->delete('produk');

}

//end pajak

} 

