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
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('tamplates/footer');
        }

        public function warung()
        {
            is_logged_in();  
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
            $data['title'] = 'Tambah Warung';
            $data['warung_active'] = 'active';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/tambah_warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function proses_add_warung() {

            is_logged_in(); 
            $this->load->model('Admin_model','warung');
            $this->warung->insert_warung();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil ditambahkan !</div></div>');
            redirect('auth/warung');
            
        }

        public function edit_warung($id)
        {
            is_logged_in();  
            $data['warung_active'] = 'active';
            $this->load->model('admin_model', 'warung');
            $data['warung'] = $this->warung->edit_warung($id);
            $data['title'] = 'Edit warung';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/edit_warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function proses_ubah_warung() {
            $this->load->model('Admin_model','warung');
            $this->warung->ubah_warung();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil diubah !</div></div>');
            redirect('auth/warung');
        }

        public function hapus_warung($id)
        {
            is_logged_in();
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','warung');
            $this->warung->hapus_warung($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Warung berhasil dihapus !</div></div>');
            redirect('auth/warung');
        }
     




        public function logout()
        {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade"><div class="alert-body"><button class="close" data-dismiss="alert"><span>×</span></button>Anda Berhasil Logout !</div></div>');
                redirect('auth');
        }


        public function pajak()
        {
            is_logged_in();  
            $data['title'] = 'Pajak';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/pajak', $data);
            $this->load->view('tamplates/footer');
        }
}