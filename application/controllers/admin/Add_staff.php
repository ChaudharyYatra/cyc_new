<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_staff extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
		
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/add_staff";
        $this->module_title       = "Add Staff";
        $this->module_url_slug    = "add_staff";
        $this->module_view_folder = "add_staff/";
	}

	public function index($id,$did)
	{  

        $id=base64_decode($id);
        // print_r($id);
        $did=base64_decode($did);
        // print_r($did);
        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        } 

        $fields = "add_staff.*,role_type.*,add_staff.id as add_staff_id,add_staff.is_active as add_staff_is_active";
        $this->db->where('add_staff.is_deleted','no');
        $this->db->where('add_staff.tour_creation_id',$id);
        $this->db->join("role_type", 'add_staff.role_type=role_type.id','left');
        // $this->db->join("supervision", 'add_staff.staff_name=supervision.id','left');
        $arr_data = $this->master_model->getRecords('add_staff',array('add_staff.is_deleted'=>'no'),$fields);

        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $this->db->where('is_active','yes');
        // $this->db->where('tour_creation_id',$id);
        // $arr_data = $this->master_model->getRecords('add_staff');

        // print_r($arr_data);

        $this->db->where('is_active','yes');
        $this->db->where('is_deleted','no');
        $this->db->where('id',$id);
        $this->db->where('tour_number_of_days',$did);
        $arr_data2 = $this->master_model->getRecords('tour_creation');

        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['arr_data2']        = $arr_data2;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
	}
    
    public function add($tour_creation_id,$tour_day)
    {   

        if($this->input->post('submit'))
        {

            $tour_cre_id=base64_decode($tour_creation_id);
            // print_r($tour_creation_id);
            $tour_days=base64_decode($tour_day);
            // print_r($tour_day);
            

                $role_type = $this->input->post('role_type');
                // $staff_name = $this->input->post('staff_name');
                $daywise_salary = $this->input->post('daywise_salary');
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');

                $count = count($daywise_salary);
                for($i=0;$i<$count;$i++)
                {
                    $arr_insert = array(
                        'tour_creation_id'   =>   $tour_cre_id,
                        'tour_no_of_days'   =>   $tour_days,
                        'role_type'   =>   $_POST["role_type"][$i],
                        'daywise_salary'   =>   $_POST["daywise_salary"][$i],
                        'start_date'   =>   $_POST["start_date"][$i],
                        'end_date'   =>   $_POST["end_date"][$i]
                    ); 
                    $inserted_id = $this->master_model->insertRecord('add_staff',$arr_insert,true);
                }
                    
                               
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Staff Added Successfully.");
                    redirect($this->module_url_path.'/index/'.$tour_creation_id.'/'.$tour_day);
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            
        }

        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $role_type = $this->master_model->getRecords('role_type');


        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['role_type']    = $role_type;
        $this->arr_view_data['tour_creation_id']    = $tour_creation_id;
        $this->arr_view_data['tour_day']    = $tour_day;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }

    public function getrolename(){ 
        // POST data 
        // $all_b=array();
        $getname = $this->input->post('did');
        // print_r($getname); die;
        
            $this->db->where('is_deleted','no');
            $this->db->where('is_active','yes');
            $this->db->where('role_type',$getname);   
            $data = $this->master_model->getRecords('supervision');
        
        echo json_encode($data);
    }


    public function active_inactive($tour_creation_id,$tour_day,$id,$type)
    {
        $encoded_tour_creation_id = rtrim(base64_encode($tour_creation_id), '=');
        $encoded_tour_no_of_days = rtrim(base64_encode($tour_day), '=');

        if(is_numeric($id) && ($type == "yes" || $type == "no") )
        {  
            // print_r($id); die;
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('add_staff');
            // print_r($arr_data); die;
            
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
            // print_r($arr_update); die;
            // if($this->master_model->updateRecord('add_staff',$arr_update,array('id' => $id)))
            if($this->master_model->updateRecord('add_staff', $arr_update, array('add_staff.id' => $id)))
            {
                $this->session->set_flashdata('success_message',$this->module_title.' Updated Successfully.');
                redirect($this->module_url_path.'/index/'.$encoded_tour_creation_id.'/'.$encoded_tour_no_of_days);
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
    public function delete($id,$tour_creation_id,$tour_day)
    {
        $encoded_tour_creation_id = rtrim(base64_encode($tour_creation_id), '=');
        $encoded_tour_no_of_days = rtrim(base64_encode($tour_day), '=');
        // print_r($id); die;
        if($id!='')
        {  
            $arr_where = "(id = $id)";
            $arr_data = $this->master_model->getRecords('add_staff');
            // print_r($arr_data); die;
            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            // $arr_where = array("id" => $id,"state_sigle_insert_id" => $id);
                 
            if($this->master_model->updateRecord('add_staff',$arr_update,$arr_where))
            {
                $this->session->set_flashdata('success_message',$this->module_title.' Deleted Successfully.');
                redirect($this->module_url_path.'/index/'.$encoded_tour_creation_id.'/'.$encoded_tour_no_of_days);
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

    public function edit($id,$tour_creation_id,$role_type_id,$tour_no_of_days)
    {
        $encoded_tour_creation_id = rtrim(base64_encode($tour_creation_id), '=');
        $encoded_tour_no_of_days = rtrim(base64_encode($tour_no_of_days), '=');

        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('add_staff');
            
            if($this->input->post('submit'))
            {
                
                    
                    $role_type = $this->input->post('role_type');
                    // $staff_name = $this->input->post('staff_name');
                    $daywise_salary = $this->input->post('daywise_salary');
                    $start_date = $this->input->post('start_date');
                    $end_date = $this->input->post('end_date');


                   $arr_update = array(
                        'role_type'   =>   $role_type,
                        // 'staff_name'   =>   $staff_name,
                        'daywise_salary'   =>  $daywise_salary,
                        'start_date'   =>  $start_date,
                        'end_date'   =>  $end_date

                    );
                     $arr_where     = array("id" => $id);
                     $this->master_model->updateRecord('add_staff',$arr_update,$arr_where);

                    if($id > 0)
                    {
                        $this->session->set_flashdata('success_message',$this->module_title." Information Updated Successfully.");
                        redirect($this->module_url_path.'/index/'.$encoded_tour_creation_id.'/'.$encoded_tour_no_of_days);
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message'," Something Went Wrong While Updating The ".ucfirst($this->module_title).".");
                    }
                    redirect($this->module_url_path.'/index');
                 
            }
        }
        else
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }
         
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $role_type = $this->master_model->getRecords('role_type');

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $this->db->where('role_type',$role_type_id);
        $supervision = $this->master_model->getRecords('supervision');

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['role_type']    = $role_type;
        $this->arr_view_data['id']    = $id;
        $this->arr_view_data['tour_creation_id']    = $tour_creation_id;
        $this->arr_view_data['role_type_id']    = $role_type_id;
        $this->arr_view_data['tour_no_of_days']    = $tour_no_of_days;
        $this->arr_view_data['supervision']    = $supervision;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }



    public function add_more_delete()
    {
        $id  = $this->input->post('request_id');

        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('state_table');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('state_table',$arr_update,$arr_where))
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

        return true; 
    }
   
}