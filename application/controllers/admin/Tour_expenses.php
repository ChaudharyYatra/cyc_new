<?php 
//   Controller for: home page
// Author: Rupali Patil
// Start Date: 16-08-2022
// last updated: 16-08-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_expenses extends CI_Controller {
	 
	function __construct() {

        parent::__construct();
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."admin/tour_expenses";
        $this->module_title       = "Tour Expenses";
        $this->module_url_slug    = "tour_expenses";
        $this->module_view_folder = "tour_expenses/";
        $this->arr_view_data = [];
	 }

        public function index()
        {
        $tour_manager_sess_name = $this->session->userdata('tour_manager_name');
        $id = $this->session->userdata('tour_manager_sess_id'); 

        $record = array();
        $fields = "tour_expenses.*,expense_type.expense_type_name,expense_category.expense_category";
        $this->db->where('tour_expenses.is_deleted','no');
        $this->db->order_by('tour_expenses.id','desc');
        $this->db->join("expense_type", 'tour_expenses.expense_type=expense_type.id','left');
        $this->db->join("expense_category", 'tour_expenses.expense_category_id=expense_category.id','left');
        $arr_data = $this->master_model->getRecords('tour_expenses',array('tour_expenses.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;

        $this->db->where('is_deleted','no');
		$this->db->order_by('tour_number','ASC');
        $packages_data = $this->master_model->getRecords('packages');
        //  print_r($packages_data); die;

        $this->arr_view_data['tour_manager_sess_name']        = $tour_manager_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
         $this->arr_view_data['arr_data']        = $arr_data;
         $this->arr_view_data['packages_data']        = $packages_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
        
        }

        public function get_date(){ 
            // POST data 
            // $all_b=array();
            $today= date('Y-m-d');
            $date_data = $this->input->post('did');
            // print_r($boarding_office_location); die;
                            // $this->db->where('is_deleted','no');
                            // $this->db->where('is_active','yes');
                            // $this->db->where('package_id',$date_data);   
                            // $data = $this->master_model->getRecords('package_date');

                        $this->db->where('is_deleted','no');
                        $this->db->where('is_active','yes');
                        // $this->db->where('bus_open_status','yes');
                        // $this->db->where('journey_date >=',$today);
                        $this->db->where('package_id',$date_data);
                        $data = $this->master_model->getRecords('package_date');
        //    print_r($data); die;
                    
            echo json_encode($data);
        }


        public function tour_expenses_data()  
        {  
               $package_title=$this->input->post('super_id');
               $package_id=$this->input->post('date_super_id');
               
                $record = array();
                $fields = "tour_expenses.*,expense_type.expense_type_name,expense_category.expense_category";
                $this->db->where('tour_date',$package_id);
                $this->db->where('package_id',$package_title);   
                $this->db->join("expense_type", 'tour_expenses.expense_type=expense_type.id','left');
                $this->db->join("expense_category", 'tour_expenses.expense_category_id=expense_category.id','left');
                $arr_data = $this->master_model->getRecords('tour_expenses');
                // print_r($arr_data); die;
                echo json_encode($arr_data);
        }
//         public function add()
//         {  
//             $tour_manager_sess_name = $this->session->userdata('tour_manager_name');
//             $id = $this->session->userdata('tour_manager_sess_id'); 

//             $this->db->where('is_deleted','no');
//             $this->db->where('is_active','yes');
//             $this->db->order_by('id','ASC');
//             $expense_type_data = $this->master_model->getRecords('expense_type');
//             // print_r($expense_type_data); die;  

//         if($this->input->post('submit'))
//         {
//             // ============================upload image 1====================
//             if($_FILES['image_name']['name']!=''){
//                 $file_name     = $_FILES['image_name']['name'];
//                 $arr_extension = array('png','jpg','JPEG','PNG','JPG','jpeg','PDF','pdf');

//                 if($file_name!="")
//                 {               
//                     $ext = explode('.',$_FILES['image_name']['name']); 
//                     $config['file_name']   = $this->input->post('txtEmp_id').'.'.$ext[1];

//                     if(!in_array($ext[1],$arr_extension))
//                     {
//                         $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
//                         redirect($this->module_url_path.'/add');  
//                     }
//                 }
//                 $file_name_to_dispaly =  $this->config->item('project_name').''.round(microtime(true)).str_replace(' ','_',$file_name);

//                 $config['upload_path']   = './uploads/tour_expenses/';
//                 $config['allowed_types'] = 'png|jpg|JPG|PNG|JPEG|jpeg|PDF|pdf'; 
//                 $config['max_size']      = '10000';
//                 $config['file_name']     =  $file_name_to_dispaly;
//                 $config['overwrite']     =  TRUE;

//                 $this->load->library('upload',$config);
//                 $this->upload->initialize($config); // Important

//                 if(!$this->upload->do_upload('image_name'))
//                 {  
//                     $data['error'] = $this->upload->display_errors();
//                     $this->session->set_flashdata('error_message',$this->upload->display_errors());
//                     redirect($this->module_url_path);  
//                 }

//                 if($file_name!="")
//                 {
//                     $file_name = $this->upload->data();
//                     $filename = $file_name_to_dispaly;
//                 }
//                 else
//                 {
//                     $filename = $this->input->post('image_name',TRUE);
//                 }
              
//             } 
//             else{
//                $filename  = '';
//             }
//             // ============================upload image 1====================
//              // ============================upload image 2====================

//              if($_FILES['image_name_2']['name']!=''){
//                 $file_name     = $_FILES['image_name_2']['name'];
                
//                 $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG','PDF','pdf');

//                 $file_name = $_FILES['image_name_2'];
//                 $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG','PDF','PDF','pdf');

//                 if($file_name['name']!="")
//                 {
//                     $ext = explode('.',$_FILES['image_name_2']['name']); 
//                     $config['file_name'] = rand(1000,90000);

//                     if(!in_array($ext[1],$arr_extension))
//                     {
//                         $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
//                     }
//                 }   

//                $file_name_to_dispaly_pdf =  $this->config->item('project_name').round(microtime(true)).str_replace(' ','_',$file_name['name']);
            
//                 $config['upload_path']   = './uploads/tour_expenses/';
//                 $config['allowed_types'] = 'JPEG|PNG|png|jpg|JPG|jpeg|pdf|PDF';  
//                 $config['max_size']      = '10000';
//                 $config['file_name']     = $file_name_to_dispaly_pdf;
//                 $config['overwrite']     = TRUE;
//                 $this->load->library('upload',$config);
//                 $this->upload->initialize($config); // Important
                
//                 if(!$this->upload->do_upload('image_name_2'))
//                 {  
//                     $data['error'] = $this->upload->display_errors();
//                     $this->session->set_flashdata('error_message',$this->upload->display_errors());
//                     redirect($this->module_url_path.'/edit/'.$id);
//                 }
//                 if($file_name['name']!="")
//                 {   
//                     $file_name = $this->upload->data();
//                     $new_img_filename = $file_name_to_dispaly_pdf;
//                 }
//                 else
//                 {
//                     $new_img_filename = $this->input->post('image_name_2',TRUE);
                    
//                 }

//             } 
//             else{
//                $new_img_filename  = '';
//             }
// // ==============================upload image 2===============================================================//

//                 $expense_type  = $this->input->post('expense_type');
//                 $expense_category  = $this->input->post('expense_category');
//                 $expense_place  = $this->input->post('expense_place');
//                 $expense_date  = $this->input->post('expense_date');
//                 $bill_number  = $this->input->post('bill_number');
//                 $total_pax  = $this->input->post('total_pax');
//                 $expense_amt  = $this->input->post('expense_amt');
//                 $expense_date  = $this->input->post('expense_date');
//                 $tour_expenses_remark  = $this->input->post('tour_expenses_remark');
//                 $tour_number  = $this->input->post('tour_number');
                
//                 $arr_insert = array(
//                 'expense_type' =>   $expense_type,
//                 'expense_category_id' =>   $expense_category,
//                 'expense_place' =>   $expense_place,
//                 'expense_date' =>   $expense_date,
//                 'bill_number' =>   $bill_number,
//                 'total_pax' =>   $total_pax,
//                 'expense_amt' =>   $expense_amt,
//                 'expense_date' =>   $expense_date,
//                 'tour_expenses_remark' =>   $tour_expenses_remark,
//                 'image_name' =>   $filename,
//                 'image_name_2' =>   $new_img_filename,
//                 'tour_manager_id' =>   $id,
//                 'package_id' =>   $tour_number
//                 ); 
//                 $inserted_id = $this->master_model->insertRecord('tour_expenses',$arr_insert,true);
//                          //sleep(2);
                    
//                  if($inserted_id > 0)
//                  {
//                      $this->session->set_flashdata('success_message',ucfirst($this->module_title)." Added Successfully.");
//                      redirect($this->module_url_path.'/index');
//                  }
//                  else
//                  {
//                      $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
//                  }
//                 //  redirect($this->module_seat_type_room_type.'/add/'.$iid);
//                  redirect($this->module_url_path.'/index');
//                 // }   
//         }

//         $this->db->where('is_deleted','no');
// 		$this->db->order_by('tour_number','ASC');
//         $packages_data = $this->master_model->getRecords('packages');
//         //  print_r($packages_data); die;
 
//          $this->arr_view_data['tour_manager_sess_name'] = $tour_manager_sess_name;
//          $this->arr_view_data['action']          = 'add';
//          $this->arr_view_data['expense_type_data']        = $expense_type_data;
//          $this->arr_view_data['packages_data']        = $packages_data;
//          $this->arr_view_data['page_title']      = " Add ".$this->module_title;
//          $this->arr_view_data['module_title']    = $this->module_title;
//          $this->arr_view_data['module_url_path'] = $this->module_url_path;
//          $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
//          $this->load->view('tour_manager/layout/agent_combo',$this->arr_view_data);
//     }


    // public function edit($id="")
    //     {  
    //         // echo $id; die;
    //         $tour_manager_sess_name = $this->session->userdata('tour_manager_name');
    //         $iid = $this->session->userdata('tour_manager_sess_id'); 

    //         $tid=base64_decode($id);
    //         if ($tid=='') 
    //         {
    //             $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //             redirect($this->module_url_path.'/index');
    //         }   
    //         else
    //         {   
    //             $this->db->where('id',$tid);
    //             $arr_data = $this->master_model->getRecords('tour_expenses');
    //         }
    //         if($this->input->post('submit'))
    //         {
    //             $old_img_name = $this->input->post('old_img_name');
                
    //                 if(!empty($_FILES['image_name']) && $_FILES['image_name']['name'] !='')
    //                 {
    //                 $file_name     = $_FILES['image_name']['name'];
    //                 $arr_extension = array('png','jpg','JPEG','PNG','JPG','jpeg','PDF','pdf');

    //                 $file_name = $_FILES['image_name'];
    //                 $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG','PDF','pdf');

    //                 if($file_name['name']!="")
    //                 {
    //                     $ext = explode('.',$_FILES['image_name']['name']); 
    //                     $config['file_name'] = rand(1000,90000);

    //                     if(!in_array($ext[1],$arr_extension))
    //                     {
    //                         $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
    //                         redirect($this->module_url_path.'/edit/'.$id);
    //                     }
    //                 }   

    //                 $file_name_to_dispaly =  $this->config->item('project_name').round(microtime(true)).str_replace(' ','_',$file_name['name']);
                    
    //                 $config['upload_path']   = './uploads/tour_expenses/';
    //                 $config['allowed_types'] = 'JPEG|PNG|png|jpg|JPG|jpeg|PDF|pdf';  
    //                 $config['max_size']      = '10000';
    //                 $config['file_name']     = $file_name_to_dispaly;
    //                 $config['overwrite']     = TRUE;
    //                 $this->load->library('upload',$config);
    //                 $this->upload->initialize($config); // Important
                    
    //                 if(!$this->upload->do_upload('image_name'))
    //                 {  
    //                     $data['error'] = $this->upload->display_errors();
    //                     $this->session->set_flashdata('error_message',$this->upload->display_errors());
    //                     redirect($this->module_url_path.'/edit/'.$id);
    //                 }
    //                 if($file_name['name']!="")
    //                 {   
    //                     $file_name = $this->upload->data();
    //                     $filename = $file_name_to_dispaly;
    //                     if($old_img_name!='') unlink('./uploads/suggestion_image/'.$old_img_name);
    //                 }
    //                 else
    //                 {
    //                     $filename = $this->input->post('image_name',TRUE);
    //                 }
    //             }
    //             else
    //             {
    //                 $filename = $old_img_name;
    //             }

    //             // =============================upload 1=============================================

    //             // =============================upload 2=============================================
    //             $old_new_name = $this->input->post('old_new_name');
                
    //             if(!empty($_FILES['image_name_2']) && $_FILES['image_name_2']['name'] !='')
    //             {
    //            $file_name     = $_FILES['image_name_2']['name'];
                
    //             $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG','PDF','pdf');

    //             $file_name = $_FILES['image_name_2'];
    //             $arr_extension = array('png','jpg','jpeg','PNG','JPG','JPEG','PDF','pdf');

    //             if($file_name['name']!="")
    //             {
    //                 $ext = explode('.',$_FILES['image_name_2']['name']); 
    //                 $config['file_name'] = rand(1000,90000);

    //                 if(!in_array($ext[1],$arr_extension))
    //                 {
    //                     $this->session->set_flashdata('error_message','Please Upload png/jpg Files.');
    //                     redirect($this->module_url_path.'/edit/'.$id);
    //                 }
    //             }   

    //            $file_name_to_dispaly_pdf =  $this->config->item('project_name').round(microtime(true)).str_replace(' ','_',$file_name['name']);
            
    //             $config['upload_path']   = './uploads/tour_expenses/';
    //             $config['allowed_types'] = 'JPEG|PNG|png|jpg|JPG|jpeg|PDF|pdf';  
    //             $config['max_size']      = '10000';
    //             $config['file_name']     = $file_name_to_dispaly_pdf;
    //             $config['overwrite']     = TRUE;
    //             $this->load->library('upload',$config);
    //             $this->upload->initialize($config); // Important
                
    //             if(!$this->upload->do_upload('image_name_2'))
    //             {  
    //                 $data['error'] = $this->upload->display_errors();
    //                 $this->session->set_flashdata('error_message',$this->upload->display_errors());
    //                 redirect($this->module_url_path.'/edit/'.$id);
    //             }
    //             if($file_name['name']!="")
    //             {   
    //                 $file_name = $this->upload->data();
    //                 $new_img_filename = $file_name_to_dispaly_pdf;
    //                 if($old_new_name!='') unlink('./uploads/tour_expenses/'.$old_new_name);
    //             }
    //             else
    //             {
    //                 $new_img_filename = $this->input->post('image_name_2',TRUE);
                    
    //             }
    //         }
    //         else
    //         {
    //             $new_img_filename = $old_new_name;
                
    //         }
			
    //             // =============================upload 2=============================================

    //             $expense_type  = $this->input->post('expense_type');
    //             $expense_category  = $this->input->post('expense_category');
    //             $expense_place  = $this->input->post('expense_place');
    //             $expense_date  = $this->input->post('expense_date');
    //             $bill_number  = $this->input->post('bill_number');
    //             $total_pax  = $this->input->post('total_pax');
    //             $expense_amt  = $this->input->post('expense_amt');
    //             $expense_date  = $this->input->post('expense_date');
    //             $tour_expenses_remark  = $this->input->post('tour_expenses_remark');
    //             $tour_number  = $this->input->post('tour_number');
                
    //             $arr_update = array(
    //             'expense_type' =>   $expense_type,
    //             'expense_category_id' =>   $expense_category,
    //             'expense_place' =>   $expense_place,
    //             'expense_date' =>   $expense_date,
    //             'bill_number' =>   $bill_number,
    //             'total_pax' =>   $total_pax,
    //             'expense_amt' =>   $expense_amt,
    //             'expense_date' =>   $expense_date,
    //             'tour_expenses_remark' =>   $tour_expenses_remark,
    //             'image_name' =>   $filename,
    //             'image_name_2' =>   $new_img_filename,
    //             'package_id' =>   $tour_number

    //              );
    //                 $arr_where     = array("id" => $tid);
    //                 $inserted_id = $this->master_model->updateRecord('tour_expenses',$arr_update,$arr_where);
                        
    //              if($inserted_id > 0)
    //              {
    //                  $this->session->set_flashdata('success_message',ucfirst($this->module_title)." Added Successfully.");
    //                  redirect($this->module_url_path.'/index/'.$tid);
    //              }
    //              else
    //              {
    //                  $this->session->set_flashdata('error_message',"Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
    //              }
    //              redirect($this->module_url_path.'/index');
    //             }   
    //     //    }

    //     $this->db->where('is_deleted','no');
    //     $this->db->where('is_active','yes');
    //     $this->db->order_by('id','ASC');
    //     $expense_type_data = $this->master_model->getRecords('expense_type');
    //     // print_r($expense_type_data); die;  

    //     $this->db->where('is_deleted','no');
    //     $this->db->where('is_active','yes');
    //     // $this->db->where('id',$iid);
    //     $this->db->order_by('id','ASC');
    //     $expense_category_data = $this->master_model->getRecords('expense_category');
    //     // print_r($expense_category_data); die;  

    //     $record = array();
    //     $fields = "tour_expenses.*,expense_type.expense_type_name,expense_category.expense_category";
    //     $this->db->where('tour_expenses.is_deleted','no');
    //     $this->db->order_by('tour_expenses.id','desc');
    //     $this->db->where('tour_expenses.id',$tid);
    //     $this->db->join("expense_type", 'tour_expenses.expense_type=expense_type.id','left');
    //     $this->db->join("expense_category", 'tour_expenses.expense_category_id=expense_category.id','left');
    //     $tour_expenses_all = $this->master_model->getRecords('tour_expenses',array('tour_expenses.is_deleted'=>'no'),$fields);
    //     // print_r($tour_expenses_all); die;

    //     $this->db->where('is_deleted','no');
	// 	$this->db->order_by('tour_number','ASC');
    //     $packages_data = $this->master_model->getRecords('packages');
    //     //  print_r($packages_data); die;

    //      $this->arr_view_data['tour_manager_sess_name'] = $tour_manager_sess_name;
    //      $this->arr_view_data['packages_data'] = $packages_data;
    //      $this->arr_view_data['tour_expenses_all'] = $tour_expenses_all;
    //      $this->arr_view_data['expense_type_data'] = $expense_type_data;
    //      $this->arr_view_data['expense_category_data'] = $expense_category_data;
    //      $this->arr_view_data['page_title']      = " Edit ".$this->module_title;
    //      $this->arr_view_data['module_title']    = $this->module_title;
    //      $this->arr_view_data['module_url_path'] = $this->module_url_path;
    //      $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
    //      $this->load->view('tour_manager/layout/agent_combo',$this->arr_view_data);
    //     }

        // Delete
    
    // public function delete($id)
    // {
    //     $tour_manager_sess_name = $this->session->userdata('tour_manager_name');
    //     $iid = $this->session->userdata('tour_manager_sess_id'); 
        
    //    $id=base64_decode($id);
    //     if(is_numeric($id))
    //     {   
    //         $this->db->where('id',$id);
    //         $arr_data = $this->master_model->getRecords('tour_expenses');

    //         if(empty($arr_data))
    //         {
    //             $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //             redirect($this->module_url_path);
    //         }
    //         $arr_update = array('is_deleted' => 'yes');
    //         $arr_where = array("id" => $id);
                 
    //         if($this->master_model->updateRecord('tour_expenses',$arr_update,$arr_where))
    //         {
    //             $this->session->set_flashdata('success_message',$this->module_title.' Deleted Successfully.');
    //         }
    //         else
    //         {
    //             $this->session->set_flashdata('error_message','Oops,Something Went Wrong While Deleting Record.');
    //         }
    //     }
    //     else
    //     {
           
    //            $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //     }
    //     redirect($this->module_url_path.'/index');  

    // }

    // public function details($id)
    // {
    //     $tour_manager_sess_name = $this->session->userdata('tour_manager_name');
    //     $iid = $this->session->userdata('tour_manager_sess_id'); 

	// 	$tid=base64_decode($id);
    //     if ($id=='') 
    //     {
    //         $this->session->set_flashdata('error_message','Invalid Selection Of Record');
    //         redirect($this->module_url_path.'/index');
    //     }   
        
    //     $record = array();
    //     $fields = "tour_expenses.*,expense_type.expense_type_name,expense_category.expense_category";
    //     $this->db->where('tour_expenses.is_deleted','no');
    //     $this->db->order_by('tour_expenses.id','desc');
    //     $this->db->where('tour_expenses.id',$tid);
    //     $this->db->join("expense_type", 'tour_expenses.expense_type=expense_type.id','left');
    //     $this->db->join("expense_category", 'tour_expenses.expense_category_id=expense_category.id','left');
    //     $tour_expenses_all = $this->master_model->getRecords('tour_expenses',array('tour_expenses.is_deleted'=>'no'),$fields);
    //     // print_r($tour_expenses_all); die;
        
    //     $this->arr_view_data['tour_manager_sess_name']        = $tour_manager_sess_name;
    //     $this->arr_view_data['tour_expenses_all']        = $tour_expenses_all;
    //     $this->arr_view_data['page_title']      = $this->module_title." Details ";
    //     $this->arr_view_data['module_title']    = $this->module_title;
    //     $this->arr_view_data['module_url_path'] = $this->module_url_path;
    //     $this->arr_view_data['middle_content']  = $this->module_view_folder."details";
    //     $this->load->view('tour_manager/layout/agent_combo',$this->arr_view_data);
    // }

    // public function get_category(){ 
    //     // POST data 
    //     // $all_b=array();
    //    $district_data = $this->input->post('did');
    //     // print_r($boarding_office_location); die;
    //                     $this->db->where('is_deleted','no');
    //                     $this->db->where('is_active','yes');
    //                     $this->db->where('expense_type',$district_data);   
    //                     $data = $this->master_model->getRecords('expense_category');
    //     echo json_encode($data);
    // }


}