<?php 
//   Controller for: home page
// Author: Rupali Patil
// Start Date: 16-08-2022
// last updated: 16-08-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class Sra_payment_receipt extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        if($this->session->userdata('agent_sess_id')=="") 
        { 
            redirect(base_url().'agent/login'); 
        }
        $this->module_url_path    =  base_url().$this->config->item('agent_panel_slug')."/sra_payment_receipt";
        $this->module_all_traveller_info    =  base_url().$this->config->item('agent_panel_slug')."/all_traveller_info";
        $this->module_booking_enquiry    =  base_url().$this->config->item('agent_panel_slug')."/booking_enquiry";
        $this->domestic_booking_process    =  base_url().$this->config->item('agent_panel_slug')."/domestic_booking_process";
        $this->domestic_final_booking    =  base_url().$this->config->item('agent_panel_slug')."/final_booking_details";
        $this->sra_payment_record    =  base_url().$this->config->item('agent_panel_slug')."/sra_all_payment_details";
        $this->module_title       = "SRA Payment Receipt";
        $this->module_ursl_slug    = "sra_payment_receipt";
        $this->module_view_folder = "sra_payment_receipt/";
        $this->arr_view_data = [];
	 }
         
     public function index($iid,$academic_year)
     {
        $agent_sess_name = $this->session->userdata('agent_name');
        $id=$this->session->userdata('agent_sess_id');

        $record = array();
        $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
        sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
        $this->db->where('sra_final_booking.is_deleted','no');
        // $this->db->where('sra_payment.sra_no',$iid);
        // $this->db->where('sra_payment.academic_year',$academic_year);
        $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
        $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
        $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
        $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
        $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
        $details_payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
        if($details_payment_receipt['select_transaction'] == 'UPI'){
            // print_r('UPI  Id');
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.sra_no',$iid);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.upi_payment_type=qr_code_add_more.upi_app_name','left');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
        }else if($details_payment_receipt['select_transaction'] == 'QR Code'){
            // print"QR Codeeeeeeeeeeeeeeee";
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.sra_no',$iid);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.QR_payment_type=qr_code_add_more.upi_app_name','left');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            //print_r($payment_receipt); die;
        }else if($details_payment_receipt['select_transaction'] == 'Net Banking'){
            // print"Net Bankinggggggggggggggggggg";
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,qr_code_add_more.account_number,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.sra_no',$iid);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.net_banking_acc_no=qr_code_add_more.id');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }else if($details_payment_receipt['select_transaction'] == 'Cheque'){
            // print"Chequeeeeeeeeeeeeeeeeee";
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.sra_no',$iid);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }else{
            // print"cashhhhhhhhhhhhhhhhhhhhh";
            // die;
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_payment.sra_no',$iid);
            $this->db->where('sra_payment.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("package_date", 'package_date.id=sra_booking_payment_details.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
        }
        // print_r($payment_receipt); die;

        $payment_rupee = $payment_receipt['booking_amt'];
        
        // $payment_rupee = $payment_receipt['booking_amt']=== null ? 0 : count($payment_receipt['booking_amt']);

        // $len = $cOTLdata['char_data'] === null ? 0 : count($cOTLdata['char_data']);
        $pay= $this->getIndianCurrency($payment_rupee);
        // print_r($pay); die;
        
        
         $this->arr_view_data['agent_sess_name']        = $agent_sess_name;
         $this->arr_view_data['listing_page']    = 'yes';
         $this->arr_view_data['payment_receipt']        = $payment_receipt;
         $this->arr_view_data['details_payment_receipt']        = $details_payment_receipt;
        //  $this->arr_view_data['arr_data']        = $arr_data;
         $this->arr_view_data['pay']        = $pay;
         $this->arr_view_data['page_title']      = $this->module_title." List";
         $this->arr_view_data['module_title']    = $this->module_title;
         $this->arr_view_data['module_url_path'] = $this->module_url_path;
         $this->arr_view_data['module_all_traveller_info'] = $this->module_all_traveller_info;
         $this->arr_view_data['module_booking_enquiry'] = $this->module_booking_enquiry;
         $this->arr_view_data['domestic_final_booking'] = $this->domestic_final_booking;
         $this->arr_view_data['sra_payment_record'] = $this->sra_payment_record;
         $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
         $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
        
     }


     function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}


