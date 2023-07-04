<?php
namespace App\Models\Auth_model;

use CodeIgniter\Model;

class Auth_model extends Model{

    public function getUserByusername($username){
        return $this->db->query("SELECT * FROM `user` WHERE `username`='$username'")->getResult();
    }
}
?>