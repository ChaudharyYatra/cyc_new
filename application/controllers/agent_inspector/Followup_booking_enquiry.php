<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Followup_booking_enquiry extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('agent_inspector_sess_id')=="") 
        { 
                redirect(base_url().'agent_inspector/login'); 
        }
	
        $this->module_url_path    =  base_url().$this->config->item('agent_inspector_panel_slug')."agent_inspector/followup_booking_enquiry";
        $this->module_title       = "Followup Booking Enquiry";
        $this->module_url_slug    = "followup_booking_enquiry";
        $this->module_view_folder = "followup_booking_enquiry/";    
        $this->load->library('upload');
	}

	public function index()
	{
                $agent_inspector_sess_name = $this->session->userdata('agent_inspector_name');
                $id = $this->session->userdata('agent_inspector_sess_id');
                $region_id = $this->session->userdata('agent_inspector_region');
                // region means department

                $record = array();
                $fields = "booking_enquiry.*,packages.tour_title,agent.agent_name,packages.tour_number,agent.department";
                $this->db->order_by('booking_enquiry.created_at','desc');
                $this->db->where('booking_enquiry.is_deleted','no');
                $this->db->where('followup_status','yes');
                // $this->db->where('agent.department',$region_id);
                $this->db->join("packages", 'booking_enquiry.package_id=packages.id','left');
                $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
                // $this->db->join("domestic_followup", 'booking_enquiry.id=domestic_followup.booking_enquiry_id','left');
                $arr_data = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
        

        $this->arr_view_data['agent_inspector_sess_name'] = $agent_inspector_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('agent_inspector/layout/agent_inspector_combo',$this->arr_view_data);
	}

        public function followup_list($id)
	{
		$i=base64_decode($id);
                $agent_inspector_sess_name = $this->session->userdata('agent_inspector_name');
                $id = $this->session->userdata('agent_inspector_sess_id');
                $region_id = $this->session->userdata('agent_inspector_region');
               
       
                $this->db->where('is_deleted','no');
                $this->db->where('booking_enquiry_id',$i);
                $arr_data = $this->master_model->getRecords('domestic_followup');

                $record = array();
		        $fields = "booking_enquiry.*,agent.agent_name,agent.booking_center,agent.department,department.department,booking_enquiry.created_at c_date";
                $this->db->where('booking_enquiry.is_deleted','no');
                $this->db->where('booking_enquiry.id',$i);
                $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
                $this->db->join("department", 'department.id=agent.department','left');
                $arr_data_booking_enquiry=$this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
                // print_r($arr_data_booking_enquiry);
                
                $this->arr_view_data['agent_inspector_sess_name'] = $agent_inspector_sess_name;
                $this->arr_view_data['listing_page']    = 'yes';
                $this->arr_view_data['arr_data']        = $arr_data;
                $this->arr_view_data['arr_data_booking_enquiry']  = $arr_data_booking_enquiry;
                $this->arr_view_data['page_title']      = $this->module_title." List";
                $this->arr_view_data['module_title']    = $this->module_title;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['middle_content']  = $this->module_view_folder."followup_list";
                $this->load->view('agent_inspector/layout/agent_inspector_combo',$this->arr_view_data);
	}




}