public function index_pending($sra_no,$academic_year,$new_id,$receipt_type)
{
   $agent_sess_name = $this->session->userdata('agent_name');
   $id=$this->session->userdata('agent_sess_id');
   // if($this->input->post('submit'))
   //  {
   //     redirect($this->module_url_path_bus_seat_sel.'/index');
   //  }

   // $this->load->library('pdf');
   // $html = $this->load->view('payment_receipt', '', true);
   // $this->pdf->createPDF($html, 'mypdf', false);
        // echo $iid; die;
   
//    $record = array();
//    $fields = "all_traveller_info.*,relation.relation";
//    $this->db->where('all_traveller_info.is_deleted','no');
//    $this->db->where('all_traveller_info.domestic_enquiry_id',$iid);
//    $this->db->where('all_traveller_info.for_credentials','yes');
//    $this->db->join("relation", 'relation.id=all_traveller_info.all_traveller_relation','left');
//    $arr_data = $this->master_model->getRecord('all_traveller_info',array('all_traveller_info.is_deleted'=>'no'),$fields);
//    // print_r($arr_data); die;
//    $traveller_id = $arr_data['id'];
//    // print_r($traveller_id); die;


$record = array();
        $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
        sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
        $this->db->where('sra_final_booking.is_deleted','no');
        $this->db->where('sra_booking_payment_details.id',$new_id);
        $this->db->where('sra_payment.sra_no',$sra_no);
        $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
        $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
        $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
        $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
        $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
        $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
        $details_payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
        // print_r($details_payment_receipt); die;

        if($details_payment_receipt['select_transaction'] == 'UPI'){
            // echo "aaaaaaaaaaaaaaaaaaaaaaaa";
            // die;
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.sra_no',$sra_no);
            $this->db->where('sra_booking_payment_details.id',$new_id);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.upi_payment_type=qr_code_add_more.upi_app_name','left');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            //  print_r($payment_receipt); die;
        }else if($details_payment_receipt['select_transaction'] == 'QR Code'){
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.id',$new_id);
            $this->db->where('sra_booking_payment_details.sra_no',$sra_no);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.QR_payment_type=qr_code_add_more.upi_app_name','left');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }else if($details_payment_receipt['select_transaction'] == 'Net Banking'){
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,qr_code_add_more.account_number,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.id',$new_id);
            $this->db->where('sra_booking_payment_details.sra_no',$sra_no);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("qr_code_add_more", 'sra_booking_payment_details.net_banking_acc_no=qr_code_add_more.id');
            $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
            $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }else if($details_payment_receipt['select_transaction'] == 'Cheque'){
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.id',$new_id);
            $this->db->where('sra_booking_payment_details.sra_no',$sra_no);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }else{
            $record = array();
            $fields = "sra_final_booking.*,package_date.journey_date,sra_booking_payment_details.*,agent.agent_name,sra_booking_payment_details.id as booking_payement_id,
            sra_payment.sra_no,sra_payment.tour_number,sra_payment.tour_date,sra_payment.customer_name,sra_payment.mobile_number,sra_payment.total_seat,sra_payment.total_sra_amt,packages.tour_number as package_tour_number";
            $this->db->where('sra_final_booking.is_deleted','no');
            $this->db->where('sra_booking_payment_details.id',$new_id);
            $this->db->where('sra_booking_payment_details.sra_no',$sra_no);
            $this->db->where('sra_booking_payment_details.academic_year',$academic_year);
            $this->db->join("packages", 'packages.id=sra_final_booking.package_id','left');
            $this->db->join("sra_booking_payment_details", 'sra_final_booking.sra_booking_payment_details_id=sra_booking_payment_details.id','left');
            $this->db->join("agent", 'sra_final_booking.agent_id=agent.id','left');
            $this->db->join("sra_payment", 'sra_final_booking.sra_payment_id=sra_payment.id','left');
            $this->db->join("package_date", 'package_date.id=sra_final_booking.package_date_id','left');
            $payment_receipt = $this->master_model->getRecord('sra_final_booking',array('sra_final_booking.is_deleted'=>'no'),$fields);
            // print_r($payment_receipt); die;
        }

   $payment_rupee = $payment_receipt['booking_amt'];
   // print_r($payment_rupee); die;
   // $payment_rupee = $payment_receipt['booking_amt']=== null ? 0 : count($payment_receipt['booking_amt']);

   // $len = $cOTLdata['char_data'] === null ? 0 : count($cOTLdata['char_data']);
   $pay= $this->getIndianCurrency_pending($payment_rupee);
   // print_r($pay); die;
   
   
    $this->arr_view_data['agent_sess_name']        = $agent_sess_name;
    $this->arr_view_data['listing_page']    = 'yes';
    $this->arr_view_data['payment_receipt']        = $payment_receipt;
    // $this->arr_view_data['arr_data']        = $arr_data;
    $this->arr_view_data['pay']        = $pay;
    $this->arr_view_data['page_title']      = $this->module_title." List";
    $this->arr_view_data['module_title']    = $this->module_title;
    $this->arr_view_data['module_url_path'] = $this->module_url_path;
    $this->arr_view_data['sra_payment_record'] = $this->sra_payment_record;
    $this->arr_view_data['module_all_traveller_info'] = $this->module_all_traveller_info;
    $this->arr_view_data['module_booking_enquiry'] = $this->module_booking_enquiry;
    $this->arr_view_data['domestic_final_booking'] = $this->domestic_final_booking;
    // $this->arr_view_data['booking_completed_details'] = $this->booking_completed_details;
    $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
    $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
   
}


