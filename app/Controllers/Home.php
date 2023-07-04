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
            $data=[
                'listOfUser'=>$this->Data_model->ListOfUser()
            ];
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
}
