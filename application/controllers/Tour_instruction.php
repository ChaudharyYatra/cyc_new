<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_instruction extends CI_Controller {
	 
	function __construct() {

        parent::__construct();

        $this->arr_view_data = [];

        if($this->session->userdata('cust_sess_id')=="") 
        { 
                redirect(base_url().'home'); 
        }

        $this->traveler_front_id =  $this->session->userdata('traveler_front_id');
	 }

	 
     public function index()
     {
        $cust_sess_name = $this->session->userdata('cust_fname');
        $cust_sess_lname = $this->session->userdata('cust_lname');
        $id=$this->session->userdata('cust_sess_id');
        
        $where_in_packages_ids = array();
         
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $website_basic_structure = $this->master_model->getRecords('website_basic_structure');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $social_media_link = $this->master_model->getRecords('social_media_link');

        $fields = "final_booking.*,packages.tour_title,package_date.journey_date,cust_instraction.instraction";
        $this->db->where('final_booking.is_deleted','no');
        $this->db->where('final_booking.is_active','yes');
        $this->db->where('final_booking.id',$id); //check session id & traverl id match
        $this->db->join("packages", 'final_booking.package_id=packages.id','left');
        $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
        $this->db->join("cust_instraction", 'final_booking.package_id=cust_instraction.tour_no','left');
        $this->db->where('cust_instraction.is_deleted','no');
        $this->db->where('cust_instraction.is_active','yes');
        $arr_data = $this->master_model->getRecords('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;      
        
        $fields = "final_booking.*,packages.tour_title";
        $this->db->where('final_booking.is_deleted','no');
        $this->db->where('final_booking.is_active','yes');
        // $this->db->where('final_booking.tour_status','1');
        // $this->db->OR_where('final_booking.tour_status','2');
        $this->db->where('final_booking.id',$id); //check session id & traverl id match
        $this->db->join("packages", 'final_booking.package_id=packages.id','left');
        $arr_data2 = $this->master_model->getRecords('final_booking',array('final_booking.is_deleted'=>'no'),$fields);    

         
        $data = array('middle_content' => 'tour_instruction',
                        'website_basic_structure'       => $website_basic_structure,
                        'social_media_link'       => $social_media_link,
                        'arr_data'               => $arr_data,
                        'arr_data2'               => $arr_data2,
                        'cust_sess_name'        => $cust_sess_name,
                        'cust_sess_lname'        => $cust_sess_lname,
                        'page_title'    => 'Tour Instruction');

        $this->arr_view_data['page_title']     =  "Tour Instruction";
        $this->arr_view_data['middle_content'] =  "tour_instruction";
        $this->load->view('front/common_view',$data);
     }





}