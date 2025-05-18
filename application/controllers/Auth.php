<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }
    
    public function index() {
        redirect('auth/login');
    }
    
    public function login() {
        // Cek sudah login atau belum
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }
        
        // Jika form disubmit
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $data['title'] = 'Login Admin';
                $this->load->view('admin/login', $data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                // Untuk pengujian sederhana
                if ($username === 'admin' && $password === 'admin123') {
                    $user_data = [
                        'username' => $username,
                        'logged_in' => TRUE
                    ];
                    
                    $this->session->set_userdata($user_data);
                    $this->session->set_flashdata('success', 'Login berhasil!');
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('error', 'Username atau password salah!');
                    redirect('auth/login');
                }
            }
        } else {
            // Tampilkan form login
            $data['title'] = 'Login Admin';
            $this->load->view('admin/login', $data);
        }
    }
    
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('success', 'Anda telah logout!');
        redirect('auth/login');
    }
}