function getIndianCurrency_pending(float $number)
{
$decimal = round($number - ($no = floor($number)), 2) * 100;
$hundred = null;
$digits_length = strlen($no);
$i = 0;
$str = array();
$words = array(0 => '', 1 => 'one', 2 => 'two',
   3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
   7 => 'seven', 8 => 'eight', 9 => 'nine',
   10 => 'ten', 11 => 'eleven', 12 => 'twelve',
   13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
   16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
   19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
   40 => 'forty', 50 => 'fifty', 60 => 'sixty',
   70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
$digits = array('', 'hundred','thousand','lakh', 'crore');
while( $i < $digits_length ) {
   $divider = ($i == 2) ? 10 : 100;
   $number = floor($no % $divider);
   $no = floor($no / $divider);
   $i += $divider == 10 ? 1 : 2;
   if ($number) {
       $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
       $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
       $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
   } else $str[] = null;
}
$Rupees = implode('', array_reverse($str));
$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}


// -----------------------------------  Extra Services Reciept -------------------------------------
public function index_extra_services($sra_no,$academic_year,$extra_count,$receipt_type)
{
//    print_r($receipt_type); die;
   $agent_sess_name = $this->session->userdata('agent_name');
   $id=$this->session->userdata('agent_sess_id');

        $record = array();
        $fields = "extra_services_booking_payment_details.*,qr_code_master.full_name,special_req_master.service_name";
        $this->db->where('extra_services_booking_payment_details.is_deleted','no');
        $this->db->where('extra_services_booking_payment_details.extra_services_count',$extra_count);
        $this->db->where('extra_services_booking_payment_details.sra_no',$sra_no);
        $this->db->where('extra_services_booking_payment_details.academic_year',$academic_year);
        $this->db->join("sra_extra_services", 'extra_services_booking_payment_details.sra_extra_services_id=sra_extra_services.id','left');
        $this->db->join("special_req_master", 'sra_extra_services.extra_services=special_req_master.id','left');
        $this->db->join("agent", 'extra_services_booking_payment_details.agent_id=agent.id','left');
        $this->db->join("sra_payment", 'extra_services_booking_payment_details.sra_payment_id=sra_payment.id','left');
        $this->db->join("qr_code_master", 'extra_services_booking_payment_details.name_on_cheque=qr_code_master.id','left');
        $extra_name_amount_payment_receipt = $this->master_model->getRecords('extra_services_booking_payment_details',array('extra_services_booking_payment_details.is_deleted'=>'no'),$fields);
        // print_r($extra_name_amount_payment_receipt); die;
        $total_customer_sending_amt = 0;
        if (!empty($extra_name_amount_payment_receipt)) {
            foreach ($extra_name_amount_payment_receipt as $info) {
                $total_customer_sending_amt += isset($info['customer_sending_amt']) ? $info['customer_sending_amt'] : 0;
            }
        }

        $record = array();
        $fields = "extra_services_booking_payment_details.*,qr_code_master.full_name,agent.agent_name";
        $this->db->where('extra_services_booking_payment_details.is_deleted','no');
        $this->db->where('extra_services_booking_payment_details.extra_services_count',$extra_count);
        $this->db->where('extra_services_booking_payment_details.sra_no',$sra_no);
        $this->db->where('extra_services_booking_payment_details.academic_year',$academic_year);
        $this->db->join("agent", 'extra_services_booking_payment_details.agent_id=agent.id' ,'left');
        $this->db->join("sra_payment", 'extra_services_booking_payment_details.sra_payment_id=sra_payment.id','left');
        $this->db->join("qr_code_master", 'extra_services_booking_payment_details.name_on_cheque=qr_code_master.id OR extra_services_booking_payment_details.demand_draft_name=qr_code_master.id OR extra_services_booking_payment_details.UPI_holder_name=qr_code_master.id OR extra_services_booking_payment_details.QR_holder_name=qr_code_master.id OR extra_services_booking_payment_details.net_banking_acc_holder_nm=qr_code_master.id','left');
        $this->db->group_by('extra_services_booking_payment_details.extra_services_count,extra_services_booking_payment_details.sra_no,extra_services_booking_payment_details.academic_year');
        $extra_details_payment_receipt = $this->master_model->getRecord('extra_services_booking_payment_details',array('extra_services_booking_payment_details.is_deleted'=>'no'),$fields);
        // print_r($extra_details_payment_receipt); die;

   $pay= $this->getIndianCurrency_extra_services($total_customer_sending_amt);
   
   
    $this->arr_view_data['agent_sess_name']        = $agent_sess_name;
    $this->arr_view_data['listing_page']    = 'yes';
    $this->arr_view_data['total_customer_sending_amt']        = $total_customer_sending_amt;
    $this->arr_view_data['extra_details_payment_receipt']        = $extra_details_payment_receipt;
    $this->arr_view_data['extra_name_amount_payment_receipt']        = $extra_name_amount_payment_receipt;
    $this->arr_view_data['pay']        = $pay;
    $this->arr_view_data['page_title']      = $this->module_title." List";
    $this->arr_view_data['module_title']    = $this->module_title;
    $this->arr_view_data['module_url_path'] = $this->module_url_path;
    $this->arr_view_data['sra_payment_record'] = $this->sra_payment_record;
    $this->arr_view_data['module_all_traveller_info'] = $this->module_all_traveller_info;
    $this->arr_view_data['module_booking_enquiry'] = $this->module_booking_enquiry;
    $this->arr_view_data['domestic_final_booking'] = $this->domestic_final_booking;
    // $this->arr_view_data['booking_completed_details'] = $this->booking_completed_details;
    $this->arr_view_data['middle_content']  = $this->module_view_folder."index_extra_services";
    $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
   
}

function getIndianCurrency_extra_services(float $number)
{
$decimal = round($number - ($no = floor($number)), 2) * 100;
$hundred = null;
$digits_length = strlen($no);
$i = 0;
$str = array();
$words = array(0 => '', 1 => 'one', 2 => 'two',
   3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
   7 => 'seven', 8 => 'eight', 9 => 'nine',
   10 => 'ten', 11 => 'eleven', 12 => 'twelve',
   13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
   16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
   19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
   40 => 'forty', 50 => 'fifty', 60 => 'sixty',
   70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
$digits = array('', 'hundred','thousand','lakh', 'crore');
while( $i < $digits_length ) {
   $divider = ($i == 2) ? 10 : 100;
   $number = floor($no % $divider);
   $no = floor($no / $divider);
   $i += $divider == 10 ? 1 : 2;
   if ($number) {
       $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
       $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
       $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
   } else $str[] = null;
}
$Rupees = implode('', array_reverse($str));
$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
// -----------------------------------  Extra Services Reciept -------------------------------------

public function index_final($iid,$booking_payment_details_id)
{
    // print_r($iid);  die;
    // print_r($booking_payment_details_id); die;
   $agent_sess_name = $this->session->userdata('agent_name');
   $id=$this->session->userdata('agent_sess_id');
   // if($this->input->post('submit'))
   //  {
   //     redirect($this->module_url_path_bus_seat_sel.'/index');
   //  }

   // $this->load->library('pdf');
   // $html = $this->load->view('payment_receipt', '', true);
   // $this->pdf->createPDF($html, 'mypdf', false);
       // echo $iid; die;
   
   $record = array();
   $fields = "all_traveller_info.*,relation.relation";
   $this->db->where('all_traveller_info.is_deleted','no');
   $this->db->where('all_traveller_info.domestic_enquiry_id',$iid);
   $this->db->where('all_traveller_info.for_credentials','yes');
   $this->db->join("relation", 'relation.id=all_traveller_info.all_traveller_relation','left');
   $arr_data = $this->master_model->getRecord('all_traveller_info',array('all_traveller_info.is_deleted'=>'no'),$fields);
//    print_r($arr_data); die;
   $traveller_id = $arr_data['id'];
//    print_r($traveller_id); die;

   $record = array();
   $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
   all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
   package_date.journey_date,booking_payment_details.id as booking_payement_id";
   $this->db->where('final_booking.is_deleted','no');
   $this->db->where('booking_payment_details.traveller_id',$traveller_id);
   $this->db->where('booking_payment_details.id',$booking_payment_details_id);
   $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
   $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
   $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
   // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
   $this->db->join("packages", 'final_booking.package_id=packages.id','left');
   $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
   $details_payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
//    print_r($details_payment_receipt); die;

   if($details_payment_receipt['select_transaction'] == 'UPI'){
    $record = array();
    $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
    all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
    package_date.journey_date,booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name";
    $this->db->where('final_booking.is_deleted','no');
    $this->db->where('booking_payment_details.traveller_id',$traveller_id);
    $this->db->where('booking_payment_details.id',$booking_payment_details_id);
    $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
    $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
    $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
    // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
    $this->db->join("packages", 'final_booking.package_id=packages.id','left');
    $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
    $this->db->join("qr_code_add_more", 'booking_payment_details.upi_payment_type=qr_code_add_more.id','left');
    $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
    $payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
 //    print_r($details_payment_receipt); die;
//  echo '1';
   }else if($details_payment_receipt['select_transaction'] == 'QR Code'){
    $record = array();
    $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
    all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
    package_date.journey_date,booking_payment_details.id as booking_payement_id,upi_apps_name.payment_app_name";
    $this->db->where('final_booking.is_deleted','no');
    $this->db->where('booking_payment_details.traveller_id',$traveller_id);
    $this->db->where('booking_payment_details.id',$booking_payment_details_id);
    $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
    $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
    $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
    // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
    $this->db->join("packages", 'final_booking.package_id=packages.id','left');
    $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
    $this->db->join("qr_code_add_more", 'booking_payment_details.QR_payment_type=qr_code_add_more.id');
    $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
    $payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
 //    print_r($details_payment_receipt); die;
//  echo '2';

    }else if($details_payment_receipt['select_transaction'] == 'Net Banking'){
        $record = array();
        $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
        all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
        package_date.journey_date,booking_payment_details.id as booking_payement_id,qr_code_add_more.account_number";
        $this->db->where('final_booking.is_deleted','no');
        $this->db->where('booking_payment_details.traveller_id',$traveller_id);
        $this->db->where('booking_payment_details.id',$booking_payment_details_id);
        $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
        $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
        $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
        // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
        $this->db->join("packages", 'final_booking.package_id=packages.id','left');
        $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
        $this->db->join("qr_code_add_more", 'booking_payment_details.net_banking_acc_no=qr_code_add_more.id');
        $this->db->join("upi_apps_name", 'qr_code_add_more.upi_app_name=upi_apps_name.id','left');
        $payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
        // print_r($payment_receipt);
//  echo '3';

    }else if($details_payment_receipt['select_transaction'] == 'Cheque'){
        $record = array();
        $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
        all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
        package_date.journey_date,booking_payment_details.id as booking_payement_id";
        $this->db->where('final_booking.is_deleted','no');
        $this->db->where('booking_payment_details.traveller_id',$traveller_id);
        $this->db->where('booking_payment_details.id',$booking_payment_details_id);
        $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
        $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
        $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
        // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
        $this->db->join("packages", 'final_booking.package_id=packages.id','left');
        $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
        $payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
     //    print_r($details_payment_receipt); die;
//  echo '4';

   }else{
    $record = array();
    $fields = "final_booking.*,booking_payment_details.*,agent.agent_name,all_traveller_info.mr/mrs,all_traveller_info.first_name,
    all_traveller_info.middle_name,all_traveller_info.last_name,packages.tour_number,packages.tour_title,
    package_date.journey_date,booking_payment_details.id as booking_payement_id";
    $this->db->where('final_booking.is_deleted','no');
    $this->db->where('booking_payment_details.traveller_id',$traveller_id);
    $this->db->where('booking_payment_details.id',$booking_payment_details_id);
    $this->db->join("booking_payment_details", 'final_booking.traveller_id=booking_payment_details.traveller_id','left');
    $this->db->join("agent", 'final_booking.agent_id=agent.id','left');
    $this->db->join("all_traveller_info", 'final_booking.traveller_id=all_traveller_info.id','left');
    // $this->db->join("courtesy_titles", 'all_traveller_info.mr/mrs=courtesy_titles.id','left');
    $this->db->join("packages", 'final_booking.package_id=packages.id','left');
    $this->db->join("package_date", 'final_booking.package_date_id=package_date.id','left');
    $payment_receipt  = $this->master_model->getRecord('final_booking',array('final_booking.is_deleted'=>'no'),$fields);
 //    print_r($details_payment_receipt); die;
//  echo '5';

    }

    // print_r($payment_receipt); die;

   $payment_rupee = $payment_receipt['booking_amt'];
//    print_r($payment_rupee); die;
   // $payment_rupee = $payment_receipt['booking_amt']=== null ? 0 : count($payment_receipt['booking_amt']);

   // $len = $cOTLdata['char_data'] === null ? 0 : count($cOTLdata['char_data']);
   $pay= $this->getIndianCurrency_final($payment_rupee);
   // print_r($pay); die;
   
   
    $this->arr_view_data['agent_sess_name']        = $agent_sess_name;
    $this->arr_view_data['listing_page']    = 'yes';
    $this->arr_view_data['payment_receipt']        = $payment_receipt;
    $this->arr_view_data['arr_data']        = $arr_data;
    $this->arr_view_data['pay']        = $pay;
    $this->arr_view_data['page_title']      = $this->module_title." List";
    $this->arr_view_data['module_title']    = $this->module_title;
    $this->arr_view_data['module_url_path'] = $this->module_url_path;
    $this->arr_view_data['module_all_traveller_info'] = $this->module_all_traveller_info;
    $this->arr_view_data['module_booking_enquiry'] = $this->module_booking_enquiry;
    $this->arr_view_data['domestic_final_booking'] = $this->domestic_final_booking;
    $this->arr_view_data['booking_completed_details'] = $this->booking_completed_details;
    $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
    $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
   
}


function getIndianCurrency_final(float $number)
{
$decimal = round($number - ($no = floor($number)), 2) * 100;
$hundred = null;
$digits_length = strlen($no);
$i = 0;
$str = array();
$words = array(0 => '', 1 => 'one', 2 => 'two',
   3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
   7 => 'seven', 8 => 'eight', 9 => 'nine',
   10 => 'ten', 11 => 'eleven', 12 => 'twelve',
   13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
   16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
   19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
   40 => 'forty', 50 => 'fifty', 60 => 'sixty',
   70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
$digits = array('', 'hundred','thousand','lakh', 'crore');
while( $i < $digits_length ) {
   $divider = ($i == 2) ? 10 : 100;
   $number = floor($no % $divider);
   $no = floor($no / $divider);
   $i += $divider == 10 ? 1 : 2;
   if ($number) {
       $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
       $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
       $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
   } else $str[] = null;
}
$Rupees = implode('', array_reverse($str));
$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

    public function getBlock(){ 
        // POST data 
        $all_b=array();
       $boarding_office_location = $this->input->post('did');
        
            $this->db->where('is_deleted','no');
            $this->db->where('is_active','yes');
            $this->db->where('id',$boarding_office_location);
            $data = $this->master_model->getRecord('packages');

            $boarding = $data['boarding_office'];
            // print_r($boarding); die;
            
            $ids = explode(',', $boarding);
            // print_r($ids);
            // die;
            // print_r($ids); die;
            $count=sizeof($ids);
            
            for($i=0; $i<$count; $i++)
            {
                    $p=$ids[$i];   
                $this->db->where('is_deleted','no');
                $this->db->where('is_active','yes');
                $this->db->where('id',$p);
                $data1 = $this->master_model->getRecord('agent');
                // print_r($data1); die;
                //$bname=$data1;   
                array_push($all_b,$data1);
                    
            }
            // print_r($all_b); die;
                        
        echo json_encode($all_b); 
    }

    public function get_tourdate(){ 
        // POST data 
        // $all_b=array();
       $boarding_office_location = $this->input->post('did');
        // print_r($boarding_office_location); die;
                        $this->db->where('is_deleted','no');
                        $this->db->where('is_active','yes');
                        $this->db->where('package_id',$boarding_office_location);
                        $data = $this->master_model->getRecords('package_date');
                        // print_r($data); die;
        echo json_encode($data);
    }

    public function get_hotel_type(){ 
        // POST data 
        // $all_b=array();
        $tour_no = $this->input->post('did');
        // print_r($tour_no); die;
                        $record = array();
                        $fields = "packages.*,hotel_type.hotel_type_name";
                        $this->db->where('hotel_type.is_deleted','no');
                        $this->db->where('hotel_type.is_active','yes');
                        $this->db->where('packages.id',$tour_no);
                        $this->db->join("hotel_type", 'packages.hotel_type=hotel_type.id','left');
                        $data = $this->master_model->getRecord('packages');
                        // print_r($data); die;
        echo json_encode($data);
    }
}