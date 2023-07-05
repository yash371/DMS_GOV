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

    public function ListOfUserByDepart($id){
            return $this->getQuery("SELECT * FROM `user` u INNER JOIN `employee` e ON u.user_id = e.user_id WHERE   u.dept_id = '$id'");
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

    public function setBundle($data){
        return $this->db->table('bundle')->insert($data);
    }
    public function getBundle($bundle_no='',$type='ASC'){
            if($bundle_no != ''){
                return $this->getQuery("SELECT * FROM `bundle` WHERE `bundle_no`='$bundle_no';");
            }
            return $this->getQuery("SELECT * FROM `bundle` ORDER BY `bundle`.`bundle_id` $type;");
    }
    public function setTempCases($data){
        return $this->db->table('temp_case_bucket')->insert($data);
    }
    public function getTempCases($type='ASC'){
        return $this->getQuery("SELECT * FROM `temp_case_bucket` ORDER BY `temp_case_bucket`.`barcode` $type ;");
    }
    public function trucateTempCases(){
        return $this->db->query("TRUNCATE `temp_case_bucket`;");
    }
    public function setCases($data){
        return $this->db->table('case_bucket')->insert($data);
    }

    public function getCases($barcode='',$type='ASC',$stage_id='',$join=false){
        if($barcode != ''){
            return $this->getQuery("SELECT * FROM `case_bucket` WHERE `barcode`='$barcode';");
        }
        if($join){
            return $this->getQuery("SELECT * FROM `case_bucket` c INNER JOIN `employee` e ON c.assign_user_id = e.user_id  WHERE c.stage_id='$stage_id' ORDER BY c.case_id $type ;");
        }
        if($stage_id !=''){
            return $this->getQuery("SELECT * FROM `case_bucket` WHERE `stage_id`='$stage_id';");
        }
        
        return $this->getQuery("SELECT * FROM `case_bucket` ORDER BY`case_bucket`.`case_id` $type;");
    }

    public function deleteTempcases($case_id){
        return $this->db->query("DELETE FROM `temp_case_bucket` WHERE `temp_case_bucket`.`case_id`='$case_id' ");
    }

    public function updateCaseAssignUser($case_id,$data){
        return $this->db->table('case_bucket')->where('case_id',$case_id)->update($data);
    }


}