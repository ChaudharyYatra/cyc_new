<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_other_than_sra extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('agent_sess_id')=="") 
        { 
                redirect(base_url().'agent/login'); 
        }
		// hasemployeepanelaccess();
		// Check User Permission
		//hasModuleAccess(6);//set same module id as in module_master table

	   
        // $this->user_id            =  $this->session->userdata('nabcons_id');
        // $this->name               =  $this->session->userdata('nabcons_username');
        // $this->ip                 =  $this->input->ip_address();
        $this->module_url_path    =  base_url().$this->config->item('agent_panel_slug')."/payment_other_than_sra";
        $this->module_ctv_transfer_receipt    =  base_url().$this->config->item('agent_panel_slug')."/ctv_transfer_receipt";
        $this->module_title       = "Payment Other Than Sra";
        $this->module_url_slug    = "payment_other_than_sra";
        $this->module_view_folder = "payment_other_than_sra/";    
        // $this->load->library('upload');
	}

	public function index()
	{  
        $fields = "payment_other_than_sra.*,agent.agent_name";
        $this->db->where('payment_other_than_sra.is_deleted','no');
        $this->db->join("agent", 'payment_other_than_sra.staff_name=agent.id','left');
        $arr_data = $this->master_model->getRecords('payment_other_than_sra',array('payment_other_than_sra.is_deleted'=>'no'),$fields);

        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
	}
    
    public function add()
    {   
        $agent_sess_name = $this->session->userdata('agent_name');
        $id=$this->session->userdata('agent_sess_id');

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('staff_name', 'staff_name', 'required');
            $this->form_validation->set_rules('select_transaction', 'select_transaction', 'required');
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $this->form_validation->set_rules('reason', 'reason', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $staff_name = $this->input->post('staff_name');
                // print_r($staff_name); die;
                $select_transaction = $this->input->post('select_transaction');
                $amount = $this->input->post('amount');
                $reason = $this->input->post('reason');
                $agent_mob_no = $this->input->post('agent_mob_no');


            $alphabet = '1234567890';
            $otp = str_shuffle($alphabet);
            $traveler_otp = substr($otp, 0, '6'); 

            $from_email='test@choudharyyatra.co.in';
            
            $authKey = "1207168241267288907";
            
            $message="Dear User, Thank you for booking the tour with us, Your OTP is $traveler_otp, Valid for 30 minutes. Please share with only Choudhary Yatra team. Regards,CYCPL Team.";
            $senderId  = "CYCPLN";
            
            $apiurl = "http://sms.sumagoinfotech.com/api/sendhttp.php?authkey=394685AG84OZGHLV0z6438e5e3P1&mobiles=$agent_mob_no&message=$message&sender=CYCPLN&route=4&country=91&DLT_TE_ID=1207168251580901563";
            
            $apiurl = str_replace(" ", '%20', $apiurl); 
            
            $ch = curl_init($apiurl);
                    $get_url = $apiurl;
                    curl_setopt($ch, CURLOPT_POST,0);
                    curl_setopt($ch, CURLOPT_URL, $get_url);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
                    curl_setopt($ch, CURLOPT_HEADER,0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $return_val = curl_exec($ch); 
               

                $arr_insert = array(
                    'traveler_otp'   =>   $traveler_otp,
                    'agent_id'   =>   $id,    
                    'agent_mob_no'   =>   $agent_mob_no,    
                    'staff_name'   =>   $staff_name,
                    'select_transaction'   =>   $select_transaction,
                    'amount'   =>   $amount,
                    'reason'   =>   $reason
                );
                
                // $this->db->where('kitchen_equipment_name',$kitchen_equipment_name);
                // $this->db->where('is_deleted','no');
                // $kitchen_equipment_exist_data = $this->master_model->getRecords('kitchen_equipment');
                // if(count($kitchen_equipment_exist_data) > 0)
                // {
                //     $this->session->set_flashdata('error_message',"Kitchen Equipment Name ".$kitchen_equipment." Already Exist.");
                //     redirect($this->module_url_path.'/add');
                // }
                
                $inserted_id = $this->master_model->insertRecord('payment_other_than_sra',$arr_insert,true);
                $insertid = $this->db->insert_id();               
                if($inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Payment Other Than Sra Added Successfully.");
                    redirect($this->module_ctv_transfer_receipt.'/index/'.$insertid);
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            }   
        }

        $fields = "money_transfer_agent_to_agent.*,agent.agent_name,agent.id as agent_id";
        $this->db->where('money_transfer_agent_to_agent.is_deleted','no');
        $this->db->where('money_transfer_agent_to_agent.money_given_agent_nm',$id);
        $this->db->join("agent", 'money_transfer_agent_to_agent.money_receiver_agent_nm=agent.id','left');
        $agent_data = $this->master_model->getRecords('money_transfer_agent_to_agent',array('money_transfer_agent_to_agent.is_deleted'=>'no'),$fields);
        // print_r($agent_data); die;

        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['agent_data'] = $agent_data;
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
    }

   
  // Active/Inactive
  
  public function active_inactive($id,$type)
    {
        $agent_sess_name = $this->session->userdata('agent_name');
        $iid=$this->session->userdata('agent_sess_id');
	  $id=base64_decode($id);
        if($id!='' && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('kitchen_equipment');
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
            
            if($this->master_model->updateRecord('kitchen_equipment',$arr_update,array('id' => $id)))
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
        $agent_sess_name = $this->session->userdata('agent_name');
        $iid=$this->session->userdata('agent_sess_id');

        $id=base64_decode($id);
        if($id!='')
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('payment_other_than_sra');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('payment_other_than_sra',$arr_update,$arr_where))
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
        $agent_sess_name = $this->session->userdata('agent_name');
        $iid=$this->session->userdata('agent_sess_id');

		$id=base64_decode($id);
        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   
        else
        {   
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('staff_name', 'staff_name', 'required');
                $this->form_validation->set_rules('select_transaction', 'select_transaction', 'required');
                $this->form_validation->set_rules('amount', 'amount', 'required');
                $this->form_validation->set_rules('reason', 'reason', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                    $staff_name = $this->input->post('staff_name');
                    $select_transaction = $this->input->post('select_transaction');
                    $amount = $this->input->post('amount');
                    $reason = $this->input->post('reason');
                   
                    // $this->db->where('kitchen_equipment_name',$kitchen_equipment_name);
                    // $this->db->where('id!='.$id);
                    // $this->db->where('is_deleted','no');
                    // $kitchen_equipment_exist_data = $this->master_model->getRecords('kitchen_equipment');
                    // if(count($kitchen_equipment_exist_data) > 0)
                    // {
                    //     $this->session->set_flashdata('error_message',"Kitchen Equipment Name ".$kitchen_equipment." Already Exist.");
                    //     redirect($this->module_url_path.'/add');
                    // }
                    
                    
                    $arr_update = array(
                        'staff_name'   =>   $staff_name,
                        'select_transaction'   =>   $select_transaction,
                        'amount'   =>   $amount,
                        'reason'   =>   $reason
                    );
                    $arr_where     = array("id" => $id);
                    $this->master_model->updateRecord('payment_other_than_sra',$arr_update,$arr_where);
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

        $fields = "money_transfer_agent_to_agent.*,agent.agent_name,agent.id as agent_id";
        $this->db->where('money_transfer_agent_to_agent.is_deleted','no');
        $this->db->where('money_transfer_agent_to_agent.money_given_agent_nm',$iid);
        $this->db->join("agent", 'money_transfer_agent_to_agent.money_receiver_agent_nm=agent.id','left');
        $agent_data = $this->master_model->getRecords('money_transfer_agent_to_agent',array('money_transfer_agent_to_agent.is_deleted'=>'no'),$fields);
        // print_r($agent_data); die;

        $this->db->where('id',$id);
        $arr_data = $this->master_model->getRecords('payment_other_than_sra');
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['agent_data']        = $agent_data;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('agent/layout/agent_combo',$this->arr_view_data);
    }

    public function getAgent_mob_no(){ 
        $agent_mob_no = $this->input->post('did');
            // print_r($taluka_data); die;
                            $this->db->where('is_deleted','no');
                            $this->db->where('is_active','yes');
                            $this->db->where('id',$agent_mob_no);   
                            $data = $this->master_model->getRecords('agent');
                            // print_r($data); die;
            echo json_encode($data); 
        }
}