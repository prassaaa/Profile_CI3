<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login($username, $password) {
        $query = $this->db->where('username', $username)->get('users');
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            if (password_verify($password, $user->password)) {
                $this->db->where('id', $user->id)->update('users', [
                    'last_login' => date('Y-m-d H:i:s')
                ]);
                return $user;
            }
        }
        
        return false;
    }
    
    public function change_password($user_id, $new_password) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        return $this->db->where('id', $user_id)
                        ->update('users', ['password' => $hashed]);
    }
}
