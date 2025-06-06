<?php 
//   Controller for: home page
// Author: Nandkishor Wagh
// Start Date: 08-08-2022
// last updated: 16-08-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends CI_Controller {
	 
	function __construct() {

        parent::__construct();

        $this->arr_view_data = [];

// ---------------------- This is Live Code ---------------------------------------
	 }

	 
    //  public function edit($id)
    // {
    //     if ($id=='') 
    //     {
    //         $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //         redirect($this->module_url_path.'/index');
    //     }   

    //     if(is_numeric($id))
    //     {   
    //         $this->db->where('id',$id);
    //         $arr_data = $this->master_model->getRecords('travelers');
    //         if($this->input->post('submit'))
    //         {
    //             $this->form_validation->set_rules('fname', 'Full Name', 'required');
    //             $this->form_validation->set_rules('email', 'Email', 'required');
    //             $this->form_validation->set_rules('mobile', 'Mobile', 'required');
    //             $this->form_validation->set_rules('password', 'Password', 'required');
    //             if($this->form_validation->run() == TRUE)
    //             {              
                
    //                $full_name = trim($this->input->post('name'));
    //                $email = trim($this->input->post('email'));
    //                $mobile = trim($this->input->post('mobile'));
    //                $password = trim($this->input->post('password'));
                  
    //                 $arr_update = array(                       
    //                     'name' => $full_name,
    //                     'email' => $email,
    //                     'mobile' => $mobile,
    //                     'password' => $password,
    //                 );
    //                 $arr_where     = array("id" => $id);
    //                $this->master_model->updateRecord('travelers',$arr_update,$arr_where);
    //                 if($id > 0)
    //                 {
    //                     $this->session->set_flashdata('success_message',$this->module_title." Information Updated Successfully.");
    //                 }
    //                 else
    //                 {
    //                     $this->session->set_flashdata('error_message'," Something Went Wrong While Updating The ".ucfirst($this->module_title).".");
    //                 }
    //                 redirect($this->module_url_path.'/index');
    //             }   
    //         }
    //     }
    //     else
    //     {
    //         $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //         redirect($this->module_url_path.'/index');
    //     }
         
    //     $data = array('middle_content' => 'user_profile',
	// 					'user_profile_data'       => $arr_data
	// 					);
    //     $this->arr_view_data['page_title']     =  "User Profile";
    //     $this->arr_view_data['middle_content'] =  "index";
    //     // $this->load->view('front/common_view',$this->arr_view_data);
    //     $this->load->view('front/common_view',$data);
    //     // $this->load->view('front/index');
    // }
// ---------------------- This is Live Code ---------------------------------------

// ---------------------- This is my Local Code ---------------------------------------

    //     $this->module_url_path    =  base_url().$this->config->item('front_panel_slug')."dashboard";
    //     $this->module_view_folder = "dashboard/";
        
	//  }

	 
     public function index()
    {

        if($this->input->post('submit'))
        {  
            // print_r($_REQUEST); die;
                $this->form_validation->set_rules('mobile', 'Mobile', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if($this->form_validation->run() == TRUE)
                {              
                    $mobile_login = trim($this->input->post('mobile'));
                    $pass_login = trim($this->input->post('password'));
                  
                   $this->db->where('mobile_number',$mobile_login);
                   $this->db->where('password',$pass_login);
                   $this->db->where('for_credentials','yes');
                   $arr_data = $this->master_model->getRecord('all_traveller_info');        
                //    print_r($arr_data);  die;

                    if(empty($arr_data))
                    {    
                        $this->session->set_flashdata('error_message1',"Mobile Number Or Password Is Wrong.");
    
                    }
                     else
                    {
                        //  foreach($arr_data as $cust_data)
                        //  {
                            // print_r($arr_data); die;

                             $this->session->set_userdata('cust_email',$arr_data['email_id']);
                             $this->session->set_userdata('cust_mobile_no',$arr_data['mobile_number']);
                             $this->session->set_userdata('cust_sess_id',$arr_data['id']);
                             $this->session->set_userdata('cust_fname',$arr_data['first_name']);
                             $this->session->set_userdata('cust_mname',$arr_data['middle_name']);
                             $this->session->set_userdata('cust_lname',$arr_data['last_name']);
                             
                        //  }
     
                        //  redirect($this->module_url_path.'/index');
                        redirect(base_url().'tour_instruction/index');  
                 
               
                    }
                }
        }
        
         
        // $data = array(
        //                 // 'middle_content' => 'user_profile',
		// 				// 'user_profile_data'       => $arr_data
		// 				);
        $this->arr_view_data['page_title']     =  "dashboard";
        $this->arr_view_data['middle_content'] =  "dashboard";
        // $this->load->view('front/common_view',$this->arr_view_data);
        // $this->load->view('front/common_view',$data);
        // $this->load->view('front/index');
    }

    public function logout()
    {
        $this->session->unset_userdata('cust_sess_id');
        $this->session->unset_userdata('cust_mobile_no');
        $this->session->unset_userdata('cust_email');
        $this->session->unset_userdata('cust_fname');
        $this->session->unset_userdata('cust_mname');
        $this->session->unset_userdata('cust_lname');
        $this->session->sess_destroy();
        // redirect($this->module_url_path.'/index');  
        redirect(base_url().'home'); 
    }

// ---------------------- This is my Local Code ---------------------------------------


	

}