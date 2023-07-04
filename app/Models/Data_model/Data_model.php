<?php
namespace App\Models\Data_model;

use CodeIgniter\Model;

class Data_model extends Model{

    public function getQuery($query){
        return $this->db->query($query)->getResult();
    }
    public function ListOfUser($id=''){
            if($id !=''){
                return $this->getQuery("SELECT * FROM `user` u INNER JOIN `employee` e ON u.user_id = e.user_id WHERE u.`user_id`='$id' AND  u.dept_id != 1");
            }
            return $this->getQuery("SELECT * FROM `user` u INNER JOIN `employee` e ON u.user_id = e.user_id WHERE u.dept_id != 1");
    }

    public function checkRegID($id){
        return $this->getQuery("SELECT * FROM `user` WHERE `regd_no`='$id'");
    }

    public function insertUserData($data){
        return $this->db->table('user')->insert($data);
    }
    public function insertEmpData($data){
        return $this->db->table('employee')->insert($data);
    }
    public function getUserDataDESC(){
        return $this->getQuery("SELECT * FROM `user` ORDER BY `user`.`user_id` DESC");
    }

    public function updateUser($userData,$user_id){
        return $this->db->table('user')->where('user_id',$user_id)->update($userData);
    }
    public function updateEmp($empData,$user_id){
        return $this->db->table('employee')->where('user_id',$user_id)->update($empData);
    }

    public function getCaseTypes(){
        return $this->getQuery("SELECT * FROM `case_types` WHERE `case_types`.`status`= 1 ");
    }


}