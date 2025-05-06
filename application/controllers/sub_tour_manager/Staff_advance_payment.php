<?php 
//   Controller for: home page
// Author: Rupali Patil
// Start Date: 16-08-2022
// last updated: 16-08-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_advance_payment extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        if($this->session->userdata('supervision_sess_id')=="") 
        { 
                redirect(base_url().'supervision/login'); 
        }
        $this->module_url_path    =  base_url().$this->config->item('sub_tour_manager_panel_slug')."sub_tour_manager/Staff_advance_payment";
        $this->add_more_module_url_path    =  base_url().$this->config->item('sub_tour_manager_panel_slug')."sub_tour_manager/add_more_tour_expenses";
        $this->module_title       = "Staff Advance Payment";
        $this->module_url_slug    = "Staff_advance_payment";
        $this->module_view_folder = "Staff_advance_payment/";

        $this->module_title_add_more       = "Add More Daily Tour Expenses";
        $this->module_url_slug_add_more    = "add_more_tour_expenses";
        $this->module_view_folder_add_more = "add_more_tour_expenses/";
        $this->arr_view_data = [];
	}

        public function index($pid,$pd_id)
        {
        $package_id=base64_decode($pid);
        // print_r($package_id); die;
        $package_date_id=base64_decode($pd_id);

        $supervision_sess_name = $this->session->userdata('supervision_name');
        $id = $this->session->userdata('supervision_sess_id');

        $record = array();
        $fields = "staff_advance_payment.*,supervision.supervision_name";
        $this->db->where('staff_advance_payment.is_deleted','no');
        $this->db->where('staff_advance_payment.package_id',$package_id);
        $this->db->where('staff_advance_payment.sub_tour_manager_id',$id);
        $this->db->where('staff_advance_payment.package_date_id',$package_date_id);
        $this->db->join("supervision", 'staff_advance_payment.select_staff=supervision.id','left');
        $staff_advance_payment_data = $this->master_model->getRecords('staff_advance_payment',array('staff_advance_payment.is_deleted'=>'no'),$fields);
        // print_r($staff_advance_payment_data); die;

        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['staff_advance_payment_data']        = $staff_advance_payment_data;
        $this->arr_view_data['pid']        = $pid;
        $this->arr_view_data['pd_id']        = $pd_id;
        $this->arr_view_data['package_id']        = $package_id;
        $this->arr_view_data['package_date_id']        = $package_date_id;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('sub_tour_manager/layout/sub_tour_manager_combo',$this->arr_view_data);
        }

        public function all_expenses($pid,$pd_id)
        {
        $package_id=base64_decode($pid);
        $package_date_id=base64_decode($pd_id);

        $supervision_sess_name = $this->session->userdata('supervision_name');
        $id = $this->session->userdata('supervision_sess_id');

        $record = array();
        $fields = "tour_expenses.*,expense_type.expense_type_name,expense_category.expense_category,
        packages.tour_number,packages.tour_title,package_date.journey_date,hotel_advance_payment.advance_amt,
        expense_category.expense_category as exp_cat,add_more_tour_expenses.id as add_more_id";
        $this->db->where('tour_expenses.is_deleted','no');
        $this->db->where('tour_expenses.package_id',$package_id);
        $this->db->where('tour_expenses.package_date_id',$package_date_id);
        $this->db->join("expense_type", 'tour_expenses.expense_type=expense_type.id','left');
        $this->db->join("expense_category", 'tour_expenses.expense_category_id=expense_category.id','left');
        $this->db->join("packages", 'tour_expenses.package_id=packages.id','left');
        $this->db->join("package_date", 'tour_expenses.package_date_id=package_date.id','left');
        $this->db->join("add_more_tour_expenses", 'tour_expenses.id=add_more_tour_expenses.tour_expenses_id','left');
        $this->db->join("hotel_advance_payment", 'tour_expenses.package_id=hotel_advance_payment.tour_number','left');
        $this->db->group_by('tour_expenses.package_id,tour_expenses.package_date_id,tour_expenses.tour_expenses_type');
        $tour_expenses_all = $this->master_model->getRecords('tour_expenses',array('tour_expenses.is_deleted'=>'no'),$fields);
        // print_r($tour_expenses_all); die;

        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        // $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['tour_expenses_all']        = $tour_expenses_all;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."all_expenses";
        $this->load->view('sub_tour_manager/layout/sub_tour_manager_combo',$this->arr_view_data);
        
        }

        public function add($aid,$did)
        {  
            $p_id=base64_decode($aid);
            // print_r($aid); die;
            $p_did=base64_decode($did);

            $supervision_sess_name = $this->session->userdata('supervision_name');
            $iid = $this->session->userdata('supervision_sess_id');
            // print_r($iid); die;

        if($this->input->post('submit'))
        {
                $select_staff  = $this->input->post('select_staff');
                $amount  = $this->input->post('amount');
                $tour_number  = $this->input->post('tour_number');
                $tour_date  = $this->input->post('tour_date');

                $arr_insert = array(
                    'select_staff'   =>   $_POST["select_staff"],
                    'amount'   =>   $_POST["amount"],
                    'package_id'   =>   $_POST["tour_number"],
                    'package_date_id'   =>   $_POST["tour_date"],
                    'sub_tour_manager_id' => $iid
                    ); 
                $inserted_id = $this->master_model->insertRecord('staff_advance_payment',$arr_insert,true);

                if($inserted_id > 0)
                {
                    $this->session->set_flashdata('success_message',ucfirst($this->module_title)." Added Successfully.");
                    redirect($this->module_url_path.'/index/'.$aid.'/'.$did);
                }
                else
                {
                    $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                //  redirect($this->module_seat_type_room_type.'/add/'.$iid);
                 redirect($this->module_url_path.'/index');
                // }   
        }

        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
		$this->db->order_by('expense_category','ASC');
        $expense_category = $this->master_model->getRecords('expense_category');
        //  print_r($expense_category); die;

        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $measuring_unit = $this->master_model->getRecords('measuring_unit');
        //  print_r($measuring_unit); die;

        $record = array();
        $fields = "packages.*,package_date.journey_date,package_date.id as pd_id";
        $this->db->where('packages.is_deleted','no');
        // $this->db->order_by('packages.id','desc');
        $this->db->where('packages.id',$p_id);
        $this->db->where('package_date.id',$p_did);
        $this->db->join("package_date", 'packages.id=package_date.package_id','left');
        $packages_data = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        // print_r($packages_data); die;

        $record = array();
        $fields = "assign_staff.*,supervision.supervision_name,supervision.id as sup_id";
        $this->db->where('assign_staff.is_deleted','no');
        $this->db->where('assign_staff.name!=',$iid);
        $this->db->where('assign_staff.package_id',$p_id);
        $this->db->where('assign_staff.package_date_id',$p_did);
        $this->db->join("supervision", 'assign_staff.name=supervision.id','left');
        $assign_staff_data = $this->master_model->getRecords('assign_staff',array('assign_staff.is_deleted'=>'no'),$fields);
        // print_r($assign_staff_data); die;
 
         $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
         $this->arr_view_data['action']          = 'add';
         $this->arr_view_data['aid']        = $aid;
         $this->arr_view_data['did']        = $did;
         $this->arr_view_data['assign_staff_data']        = $assign_staff_data;
         $this->arr_view_data['packages_data']        = $packages_data;
         $this->arr_view_data['expense_category']        = $expense_category;
         $this->arr_view_data['measuring_unit']        = $measuring_unit;
         $this->arr_view_data['page_title']      = " Add ".$this->module_title;
         $this->arr_view_data['module_title']    = $this->module_title;
         $this->arr_view_data['module_url_path'] = $this->module_url_path;
         $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
         $this->load->view('sub_tour_manager/layout/sub_tour_manager_combo',$this->arr_view_data);
    }



    // Edit - Get data for edit
    
    public function edit($id,$pid,$pd_id)
    {
        $package_id=base64_decode($pid);
        $package_date_id=base64_decode($pd_id);

        $supervision_sess_name = $this->session->userdata('supervision_name');
        $iid = $this->session->userdata('supervision_sess_id');

        if ($id=='') 
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }   

        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('staff_advance_payment');
            // print_r($arr_data); die;
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('select_staff', 'select_staff', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                   $select_staff = trim($this->input->post('select_staff'));
                   $amount = trim($this->input->post('amount'));
                   
                    // $this->db->where('hotel_type_name',$hotel_type_name);
                    // $this->db->where('id!='.$id);
                    // $this->db->where('is_deleted','no');
                    // $bus_master_exist_data = $this->master_model->getRecords('staff_advance_payment');
                    // if(count($bus_master_exist_data) > 0)
                    // {
                    //     $this->session->set_flashdata('error_message',"Bus".$hotel_type_name." Already Exist.");
                    //     redirect($this->module_url_path.'/add');
                    // }

                   $arr_update = array(
                        'select_staff' => $select_staff,
                        'amount' => $amount
                    );
                    $arr_where     = array("id" => $id);
                   $this->master_model->updateRecord('staff_advance_payment',$arr_update,$arr_where);
                    if($id > 0)
                    {
                        $this->session->set_flashdata('success_message',$this->module_title." Information Updated Successfully.");
                        redirect($this->module_url_path.'/index/'.$pid.'/'.$pd_id);
                    }
                    else
                    {
                        $this->session->set_flashdata('error_message'," Something Went Wrong While Updating The ".ucfirst($this->module_title).".");
                    }
                    redirect($this->module_url_path.'/index');
                }   
            }
        }
        else
        {
            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
            redirect($this->module_url_path.'/index');
        }

        $record = array();
        $fields = "assign_staff.*,supervision.supervision_name,supervision.id as sup_id";
        $this->db->where('assign_staff.is_deleted','no');
        $this->db->where('assign_staff.name!=',$iid);
        $this->db->where('assign_staff.package_id',$package_id);
        $this->db->where('assign_staff.package_date_id',$package_date_id);
        $this->db->join("supervision", 'assign_staff.name=supervision.id','left');
        $assign_staff_data = $this->master_model->getRecords('assign_staff',array('assign_staff.is_deleted'=>'no'),$fields);
        // print_r($assign_staff_data); die;
         
        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['assign_staff_data']        = $assign_staff_data;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['id']        = $id;
        $this->arr_view_data['pid']        = $pid;
        $this->arr_view_data['pd_id']        = $pd_id;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('sub_tour_manager/layout/sub_tour_manager_combo',$this->arr_view_data);
    }

    public function delete($id,$pid,$pd_id)
    {
        if($id!='')
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('staff_advance_payment');
            // print_r($arr_data); die;

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }
            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('staff_advance_payment',$arr_update,$arr_where))
            {
                $this->session->set_flashdata('success_message',$this->module_title.' Deleted Successfully.');
                redirect($this->module_url_path.'/index/'.$pid.'/'.$pd_id);
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

    // Active/Inactive
  public function active_inactive($s_id,$type,$pid,$pd_id)
  {
      if($s_id!="" || $pid!="" || $pd_id!="" && ($type == "yes" || $type == "no"))
      {   
          $this->db->where('id',$s_id);
          $arr_data = $this->master_model->getRecords('staff_advance_payment');
        //   print_r($arr_data); die;
          if(empty($arr_data))
          {
             $this->session->set_flashdata('error_message','Invalid Selection Of Record');
             redirect($this->module_url_path.'/index/'.$pid.'/'.$pd_id);
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
          
          if($this->master_model->updateRecord('staff_advance_payment',$arr_update,array('id' => $s_id)))
          {
              $this->session->set_flashdata('success_message',$this->module_title.' Updated Successfully.');
              redirect($this->module_url_path.'/index/'.$pid.'/'.$pd_id);
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



}