<?php
namespace App\Models\Data_model;

use CodeIgniter\Model;

class Data_model extends Model{

    public function getQuery($query){
        return $this->db->query($query)->getResult();
    }
    public function ListOfUser($id=''){
            if($id !=''){
                return $this->getQuery("SELECT * FROM `user` WHERE `user_id`='$id'");
            }
            return $this->getQuery("SELECT * FROM `user`");
    }


}