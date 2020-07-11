<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('commondatamodel','commondatamodel',TRUE);
        $this->load->model('Usermodel','user',TRUE);       
    }


    public function index()
	{   
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            // pre($session['userid']);
            $page = "usermanagement/user";
            $header="";       
            $result['userslist']=$this->user->getUserList($session['user_role']); 
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }

    public function create()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            $page = "usermanagement/createuser";
            $header="";  
            $result['userRoleList']=$this->user->getUserRoleList($session['user_role']);
            createbody_method($result, $page, $header, $session);
        }else{
			redirect('login','refresh');
		}
    }

    public function store()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{  
            $name=$this->input->post('name');
            $user_name=$this->input->post('user_name');
            $mobile_no=$this->input->post('mobile_no');
            $user_role_id=$this->input->post('user_role_id');
            $password=$this->input->post('password');
            $date=date('Y-m-d H:i:s');
             $insert_Arr=[
                 'name'=>$name,
                 'user_name'=>$user_name,
                 'mobile_no'=>$mobile_no,
                 'user_role_id'=>$user_role_id,
                 'password'=>md5($password),
                 'created_at'=>$date,
                 'updated_at'=>$date
             ];

            
            $id= $this->commondatamodel->insertSingleTableData('users',$insert_Arr);
            if ($id>0) {

                /** audit trail */
                $user_activity = array(
                    "activity_module_admin" => 'Create User',
                    "activity_module" => 'user',
                    "action" => 'Insert',
                    "from_method" => 'user/store',
                    "module_master_id" => $id,
                    "user_id" =>$session['userid'],
                    "table_name" => 'users',
                    "user_browser" => getUserBrowserName(),
                    "user_platform" =>  getUserPlatform(),
                    'ip_address'=>getUserIPAddress()
                );

                $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);


                $this->session->set_flashdata('success', 'User created successfully');
            }else{
                $this->session->set_flashdata('error', 'oops! an error occur');
            }
            redirect('user');

        }else{
			redirect('login','refresh');
		}
    }

    public function ActiveUser()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{   

            $userId=$this->uri->segment(3);            
            $this->user->ActiveInactiveUserAccount($userId,'Y');
            /** audit trail */
            $user_activity = array(
                "activity_module_admin" => 'Active User Account',
                "activity_module" => 'user',
                "action" => 'Insert',
                "from_method" => 'user/ActiveUser',
                "module_master_id" => $userId,
                "user_id" =>$session['userid'],
                "table_name" => 'users',
                "user_browser" => getUserBrowserName(),
                "user_platform" =>  getUserPlatform(),
                'ip_address'=>getUserIPAddress()
            );

            $this->commondatamodel->insertSingleTableData('activity_log',$user_activity);

            redirect('user','refresh');

        }else{
			redirect('login','refresh');
		}
    }
    public function InactiveUser()
    {
        $session = $this->session->userdata('user_detail');
		if($this->session->userdata('user_detail'))
		{   
            $userId=$this->uri->segment(3);
            $this->user->ActiveInactiveUserAccount($userId,'N');
            /** audit trail */
            $user_activity = array(
                "activity_module_admin" => 'Inactive User Account',
                "activity_module" => 'user',
                "action" => 'Insert',
                "from_method" => 'user/InactiveUser',
                "module_master_id" => $userId,
                "user_id" =>$session['userid'],
                "table_name" => 'users',
                "user_browser" => getUserBrowserName(),
                "user_platform" =>  getUserPlatform(),
                'ip_address'=>getUserIPAddress()
            );

            redirect('user','refresh');

        }else{
			redirect('login','refresh');
		}
    }
    
    public function getloginLogoutDetailByUserId()
    {
        $userid=$this->input->post('userid');
        
        $table="";
        $userActivity=$this->user->getUserAccountActivity($userid);
        $table="<table id='loginLogoutTable' class='table customTbl table-bordered table-striped dataTables' style='border-collapse: collapse !important;'>
                    <thead>
                        <tr>
                            <th>Login Date & Time</th>
                            <th>Logout Date & Time</th>
                            <th>Browser</th>
                            <th>Device OS</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($userActivity as $Activity) {
                            $table .="<tr>
                                        <td>".$Activity->login_time."</td>
                                        <td>".$Activity->logout_time."</td>
                                        <td>".$Activity->user_browser."</td>
                                        <td>".$Activity->user_platform."</td>                        
                                    </tr>";
                        }
                    $table .="</tbody>
                </table>";
        echo $table;
    }
 

}// end of class