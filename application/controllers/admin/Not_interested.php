<?php 
//   Controller for: home page
// Author: Vivek Patil
// Start Date: 21-12-2022
// last updated: 

defined('BASEPATH') OR exit('No direct script access allowed');

class Not_interested extends CI_Controller {
	 
	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }

        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/not_interested";
        $this->module_url_path_booking_enq    =  base_url().$this->config->item('admin_panel_slug')."/booking_enquiry";
        $this->module_title       = "Not Interested Customers";
        $this->module_url_slug    = "not_interested";
        $this->module_view_folder = "not_interested/";
	 }

     public function index()
     {

        $record = array();
        $fields = "booking_enquiry.*,packages.tour_title,agent.agent_name,packages.tour_number";
        $this->db->order_by('booking_enquiry.created_at','desc');
        $this->db->where('booking_enquiry.is_deleted','no');
        $this->db->where('booking_enquiry.not_interested','no');
        // $this->db->where('booking_enquiry.agent_id',$id);
        $this->db->join("packages", 'booking_enquiry.package_id=packages.id','left');
        $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
        // $this->db->join("domestic_followup", 'booking_enquiry.id=domestic_followup.booking_enquiry_id','left');
        $arr_data = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
        

         $this->arr_view_data['listing_page']    = 'yes';
         $this->arr_view_data['arr_data']        = $arr_data;
         $this->arr_view_data['page_title']      = $this->module_title." ";
         $this->arr_view_data['module_title']    = $this->module_title;
         $this->arr_view_data['module_url_path'] = $this->module_url_path;
         $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
         $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
        
     }

     public function details($id)
    {
		$i=base64_decode($id); 

        $record = array();
        $fields = "domestic_followup.*,followup_reason.create_followup_reason";
        $this->db->where('domestic_followup.is_deleted','no');
        $this->db->where('booking_enquiry_id',$i);
        $this->db->join("followup_reason", 'domestic_followup.followup_reason=followup_reason.id','left');
		$this->db->order_by('id','ASC');
        $arr_data = $this->master_model->getRecords('domestic_followup',array('domestic_followup.is_deleted'=>'no'),$fields);

        $record = array();
        $fields = "booking_enquiry.*,agent.agent_name,agent.booking_center,agent.department,department.department,booking_enquiry.created_at c_date";
        $this->db->where('booking_enquiry.is_deleted','no');
        $this->db->where('booking_enquiry.id',$i);
        $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
        $this->db->join("department", 'department.id= agent.department','left');
        $arr_data_details = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);

        $this->db->where('is_deleted','no');
        $this->db->where('status','approved');
        $followup_reason_data = $this->master_model->getRecords('followup_reason');
         
         $this->arr_view_data['listing_page']    = 'yes';
         $this->arr_view_data['arr_data']        = $arr_data;
         $this->arr_view_data['followup_reason_data'] = $followup_reason_data;
         $this->arr_view_data['arr_data_details']        = $arr_data_details;
         $this->arr_view_data['page_title']      = "Not Interested Customer Followups";
         $this->arr_view_data['module_title']    = $this->module_title;
         $this->arr_view_data['module_url_path'] = $this->module_url_path;
         $this->arr_view_data['module_url_path_booking_enq'] = $this->module_url_path_booking_enq;
         $this->arr_view_data['middle_content']  = $this->module_view_folder."details";
         $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }

    public function domestic_followup()
    {
        $agent_sess_name = $this->session->userdata('agent_name');
        $id=$this->session->userdata('agent_sess_id');
         
         if($this->input->post('submit'))
         {
             $this->form_validation->set_rules('follow_up_time', 'follow up time', 'required');
             $this->form_validation->set_rules('next_followup_date', 'next follow up time', 'required');
             $this->form_validation->set_rules('follow_up_comment', 'follow up comment', 'required');
             
             if($this->form_validation->run() == TRUE)
             { 
                 $follow_up_time  = $this->input->post('follow_up_time'); 
                 $next_followup_date  = $this->input->post('next_followup_date');
                 $followup_reason  = $this->input->post('followup_reason');
                 $follow_up_comment  = $this->input->post('follow_up_comment'); 
                 $enquiry_id  = $this->input->post('enquiry_id'); 
                 $current_date= date('Y-m-d');
                 $arr_insert = array(
                     'follow_up_time'   =>   $follow_up_time, 
                     'next_followup_date'   =>   $next_followup_date, 
                     'follow_up_comment'   =>   $follow_up_comment,
                     'followup_reason' => $followup_reason
 
                 );
                 $arr_where     = array("id" => $enquiry_id);
                 $inserted_id = $this->master_model->updateRecord('domestic_followup',$arr_insert,$arr_where);
 
                 // $arr_update = array(
                 //     'followup_status'   =>   'yes',
                 //     'ftaken_by' => $id
                 //     );
                 // $arr_where     = array("id" => $enquiry_id);
                 // $this->master_model->updateRecord('booking_enquiry',$arr_update,$arr_where);
 
                 if($inserted_id > 0)
                  {
                      $this->session->set_flashdata('success_message',"Followup Added Successfully Please Check Followup on Followup List.");
                      redirect($this->module_url_path.'/index');
                  }
  
                  else
                  {
                      $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                  }
                  redirect($this->module_url_path.'/index');
 
                 $this->db->where('is_deleted','no');
                 $this->db->where('is_active','yes');
                 $this->db->where('id',$id);
                 $this->db->order_by('id','DESC');
                 $agent_data_email = $this->master_model->getRecord('agent');
 
                 $this->db->where('is_deleted','no');
                //  $this->db->where('is_active','yes');
                 $this->db->where('id',$enquiry_id);
                 $booking_enquiry_data = $this->master_model->getRecord('booking_enquiry');
 
                 $agent_email=$agent_data_email['email'];
                 $agent_name=$agent_data_email['agent_name'];
 
                 $user_email=$booking_enquiry_data['email'];
                 $first_name=$booking_enquiry_data['first_name'];
                 $last_name=$booking_enquiry_data['last_name'];
 
                
             $from_email='chaudharyyatra8@gmail.com';
 
                     $this->session->set_flashdata('success_message',ucfirst($this->module_title_followup). " Added Successfully.");
                     redirect($this->module_url_path_domestic_followup.'/index/'.$enquiry_id);
                    
                 }
 
                 else
                 {
                     $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                 }
                 redirect($this->module_url_path.'/index');
             }  
             else{
                redirect($this->module_url_path.'/index');
            } 
    }
 

}