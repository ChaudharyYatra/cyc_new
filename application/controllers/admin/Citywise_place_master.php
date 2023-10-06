<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Citywise_place_master extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
		
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/citywise_place_master";
        $this->module_title       = "Citywise Place Master";
        $this->module_url_slug    = "citywise_place_master";
        $this->module_view_folder = "citywise_place_master/";
	}

	public function index()
	{  
        $fields = "citywise_place_master.*,district_table.district";
        $this->db->order_by('id','desc');
        $this->db->where('citywise_place_master.is_deleted','no');
        $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        $arr_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;

        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $arr_data = $this->master_model->getRecords('citywise_place_master');

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
            $this->form_validation->set_rules('select_district', 'select_district', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $select_district = $this->input->post('select_district');
                $approximate_hall_rate = $this->input->post('approximate_hall_rate');
                $separate_room_rate = $this->input->post('separate_room_rate');
                $dharmshala_rate = $this->input->post('dharmshala_rate');
                $state_tax = $this->input->post('state_tax');

                $Place_name = $this->input->post('Place_name');
                $opening_time = $this->input->post('opening_time');
                $closing_time = $this->input->post('closing_time');
                $open_days = $this->input->post('open_days');
                $req_time = $this->input->post('req_time');
                $ticket_yes_no = $this->input->post('ticket_yes_no');
                $ticket_cost = $this->input->post('ticket_cost');
                $allow_vehicle_types = $this->input->post('allow_vehicle_types');
                $railway_station_name = $this->input->post('railway_station_name');

                $count = count($Place_name);
                for($i=0;$i<$count;$i++)
                {
                    $arr_insert = array(
                        'select_district'   =>   $select_district,
                        'approximate_hall_rate'   =>   $approximate_hall_rate,
                        'separate_room_rate'   =>   $separate_room_rate,
                        'dharmshala_rate'   =>   $dharmshala_rate,
                        'state_tax'   =>   $state_tax,

                        'place_name'   =>   $Place_name[$i],
                        'opening_time'   =>   $opening_time[$i],
                        'closing_time'   =>   $closing_time[$i],
                        'open_days'   =>   $open_days[$i],
                        'req_time'   =>   $req_time[$i],
                        'ticket_yes_no'   =>   $ticket_yes_no[$i],
                        'ticket_cost'   =>   $ticket_cost[$i],
                        'allow_vehicle_types'   =>   $allow_vehicle_types[$i],
                        'railway_station_name'   =>   $railway_station_name[$i]
                    );
                
                    $inserted_id = $this->master_model->insertRecord('citywise_place_master',$arr_insert,true);
                   
                }
                               
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Citywise Place Added Successfully.");
                    redirect($this->module_url_path.'/index');
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            }   
        }

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $district_table = $this->master_model->getRecords('district_table');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $vehicle_type = $this->master_model->getRecords('vehicle_type');
        // print_r($district_table); die;

        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['district_table'] = $district_table;
        $this->arr_view_data['vehicle_type'] = $vehicle_type;
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
            $arr_data = $this->master_model->getRecords('citywise_place_master');
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
            
            if($this->master_model->updateRecord('citywise_place_master',$arr_update,array('id' => $id)))
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
            $arr_data = $this->master_model->getRecords('citywise_place_master');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }

            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('citywise_place_master',$arr_update,$arr_where))
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
            $arr_data = $this->master_model->getRecords('citywise_place_master');
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('select_district', 'select_district', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                    $select_district = $this->input->post('select_district');
                    $approximate_hall_rate = $this->input->post('approximate_hall_rate');
                    $separate_room_rate = $this->input->post('separate_room_rate');
                    $dharmshala_rate = $this->input->post('dharmshala_rate');
                    $state_tax = $this->input->post('state_tax');

                    $Place_name = $this->input->post('Place_name');
                    $opening_time = $this->input->post('opening_time');
                    $closing_time = $this->input->post('closing_time');
                    $open_days = $this->input->post('open_days');
                    $req_time = $this->input->post('req_time');
                    $ticket_yes_no = $this->input->post('ticket_yes_no');
                    $ticket_cost = $this->input->post('ticket_cost');
                    $allow_vehicle_types = $this->input->post('allow_vehicle_types');
                    $railway_station_name = $this->input->post('railway_station_name');

                   $arr_update = array(
                        'select_district'   =>   $select_district,
                        'approximate_hall_rate'   =>   $approximate_hall_rate,
                        'separate_room_rate'   =>   $separate_room_rate,
                        'dharmshala_rate'   =>   $dharmshala_rate,
                        'state_tax'   =>   $state_tax,

                        'place_name'   =>   $Place_name[$i],
                        'opening_time'   =>   $opening_time[$i],
                        'closing_time'   =>   $closing_time[$i],
                        'open_days'   =>   $open_days[$i],
                        'req_time'   =>   $req_time[$i],
                        'ticket_yes_no'   =>   $ticket_yes_no[$i],
                        'ticket_cost'   =>   $ticket_cost[$i],
                        'allow_vehicle_types'   =>   $allow_vehicle_types[$i],
                        'railway_station_name'   =>   $railway_station_name[$i]
                    );

                    $arr_where     = array("id" => $id);
                    $this->master_model->updateRecord('citywise_place_master',$arr_update,$arr_where);

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
         

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $district_table = $this->master_model->getRecords('district_table');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $vehicle_type = $this->master_model->getRecords('vehicle_type');
        // print_r($district_table); die;

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['district_table'] = $district_table;
        $this->arr_view_data['vehicle_type'] = $vehicle_type;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }
   
}