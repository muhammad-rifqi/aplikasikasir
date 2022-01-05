<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
       
        $this->load->helper(array('form', 'url', 'file'));
    }

    public function index()
        {
            if($this->session->userdata('email')){
                redirect('auth/dashboard');
            }
                $data['title'] = 'Login Aplikasi Kasir';
                $this->load->view('tamplates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('tamplates/auth_footer');
        }
        
        public function proses_login()
        {
            $email = $this->input->post('email');
            $passwords = $this->input->post('password');
        
                $this->load->library('session');
                $password = md5($passwords);
                $this->load->model('user_model', 'proses_login');
                $data['log'] = $this->proses_login->login($email, $password);
                $cek = count($data['log']);
                if ($cek > 0) {
                    $newdata = array(
                        'id_user' => $data['log'][0]['id_user'],
                        'email' => $data['log'][0]['email'],
                        'username' => $data['log'][0]['username'],
                        'status' => $data['log'][0]['status'],
                        'id_warung' => $data['log'][0]['id_warung']
                    );
                    $this->session->set_userdata($newdata);
                    redirect(base_url() . 'auth/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Email atau Password salah !</div></div>');
                    redirect('auth');
                }
            
    
        }

        public function dashboard()
        {
             is_logged_in();  
            $data = array();
            $data['title'] = 'Dashboard Aplikasi Kasir';
            $data['dashboard_active'] = 'active';
            $this->load->model('Admin_model','warung');
            $data['warung'] = $this->warung->total_warung($this->session->userdata('status'));
            $data['bm'] = $this->warung->total_barang_masuk($this->session->userdata('status'));
            $data['bk'] = $this->warung->total_barang_keluar($this->session->userdata('status'));
            $data['pajak'] = $this->warung->getpajak();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('tamplates/footer');
        }

        public function warung()
        {
            is_logged_in();  
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $data = array();
            $data['title'] = 'Data Warung';
            $data['warung_active'] = 'active';
            $this->load->model('admin_model', 'warung');
			$this->load->library('pagination');
            if ($this->input->post('submit')){
                $data['keyword'] = $this->input->post('keyword');
                $this->session->set_userdata('keyword', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->userdata('keyword');
            }
         
            $this->db->like('nama_warung',$data['keyword']);
            $this->db->from('warung');
			$config['base_url'] = base_url('auth/warung');
			$config['total_rows'] = $this->db->count_all_results();
			// $config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open']    = '<li class="page-item">';
			$config['prev_tagl_close']  = 'Next</li>';
			$config['first_tag_open']   = '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open']    = '<li class="page-item">';
			$config['last_tagl_close']  = '</li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['page'] = $this->uri->segment(3);
			$data['warung'] = $this->warung->getwarung($d['page'],$config["per_page"],$data['keyword'])->result_array();
            // echo "<pre>";
            // var_dump($data['keyword']); 
            // echo "</pre>";
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/warung', $data);
            $this->load->view('tamplates/footer');
            
        }

        public function tambah_warung()
        {
            is_logged_in();  
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $data['title'] = 'Tambah Warung';
            $data['warung_active'] = 'active';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/tambah_warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function proses_add_warung() {

            is_logged_in(); 
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $this->load->model('Admin_model','warung');
            $this->warung->insert_warung();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil ditambahkan !</div></div>');
            redirect('auth/warung');
            
        }

        public function edit_warung($id)
        {
            is_logged_in();  
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $data['warung_active'] = 'active';
            $this->load->model('admin_model', 'warung');
            $data['warung'] = $this->warung->edit_warung($id);
            $data['title'] = 'Edit warung';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/edit_warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function proses_ubah_warung() {
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $this->load->model('Admin_model','warung');
            $this->warung->ubah_warung();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil diubah !</div></div>');
            redirect('auth/warung');
        }

        public function hapus_warung($id)
        {
            is_logged_in();
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','warung');
            $this->warung->hapus_warung($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil dihapus !</div></div>');
            redirect('auth/warung');
        }
     

        public function detail_warung(){

            $id = $this->uri->segment(3);
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            }
            $data['title'] = 'Detail Warung';
            $this->load->model('Admin_model','warung');
            $data['warung'] = $this->warung->getwarungdetail($id);
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/detailwarung', $data);
            $this->load->view('tamplates/footer');
            
        }

        public function pajak()
        {
            is_logged_in(); 
            if($this->session->userdata('status') != 'admin'){
                redirect('auth/blocked');
            } 
            $data['title'] = 'Pajak';
            $this->load->model('Admin_model','pajak');
            $data['pajak'] = $this->pajak->getpajak();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/pajak', $data);
            $this->load->view('tamplates/footer');
        }

        public function produk()
        {
            is_logged_in();  
            $data = array();
            $data['title'] = 'Data Produk';
            $this->load->model('admin_model', 'produk');
			$this->load->library('pagination');
            if ($this->input->post('submit')){
                $data['keyword'] = $this->input->post('keyword');
                $this->session->set_userdata('keyword', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->userdata('keyword');
            }
            $this->db->like('nama_produk',$data['keyword']);
            $this->db->from('produk');
			$config['base_url'] = base_url('auth/produk');
			$config['total_rows'] = $this->db->count_all_results();
			// $config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open']    = '<li class="page-item">';
			$config['prev_tagl_close']  = 'Next</li>';
			$config['first_tag_open']   = '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open']    = '<li class="page-item">';
			$config['last_tagl_close']  = '</li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['page'] = $this->uri->segment(3);
			$data['produk'] = $this->produk->getproduk($d['page'],$config["per_page"],$data['keyword'])->result_array();
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/produk', $data);
            $this->load->view('tamplates/footer');
            
        }


        public function update_harga(){

            $this->load->model('admin_model', 'update_barang');
            $this->update_barang->insert_barang_keluar();

        }

        public function barang_masuk()
        {
            is_logged_in();  
            $data = array();
            $data['title'] = 'Data Barang Masuk';
            $this->load->model('admin_model', 'barang_masuk');
			$this->load->library('pagination');
            if ($this->input->post('submit')){
                $data['keyword'] = $this->input->post('keyword');
                $this->session->set_userdata('keyword', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->userdata('keyword');
            }
            $this->db->like('nama_produk',$data['keyword']);
            $this->db->from('barang_masuk');
			$config['base_url'] = base_url('auth/barang_masuk');
			$config['total_rows'] = $this->db->count_all_results();
			// $config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open']    = '<li class="page-item">';
			$config['prev_tagl_close']  = 'Next</li>';
			$config['first_tag_open']   = '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open']    = '<li class="page-item">';
			$config['last_tagl_close']  = '</li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['page'] = $this->uri->segment(3);
			$data['barang_masuk'] = $this->barang_masuk->getbarangmasuk($d['page'],$config["per_page"],$data['keyword'])->result_array();
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/barang_masuk', $data);
            $this->load->view('tamplates/footer');
            
        }


        public function tambah_barang_masuk()
        {
            is_logged_in();  
            $data['title'] = 'Tambah Barang Masuk';
            $this->load->model('admin_model', 'warung');
            $data['warung'] = $this->warung->datawarung();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/tambah_barang_masuk', $data);
            $this->load->view('tamplates/footer');
        }



        public function proses_tambah_barang_masuk()
        {
            is_logged_in();  
            $this->load->model('Admin_model','barang_masuk');
            $this->barang_masuk->proses_tambah_barang_masuk();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Barang Masuk berhasil ditambahkan !</div></div>');
            redirect('auth/barang_masuk');
        }


        public function  hapus_barang_masuk()
        {
            is_logged_in();  
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','barang_masuk');
            $this->barang_masuk->hapus_barang_masuk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Barang Masuk berhasil dihapus !</div></div>');
            redirect('auth/barang_masuk');
        }
      


        
        public function edit_barang_masuk()
        {
            is_logged_in();  
            $id = $this->uri->segment(3);
            $data['title'] = 'Edit Barang Masuk';
            $this->load->model('admin_model', 'barang_masuk');
            $data['warung'] = $this->barang_masuk->datawarung();
            $data['bm'] = $this->barang_masuk->edit_barang_masuk($id);
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/edit_barang_masuk', $data);
            $this->load->view('tamplates/footer');
        }



        public function  proses_update_barang_masuk()
        {
            is_logged_in();  
            $this->load->model('Admin_model','barang_masuk');
            $this->barang_masuk->update_barang_masuk();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Barang Masuk berhasil diupdate !</div></div>');
            redirect('auth/barang_masuk');
        }
      
        public function insert_to_produk(){

            $this->load->model('admin_model', 'barang_masuk');
            $this->barang_masuk->insert_to_produk();

        }

        public function barang_keluar()
        {
            is_logged_in();  
            $data = array();
            $data['title'] = 'Data Barang Keluar';
            $this->load->model('admin_model', 'barang_keluar');
			$this->load->library('pagination');
            if ($this->input->post('submit')){
                $data['keyword'] = $this->input->post('keyword');
                $this->session->set_userdata('keyword', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->userdata('keyword');
            }
            $this->db->like('nama_produk',$data['keyword']);
            $this->db->from('barang_keluar');
			$config['base_url'] = base_url('auth/barang_keluar');
			$config['total_rows'] = $this->db->count_all_results();
			// $config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open']    = '<li class="page-item">';
			$config['prev_tagl_close']  = 'Next</li>';
			$config['first_tag_open']   = '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open']    = '<li class="page-item">';
			$config['last_tagl_close']  = '</li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['page'] = $this->uri->segment(3);
			$data['barang_keluar'] = $this->barang_keluar->getbarangkeluar($d['page'],$config["per_page"],$data['keyword'])->result_array();
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/barang_keluar', $data);
            $this->load->view('tamplates/footer');
            
        }


        public function hapus_barang_keluar(){
            is_logged_in();  
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','barang_keluar');
            $this->barang_keluar->proses_hapus_barang_keluar($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Barang Keluar berhasil dihapus !</div></div>');
            redirect('auth/barang_keluar');   
        }


        public function hapus_produk(){
            is_logged_in();  
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','produk');
            $this->produk->proses_hapus_produk($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Produk berhasil dihapus !</div></div>');
            redirect('auth/produk');   
        }


        public function logout()
        {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Anda Berhasil Logout !</div></div>');
                redirect('auth');
        }

        public function blocked(){
            $this->load->view('auth/blocked');
        } 



        public function transaksi()
        {
            is_logged_in();  
            $data = array();
            $data['title'] = 'Data Transksi';
            $this->load->model('admin_model', 'transaksi');
			$this->load->library('pagination');
            if ($this->input->post('submit')){
                $data['keyword'] = $this->input->post('keyword');
                $this->session->set_userdata('keyword', $data['keyword']);
            }else{
                $data['keyword'] = $this->session->userdata('keyword');
            }
            $this->db->like('nama_produk',$data['keyword']);
            $this->db->from('transaksi');
			$config['base_url'] = base_url('auth/transaksi');
			$config['total_rows'] = $this->db->count_all_results();
			// $config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item">';
			$config['num_tag_close']    = '</li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';
			$config['prev_tag_open']    = '<li class="page-item">';
			$config['prev_tagl_close']  = 'Next</li>';
			$config['first_tag_open']   = '<li class="page-item">';
			$config['first_tagl_close'] = '</li>';
			$config['last_tag_open']    = '<li class="page-item">';
			$config['last_tagl_close']  = '</li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['page'] = $this->uri->segment(3);
			$data['transaksi'] = $this->transaksi->gettransaksi($d['page'],$config["per_page"],$data['keyword'])->result_array();
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/transaksi', $data);
            $this->load->view('tamplates/footer');
            
        }



}