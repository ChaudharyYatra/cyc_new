<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Citywise_place_master extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('chy_admin_id')=="") 
        { 
                redirect(base_url().'admin/login'); 
        }
		
        $this->module_url_path    =  base_url().$this->config->item('admin_panel_slug')."/citywise_place_master";
        $this->module_title       = "Citywise Place Master";
        $this->module_url_slug    = "citywise_place_master";
        $this->module_view_folder = "citywise_place_master/";
	}

	public function index()
	{  
        $fields = "citywise_place_master.*,district_table.district,city.city_name";
        $this->db->order_by('id','desc');
        $this->db->where('citywise_place_master.is_deleted','no');
        $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        $this->db->group_by('citywise_place_master.select_district,citywise_place_master.select_city');
        $arr_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;

        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $arr_data = $this->master_model->getRecords('citywise_place_master');

        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
	}
    

    // public function insert_particular_data()
    // { 
    //     $Place_name = $this->input->post('Place_name');
    //     $opening_time = $this->input->post('opening_time');
    //     $closing_time = $this->input->post('closing_time');
    //     $open_days = implode(",", $this->input->post('open_days')); 
    //     $ticket_yes_no = $this->input->post('ticket_yes_no');
    //     $ticket_cost = $this->input->post('ticket_cost');
    //     $municipal_tax_yes_no = $this->input->post('municipal_tax_yes_no');
    //     $municipal_amt = $this->input->post('municipal_amt');
    //     $parking_cost_yes_no = $this->input->post('parking_cost_yes_no');
    //     $parking_cost = $this->input->post('parking_cost');
    //     $req_time = $this->input->post('req_time');
    //     $allow_vehicle_types = implode(",", $this->input->post('allow_vehicle_types')); 
    //     $railway_station_name = $this->input->post('railway_station_name');
    //     $airport_name = $this->input->post('airport_name');

    //         $arr_insert = array(
    //                     'place_name'   =>   $Place_name,
    //                     'opening_time'   =>   $opening_time,
    //                     'closing_time'   =>   $closing_time,
    //                     'open_days'   =>   $open_days,
    //                     'ticket_yes_no'   =>   $ticket_yes_no,
    //                     'ticket_cost'   =>   $ticket_cost,
    //                     'municipal_tax_yes_no'   =>   $municipal_tax_yes_no,
    //                     'municipal_amt'   =>   $municipal_amt,
    //                     'parking_cost_yes_no'   =>   $parking_cost_yes_no,
    //                     'parking_cost'   =>   $parking_cost,
    //                     'req_time'   =>   $req_time,
    //                     'allow_vehicle_types'   =>   $allow_vehicle_types,
    //                     'railway_station_name'   =>   $railway_station_name,
    //                     'airport_name'   =>   $airport_name
    //         );

    //          $inserted_id = $this->master_model->insertRecord('citywise_place_master',$arr_insert,true);

    //     if($inserted_id!=''){
    //        echo true;

    //    }else {
    //        echo false;
    //    }

    // }

    public function add()
    {   
        if($this->input->post('submit'))
        {
            // print_r($_REQUEST); die;
            $this->form_validation->set_rules('select_district', 'select_district', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                // print_r($_REQUEST); die;
                $select_district = $this->input->post('select_district');
                $select_city = $this->input->post('select_city');

                $select_type = $this->input->post('select_type');
                $room_select = $this->input->post('room_select');
                $room_rate = $this->input->post('room_rate');
                $room_total_person = $this->input->post('room_total_person');
                $extra_bed_charges = $this->input->post('extra_bed_charges');

                $select_type_sector = $this->input->post('select_type_sector');
                $organization = $this->input->post('organization');
                $select_designation = $this->input->post('select_designation');
                $person_name = $this->input->post('person_name');
                $mobile_number = $this->input->post('mobile_number');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $website_url = $this->input->post('website_url');

                $Place_name = $this->input->post('Place_name');
                $opening_time = $this->input->post('opening_time');
                $closing_time = $this->input->post('closing_time');
                // $open_days = $this->input->post('open_days');
                // $open_days = implode(",", $this->input->post('open_days'));
                // print_r($open_days); die;
                // $ticket_yes_no = $this->input->post('ticket_yes_no');
                // $ticket_cost = $this->input->post('ticket_cost');
                // $municipal_tax_yes_no = $this->input->post('municipal_tax_yes_no');
                // $municipal_amt = $this->input->post('municipal_amt');
                // $parking_cost_yes_no = $this->input->post('parking_cost_yes_no');
                // $parking_cost = $this->input->post('parking_cost');
                $req_time = $this->input->post('req_time');
                $allow_vehicle_types = $this->input->post('allow_vehicle_types');
                // $allow_vehicle_types = implode(",", $this->input->post('allow_vehicle_types')); 
                $railway_station_name = $this->input->post('railway_station_name');
                $airport_name = $this->input->post('airport_name');

                $place_description_english = $this->input->post('place_description_english');
                // print_r($place_description_english); die;
                $place_description_marathi = $this->input->post('place_description_marathi');
                $place_description_hindi = $this->input->post('place_description_hindi');
                $youtube_link = $this->input->post('youtube_link');
                $google_map_link = $this->input->post('google_map_link');
                // $in_tour_creation_no_one = $this->input->post('in_tour_creation_no_one');
                // $ticket_yes_no1 = $this->input->post('ticket_yes_no1');
                // print_r($ticket_yes_no1); 
                $ticket_cost = $this->input->post('ticket_cost');
                // $in_tour_creation_no_two = $this->input->post('in_tour_creation_no_two');
                $municipal_tax_yes_no1 = $this->input->post('municipal_tax_yes_no1');
                $municipal_amt = $this->input->post('municipal_amt');
                // $in_tour_creation_no_three = $this->input->post('in_tour_creation_no_three');
                // $parking_cost_yes_no1 = $this->input->post('parking_cost_yes_no1');
                $parking_cost = $this->input->post('parking_cost');
                // $in_tour_creation_no_four = $this->input->post('in_tour_creation_no_four');
                // $darshan_pass_cost_yes_no1 = $this->input->post('darshan_pass_cost_yes_no1');
                $darshan_pass_cost = $this->input->post('darshan_pass_cost');
                $ticket_booking_link = $this->input->post('ticket_booking_link');
                $in_tour_creation_no5 = $this->input->post('in_tour_creation_no5');

                
                $other_vehicle = $this->input->post('other_vehicle');
                $max_amt = $this->input->post('max_amt');

                $place_count = count($Place_name);
                // print_r($place_count); die;
                for($j=0;$j<$place_count;$j++)
                {
                    $p=$j+1;
                    $ticket_dynamic_name='in_tour_creation_no_one'.$p;
                    $in_tour_creation_no_one = $this->input->post($ticket_dynamic_name);

                    $municipal_dynamic_name='in_tour_creation_no_two'.$p;
                    $in_tour_creation_no_two = $this->input->post($municipal_dynamic_name);

                    $parking_dynamic_name='in_tour_creation_no_three'.$p;
                    $in_tour_creation_no_three = $this->input->post($parking_dynamic_name);

                    $darshan_pass_dynamic_name='in_tour_creation_no_four'.$p;
                    $in_tour_creation_no_four = $this->input->post($darshan_pass_dynamic_name);
                    // print_r($darshan_pass_yes_no); die;


                    $ticket_name='ticket_yes_no'.$p;
                    $ticket_yes_no = $this->input->post($ticket_name);

                    $municipal_name='municipal_tax_yes_no'.$p;
                    $municipal_tax_yes_no = $this->input->post($municipal_name);

                    $parking_name='parking_cost_yes_no'.$p;
                    $parking_cost_yes_no = $this->input->post($parking_name);

                    $darshan_pass__name='darshan_pass_cost_yes_no'.$p;
                    $darshan_pass_cost_yes_no = $this->input->post($darshan_pass__name);
                    // print_r($darshan_pass_yes_no); die;

                    $new_image_name='image_name'.$p;
                    // print_r($new_image_name); die;


                    // Retrieve the open days for this row
                        // Retrieve the open days for this row
                            $open_days = $this->input->post('open_days' . $p . '[]');

                            // Convert to array if not already an array
                            $open_days = is_array($open_days) ? $open_days : [];

                            // Convert selected open days to a comma-separated string
                            $open_days_str = implode(",", $open_days);

                        // Retrieve the open days for this row
                        $vehicle_types = $this->input->post('allow_vehicle_types' . $p . '[]');

                        $vehicle_types = is_array($vehicle_types) ? $vehicle_types : [];
                        // Convert selected open days to a comma-separated string
                        $allow_vehicle_types = implode(",", $vehicle_types);


                        // ======================= Image ===================================
                        
                        $_FILES['file']['name']     = $_FILES[$new_image_name]['name']; 
                        $_FILES['file']['type']     = $_FILES[$new_image_name]['type']; 
                        $_FILES['file']['tmp_name'] = $_FILES[$new_image_name]['tmp_name']; 
                        $_FILES['file']['error']     = $_FILES[$new_image_name]['error']; 
                        $_FILES['file']['size']     = $_FILES[$new_image_name]['size'];
                        
                        $uploadPath = './uploads/visiting_place/'; 
                        $config['upload_path'] = $uploadPath; 
                        $config['allowed_types'] = 'jpg|jpeg|png|gif'; 

                        $this->load->library('upload', $config); 
                        $this->upload->initialize($config); 

                        if($this->upload->do_upload('file')){ 
                            // Uploaded file data 
                            $fileData = $this->upload->data(); 
                        }

                        // ======================= Image ===================================


                    $arr_insert = array(
                    'select_district'    => $select_district,
                    'select_city'        => $select_city,
                    'place_name'         => $Place_name[$j],
                    'opening_time'       => $opening_time[$j],
                    'closing_time'       => $closing_time[$j],
                    'image_name'      => $fileData['file_name'],
                    'open_days'         => $open_days_str,
                    // 'ticket_yes_no'      => $ticket_yes_no['0'],      
                    // 'municipal_tax_yes_no' => $municipal_yes_no['0'],  
                    // 'parking_cost_yes_no' => $parking_yes_no['0'],          
                    // 'darshan_pass_yes_no' => $darshan_pass_yes_no['0'],          
                    'req_time'           => $req_time[$j],
                    'allow_vehicle_types' => $allow_vehicle_types,
                    'railway_station_name' => $railway_station_name[$j],
                    'airport_name'       => $airport_name[$j],
                    'place_description_english' => $place_description_english[$j],
                    'place_description_marathi' => $place_description_marathi[$j],
                    'place_description_hindi'   => $place_description_hindi[$j],
                    'youtube_link'              => $youtube_link[$j],
                    'google_map_link'           => $google_map_link[$j],
                    'in_tour_creation_no1'      => $in_tour_creation_no_one,
                    'ticket_yes_no1'            => $ticket_yes_no,
                    'ticket_cost'               => $ticket_cost[$j],
                    'in_tour_creation_no2'      => $in_tour_creation_no_two,
                    'municipal_tax_yes_no1'     => $municipal_tax_yes_no,
                    'municipal_amt'             => $municipal_amt[$j],
                    'in_tour_creation_no3'      => $in_tour_creation_no_three,
                    'parking_cost_yes_no1'      => $parking_cost_yes_no,
                    'parking_cost'              => $parking_cost[$j],
                    'in_tour_creation_no4'      => $in_tour_creation_no_four,
                    'darshan_pass_cost_yes_no1' => $darshan_pass_cost_yes_no,
                    'darshan_pass_cost'         => $darshan_pass_cost[$j],
                    'ticket_booking_link'       => $ticket_booking_link[$j],
                    'in_tour_creation_no5'      => $in_tour_creation_no5
                    // 'other_vehicle'             => $other_vehicle[$j],
                    // 'max_amt'                   => $max_amt[$j]
                    );
                    // die;
                    $citywise_other_add_more_inserted_id = $this->master_model->insertRecord('citywise_other_add_more',$arr_insert,true);
                    $citywise_other_add_more_id = $this->db->insert_id();
                    // print_r($citywise_other_add_more_id); die;
                    $room_count = count($select_type);
                    // print_r($room_count); die;
                    for($i=0;$i<$room_count;$i++)
                    {
                        $arr_insert = array(
                        'select_type'        => $this->input->post('select_type')[$i],
                        'room_select'        => $this->input->post('room_select')[$i],
                        'room_rate'          => $this->input->post('room_rate')[$i],
                        'room_total_person'  => $this->input->post('room_total_person')[$i],
                        'extra_bed_charges'  => $this->input->post('extra_bed_charges')[$i],
                        'citywise_other_add_more_id' => $citywise_other_add_more_id,
                        'select_district'    => $select_district,
                        'select_city'        => $select_city
                        );
                        // print_r($arr_insert); die;
                        $citywise_place_master_inserted_id = $this->master_model->insertRecord('citywise_place_master',$arr_insert,true);
                       
                    }

                    $sector_count = count($select_type_sector);
                    // print_r($sector_count); die;
                    for($k=0;$k<$sector_count;$k++)
                    {
                        $arr_insert = array(
                        'select_district'    => $select_district,
                        'select_city'        => $select_city,
                        'select_type_sector'=> $select_type_sector[$k],
                        'organization'      => $organization[$k],
                        'select_designation'=> $select_designation[$k],
                        'person_name'       => $person_name[$k],
                        'mobile_number'     => $mobile_number[$k],
                        'email'             => $email[$k],
                        'address'           => $address[$k],
                        'citywise_other_add_more_id' => $citywise_other_add_more_id,
                        'website_url'       => $website_url[$k]
                        );
                        $citywise_place_master_sector_inserted_id = $this->master_model->insertRecord('citywise_place_master_sector',$arr_insert,true);
                    }

                    $other_vehicle_count = count($other_vehicle);
                    for($l=0;$l<$other_vehicle_count;$l++)
                    {
                        $arr_insert = array(
                        'select_district'    => $select_district,
                        'select_city'        => $select_city,
                        'other_vehicle'      => $other_vehicle[$l],
                        'citywise_other_add_more_id' => $citywise_other_add_more_id,
                        'max_amt'            => $max_amt[$l]

                        );
                    
                        $citywise_other_vehicle_details_inserted_id = $this->master_model->insertRecord('citywise_other_vehicle_details',$arr_insert,true);
                    
                    }
                
                }
                if($citywise_place_master_inserted_id > 0 &&
                    $citywise_other_add_more_inserted_id > 0 &&
                    $citywise_place_master_sector_inserted_id > 0 &&
                    $citywise_other_vehicle_details_inserted_id > 0)
                {    
                    $this->session->set_flashdata('success_message',"Citywise Place Added Successfully.");
                    redirect($this->module_url_path.'/index');
                }
                else
                {
                    $this->session->set_flashdata('error_message'," Something Went Wrong While Adding The ".ucfirst($this->module_title).".");
                }
                redirect($this->module_url_path.'/index');
            }   
        }

        $this->db->order_by('id','ASC');
        $this->db->where('is_deleted','no');
        $city_table = $this->master_model->getRecords('city');
        // print_r($district_table); die;

        $this->db->order_by('id','ASC');
        $this->db->where('is_deleted','no');
        $district_table = $this->master_model->getRecords('district_table');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $vehicle_type = $this->master_model->getRecords('vehicle_type');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $hotel_type = $this->master_model->getRecords('hotel_type');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $sector = $this->master_model->getRecords('sector');
        // print_r($sector); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $room_type = $this->master_model->getRecords('room_type');
        // print_r($district_table); die;

        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['district_table'] = $district_table;
        $this->arr_view_data['city_table'] = $city_table;
        $this->arr_view_data['hotel_type'] = $hotel_type;
        $this->arr_view_data['sector'] = $sector;
        $this->arr_view_data['room_type'] = $room_type;
        $this->arr_view_data['vehicle_type'] = $vehicle_type;
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }
  // Active/Inactive
  
  public function active_inactive($district_id,$city_id,$type)
    {
        // print_r($district_id); die;
        // print_r($city_id); die;
        if(is_numeric($district_id) && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('select_district',$district_id);
            $this->db->or_where('select_city',$city_id);
            $arr_data = $this->master_model->getRecords('citywise_place_master');
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
            
            if($this->master_model->updateRecord('citywise_place_master',$arr_update,array('select_district' => $district_id,'select_city' => $city_id)))
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
        
        if(is_numeric($id))
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('citywise_place_master');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }

            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('citywise_place_master',$arr_update,$arr_where))
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
    
    public function edit($select_district,$select_city)
    { 
            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('select_district', 'select_district', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                //     $select_district = $this->input->post('select_district');
                //     $approximate_hall_rate = $this->input->post('approximate_hall_rate');
                //     $separate_room_rate = $this->input->post('separate_room_rate');
                //     $dharmshala_rate = $this->input->post('dharmshala_rate');
                //     $state_tax = $this->input->post('state_tax');

                //     $Place_name = $this->input->post('Place_name');
                //     $opening_time = $this->input->post('opening_time');
                //     $closing_time = $this->input->post('closing_time');
                //     $open_days = $this->input->post('open_days');
                //     $req_time = $this->input->post('req_time');
                //     $ticket_yes_no = $this->input->post('ticket_yes_no');
                //     $ticket_cost = $this->input->post('ticket_cost');
                //     $allow_vehicle_types = $this->input->post('allow_vehicle_types');
                //     $railway_station_name = $this->input->post('railway_station_name');

                //    $arr_update = array(
                //         'select_district'   =>   $select_district,
                //         'approximate_hall_rate'   =>   $approximate_hall_rate,
                //         'separate_room_rate'   =>   $separate_room_rate,
                //         'dharmshala_rate'   =>   $dharmshala_rate,
                //         'state_tax'   =>   $state_tax,

                //         'place_name'   =>   $Place_name[$i],
                //         'opening_time'   =>   $opening_time[$i],
                //         'closing_time'   =>   $closing_time[$i],
                //         'open_days'   =>   $open_days[$i],
                //         'req_time'   =>   $req_time[$i],
                //         'ticket_yes_no'   =>   $ticket_yes_no[$i],
                //         'ticket_cost'   =>   $ticket_cost[$i],
                //         'allow_vehicle_types'   =>   $allow_vehicle_types[$i],
                //         'railway_station_name'   =>   $railway_station_name[$i]
                //     );

                //     $arr_where     = array("id" => $id);
                //     $this->master_model->updateRecord('citywise_place_master',$arr_update,$arr_where);
                
                $room_rate_id = $this->input->post('room_rate_id');
                $select_district = $this->input->post('select_district');
                $select_city = $this->input->post('select_city');
                $select_type = $this->input->post('select_type');
                $room_select = $this->input->post('room_select');
                $room_rate = $this->input->post('room_rate');
                $room_total_person = $this->input->post('room_total_person');
                $extra_bed_charges = $this->input->post('extra_bed_charges');

                $room_count = count($select_type);
                for($i=0;$i<$room_count;$i++)
                {
                    $arr_update = array(
                    'select_type'        => $this->input->post('select_type')[$i],
                    'room_select'        => $this->input->post('room_select')[$i],
                    'room_rate'          => $this->input->post('room_rate')[$i],
                    'room_total_person'  => $this->input->post('room_total_person')[$i],
                    'extra_bed_charges'  => $this->input->post('extra_bed_charges')[$i],
                    // 'citywise_other_add_more_id' => $citywise_other_add_more_id,
                    'select_district'    => $select_district,
                    'select_city'        => $select_city
                    );
                    // print_r($arr_insert); die;
                    $arr_where     = array("id" => $room_rate_id[$i]);
                    $inserted_id = $this->master_model->updateRecord('citywise_place_master',$arr_update,$arr_where);
                    $citywise_other_add_more_id = $this->db->insert_id();
                }

                $edit_select_type = $this->input->post('edit_select_type');
                $edit_room_select = $this->input->post('edit_room_select');
                $edit_room_rate = $this->input->post('edit_room_rate');
                $edit_room_total_person = $this->input->post('edit_room_total_person');
                $edit_extra_bed_charges = $this->input->post('edit_extra_bed_charges');

                if($edit_select_type!=''){
                $edit_room_count = count($edit_select_type);
                    for($i=0;$i<$edit_room_count;$i++)
                    {
                        $arr_insert = array(
                        'select_type'        => $this->input->post('edit_select_type')[$i],
                        'room_select'        => $this->input->post('edit_room_select')[$i],
                        'room_rate'          => $this->input->post('edit_room_rate')[$i],
                        'room_total_person'  => $this->input->post('edit_room_total_person')[$i],
                        'extra_bed_charges'  => $this->input->post('edit_extra_bed_charges')[$i],
                        'citywise_other_add_more_id' => $citywise_other_add_more_id,
                        'select_district'    => $select_district,
                        'select_city'        => $select_city
                        );
                        $inserted_id = $this->master_model->insertRecord('citywise_place_master',$arr_insert,true);
                    }
                }

                    if($inserted_id > 0)
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
        
        $fields = "citywise_place_master.*,district_table.district,city.city_name";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_place_master.is_deleted','no');
        $this->db->where('citywise_place_master.select_district',$select_district);
        $this->db->where('citywise_place_master.select_city',$select_city);
        $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        $this->db->group_by('citywise_place_master.select_district,citywise_place_master.select_city');
        $distict_city_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // print_r($distict_city_data); die;

        $fields = "citywise_place_master.*,district_table.district,city.city_name,hotel_type.hotel_type_name,room_type.room_name";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_place_master.is_deleted','no');
        $this->db->where('citywise_place_master.select_district',$select_district);
        $this->db->where('citywise_place_master.select_city',$select_city);
        $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        $this->db->join("hotel_type", 'citywise_place_master.select_type=hotel_type.id','left');
        $this->db->join("room_type", 'citywise_place_master.room_select=room_type.id','left');
        $this->db->group_by('citywise_place_master.select_type');
        $room_rate_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // print_r($room_rate_data); die;


        $fields = "citywise_place_master.*,district_table.district,city.city_name,hotel_type.hotel_type_name,room_type.room_name";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_place_master.is_deleted','no');
        $this->db->where('citywise_place_master.select_district',$select_district);
        $this->db->where('citywise_place_master.select_city',$select_city);
        $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        $this->db->join("hotel_type", 'citywise_place_master.select_type=hotel_type.id','left');
        $this->db->join("room_type", 'citywise_place_master.room_select=room_type.id','left');
        // $this->db->group_by('citywise_place_master.select_type');
        $multiple_room_rate_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // print_r($multiple_room_rate_data); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $district_table = $this->master_model->getRecords('district_table');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $vehicle_type = $this->master_model->getRecords('vehicle_type');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $city_data = $this->master_model->getRecords('city');
        // print_r($city_data); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $hotel_type = $this->master_model->getRecords('hotel_type');
        // print_r($hotel_type); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $room_type = $this->master_model->getRecords('room_type');
        // print_r($room_type); die;

        $fields = "citywise_place_master_sector.*,sector.sector,hotel_type.hotel_type_name";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_place_master_sector.is_deleted','no');
        $this->db->where('citywise_place_master_sector.select_district',$select_district);
        $this->db->where('citywise_place_master_sector.select_city',$select_city);
        $this->db->join("sector", 'citywise_place_master_sector.select_type_sector=sector.id','left');
        $this->db->join("hotel_type", 'citywise_place_master_sector.select_designation=hotel_type.id','left');
        $this->db->group_by('citywise_place_master_sector.person_name');
        $sector_data = $this->master_model->getRecords('citywise_place_master_sector',array('citywise_place_master_sector.is_deleted'=>'no'),$fields);
        // print_r($sector_data); die;

        $fields = "citywise_place_master_sector.*,sector.sector,hotel_type.hotel_type_name";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_place_master_sector.is_deleted','no');
        $this->db->where('citywise_place_master_sector.select_district',$select_district);
        $this->db->where('citywise_place_master_sector.select_city',$select_city);
        $this->db->join("sector", 'citywise_place_master_sector.select_type_sector=sector.id','left');
        $this->db->join("hotel_type", 'citywise_place_master_sector.select_designation=hotel_type.id','left');
        // $this->db->group_by('citywise_place_master_sector.person_name');
        $multiple_sector_data = $this->master_model->getRecords('citywise_place_master_sector',array('citywise_place_master_sector.is_deleted'=>'no'),$fields);
        // print_r($multiple_sector_data); die;
        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $sector = $this->master_model->getRecords('sector');
        // print_r($sector); die;

        $fields = "citywise_other_add_more.*";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_other_add_more.is_deleted','no');
        $this->db->where('citywise_other_add_more.select_district',$select_district);
        $this->db->where('citywise_other_add_more.select_city',$select_city);
        $this->db->join("city", 'citywise_other_add_more.railway_station_name=city.id and citywise_other_add_more.airport_name=city.id','left');
        $visiting_place_data = $this->master_model->getRecords('citywise_other_add_more',array('citywise_other_add_more.is_deleted'=>'no'),$fields);
        // print_r($visiting_place_data); die;

        $fields = "citywise_other_vehicle_details.*";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_other_vehicle_details.is_deleted','no');
        $this->db->where('citywise_other_vehicle_details.select_district',$select_district);
        $this->db->where('citywise_other_vehicle_details.select_city',$select_city);
        $this->db->join("vehicle_type", 'citywise_other_vehicle_details.other_vehicle=vehicle_type.id','left');
        $this->db->group_by('citywise_other_vehicle_details.other_vehicle');
        $vehicle_details_data = $this->master_model->getRecords('citywise_other_vehicle_details',array('citywise_other_vehicle_details.is_deleted'=>'no'),$fields);
        // print_r($visiting_place_data); die;
        
        $fields = "citywise_other_add_more.*";
        $this->db->order_by('id','ASC');
        $this->db->where('citywise_other_add_more.is_deleted','no');
        $this->db->where('citywise_other_add_more.select_district',$select_district);
        $this->db->where('citywise_other_add_more.select_city',$select_city);
        $this->db->group_by('citywise_other_add_more.in_tour_creation_no5');
        $Other_vehicle_in_tour_creation = $this->master_model->getRecords('citywise_other_add_more',array('citywise_other_add_more.is_deleted'=>'no'),$fields);
        // print_r($Other_vehicle_in_tour_creation); die;

        // $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['Other_vehicle_in_tour_creation'] = $Other_vehicle_in_tour_creation;
        $this->arr_view_data['multiple_sector_data'] = $multiple_sector_data;
        $this->arr_view_data['multiple_room_rate_data'] = $multiple_room_rate_data;
        $this->arr_view_data['visiting_place_data'] = $visiting_place_data;
        $this->arr_view_data['vehicle_details_data'] = $vehicle_details_data;
        $this->arr_view_data['distict_city_data'] = $distict_city_data;
        $this->arr_view_data['sector'] = $sector;
        $this->arr_view_data['sector_data'] = $sector_data;
        $this->arr_view_data['room_rate_data'] = $room_rate_data;
        $this->arr_view_data['district_table'] = $district_table;
        $this->arr_view_data['city_data'] = $city_data;
        $this->arr_view_data['room_type'] = $room_type;
        $this->arr_view_data['hotel_type'] = $hotel_type;
        $this->arr_view_data['vehicle_type'] = $vehicle_type;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('admin/layout/admin_combo',$this->arr_view_data);
    }
   

    public function get_city(){ 
        // POST data 
        // $all_b=array();
       $district_data = $this->input->post('did');
        // print_r($boarding_office_location); die;
                        $this->db->where('is_deleted','no');
                        $this->db->where('is_active','yes');
                        $this->db->where('district_id',$district_data);   
                        $data = $this->master_model->getRecords('city');
        echo json_encode($data);
    }



}