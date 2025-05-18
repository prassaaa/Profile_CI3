<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_profile() {
        $query = $this->db->get('profile');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        // Jika belum ada data, kembalikan objek kosong
        return (object) [
            'id' => null,
            'name' => '',
            'title' => '',
            'nim' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'birthdate' => '',
            'about_me' => '',
            'photo' => 'default.jpg'
        ];
    }
    
    public function update_profile($data) {
        if ($this->db->get('profile')->num_rows() > 0) {
            return $this->db->update('profile', $data);
        } else {
            return $this->db->insert('profile', $data);
        }
    }
    
    // Achievement methods
    public function get_achievements() {
    // Debug: tampilkan query
    $query = $this->db->order_by('year', 'DESC')->get('achievements');
    
    // Debug: cek jumlah hasil
    echo "<!-- Jumlah data prestasi: " . $query->num_rows() . " -->";
    
    return $query->result();
	}
    
    public function get_achievement($id) {
        return $this->db->where('id', $id)->get('achievements')->row();
    }
    
    public function add_achievement($data) {
        return $this->db->insert('achievements', $data);
    }
    
    public function update_achievement($id, $data) {
        return $this->db->where('id', $id)->update('achievements', $data);
    }
    
    public function delete_achievement($id) {
        return $this->db->where('id', $id)->delete('achievements');
    }
    
    // Education methods
    public function get_education() {
        return $this->db->order_by('start_year', 'DESC')->get('education')->result();
    }
    
    public function get_education_item($id) {
        return $this->db->where('id', $id)->get('education')->row();
    }
    
    public function add_education($data) {
        return $this->db->insert('education', $data);
    }
    
    public function update_education($id, $data) {
        return $this->db->where('id', $id)->update('education', $data);
    }
    
    public function delete_education($id) {
        return $this->db->where('id', $id)->delete('education');
    }
    
    // Skills methods
    public function get_skills() {
        return $this->db->order_by('percentage', 'DESC')->get('skills')->result();
    }
    
    public function get_skills_by_category() {
        $skills = $this->db->order_by('percentage', 'DESC')->get('skills')->result();
        $categorized = [];
        
        foreach ($skills as $skill) {
            $category = $skill->category;
            if (!isset($categorized[$category])) {
                $categorized[$category] = [];
            }
            $categorized[$category][] = $skill;
        }
        
        return $categorized;
    }
    
    public function get_skill($id) {
        return $this->db->where('id', $id)->get('skills')->row();
    }
    
    public function add_skill($data) {
        return $this->db->insert('skills', $data);
    }
    
    public function update_skill($id, $data) {
        return $this->db->where('id', $id)->update('skills', $data);
    }
    
    public function delete_skill($id) {
        return $this->db->where('id', $id)->delete('skills');
    }
    
    // Projects methods
    public function get_projects() {
        return $this->db->get('projects')->result();
    }
    
    public function get_project($id) {
        return $this->db->where('id', $id)->get('projects')->row();
    }
    
    public function add_project($data) {
        return $this->db->insert('projects', $data);
    }
    
    public function update_project($id, $data) {
        return $this->db->where('id', $id)->update('projects', $data);
    }
    
    public function delete_project($id) {
        return $this->db->where('id', $id)->delete('projects');
    }
}
