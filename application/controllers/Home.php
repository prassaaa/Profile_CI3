<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
        $this->load->model('message_model');
    }
    
    public function index() {
        $data['profile'] = $this->profile_model->get_profile();
        $data['achievements'] = $this->profile_model->get_achievements();
        $data['education'] = $this->profile_model->get_education();
        $data['skills'] = $this->profile_model->get_skills_by_category();
        $data['projects'] = $this->profile_model->get_projects();
        $data['title'] = 'Profil Mahasiswa';
        
        $this->load->view('landing_page', $data);
    }
    
    public function send_message() {
        // Set validation rules
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subjek', 'required');
        $this->form_validation->set_rules('message', 'Pesan', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            ];
            
            if ($this->message_model->add_message($data)) {
                $this->session->set_flashdata('success', 'Pesan Anda telah terkirim!');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengirim pesan. Silakan coba lagi.');
            }
        }
        
        redirect('/#contact');
    }
}
