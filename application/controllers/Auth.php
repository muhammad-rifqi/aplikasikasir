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
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email atau Password Salah !</div>');
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
			$config['base_url'] = base_url('auth/warung');
			$config['total_rows'] = $this->warung->total_warung();
			$config['per_page'] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] 		= floor($choice);
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
			$this->pagination->initialize($config);
			$d['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['warung'] = $this->warung->getwarung($d['page'],$config["per_page"])->result_array();
			$this->load->view('tamplates/header', $data);
            $this->load->view('admin/warung', $data);
            $this->load->view('tamplates/footer');
            
        }

        public function tambah_warung()
        {
            is_logged_in();  
            $data['title'] = 'Tambah Warung';
            $data['warung_active'] = 'active';
            $this->load->model('admin_model', 'warung');
            $data['warung'] = $this->warung->getwarung();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/tambah_warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function proses_add_warung() {

            is_logged_in(); 
            $this->load->model('Admin_model','warung');
            $this->warung->insert_warung();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Warung berhasil ditambahkan !</div>');
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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Warung berhasil diubah !</div>');
            redirect('auth/warung');
        }

        public function hapus_warung($id)
        {
            is_logged_in();
            $id = $this->uri->segment(3);
            $this->load->model('Admin_model','warung');
            $this->warung->hapus_warung($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
            redirect('auth/warung');
        }
     


        public function logout()
        {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('username');
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kamu Berhasil Logout !</div>');
                redirect('auth');
        }
}