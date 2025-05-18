<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_messages() {
        return $this->db->order_by('created_at', 'DESC')->get('messages')->result();
    }
    
    public function get_message($id) {
        return $this->db->where('id', $id)->get('messages')->row();
    }
    
    public function get_unread_count() {
        return $this->db->where('read_status', 0)->count_all_results('messages');
    }
    
    public function add_message($data) {
        return $this->db->insert('messages', $data);
    }
    
    public function mark_as_read($id) {
        return $this->db->where('id', $id)->update('messages', ['read_status' => 1]);
    }
    
    public function delete_message($id) {
        return $this->db->where('id', $id)->delete('messages');
    }
}
