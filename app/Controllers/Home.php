<?php

namespace App\Controllers;
use App\Models\Auth_model\Auth_model;
use App\Models\Data_model\Data_model;

class Home extends BaseController
{
    function __construct(){
        $this->session = session();
        $this->Auth_model=new Auth_model();
        $this->Data_model=new Data_model();
    }
    function createUserRegID(){
        $id=rand(1000000000,9999999999);
        $result=$this->Data_model->checkRegID($id);
        if(empty($result)){
            return $id;
        }else{
            return createUserRegID();
        }
    }
    public function Login($alert=''){
        if(!empty($this->session->get('User'))){
            return  redirect()->to(base_url() . 'dashboard');
        }
        $data=[
            'login_alert'=>$alert
        ];
        
        return view('UI/login', $data);
    }
    public function Index(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $data=[];
        if($this->session->get('User')->dept_id == 1){
            $listOfUser=$this->Data_model->ListOfUser();
            $this->session->set('listOfUser',$listOfUser);
        }
        return view('UI/index',$data);
    }
    public function User_login(){

        $username=$this->request->getPost('username');
        $password=$this->request->getPost('password');
        $result=$this->Auth_model->getUserByusername($username);
        if(!empty($result)){
           foreach($result as $key=>$value){
                if($value->password == $password){
                        $this->session->set('User',$value);
                        return  redirect()->to(base_url().'dashboard');
                }else{
                    return $this->Login($alert='Invalid Credential!!');
                }
           }
        }else{
            return $this->Login($alert='Invalid Credential!!');
        }

    }

    public function Logout(){
        $this->session->destroy();
        return redirect()->to(base_url());
    }
    
    public function AddEmploye(){
        $user_id=$this->request->getGet('user_id');
        if($user_id != null){
            $getDataBYID=$this->Data_model->ListOfUser($user_id);
            $data=[
                'reg_no'=>$this->createUserRegID(),
                'listOfUser'=>$this->Data_model->ListOfUser(),
                'update'=>true,
                'user_data'=>$getDataBYID,
            ];
        }else{
        $data=[
            'reg_no'=>$this->createUserRegID(),
            'listOfUser'=>$this->Data_model->ListOfUser(),
            'update'=>false
        ];
    }
       
        return view('UI/add_emp',$data);
    }
    public function AddEmployePost(){
        $Userdata=[
            'dept_id'=>$this->request->getPost('department'),
            'regd_no'=>$this->request->getPost('reg_no'),
            'email'=>$this->request->getPost('mail'),
            'mobile'=>$this->request->getPost('mobile'),
            'username'=>$this->request->getPost('reg_no'),
            'password'=>$this->request->getPost('password'),
            'user_role'=>$this->request->getPost('department'),
            'created_by'=>$this->session->get('User')->user_id,
        ];
        $push=$this->Data_model->insertUserData($Userdata);
        if($push){
            $LastId=1;
            $getUserDataDESC=$this->Data_model->getUserDataDESC();
            foreach($getUserDataDESC as $key=>$value){
                $LastId=$value->user_id;
                break;
            }

            $Empdata=[
                'user_id'=> $LastId,
                'fname'=>$this->request->getPost('emp_firstname'),
                'middle_name'=>$this->request->getPost('emp_middlename'),
                'surname'=>$this->request->getPost('emp_lastname'),
                'gender'=>$this->request->getPost('gender'),
              ];
            $push2=$this->Data_model->insertEmpData($Empdata);

            return redirect()->to(base_url().'add_employee');
        
        }else{
            return redirect()->to(base_url().'add_employee');
        }
       

    }

    public function UpdateEmploye(){
        $Userdata=[
            'dept_id'=>$this->request->getPost('department'),
            'email'=>$this->request->getPost('mail'),
            'mobile'=>$this->request->getPost('mobile'),
            'password'=>$this->request->getPost('password'),
            'user_role'=>$this->request->getPost('department')
        ];
        $Empdata=[
            'fname'=>$this->request->getPost('emp_firstname'),
            'middle_name'=>$this->request->getPost('emp_middlename'),
            'surname'=>$this->request->getPost('emp_lastname'),
            'gender'=>$this->request->getPost('gender'),
          ];
          $user_id=$this->request->getPost('user_id');
        $result1=$this->Data_model->updateUser($Userdata,$user_id);
        $result2=$this->Data_model->updateEmp($Empdata,$user_id);
        return redirect()->to(base_url().'add_employee');

    }
}
