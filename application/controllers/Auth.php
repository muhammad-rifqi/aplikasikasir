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
            $data['warung'] = $this->warung->getwarung();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/warung', $data);
            $this->load->view('tamplates/footer');
        }

        public function tambah_warung()
        {
            is_logged_in();  
            $data = array();
            $data['title'] = 'Tambah Warung';
            $data['warung_active'] = 'active';
            $this->load->model('admin_model', 'warung');
            $data['warung'] = $this->warung->getwarung();
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/tambah_warung', $data);
            $this->load->view('tamplates/footer');
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