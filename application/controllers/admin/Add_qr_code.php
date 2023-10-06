<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_qr_code extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
	
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/add_qr_code";
        $this->module_title       = "QR Code";
        $this->module_url_slug    = "add_qr_code";
        $this->module_view_folder = "add_qr_code/";    
        $this->load->library('upload');
	}

	public function index()
	{
        $fields = "qr_code_master.*,role_type.role_name";
        $this->db->order_by('id','desc');
        $this->db->where('qr_code_master.is_deleted','no');
        $this->db->join("role_type", 'qr_code_master.role_name=role_type.id','left');
        $arr_data = $this->master_model->getRecords('qr_code_master',array('qr_code_master.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;
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
        if($this->input->post('submit'))
        {        
            $this->form_validation->set_rules('full_name', 'full_name', 'required');      
            $this->form_validation->set_rules('role_name', 'role_name', 'required');      
            $this->form_validation->set_rules('upi_id', 'upi_id', 'required');      
            
            if($this->form_validation->run() == TRUE)
            {
                $file_name     = $_FILES['image_name']['name'];
                $arr_extension = array('png','jpg','JPEG','PNG','JPG','jpeg');

                if($file_name!="")
                {               
                    $ext = explode('.',$_FILES['image_name']['name']); 
                    $config['file_name']   = $this->input->post('txtEmp_id').'.'.$ext[1];

                    if(!in_array($ext[1],$arr_extension))
                    {
                        $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
                        redirect($this->module_url_path.'/add');  
                    }
                }
                $file_name_to_dispaly =  $this->config->item('project_name').''.round(microtime(true)).str_replace(' ','_',$file_name);

                $config['upload_path']   = './uploads/QR_code_image/';
                $config['allowed_types'] = 'png|jpg|jpeg|PNG|JPEG|JPG';
                $config['max_size']      = '10000';
                $config['file_name']     =  $file_name_to_dispaly;
                $config['overwrite']     =  TRUE;

                $this->load->library('upload',$config);
                $this->upload->initialize($config); // Important

                if(!$this->upload->do_upload('image_name'))
                {  
                    $data['error'] = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message',$this->upload->display_errors());
                    redirect($this->module_url_path);  
                }

                if($file_name!="")
                {
                    $file_name = $this->upload->data();
                    $filename = $file_name_to_dispaly;
                    // if($old_img_name!='') unlink('./uploads/award/'.$old_img_name);
                }

                else
                {
                    $filename = $this->input->post('image_name',TRUE);
                }
              
                $full_name = trim($this->input->post('full_name'));
                $role_name = trim($this->input->post('role_name'));
                $other_role = trim($this->input->post('other_role'));
                $mobile_number = trim($this->input->post('mobile_number'));
                $upi_id = trim($this->input->post('upi_id'));
                $arr_insert = array(               
                    'full_name'  => $full_name,
                    'Role_name'  => $role_name,
                    'mobile_number'  => $mobile_number,
                    'other_role_name'  => $other_role,
                    'qr_code_image'      => $filename,
                    'upi_id'  => $upi_id
                ); 
                                
                $inserted_id = $this->master_model->insertRecord('qr_code_master',$arr_insert,true);
                               
                if($inserted_id > 0)
                {
                    $this->session->set_flashdata('success_message',ucfirst($this->module_title)." Added Successfully.");
                    redirect($this->module_url_path.'/index');
                }

                else
                {
                    $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            }   
        }  
        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $role_type_data = $this->master_model->getRecords('role_type');
        // // print_r($role_type_data); die;

        $this->db->order_by('id', 'desc');
        $this->db->where('is_deleted', 'no');
        $this->db->where('role_name !=', 'agent');
        $role_type_data = $this->master_model->getRecords('role_type');

        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['role_type_data'] = $role_type_data;
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }

    
   
    
   
  // Active/Inactive
  
  public function active_inactive($id,$type)
    {
	  $id=base64_decode($id);
        if($id!='' && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('qr_code_master');
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
            
            if($this->master_model->updateRecord('qr_code_master',$arr_update,array('id' => $id)))
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
            $arr_data = $this->master_model->getRecords('qr_code_master');
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('full_name', 'full_name', 'required');
                // $this->form_validation->set_rules('image_name','Image', '');
                if($this->form_validation->run() == TRUE)
                {
                 
                 $old_img_name = $this->input->post('old_img_name');
                
                    if(!empty($_FILES['image_name']) && $_FILES['image_name']['name'] !='')
                    {
                    $file_name     = $_FILES['image_name']['name'];
                    $arr_extension = array('png','jpg','JPEG','PNG','JPG','jpeg');

                    $file_name = $_FILES['image_name'];
                    $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG');

                    if($file_name['name']!="")
                    {
                        $ext = explode('.',$_FILES['image_name']['name']); 
                        $config['file_name'] = rand(1000,90000);

                        if(!in_array($ext[1],$arr_extension))
                        {
                            $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
                            redirect($this->module_url_path.'/edit/'.$id);
                        }
                    }   

                    $file_name_to_dispaly =  $this->config->item('project_name').round(microtime(true)).str_replace(' ','_',$file_name['name']);
                    
                    $config['upload_path']   = './uploads/QR_code_image/';
                    $config['allowed_types'] = 'png|jpg|jpeg|PNG|JPEG|JPG';
                    $config['max_size']      = '10000';
                    $config['file_name']     = $file_name_to_dispaly;
                    $config['overwrite']     = TRUE;
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config); // Important
                    
                    if(!$this->upload->do_upload('image_name'))
                    {  
                        $data['error'] = $this->upload->display_errors();
                        $this->session->set_flashdata('error_message',$this->upload->display_errors());
                        redirect($this->module_url_path.'/edit/'.$id);
                    }
                    if($file_name['name']!="")
                    {   
                        $file_name = $this->upload->data();
                        $filename = $file_name_to_dispaly;
                        if($old_img_name!='') unlink('./uploads/QR_code_image/'.$old_img_name);
                    }
                    else
                    {
                        $filename = $this->input->post('image_name',TRUE);
                    }
                }
                else
                {
                    $filename = $old_img_name;
                }
               
                
                $full_name = trim($this->input->post('full_name'));
                $role_name = trim($this->input->post('role_name'));
                $mobile_number = trim($this->input->post('mobile_number'));
                $other_role = trim($this->input->post('other_role'));
                $upi_id = trim($this->input->post('upi_id'));
                $arr_update = array(
                    'full_name'  => $full_name,
                    'Role_name'  => $role_name,
                    'mobile_number'  => $mobile_number,
                    'other_role_name'  => $other_role,
                    'qr_code_image'      => $filename,
                    'upi_id'  => $upi_id
                );
                
                    $arr_where     = array("id" => $id);
                    $this->master_model->updateRecord('qr_code_master',$arr_update,$arr_where);
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
        
        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $this->db->where('id',$id);
        $qr_code_master_data = $this->master_model->getRecords('qr_code_master');

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $role_type_data = $this->master_model->getRecords('role_type');
        
        $this->arr_view_data['qr_code_master_data']   = $qr_code_master_data;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['role_type_data']        = $role_type_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }

     
    public function delete($id)
    {
        $id=base64_decode($id);
        if($id!='')
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('qr_code_master');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('qr_code_master',$arr_update,$arr_where))
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
   

}