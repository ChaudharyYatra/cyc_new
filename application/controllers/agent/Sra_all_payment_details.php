<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sra_all_payment_details extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('agent_sess_id')=="") 
        { 
                redirect(base_url().'agent/login'); 
        }
	
        $this->module_url_path    =  base_url().$this->config->item('agent_panel_slug')."/sra_all_payment_details";
        $this->module_title       = "SRA particular customer Record";
        $this->module_url_slug    = "sra_all_payment_details";
        $this->module_view_folder = "sra_all_payment_details/";    
        $this->load->library('upload');
	}

	public function index()
	{
        $agent_sess_name = $this->session->userdata('agent_name');
        $iid = $this->session->userdata('agent_sess_id');
       // print_r($iid); die;

        $fields = "sra_payment.*,package_date.journey_date,sra_booking_payment_details.booking_amt,sra_booking_payment_details.payment_confirmed_status,academic_years.year,packages.tour_number as package_tour_number";
        // $this->db->order_by('id','ASC');
        $this->db->where('sra_booking_payment_details.is_deleted','no');
        $this->db->where('sra_booking_payment_details.is_deleted','no');
        $this->db->where('sra_booking_payment_details.agent_id',$iid);
        $this->db->join("packages", 'packages.id=sra_payment.tour_number','left');
        $this->db->join("sra_booking_payment_details", 'sra_booking_payment_details.sra_payment_id=sra_payment.id','left');
        $this->db->join("academic_years", 'academic_years.id=sra_booking_payment_details.academic_year','left');
        $this->db->join("package_date", 'package_date.id=sra_payment.tour_date','left');
        $this->db->group_by('sra_booking_payment_details.academic_year,sra_booking_payment_details.sra_no');
        $arr_data = $this->master_model->getRecords('sra_payment',array('sra_payment.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;

        $this->arr_view_data['agent_sess_name'] = $agent_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        // $this->arr_view_data['module_pending_amt'] = $this->module_pending_amt;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
       
	}
	
	
    public function details($sra_no,$sra_pay_id,$academic_year)
    {
       $agent_sess_name = $this->session->userdata('agent_name');
       $iid = $this->session->userdata('agent_sess_id');
       // print_r($iid); die;

        $record = array();
        $fields = "sra_payment.*,package_date.journey_date,sra_payment.id as sra_payment_id,packages.tour_number as package_tour_number";
        $this->db->where('sra_payment.is_deleted','no');
        $this->db->where('sra_payment.is_active','yes');
        $this->db->join("packages", 'packages.id=sra_payment.tour_number','left');
        $this->db->join("package_date", 'package_date.id=sra_payment.tour_date','left');
        $this->db->group_start();
        $this->db->where('sra_payment.sra_no', $sra_no);
        $this->db->where('sra_payment.academic_year', $academic_year);
        $this->db->group_end();
        $traveller_booking_info_header = $this->master_model->getRecords('sra_payment','',$fields);

//        $this->db->where('is_deleted','no');
//        $this->db->where('is_active','yes');
//        $this->db->where('sra_no',$sra_no);
//        $traveller_booking_info_header = $this->master_model->getRecords('sra_payment');

        $record = array();
        $fields = "sra_booking_payment_details.*,qr_code_master.full_name,upi_apps_name.payment_app_name,qr_code_add_more.account_number,agent.agent_name";
        $this->db->where('sra_booking_payment_details.is_deleted','no');
        $this->db->where('sra_booking_payment_details.sra_payment_id',$sra_pay_id);
        $this->db->where('sra_booking_payment_details.sra_no', $sra_no);
        $this->db->where('sra_booking_payment_details.academic_year', $academic_year);
        $this->db->join("qr_code_master", 'sra_booking_payment_details.UPI_holder_name=qr_code_master.id OR sra_booking_payment_details.QR_holder_name=qr_code_master.id OR sra_booking_payment_details.name_on_cheque=qr_code_master.id OR sra_booking_payment_details.demand_draft_name=qr_code_master.id OR sra_booking_payment_details.net_banking_acc_holder_nm=qr_code_master.id','left');
        $this->db->join("qr_code_add_more", 'sra_booking_payment_details.net_banking_acc_no=qr_code_add_more.id','left');
        $this->db->join("upi_apps_name", 'sra_booking_payment_details.upi_payment_type=upi_apps_name.id OR sra_booking_payment_details.QR_payment_type=upi_apps_name.id','left');
        $this->db->join("agent", 'sra_booking_payment_details.agent_id=agent.id','left');
        $booking_payment_details_all = $this->master_model->getRecords('sra_booking_payment_details',array('sra_booking_payment_details.is_deleted'=>'no'),$fields);
        //  print_r($booking_payment_details_all); die;

        $record = array();
        $this->db->where('sra_payment.is_deleted','no');
        $this->db->where('sra_payment.sra_no', $sra_no);
        $this->db->where('sra_payment.academic_year', $academic_year);
        $particular_sra_total = $this->master_model->getRecords('sra_payment');
        //print_r($particular_sra_total); die;
        
        $sra_total_amount = 0;
        foreach($particular_sra_total as $info) 
        { 
            $sra_total_amount = $info['total_sra_amt']; 
        }

        $fields = "extra_services_booking_payment_details.*,special_req_master.service_name,sra_extra_services.services_amt,qr_code_add_more.account_number";
        $this->db->where('extra_services_booking_payment_details.is_deleted','no');
        // $this->db->where('extra_services_booking_payment_details.is_active','yes');
        $this->db->where('extra_services_booking_payment_details.sra_payment_id',$sra_pay_id);
        $this->db->where('extra_services_booking_payment_details.sra_no',$sra_no);
        $this->db->where('extra_services_booking_payment_details.academic_year', $academic_year);
        $this->db->join("sra_extra_services", 'extra_services_booking_payment_details.sra_extra_services_id=sra_extra_services.id','left');
        $this->db->join("special_req_master", 'sra_extra_services.extra_services=special_req_master.id','left');
        $this->db->join("qr_code_add_more", 'extra_services_booking_payment_details.net_banking_acc_no=qr_code_add_more.id','left');
        $extra_services_booking_payment_details_all = $this->master_model->getRecords('extra_services_booking_payment_details',array('extra_services_booking_payment_details.is_deleted'=>'no'),$fields);
        // print_r($extra_services_booking_payment_details_all); die;
        $extra_services_total_amount = 0;
        

        foreach($extra_services_booking_payment_details_all as $info) 
        {
            $extra_services_total_amount = $info['final_amt']; 
            
        }
        

        $this->arr_view_data['agent_sess_name'] = $agent_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['sra_total_amount']        = $sra_total_amount;
        $this->arr_view_data['extra_services_total_amount']        = $extra_services_total_amount;
        $this->arr_view_data['traveller_booking_info_header']        = $traveller_booking_info_header;
        $this->arr_view_data['booking_payment_details_all']        = $booking_payment_details_all;
        $this->arr_view_data['extra_services_booking_payment_details_all']        = $extra_services_booking_payment_details_all;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        // $this->arr_view_data['module_pending_amt'] = $this->module_pending_amt;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."details";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
       
    }


}