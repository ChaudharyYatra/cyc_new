<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class All_other_qr extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('agent_sess_id')=="") 
        { 
                redirect(base_url().'agent/login'); 
        }
		// hasemployeepanelaccess();
		// Check User Permission
		//hasModuleAccess(6);//set same module id as in module_master table

	   
        // $this->user_id            =  $this->session->userdata('nabcons_id');
        // $this->name               =  $this->session->userdata('nabcons_username');
        // $this->ip                 =  $this->input->ip_address();
        $this->module_url_path    =  base_url().$this->config->item('agent_panel_slug')."/all_other_qr";
        $this->module_title       = "All Other QR";
        $this->module_url_slug    = "all_other_qr";
        $this->module_view_folder = "all_other_qr/";    
        // $this->load->library('upload');
	}

	public function index()
	{  
       
        //$user_role = $this->session->userdata('nabcons_user_role');
        //$front_id = $this->session->userdata('nabcons_emp_id');

        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $arr_data = $this->master_model->getRecords('academic_years');

        $record = array();
        $fields = "qr_code_add_more.*,qr_code_master.full_name,upi_apps_name.payment_app_name";
        $this->db->where('qr_code_add_more.is_deleted','no');
        $this->db->where('qr_code_add_more.is_agent','no');
        $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
        $this->db->join("qr_code_master", 'qr_code_add_more.qr_code_master_id=qr_code_master.id','left');
        $arr_data = $this->master_model->getRecords('qr_code_add_more',array('qr_code_add_more.is_deleted'=>'no'),$fields);

        // $this->arr_view_data['user_role']       = $user_role;
        // $this->arr_view_data['front_id']        = $front_id;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
	}
    
    public function add()
    {   

        // $nabcons_emp_id = $this->session->userdata('nabcons_emp_id');
        // $user_role = $this->session->userdata('nabcons_user_role');
       
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('year', 'Year', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $year = $this->input->post('year');
                
                $this->db->where('year',$year);
                $this->db->where('is_deleted','no');
                $academic_year_exist_data = $this->master_model->getRecords('academic_years');
                if(count($academic_year_exist_data) > 0)
                {
                    $this->session->set_flashdata('error_message',"Academic Year ".$year." Already Exist.");
                    redirect($this->module_url_path.'/add');
                }
                
                $arr_insert = array(
                    'year'   =>   $year
                );
                
                $inserted_id = $this->master_model->insertRecord('academic_years',$arr_insert,true);
                               
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Academic Year Added Successfully.");
                    redirect($this->module_url_path.'/index');
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            }   
        }

        //$img_id = $this->master_model->next_id("id", "nabcons_blogs");
        //$this->arr_view_data['img']          = $img_id;

        $this->arr_view_data['action']          = 'add';
        //$this->arr_view_data['user_role']       = $user_role; 
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
    }

    
  // Active/Inactive
  
  public function active_inactive($id,$type)
    {
	  $id=base64_decode($id);
        if($id!='' && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('academic_years');
            if(empty($arr_data))
            {
               $this->session->set_flashdata('error_message','Invalid Selection Of Record');
               redirect($this->module_url_path.'/index');
            }   

            $arr_update =  array();

            if($type == 'yes')
            {
                $arr_update['is_active'] = "no";
            }
            else
            {
                $arr_update['is_active'] = "yes";
            }
            
            if($this->master_model->updateRecord('academic_years',$arr_update,array('id' => $id)))
            {
                $this->session->set_flashdata('success_message',$this->module_title.' Updated Successfully.');
            }
            else
            {
             $this->session->set_flashdata('error_message'," Something Went Wrong While Updating The ".ucfirst($this->module_title).".");
            }
        }
        else
        {
           $this->session->set_flashdata('error_message','Invalid Selection Of Record');
        }
        redirect($this->module_url_path.'/index');   
    }

    
    // Delete
    
    public function delete($id)
    {
        $id=base64_decode($id);
        if($id!='')
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('academic_years');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('academic_years',$arr_update,$arr_where))
            {
                $this->session->set_flashdata('success_message',$this->module_title.' Deleted Successfully.');
            }
            else
            {
                $this->session->set_flashdata('error_message','Oops,Something Went Wrong While Deleting Record.');
            }
        }
        else
        {
           
               $this->session->set_flashdata('error_message','Invalid Selection Of Record');
        }
        redirect($this->module_url_path.'/index');  
    }
   
    // Edit - Get data for edit
    
    public function edit($id)
    {
		$id=base64_decode($id);
        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

       	else
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('academic_years');
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('year', 'Academic Year', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                   $year = trim($this->input->post('year'));
                   
                    $this->db->where('year',$year);
                    $this->db->where('id!='.$id);
                    $this->db->where('is_deleted','no');
                    $academic_year_exist_data = $this->master_model->getRecords('academic_years');
                    if(count($academic_year_exist_data) > 0)
                    {
                        $this->session->set_flashdata('error_message',"Academic Year ".$year." Already Exist.");
                        redirect($this->module_url_path.'/add');
                    }
                   
                    $arr_update = array(
                        'year' => $year
                    );
                    $arr_where     = array("id" => $id);
                   $this->master_model->updateRecord('academic_years',$arr_update,$arr_where);
                    if($id > 0)
                    {
                        $this->session->set_flashdata('success_message',$this->module_title." Information Updated Successfully.");
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message'," Something Went Wrong While Updating The ".ucfirst($this->module_title).".");
                    }
                    redirect($this->module_url_path.'/index');
                }   
            }
        }
         
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
    }
   
}