<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menupermission extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Menupermissionmodel','Menupermissionmodel',TRUE);       
    }


    public function index()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            $result['userslist']=$this->Menupermissionmodel->getUserList($session['user_role']);
            $result['Menulist'] =$this->Menupermissionmodel->getMenuList($session['user_role'],$session['userid']);

            // pre( $result['Menulist']);exit;
            $page = "usermanagement/usermenu";
            $header="";                   
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }
    
    public function getUsersPermittedMenu()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            $userId=$this->input->post('userId');
            $menuId= $this->Menupermissionmodel->getUsersPermittedMenu($userId);
            $json_response = array(
                "data" =>$menuId
            );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
           
        }else{
			redirect('login','refresh');
		}
    }

    public function AssignMenu()
    {   $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{   

            $userId=$this->input->post('userId');
            $menuIds=explode(",",$this->input->post('MenuString'));

            $count=$this->Menupermissionmodel->getMenuCount($userId);

            if($count>0)
            {
                $this->Menupermissionmodel->DeletePermittedMenu($userId);
            }
            

                foreach ($menuIds as $key => $menuid) {
                    $insert_Arr=array(
                        "user_id"=>$userId,
                        "menu_id"=>$menuid,
                        'created_at'        =>date('Y-m-d H:i:s'),
                        'updated_at'        =>date('Y-m-d H:i:s'),
                    );

                    $masterId=$this->Menupermissionmodel->InsertPermittedMenu($insert_Arr);  
        
                    
                    /** audit trail */
                    $user_activity = array(
                        "activity_module_admin" => 'Menu Permission',
                        "activity_module" => 'Menupermission',
                        "action" => 'Delete & Insert',
                        "from_method" => 'AssignMenu',
                        "module_master_id" => $masterId,
                        "user_id" => $session['userid'],
                        "table_name" => 'menupermissions',
                        "user_browser" => getUserBrowserName(),
                        "user_platform" =>  getUserPlatform()
                    );
                    $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);
                    /** audit trail */
                } 
                    
            
            $json_response = array(
                "status"=>1,
                "msg" =>'Menu permitted successfully'
            );

            header('Content-Type: application/json');
            echo json_encode( $json_response );
            exit;
        }else{
            redirect('login','refresh');
        }
        
    }











}//end of class