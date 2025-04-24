<?php 
//   Controller for: Contact_us page
// Author: Rupali patil
// Start Date: 16-08-2022
// last updated: 16-08-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        
        $this->arr_view_data = [];
	 }


    public function index()
     {    
        
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');

            if($this->form_validation->run() == TRUE)
            {
                $first_name         = $this->input->post('first_name'); 
                $last_name         = $this->input->post('last_name'); 
                $email        = trim($this->input->post('email'));
                $mobile       = trim($this->input->post('mobile'));
                $message      = trim($this->input->post('message'));

                $arr_insert = array(
                    'first_name'   =>   $first_name,
                    'last_name'     => $last_name,
                    'email'          => $email,
                    'mobile'        => $mobile,
                    'message'        => $message
                );
                
                $inserted_id = $this->master_model->insertRecord('enquiries',$arr_insert,true);
            
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Added Successfully.");
                    redirect(base_url().'contact_us/index');
                    
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect(base_url().'contact_us/index');
            }   
        }

        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $website_basic_structure = $this->master_model->getRecords('website_basic_structure');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $social_media_link = $this->master_model->getRecords('social_media_link');
        
        $data = array('middle_content' => 'contact_us',
                'website_basic_structure' => $website_basic_structure,
                'social_media_link' => $social_media_link,
                'page_title' => 'Contact Us');
        $this->arr_view_data['page_title']     =  "Contact Page";
        $this->arr_view_data['middle_content'] =  "contact_us";
        $this->load->view('front/common_view',$data);
     }


}