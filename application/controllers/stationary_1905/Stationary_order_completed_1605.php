<?php 
//   Controller for: home page
// Author: Vivek Patil
// Start Date: 21-12-2022
// last updated: 

defined('BASEPATH') OR exit('No direct script access allowed');

class Stationary_order_completed extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        if($this->session->userdata('stationary_sess_id')=="") 
        { 
                redirect(base_url().'stationary/login'); 
        }
        $this->module_url_path    =  base_url().$this->config->item('stationary_panel_slug')."stationary/Stationary_order_completed";
        $this->module_title       = "Stationary Order Completed";
        $this->module_title2       = "Reject Stationary Order";
        $this->module_url_slug    = "Stationary_order_completed";
        $this->module_view_folder = "stationary_order_completed/";
        $this->arr_view_data = [];
	 }
     

    public function completed()
    {
        $stationary_sess_name = $this->session->userdata('stationary_name');
        $id = $this->session->userdata('stationary_sess_id');

    //     $record = array();
    //     $fields = "stationary_order.*";
    //     $this->db->order_by('stationary_order.created_at','desc');
    //     $this->db->where('stationary_order.is_deleted','no');
    //     $this->db->where('stationary_order.received_status','yes');
    //     $this->db->where('stationary_order.order_status','completed');
    //     $this->db->where('stationary_order.agent_id',$id);
    //    //  $this->db->join("stationary", 'stationary_order_details.stationary_name=stationary.id','left');
    //     $arr_data = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);

        $record = array();
         $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
         $this->db->order_by('stationary_order.created_at','desc');
        // $this->db->where('stationary_order.is_deleted','no');
        //$this->db->where('stationary_order.received_status','yes');
        $this->db->where('stationary_order.order_status','completed');
       // $this->db->where('stationary_order.agent_id',$id);
         $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $this->db->join("stationary_order_details", 'stationary_order_details.order_id=stationary_order.id','left');
         $this->db->group_by('stationary_order_details.order_id');
         $arr_data = $this->master_model->getRecords('stationary_order',array('stationary_order.received_status'=>'yes'),$fields);
  //print_r($arr_data); die;
       //  $this->db->where('is_deleted','no');
       //  $arr_data = $this->master_model->getRecords('stationary_order');
       

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
         //$id = $this->session->userdata('stationary_sess_id');

        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

        $record = array();
         $fields = "stationary_order_details.*,stationary.stationary_name,agent.agent_name,agent.booking_center,department.department";
         $this->db->order_by('stationary_order_details.created_at','desc');
         $this->db->where('stationary_order_details.is_deleted','no');
         $this->db->where('stationary_order_details.order_id',$id);
         $this->db->join("stationary", 'stationary_order_details.stationary_name=stationary.id','left');
         $this->db->join("agent", 'stationary_order_details.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $arr_data = $this->master_model->getRecords('stationary_order_details',array('stationary_order_details.is_deleted'=>'no'),$fields);
        
        //  $this->db->where('is_deleted','no');
        // $arr_data_s_order = $this->master_model->getRecords('stationary_order');

        $record = array();
         $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
         $this->db->order_by('stationary_order.created_at','desc');
         $this->db->where('stationary_order.is_deleted','no');
         $this->db->where('stationary_order.id',$id);
         $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
         $this->db->join("department", 'agent.department=department.id','left');
         $arr_data_s_order = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
        
        $this->arr_view_data['stationary_sess_name'] = $stationary_sess_name;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['arr_data_s_order']        = $arr_data_s_order;
        $this->arr_view_data['page_title']      = $this->module_title." Details ";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."details";
        $this->load->view('stationary/layout/stationary_combo',$this->arr_view_data);
    }
    




}