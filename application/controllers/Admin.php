<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load libraries
        $this->load->library('session');
        $this->load->library('form_validation');
        
        // Load helpers
        $this->load->helper('url');
        $this->load->helper('form');
        
        // Load models
        $this->load->model('profile_model');
        $this->load->model('message_model');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
    
    // Dashboard
    public function index() {
        $data['title'] = 'Dashboard Admin';
        
        // Untuk statistik dashboard
        $data['projects_count'] = count($this->profile_model->get_projects());
        $data['skills_count'] = count($this->profile_model->get_skills());
        $data['education_count'] = count($this->profile_model->get_education());
        $data['achievements_count'] = count($this->profile_model->get_achievements());
        
        // Untuk pesan terbaru
        $data['messages'] = array_slice($this->message_model->get_messages(), 0, 3);
        $data['unread_count'] = $this->message_model->get_unread_count();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
    }
    
    // Profil Management
    public function profile() {
        $data['title'] = 'Edit Profil';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['profile'] = $this->profile_model->get_profile();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_profile() {
        $data = [
            'name' => $this->input->post('name'),
            'title' => $this->input->post('title'),
            'nim' => $this->input->post('nim'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'birthdate' => $this->input->post('birthdate'),
            'about_me' => $this->input->post('about_me')
        ];
        
        // Handle photo upload
        if (!empty($_FILES['photo']['name'])) {
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = 'profile_' . time();
            
            // Create directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('photo')) {
                $upload_data = $this->upload->data();
                $data['photo'] = $upload_data['file_name'];
                
                // Delete old photo if exists
                $old_photo = $this->profile_model->get_profile()->photo;
                if (!empty($old_photo) && file_exists('./assets/uploads/' . $old_photo) && $old_photo != 'default.jpg') {
                    unlink('./assets/uploads/' . $old_photo);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/profile');
                return;
            }
        }
        
        if ($this->profile_model->update_profile($data)) {
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil!');
        }
        
        redirect('admin/profile');
    }
    
    // Achievement Management
	public function achievements() {
		$data['title'] = 'Kelola Prestasi & Sertifikasi';
		$data['unread_count'] = $this->message_model->get_unread_count();
		
		// Debug: tampilkan model yang digunakan
		echo "<!-- Loading profile_model... -->";
		$this->load->model('profile_model');
		
		// Debug: ambil data dan tampilkan jumlah
		$data['achievements'] = $this->profile_model->get_achievements();
		echo "<!-- Jumlah data di controller: " . count($data['achievements']) . " -->";
		
		// Debug: tampilkan data untuk cek
		echo "<!-- Data prestasi: ";
		print_r($data['achievements']);
		echo " -->";
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/achievements', $data);
		$this->load->view('admin/footer');
	}
    
    public function add_achievement() {
        $this->form_validation->set_rules('title', 'Judul', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/achievements');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'place' => $this->input->post('place'),
                'year' => $this->input->post('year'),
                'description' => $this->input->post('description')
            ];
            
            if ($this->profile_model->add_achievement($data)) {
                $this->session->set_flashdata('success', 'Prestasi berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan prestasi!');
            }
            
            redirect('admin/achievements');
        }
    }
    
    public function edit_achievement($id) {
        $data['title'] = 'Edit Prestasi & Sertifikasi';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['achievement'] = $this->profile_model->get_achievement($id);
        
        if (!$data['achievement']) {
            $this->session->set_flashdata('error', 'Prestasi tidak ditemukan!');
            redirect('admin/achievements');
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_achievement', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_achievement($id) {
        $this->form_validation->set_rules('title', 'Judul', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_achievement/'.$id);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'place' => $this->input->post('place'),
                'year' => $this->input->post('year'),
                'description' => $this->input->post('description')
            ];
            
            if ($this->profile_model->update_achievement($id, $data)) {
                $this->session->set_flashdata('success', 'Prestasi berhasil diperbarui!');
                redirect('admin/achievements');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui prestasi!');
                redirect('admin/edit_achievement/'.$id);
            }
        }
    }
    
    public function delete_achievement($id) {
        if ($this->profile_model->delete_achievement($id)) {
            $this->session->set_flashdata('success', 'Prestasi berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus prestasi!');
        }
        
        redirect('admin/achievements');
    }
    
    // Education Management
    public function education() {
        $data['title'] = 'Kelola Pendidikan';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['education'] = $this->profile_model->get_education();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/education', $data);
        $this->load->view('admin/footer');
    }
    
    public function add_education() {
        $this->form_validation->set_rules('institution', 'Institusi', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/education');
        } else {
            $data = [
                'institution' => $this->input->post('institution'),
                'degree' => $this->input->post('degree'),
                'start_year' => $this->input->post('start_year'),
                'end_year' => empty($this->input->post('end_year')) ? 0 : $this->input->post('end_year'),
                'description' => $this->input->post('description'),
                'gpa' => $this->input->post('gpa')
            ];
            
            if ($this->profile_model->add_education($data)) {
                $this->session->set_flashdata('success', 'Pendidikan berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan pendidikan!');
            }
            
            redirect('admin/education');
        }
    }
    
    public function edit_education($id) {
        $data['title'] = 'Edit Pendidikan';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['education'] = $this->profile_model->get_education_item($id);
        
        if (!$data['education']) {
            $this->session->set_flashdata('error', 'Pendidikan tidak ditemukan!');
            redirect('admin/education');
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_education', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_education($id) {
        $this->form_validation->set_rules('institution', 'Institusi', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_education/'.$id);
        } else {
            $data = [
                'institution' => $this->input->post('institution'),
                'degree' => $this->input->post('degree'),
                'start_year' => $this->input->post('start_year'),
                'end_year' => empty($this->input->post('end_year')) ? 0 : $this->input->post('end_year'),
                'description' => $this->input->post('description'),
                'gpa' => $this->input->post('gpa')
            ];
            
            if ($this->profile_model->update_education($id, $data)) {
                $this->session->set_flashdata('success', 'Pendidikan berhasil diperbarui!');
                redirect('admin/education');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui pendidikan!');
                redirect('admin/edit_education/'.$id);
            }
        }
    }
    
    public function delete_education($id) {
        if ($this->profile_model->delete_education($id)) {
            $this->session->set_flashdata('success', 'Pendidikan berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pendidikan!');
        }
        
        redirect('admin/education');
    }
    
    // Skills Management
    public function skills() {
        $data['title'] = 'Kelola Keahlian';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['skills'] = $this->profile_model->get_skills();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/skills', $data);
        $this->load->view('admin/footer');
    }
    
    public function add_skill() {
        $this->form_validation->set_rules('name', 'Nama Keahlian', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/skills');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'percentage' => $this->input->post('percentage')
            ];
            
            if ($this->profile_model->add_skill($data)) {
                $this->session->set_flashdata('success', 'Keahlian berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan keahlian!');
            }
            
            redirect('admin/skills');
        }
    }
    
    public function edit_skill($id) {
        $data['title'] = 'Edit Keahlian';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['skill'] = $this->profile_model->get_skill($id);
        
        if (!$data['skill']) {
            $this->session->set_flashdata('error', 'Keahlian tidak ditemukan!');
            redirect('admin/skills');
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_skill', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_skill($id) {
        $this->form_validation->set_rules('name', 'Nama Keahlian', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_skill/'.$id);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'category' => $this->input->post('category'),
                'percentage' => $this->input->post('percentage')
            ];
            
            if ($this->profile_model->update_skill($id, $data)) {
                $this->session->set_flashdata('success', 'Keahlian berhasil diperbarui!');
                redirect('admin/skills');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui keahlian!');
                redirect('admin/edit_skill/'.$id);
            }
        }
    }
    
    public function delete_skill($id) {
        if ($this->profile_model->delete_skill($id)) {
            $this->session->set_flashdata('success', 'Keahlian berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus keahlian!');
        }
        
        redirect('admin/skills');
    }
    
    // Projects Management
    public function projects() {
        $data['title'] = 'Kelola Proyek';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['projects'] = $this->profile_model->get_projects();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/projects', $data);
        $this->load->view('admin/footer');
    }
    
    public function add_project() {
        $this->form_validation->set_rules('title', 'Judul Proyek', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/projects');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'technologies' => $this->input->post('technologies'),
                'link' => $this->input->post('link')
            ];
            
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/uploads/projects/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'project_' . time();
                
                // Create directory if it doesn't exist
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $data['image'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/projects');
                    return;
                }
            }
            
            if ($this->profile_model->add_project($data)) {
                $this->session->set_flashdata('success', 'Proyek berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan proyek!');
            }
            
            redirect('admin/projects');
        }
    }
    
    public function edit_project($id) {
        $data['title'] = 'Edit Proyek';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['project'] = $this->profile_model->get_project($id);
        
        if (!$data['project']) {
            $this->session->set_flashdata('error', 'Proyek tidak ditemukan!');
            redirect('admin/projects');
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/edit_project', $data);
        $this->load->view('admin/footer');
    }
    
    public function update_project($id) {
        $this->form_validation->set_rules('title', 'Judul Proyek', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/edit_project/'.$id);
        } else {
            $project = $this->profile_model->get_project($id);
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'technologies' => $this->input->post('technologies'),
                'link' => $this->input->post('link')
            ];
            
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/uploads/projects/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'project_' . time();
                
                // Create directory if it doesn't exist
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $data['image'] = $upload_data['file_name'];
                    
                    // Delete old image if exists
                    if (!empty($project->image) && file_exists('./assets/uploads/projects/' . $project->image)) {
                        unlink('./assets/uploads/projects/' . $project->image);
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/edit_project/'.$id);
                    return;
                }
            }
            
            if ($this->profile_model->update_project($id, $data)) {
                $this->session->set_flashdata('success', 'Proyek berhasil diperbarui!');
                redirect('admin/projects');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui proyek!');
                redirect('admin/edit_project/'.$id);
            }
        }
    }
    
    public function delete_project($id) {
        $project = $this->profile_model->get_project($id);
        
        // Delete project image if exists
        if (!empty($project->image) && file_exists('./assets/uploads/projects/' . $project->image)) {
            unlink('./assets/uploads/projects/' . $project->image);
        }
        
        if ($this->profile_model->delete_project($id)) {
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus proyek!');
        }
        
        redirect('admin/projects');
    }
    
    // Messages Management
    public function messages() {
        $data['title'] = 'Kelola Pesan';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['messages'] = $this->message_model->get_messages();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/messages', $data);
        $this->load->view('admin/footer');
    }
    
    public function view_message($id) {
        $data['title'] = 'Lihat Pesan';
        $data['unread_count'] = $this->message_model->get_unread_count();
        $data['message'] = $this->message_model->get_message($id);
        
        if (!$data['message']) {
            $this->session->set_flashdata('error', 'Pesan tidak ditemukan!');
            redirect('admin/messages');
        }
        
        // Mark as read if unread
        if ($data['message']->read_status == 0) {
            $this->message_model->mark_as_read($id);
        }
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/view_message', $data);
        $this->load->view('admin/footer');
    }
    
    public function delete_message($id) {
        if ($this->message_model->delete_message($id)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pesan!');
        }
        
        redirect('admin/messages');
    }
    
    // Settings
    public function settings() {
        $data['title'] = 'Pengaturan';
        $data['unread_count'] = $this->message_model->get_unread_count();
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/footer');
    }
    
    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/settings');
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            
            // Load Auth model
            $this->load->model('auth_model');
            
            // Verify current password
            if ($this->auth_model->verify_password($user_id, $current_password)) {
                if ($this->auth_model->change_password($user_id, $new_password)) {
                    $this->session->set_flashdata('success', 'Password berhasil diperbarui!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui password!');
                }
            } else {
                $this->session->set_flashdata('error', 'Password saat ini tidak cocok!');
            }
            
            redirect('admin/settings');
        }
    }
}
