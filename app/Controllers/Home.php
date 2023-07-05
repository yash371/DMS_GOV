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
                        $caseTypes=$this->Data_model->getCaseTypes();
                        $this->session->set('caseTypes',$caseTypes);
                        $this->session->set('Bundle_master',false);
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
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        if($this->session->get('User')->dept_id !=1){
            return redirect()->to(base_url());
        }
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
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
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

    ///Bundle Master Section start

    public function BundleMaster(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $case_id=$this->request->getGet('temp_id');
        if($case_id != null){
            $this->Data_model->deleteTempcases($case_id);
        }
        if($this->session->get('Bundle_master')){
            
        }
        else
        {
            $this->Data_model->trucateTempCases();
            $newBundleNo='';
            $newBarcode='';
            $getBundleDetails=$this->Data_model->getBundle('','DESC');
            $getCasesDetails=$this->Data_model->getCases('','DESC');
         if(!empty($getBundleDetails)){
            foreach($getBundleDetails as $key=>$bundle){
                $newBundleNo=((int)$bundle->bundle_no) + 1;
                break;
            }
             }else{
            $newBundleNo="10000001";  
             } 
        if(!empty($getCasesDetails)){
            foreach($getCasesDetails as $key=>$cases){
                $newBarcode=((int)$cases->barcode) + 1;
                break;
            }
        }   else{
            $newBarcode='1000000001';
        }  
            $this->session->set('Session_Bundle_no',$newBundleNo);
            $this->session->set('Session_Case_no',$newBarcode);
            $this->session->set('Bundle_master',true);
    }      
        $data=[
            'temp_case_bucket'=>$this->Data_model->getTempCases()
        ];
        return view('UI/bundle_master',$data);
    }

    public function BundleMasterTempPost(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $data=[
            'bundle_no'=>$this->request->getPost('bundle_no'),
            'barcode'=>$this->request->getPost('barcode'),
            'case_no'=>$this->request->getPost('case_no'),
            'case_type_id'=>$this->request->getPost('case_type'),
            'case_name'=>$this->request->getPost('case_name'),
            'case_year'=>$this->request->getPost('case_year')
        ];
        $this->Data_model->setTempCases($data);
        $getTempCasesDetails=$this->Data_model->getTempCases('DESC');
        if(!empty($getTempCasesDetails)){
            foreach($getTempCasesDetails as $key=>$value){
                $newBarcode=((int)$value->barcode) + 1;
                $this->session->set('Session_Case_no',$newBarcode);
                break;
            }
        }
        return  redirect()->to(base_url().'bundle_master');
    }

    public function BundleMasterFinalPost(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $tempCases=$this->Data_model->getTempCases();
        $newBarcode='';
        $getCasesDetails=$this->Data_model->getCases('','DESC');
        if(!empty($getCasesDetails)){
            foreach($getCasesDetails as $key=>$cases){
                $newBarcode=((int)$cases->barcode) + 1;
                break;
            }
        }   else{
            $newBarcode='1000000001';
        }  
        if(!empty($tempCases)){
            foreach($tempCases as $key=>$value){
                if($key==0){
                    $BundleData=[
                        'bundle_no'=>$value->bundle_no,
                        'bundle_length'=>count($tempCases),
                        'created_by_user_id'=>$this->session->get('User')->user_id
                    ];
                    $this->Data_model->setBundle($BundleData);
                }
                $data=[
                    'bundle_no'=>$value->bundle_no,
                    'barcode'=>$newBarcode,
                    'case_no'=>$value->case_no,
                    'case_type_id'=>$value->case_type_id,
                    'case_name'=>$value->case_name,
                    'case_year'=>$value->case_year,
                    'stage_id'=>1,
                ];
                $this->Data_model->setCases($data);
                $newBarcode++;
                
            }
            $this->session->set('Bundle_master',false);
            return  redirect()->to(base_url());

        }
        else{
            return  redirect()->to(base_url().'bundle_master');
        }
    }

      //Bundle List
    public function BundleList(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $data=[
            'bundle_list'=>$this->Data_model->getBundle(),
            'case_list'=>$this->Data_model->getCases()
        ];
        return view('UI/bundle_list',$data);
    }

    /// Stage 1 -- Case Assignment
    public function CaseAssignment(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $user_id=$this->request->getPost('user_id');
        if($user_id != null){
            $case_id=$this->request->getPost('case_id');
            $da=[
                'assign_user_id'=>$user_id,
                'assign_time'=>date('Y/m/d h:i:s a', time()),
                'stage_id'=>2
            ];
            $this->Data_model->updateCaseAssignUser($case_id,$da);
        }
        $data=[
            'case_bucket'=>$this->Data_model->getCases('','ASC','1'),
            'users'=>$this->Data_model->ListOfUserByDepart(3)
        ];
        return view('UI/case_assignment',$data);
    }

    /// Stage 2 -- Assign Cases
    public function AssignCases(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $data=[
            'case_bucket'=>$this->Data_model->getCases('','DESC','2',true),
        ];
        return view('UI/assign_cases',$data);
    }

  

    //Scanner Part
    public function ScanCenter(){
        if(empty($this->session->get('User'))){
            return  redirect()->to(base_url());
        }
        $data=[
            'scan_list'=>$this->Data_model->getCases('','DESC','2',true)
        ];
    return view('UI/scan_center',$data);
    }
}
