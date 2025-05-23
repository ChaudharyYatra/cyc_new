<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Boarding_expenses_master extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
		// hasemployeepanelaccess();
		// Check User Permission
		//hasModuleAccess(6);//set same module id as in module_master table

	   
        // $this->user_id            =  $this->session->userdata('nabcons_id');
        // $this->name               =  $this->session->userdata('nabcons_username');
        // $this->ip                 =  $this->input->ip_address();
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/boarding_expenses_master";
        $this->module_title       = "Boarding Expenses Master";
        $this->module_url_slug    = "boarding_expenses_master";
        $this->module_view_folder = "boarding_expenses_master/";    
        // $this->load->library('upload');
	}

	public function index()
	{  
        //$user_role = $this->session->userdata('nabcons_user_role');
        //$front_id = $this->session->userdata('nabcons_emp_id');

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $arr_data = $this->master_model->getRecords('hotel_master');

        // $this->arr_view_data['user_role']       = $user_role;
        // $this->arr_view_data['front_id']        = $front_id;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
	}
    
    public function add()
    {   

        // $nabcons_emp_id = $this->session->userdata('nabcons_emp_id');
        // $user_role = $this->session->userdata('nabcons_user_role');
       
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('from_seat_1', 'from_seat_1', 'required');
            $this->form_validation->set_rules('to_seat1', 'to_seat1', 'required');
            $this->form_validation->set_rules('rates1', 'rates1', 'required');

            $this->form_validation->set_rules('from_seat_2', 'from_seat_2', 'required');
            $this->form_validation->set_rules('to_seat2', 'to_seat2', 'required');
            $this->form_validation->set_rules('rates2', 'rates2', 'required');

            $this->form_validation->set_rules('from_seat_3', 'from_seat_3', 'required');
            $this->form_validation->set_rules('to_seat3', 'to_seat3', 'required');
            $this->form_validation->set_rules('rates3', 'rates3', 'required');

            $this->form_validation->set_rules('from_seat_4', 'from_seat_4', 'required');
            $this->form_validation->set_rules('to_seat4', 'to_seat4', 'required');
            $this->form_validation->set_rules('rates4', 'rates4', 'required');

            $this->form_validation->set_rules('from_seat_5', 'from_seat_5', 'required');
            $this->form_validation->set_rules('to_seat5', 'to_seat5', 'required');
            $this->form_validation->set_rules('rates5', 'rates5', 'required');

            $this->form_validation->set_rules('from_seat_6', 'from_seat_6', 'required');
            $this->form_validation->set_rules('to_seat6', 'to_seat6', 'required');
            $this->form_validation->set_rules('rates6', 'rates6', 'required');

            $this->form_validation->set_rules('from_seat_7', 'from_seat_7', 'required');
            $this->form_validation->set_rules('to_seat7', 'to_seat7', 'required');
            $this->form_validation->set_rules('rates7', 'rates7', 'required');

            $this->form_validation->set_rules('from_seat_8', 'from_seat_8', 'required');
            $this->form_validation->set_rules('to_seat8', 'to_seat8', 'required');
            $this->form_validation->set_rules('rates8', 'rates8', 'required');

            $this->form_validation->set_rules('from_seat_9', 'from_seat_9', 'required');
            $this->form_validation->set_rules('to_seat9', 'to_seat9', 'required');
            $this->form_validation->set_rules('rates9', 'rates9', 'required');

            $this->form_validation->set_rules('from_seat_10', 'from_seat_10', 'required');
            $this->form_validation->set_rules('to_seat10', 'to_seat10', 'required');
            $this->form_validation->set_rules('rates10', 'rates10', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $from_seat_1 = $this->input->post('from_seat_1'); 
                $to_seat1 = $this->input->post('to_seat1'); 
                $rates1 = $this->input->post('rates1'); 

                $from_seat_2 = $this->input->post('from_seat_2'); 
                $to_seat2 = $this->input->post('to_seat2'); 
                $rates2 = $this->input->post('rates2'); 

                $from_seat_3 = $this->input->post('from_seat_3'); 
                $to_seat3 = $this->input->post('to_seat3'); 
                $rates3 = $this->input->post('rates3'); 
                
                $from_seat_4 = $this->input->post('from_seat_4'); 
                $to_seat4 = $this->input->post('to_seat4'); 
                $rates4 = $this->input->post('rates4'); 
                
                $from_seat_5 = $this->input->post('from_seat_5'); 
                $to_seat5 = $this->input->post('to_seat5'); 
                $rates5 = $this->input->post('rates5'); 

                $from_seat_6 = $this->input->post('from_seat_6'); 
                $to_seat6 = $this->input->post('to_seat6'); 
                $rates6 = $this->input->post('rates6'); 

                $from_seat_7 = $this->input->post('from_seat_7'); 
                $to_seat7 = $this->input->post('to_seat7'); 
                $rates7 = $this->input->post('rates7'); 

                $from_seat_8 = $this->input->post('from_seat_8'); 
                $to_seat8 = $this->input->post('to_seat8'); 
                $rates8 = $this->input->post('rates8'); 

                $from_seat_9 = $this->input->post('from_seat_9'); 
                $to_seat9 = $this->input->post('to_seat9'); 
                $rates9 = $this->input->post('rates9'); 

                $from_seat_10 = $this->input->post('from_seat_10'); 
                $to_seat10 = $this->input->post('to_seat10'); 
                $rates10 = $this->input->post('rates10'); 

                $arr_insert = array(
                    'from_seat_1'   =>   $from_seat_1,
                    'to_seat1'   =>   $to_seat1,
                    'rates1'   =>   $rates1,

                    'from_seat_2'   =>   $from_seat_2,
                    'to_seat2'   =>   $to_seat2,
                    'rates2'   =>   $rates2,

                    'from_seat_3'   =>   $from_seat_3,
                    'to_seat3'   =>   $to_seat3,
                    'rates3'   =>   $rates3,

                    'from_seat_4'   =>   $from_seat_4,
                    'to_seat4'   =>   $to_seat4,
                    'rates4'   =>   $rates4,

                    'from_seat_5'   =>   $from_seat_5,
                    'to_seat5'   =>   $to_seat5,
                    'rates5'   =>   $rates5,

                    'from_seat_6'   =>   $from_seat_6,
                    'to_seat6'   =>   $to_seat6,
                    'rates6'   =>   $rates6,

                    'from_seat_7'   =>   $from_seat_7,
                    'to_seat7'   =>   $to_seat7,
                    'rates7'   =>   $rates7,

                    'from_seat_8'   =>   $from_seat_8,
                    'to_seat8'   =>   $to_seat8,
                    'rates8'   =>   $rates8,

                    'from_seat_9'   =>   $from_seat_9,
                    'to_seat9'   =>   $to_seat9,
                    'rates9'   =>   $rates9,

                    'from_seat_10'   =>   $from_seat_10,
                    'to_seat10'   =>   $to_seat10,
                    'rates10'   =>   $rates10,
                );
                
                // $this->db->where('hotel_name',$hotel_name);
                // $this->db->where('is_deleted','no');
                // $department_exist_data = $this->master_model->getRecords('boarding_expenses_master');
                // if(count($department_exist_data) > 0)
                // {
                //     $this->session->set_flashdata('error_message',"Hotel".$department." Already Exist.");
                //     redirect($this->module_url_path.'/add');
                // }
                
                $inserted_id = $this->master_model->insertRecord('boarding_expenses_master',$arr_insert,true);
                               
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"boarding Expenses Added Successfully.");
                    redirect($this->module_url_path.'/add');
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
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }

    

    

    

    
   
  // Active/Inactive
  
  public function active_inactive($id,$type)
    {
        if(is_numeric($id) && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('boarding_expenses_master');
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
            
            if($this->master_model->updateRecord('boarding_expenses_master',$arr_update,array('id' => $id)))
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
        
        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('boarding_expenses_master');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('boarding_expenses_master',$arr_update,$arr_where))
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
        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('boarding_expenses_master');
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('from_seat_1', 'from_seat_1', 'required');
            $this->form_validation->set_rules('to_seat1', 'to_seat1', 'required');
            $this->form_validation->set_rules('rates1', 'rates1', 'required');

            $this->form_validation->set_rules('from_seat_2', 'from_seat_2', 'required');
            $this->form_validation->set_rules('to_seat2', 'to_seat2', 'required');
            $this->form_validation->set_rules('rates2', 'rates2', 'required');

            $this->form_validation->set_rules('from_seat_3', 'from_seat_3', 'required');
            $this->form_validation->set_rules('to_seat3', 'to_seat3', 'required');
            $this->form_validation->set_rules('rates3', 'rates3', 'required');

            $this->form_validation->set_rules('from_seat_4', 'from_seat_4', 'required');
            $this->form_validation->set_rules('to_seat4', 'to_seat4', 'required');
            $this->form_validation->set_rules('rates4', 'rates4', 'required');

            $this->form_validation->set_rules('from_seat_5', 'from_seat_5', 'required');
            $this->form_validation->set_rules('to_seat5', 'to_seat5', 'required');
            $this->form_validation->set_rules('rates5', 'rates5', 'required');

            $this->form_validation->set_rules('from_seat_6', 'from_seat_6', 'required');
            $this->form_validation->set_rules('to_seat6', 'to_seat6', 'required');
            $this->form_validation->set_rules('rates6', 'rates6', 'required');

            $this->form_validation->set_rules('from_seat_7', 'from_seat_7', 'required');
            $this->form_validation->set_rules('to_seat7', 'to_seat7', 'required');
            $this->form_validation->set_rules('rates7', 'rates7', 'required');

            $this->form_validation->set_rules('from_seat_8', 'from_seat_8', 'required');
            $this->form_validation->set_rules('to_seat8', 'to_seat8', 'required');
            $this->form_validation->set_rules('rates8', 'rates8', 'required');

            $this->form_validation->set_rules('from_seat_9', 'from_seat_9', 'required');
            $this->form_validation->set_rules('to_seat9', 'to_seat9', 'required');
            $this->form_validation->set_rules('rates9', 'rates9', 'required');

            $this->form_validation->set_rules('from_seat_10', 'from_seat_10', 'required');
            $this->form_validation->set_rules('to_seat10', 'to_seat10', 'required');
            $this->form_validation->set_rules('rates10', 'rates10', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                    $from_seat_1 = $this->input->post('from_seat_1'); 
                $to_seat1 = $this->input->post('to_seat1'); 
                $rates1 = $this->input->post('rates1'); 

                $from_seat_2 = $this->input->post('from_seat_2'); 
                $to_seat2 = $this->input->post('to_seat2'); 
                $rates2 = $this->input->post('rates2'); 

                $from_seat_3 = $this->input->post('from_seat_3'); 
                $to_seat3 = $this->input->post('to_seat3'); 
                $rates3 = $this->input->post('rates3'); 
                
                $from_seat_4 = $this->input->post('from_seat_4'); 
                $to_seat4 = $this->input->post('to_seat4'); 
                $rates4 = $this->input->post('rates4'); 
                
                $from_seat_5 = $this->input->post('from_seat_5'); 
                $to_seat5 = $this->input->post('to_seat5'); 
                $rates5 = $this->input->post('rates5'); 

                $from_seat_6 = $this->input->post('from_seat_6'); 
                $to_seat6 = $this->input->post('to_seat6'); 
                $rates6 = $this->input->post('rates6'); 

                $from_seat_7 = $this->input->post('from_seat_7'); 
                $to_seat7 = $this->input->post('to_seat7'); 
                $rates7 = $this->input->post('rates7'); 

                $from_seat_8 = $this->input->post('from_seat_8'); 
                $to_seat8 = $this->input->post('to_seat8'); 
                $rates8 = $this->input->post('rates8'); 

                $from_seat_9 = $this->input->post('from_seat_9'); 
                $to_seat9 = $this->input->post('to_seat9'); 
                $rates9 = $this->input->post('rates9'); 

                $from_seat_10 = $this->input->post('from_seat_10'); 
                $to_seat10 = $this->input->post('to_seat10'); 
                $rates10 = $this->input->post('rates10'); 
                   
                    $this->db->where('hotel_name',$hotel_name);
                    $this->db->where('id!='.$id);
                    $this->db->where('is_deleted','no');
                    $bus_master_exist_data = $this->master_model->getRecords('boarding_expenses_masters');
                    if(count($bus_master_exist_data) > 0)
                    {
                        $this->session->set_flashdata('error_message',"Bus".$department." Already Exist.");
                        redirect($this->module_url_path.'/add');
                    }
                    
                    
                    $arr_update = array(
                        'from_seat_1'   =>   $from_seat_1,
                    'to_seat1'   =>   $to_seat1,
                    'rates1'   =>   $rates1,

                    'from_seat_2'   =>   $from_seat_2,
                    'to_seat2'   =>   $to_seat2,
                    'rates2'   =>   $rates2,

                    'from_seat_3'   =>   $from_seat_3,
                    'to_seat3'   =>   $to_seat3,
                    'rates3'   =>   $rates3,

                    'from_seat_4'   =>   $from_seat_4,
                    'to_seat4'   =>   $to_seat4,
                    'rates4'   =>   $rates4,

                    'from_seat_5'   =>   $from_seat_5,
                    'to_seat5'   =>   $to_seat5,
                    'rates5'   =>   $rates5,

                    'from_seat_6'   =>   $from_seat_6,
                    'to_seat6'   =>   $to_seat6,
                    'rates6'   =>   $rates6,

                    'from_seat_7'   =>   $from_seat_7,
                    'to_seat7'   =>   $to_seat7,
                    'rates7'   =>   $rates7,

                    'from_seat_8'   =>   $from_seat_8,
                    'to_seat8'   =>   $to_seat8,
                    'rates8'   =>   $rates8,

                    'from_seat_9'   =>   $from_seat_9,
                    'to_seat9'   =>   $to_seat9,
                    'rates9'   =>   $rates9,

                    'from_seat_10'   =>   $from_seat_10,
                    'to_seat10'   =>   $to_seat10,
                    'rates10'   =>   $rates10
                    );
                    $arr_where     = array("id" => $id);
                   $this->master_model->updateRecord('boarding_expenses_master',$arr_update,$arr_where);
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
        else
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }
         
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }
   
}