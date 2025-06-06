<?php 
//   Controller for: 
// Author: Vivek Patil
// Start Date: 21-12-2022
// last updated: 

defined('BASEPATH') OR exit('No direct script access allowed');

class Stationary_request_reject extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        if($this->session->userdata('stationary_sess_id')=="") 
        { 
                redirect(base_url().'stationary/login'); 
        }
        $this->module_url_path    =  base_url().$this->config->item('stationary_panel_slug')."stationary/stationary_request_reject";
        $this->module_title       = "Stationary Request Reject ";
        $this->module_url_slug    = "stationary_request_reject";
        $this->module_view_folder = "stationary_request_reject/";
        $this->arr_view_data = [];
	 }

     public function index()
     {
        $stationary_sess_name = $this->session->userdata('stationary_name');
        $id = $this->session->userdata('stationary_sess_id');

         $record = array();
         $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
         $this->db->order_by('stationary_order.created_at','desc');
         $this->db->where('stationary_order_details.order_status','requested');
        //  $this->db->where('stationary_order.received_status','no');
         $this->db->where('stationary_order.reject_status','yes');
         $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $this->db->join("stationary_order_details", 'stationary_order_details.order_id=stationary_order.id','left');
         $this->db->group_by('stationary_order_details.order_id');
         $arr_data = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
        

         $this->arr_view_data['stationary_sess_name'] = $stationary_sess_name;
         $this->arr_view_data['listing_page']    = 'yes';
         $this->arr_view_data['arr_data']        = $arr_data;
         $this->arr_view_data['page_title']      = $this->module_title." List";
         $this->arr_view_data['module_title']    = $this->module_title;
         $this->arr_view_data['module_url_path'] = $this->module_url_path;
         $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
         $this->load->view('stationary/layout/stationary_combo',$this->arr_view_data);
        
     }

    // Get Details 
    public function details($id)
    {
        $stationary_sess_name = $this->session->userdata('stationary_name');
       // $id = $this->session->userdata('stationary_sess_id');

        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

         $record = array();
         $fields = "stationary_order_details.*,stationary_order_details.stationary_name as sta_id,stationary.stationary_name,
         stationary.series_yes_no,agent.agent_name,agent.booking_center,department.department,stationary.id as stid";
         $this->db->order_by('stationary_order_details.created_at','desc');
         $this->db->where('stationary_order_details.is_deleted','no');
         $this->db->where('stationary_order_details.reject_status','yes');
         $this->db->where('stationary_order_details.order_id',$id);
         $this->db->join("stationary", 'stationary_order_details.stationary_name=stationary.id','left');
         $this->db->join("agent", 'stationary_order_details.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $arr_data = $this->master_model->getRecords('stationary_order_details',array('stationary_order_details.is_deleted'=>'no'),$fields);

         $record = array();
         $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
         $this->db->order_by('stationary_order.created_at','desc');
         $this->db->where('stationary_order.is_deleted','no');
         $this->db->where('stationary_order.id',$id);
         $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $arr_data_s_order = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
        

        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $courier_company_name_data = $this->master_model->getRecords('courier');

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $academic_years_data = $this->master_model->getRecords('academic_years');

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->where('series_yes_no','Yes');
        $from_series_data = $this->master_model->getRecords('stationary');
        
        $this->arr_view_data['stationary_sess_name'] = $stationary_sess_name;
        $this->arr_view_data['academic_years_data']  = $academic_years_data;
        $this->arr_view_data['from_series_data']  = $from_series_data;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['arr_data_s_order'] = $arr_data_s_order;
        $this->arr_view_data['courier_company_name_data'] = $courier_company_name_data;
        $this->arr_view_data['page_title']      = $this->module_title." Details ";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."details";
        $this->load->view('stationary/layout/stationary_combo',$this->arr_view_data);
    }




}