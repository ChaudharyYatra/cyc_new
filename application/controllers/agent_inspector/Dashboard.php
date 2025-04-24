<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('agent_inspector_sess_id')=="") 
        { 
                redirect(base_url().'agent_inspector/login'); 
        }


        $this->module_url_path    =  base_url().$this->config->item('agent_inspector_panel_slug')."/dashboard";
        $this->module_title       = "Dashboard";
        $this->module_url_slug    = "dashboard";
        $this->module_view_folder = "dashboard/";
	}

	public function index()
	{
	    
	           //    $info_arr = array('from'=>'test@choudharyyatra.co.in',
	          	// 			'to'=>'mhaskem01@gmail.com',
	          	// 			'subject'=> 'Testing mail',
	          	// 			'message'=>'testing'); 
	          	// 		$this->emailsending->sendmail($info_arr);
	          
	          			
	   // require_once APPPATH . "/third_party/phpmail/PHPMailerAutoload.php";

// 		$mail = new PHPMailer();

// 		$mail->SMTPDebug = 0;
	
		//Ask for HTML-friendly debug output
// 		$mail->Debugoutput = 'html';
// 		$mail->SMTPSecure  = 'ssl';
// 	//	$mail->SMTPSecure = 'tls'; //tls
// 		//Set the hostname of the mail server
// 		$mail->Host = "smtp.gmail.com";
// 		//Set the SMTP port number - likely to be 25, 465 or 587
// 		$mail->Port = 465;
// 		$mail->SMTPOptions = [
// 			'ssl'=> [
// 			'verify_peer' => false,
// 			'verify_peer_name' => false,
// 			'allow_self_signed' => true
// 			]
// 		];
	
		//Whether to use SMTP authentication
// 		$mail->SMTPAuth = true;
// 		// secure transfer enabled REQUIRED for Gmail
// 		//$mail->SMTPSecure = 'ssl'; //tls
// 		//Username to use for SMTP authentication
// 		//$mail->Username = "info@nathetyres.in";
// 		$mail->Username = "info.cycplteam@gmail.com";
// 		//Password to use for SMTP authentication 
// 		 $mail->Password = 'glxvtzjwiqngpwuq';
// 		//Set who the message is to be sent from		
// 		$mail->SetFrom('info.cycplteam@gmail.com', 'CHAUDHARY');
// 		//Set an alternative reply-to address
// 		$mail->addReplyTo('info.cycplteam@gmail.com', 'CHAUDHARY');
// 		//Set who the message is to be sent to
// 		$mail->addAddress('mhaskem01@gmail.com', ''); 
// 		//$mail->addCC('bhagwan.sahane@esds.co.in', 'Bhagwan Sahane');
// 		//Set the subject line
// 		$mail->Subject = 'test';
// 		//Read an HTML message body from an external file, convert referenced images to embedded,
// 		//convert HTML into a basic plain-text alternative body
// 		$mail->Body = 'hi';
// 		$mail->IsHTML(true);
// 		// $mail->msgHTML(file_get_contents('contents.html'), dirname(_FILE_));
// 		// Replace the plain text body with one created manually
// 		//    $mail->AltBody = 'This is a plain-text message body';
// 		//Attach an image file
// 		if ($attachment != '') {
// 			$mail->addAttachment($attachment);
// 		}
		//send the message, check for errors
// 	$mahesh = $mail->send();
// 	echo $this->email->print_debugger();
		
// 		if (!$mail->send()) {
// 			echo "Mailer Error: " . $mail->ErrorInfo;
// 			return false;
// 		} else {
// 		    	echo 'test1';
// 			return true;
// 		}
	          			
// 	     die;
	    
	    
	    
	    
                $agent_inspector_sess_name = $this->session->userdata('agent_inspector_name');
                $id = $this->session->userdata('agent_inspector_sess_id');
                $region_id = $this->session->userdata('agent_inspector_region');
                // region means department
       
                // $record = array();
                // $fields = "booking_enquiry.*,agent.department";
                // $this->db->where('is_deleted','no');
                // $this->db->where('followup_status','no');
                // $this->db->where('agent.department',$region_id);
                // $booking_enquiry = $this->master_model->getRecords('booking_enquiry');
                // $arr_data['booking_enquiry_count'] = count($booking_enquiry);

                $record = array();
                $fields = "booking_enquiry.*,packages.tour_title,agent.agent_name,packages.tour_number,agent.department";
                $this->db->order_by('booking_enquiry.created_at','desc');
                $this->db->where('booking_enquiry.is_deleted','no');
                $this->db->where('followup_status','no');
                $this->db->where('booking_process','no');
                $this->db->join("packages", 'booking_enquiry.package_id=packages.tour_number','left');
                $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
                $booking_enquiry = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['booking_enquiry_count'] = count($booking_enquiry);
                // print_r($arr_data['booking_enquiry_count']); die;

                $record = array();
                $fields = "booking_enquiry.*,packages.tour_title,agent.agent_name,packages.tour_number,agent.department";
                $this->db->order_by('booking_enquiry.created_at','desc');
                $this->db->where('booking_enquiry.is_deleted','no');
                $this->db->where('followup_status','yes');
                // $this->db->where('agent.department',$region_id);
                $this->db->join("packages", 'booking_enquiry.package_id=packages.tour_number','left');
                $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
                $booking_enquiry_follow_up = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['booking_enquiry_follow_up_count'] = count($booking_enquiry_follow_up);

                $record = array();
                $fields = "booking_enquiry.*,packages.tour_title,agent.agent_name,packages.tour_number";
                $this->db->order_by('booking_enquiry.created_at','desc');
                $this->db->where('booking_enquiry.is_deleted','no');
                $this->db->where('booking_enquiry.not_interested','no');
                // $this->db->where('agent.department',$region_id);
                // $this->db->where('booking_enquiry.agent_id',$id);
                $this->db->join("packages", 'booking_enquiry.package_id=packages.tour_number','left');
                $this->db->join("agent", 'booking_enquiry.agent_id=agent.id','left');
                // $this->db->join("domestic_followup", 'booking_enquiry.id=domestic_followup.booking_enquiry_id','left');
                $not_interested = $this->master_model->getRecords('booking_enquiry',array('booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['not_interested_count'] = count($not_interested);

                $record = array();
                $fields = "international_booking_enquiry.*,international_packages.tour_title,agent.agent_name,international_packages.tour_number";
                $this->db->order_by('international_booking_enquiry.id','desc');
                $this->db->where('international_booking_enquiry.is_deleted','no');
                $this->db->where('followup_status','no');
                $this->db->where('booking_process','no');
                $this->db->join("international_packages", 'international_booking_enquiry.package_id=international_packages.tour_number','left');
                $this->db->join("agent", 'international_booking_enquiry.agent_id=agent.id','left');
                $international_booking_enquiry = $this->master_model->getRecords('international_booking_enquiry',array('international_booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['international_booking_enquiry_count'] = count($international_booking_enquiry);

                $record = array();
                $fields = "international_booking_enquiry.*,international_packages.tour_title,agent.agent_name,international_packages.tour_number";
                $this->db->order_by('international_booking_enquiry.id','desc');
                $this->db->where('international_booking_enquiry.is_deleted','no');
                $this->db->where('followup_status','yes');
                // $this->db->where('agent.department',$region_id);
                $this->db->join("international_packages", 'international_booking_enquiry.package_id=international_packages.tour_number','left');
                $this->db->join("agent", 'international_booking_enquiry.agent_id=agent.id','left');
                $international_booking_enquiry_followup = $this->master_model->getRecords('international_booking_enquiry',array('international_booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['international_booking_enquiry_followup_count'] = count($international_booking_enquiry_followup);
                
                $record = array();
                $fields = "international_booking_enquiry.*,international_packages.tour_title,agent.agent_name,international_packages.tour_number as tno, international_booking_enquiry.package_id as pid";
                $this->db->order_by('international_booking_enquiry.created_at','desc');
                $this->db->where('international_booking_enquiry.is_deleted','no');
                $this->db->where('international_booking_enquiry.not_interested','no');
                // $this->db->where('agent.department',$region_id);
                //  $this->db->where('international_booking_enquiry.agent_id',$id);
                $this->db->join("international_packages", 'international_booking_enquiry.package_id= international_packages.tour_number','left');
                $this->db->join("agent", 'international_booking_enquiry.agent_id=agent.id','left');
                // $this->db->join("domestic_followup", 'international_booking_enquiry.id=domestic_followup.international_booking_enquiry_id','left');
                $international_not_interested = $this->master_model->getRecords('international_booking_enquiry',array('international_booking_enquiry.is_deleted'=>'no'),$fields);
                $arr_data['international_not_interested_count'] = count($international_not_interested);

                $fields = "agent.*,department.department";
                $this->db->order_by('agent.arrange_id','asc');        
                $this->db->where('department.is_deleted','no'); 
                // $this->db->where('agent.department',$region_id);       
                $this->db->join("department", 'agent.department=department.id','left');
                $total_agent = $this->master_model->getRecords('agent',array('agent.is_deleted'=>'no'),$fields);
                $arr_data['total_agent_count'] = count($total_agent);

                $record = array();
                $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
                $this->db->order_by('stationary_order.created_at','desc');
                // $this->db->where('agent.department',$region_id);
                $this->db->where('stationary_order.order_status','Pending');
                $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
                $this->db->join("department", 'agent.department=department.id','left');
                $stationary_request_details = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
                $arr_data['stationary_request_details'] = count($stationary_request_details);

                $record = array();
                $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
                $this->db->order_by('stationary_order.created_at','desc');
                // $this->db->where('agent.department',$region_id);
                $this->db->where('stationary_order.order_status','Inprocess');
                $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
                $this->db->join("department", 'agent.department=department.id','left');
                $stationary_not_received_details = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
                $arr_data['stationary_not_received_details'] = count($stationary_not_received_details);

                $record = array();
                $fields = "stationary_order.*,agent.agent_name,agent.booking_center,department.department";
                $this->db->order_by('stationary_order.created_at','desc');
                // $this->db->where('agent.department',$region_id);
                $this->db->where('stationary_order.order_status','completed');
                $this->db->join("agent", 'stationary_order.agent_id=agent.id','left');
                $this->db->join("department", 'agent.department=department.id','left');
                $stationary_details = $this->master_model->getRecords('stationary_order',array('stationary_order.is_deleted'=>'no'),$fields);
                $arr_data['stationary_details'] = count($stationary_details);

                $this->arr_view_data['agent_inspector_sess_name']        = $agent_inspector_sess_name;
                $this->arr_view_data['listing_page']    = 'yes';
                $this->arr_view_data['arr_data']        = $arr_data;
                $this->arr_view_data['page_title']      = $this->module_title." List";
                $this->arr_view_data['module_title']    = $this->module_title;
                $this->arr_view_data['module_url_path'] = $this->module_url_path;
                $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
                $this->load->view('agent_inspector/layout/agent_inspector_combo',$this->arr_view_data);
       
	}


   
}