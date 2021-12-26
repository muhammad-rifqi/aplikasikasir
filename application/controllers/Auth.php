<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
                $data['title'] = 'Login Aplikasi Kasir';
                $this->load->view('tamplates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('tamplates/auth_footer');
        }
        
        public function proses_login()
        {
            $email = $this->input->post('email');
            $passwords = $this->input->post('password');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
                'required' => 'Email Harus Diisi !',
                'valid_email' => 'Email Tidak Benar !'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'trim|required', [
                'required' => 'Password Harus Diisi !'
            ]);
            if($this->form_validation->run() != false){
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
    
        }


        public function dashboard()
        {
            $data = array();
            $data['title'] = 'Dashboard Aplikasi Kasir';
            $this->load->view('tamplates/header', $data);
            $this->load->view('admin/dashboard', $data);
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