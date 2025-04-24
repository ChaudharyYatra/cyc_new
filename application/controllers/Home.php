<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	 
	function __construct() {

        parent::__construct();

        $this->arr_view_data = [];
        $this->traveler_front_id =  $this->session->userdata('traveler_front_id');
	 }

	 
     public function index()
     {
        $aData['msg'] = '';
		 
		 // this code for website visiter count
		  $ip = $this->input->ip_address();
        $this->db->where('ip_address',$ip);
        $visiter_data = $this->master_model->getRecord('visiter_data');
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
		 
		   if(!empty($visiter_data)){
        $visiter_data_c = $visiter_data['ip_address'];
        $visiter_data_cnt = $visiter_data['visiter_count'];
        $visiter_data_id = $visiter_data['id'];
        $visiter_visit_date = $visiter_data['added_date'];
        $visiter_data_count = $visiter_data_cnt + 1;
        $added_date = date('Y-m-d');
            if($added_date >$visiter_visit_date)
            {
                $arr_update = array(
                    'ip_address'   =>   $ip,
                    'added_date'   =>   date('Y-m-d'),
                    'visiter_count'   =>   $visiter_data_count
                );

                $arr_where     = array("id" => $visiter_data_id);
                $this->master_model->updateRecord('visiter_data',$arr_update,$arr_where);
            }
        
        }else{
            $visiter_data_count = 1;
            $arr_insert = array(
                'ip_address'   =>   $ip,
                'added_date'   =>   date('Y-m-d'),
                'visiter_count'   =>   $visiter_data_count
            );
            
            $inserted_id = $this->master_model->insertRecord('visiter_data',$arr_insert,true);
        }
		 // end
      
		$this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $sliders = $this->master_model->getRecords('sliders');
        
        
        // ==================================
        
        $record = array();
        $fields = "packages.*, package_date.journey_date, package_date.single_seat_cost, package_date.twin_seat_cost, package_date.three_four_sharing_cost";
        $currentDate = date('Y-m-d');
        $this->db->where('packages.is_deleted', 'no');
        $this->db->where('packages.package_type', '1');
        $this->db->where('packages.is_active', 'yes');
        $this->db->where('package_date.journey_date >=', $currentDate); // Ensuring the journey date is today or later
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(7);
        $this->db->join("package_date", 'packages.id=package_date.package_id', 'right');
        $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
        $this->db->group_by('package_date.package_id');
        $main_packages_all = $this->master_model->getRecords('packages', array('packages.is_deleted' => 'no'), $fields);
        // print_r($main_packages_all); die;
                
        // ==================================
    //     $record = array();
    //     $fields = "packages.*,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost";
    //     $this->db->where('packages.is_deleted','no');
    //     $this->db->where('packages.is_active','yes');
    //     // $this->db->where('MONTH(package_date.journey_date)', date('m'));
	   // // $this->db->where('YEAR(package_date.journey_date)', date('Y'));
	   // $this->db->order_by('id', 'RANDOM');
	   // $this->db->limit(7);
    //     $this->db->join("package_date", 'packages.id=package_date.package_id','right');
    //     $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
    //     $this->db->group_by('package_date.package_id');
    //     $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        // print_r($main_packages_all); die;
 
        $record = array();
        $fields ="packages.*,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost";
		$currentDate = date('Y-m-d');
		$this->db->join("package_date", 'packages.id=package_date.package_id', 'right');
		$this->db->join("package_type", 'packages.package_type=package_type.id', 'right');
		$this->db->where('package_date.journey_date >=', $currentDate); // Ensuring the journey date is today or later
		$this->db->where('packages.package_type','2');
        $this->db->where('packages.is_deleted','no');
        $this->db->where('packages.is_active','yes');
        $this->db->group_by('package_id');
        $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
		$international_packages_all= $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
// 		print_r($international_packages_all); die;
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $core_features = $this->master_model->getRecords('core_features');
        
        $fields = "packages.*";
        $this->db->where('packages.is_deleted','no');
        $this->db->where('packages.is_active','yes');
        $this->db->where('package_type','3');
        // $this->db->join("package_date", 'packages.id=package_date.package_id','right');
        $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
        // $this->db->group_by('package_date.package_id');
        $custom_main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        // print_r($custom_main_packages_all); die; 

        $fields ="packages.*";
		// $this->db->join("package_date", 'packages.id=package_date.package_id','right');
        $this->db->where('packages.is_deleted','no');
        $this->db->where('packages.is_active','yes');
        $this->db->where('package_type','4');
        // $this->db->group_by('package_id');
        $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
		$custom_international_packages_all= $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        // print_r($international_packages_all); die;
        
        $today = date('Y-m-d');
        $fields = "packages.*";
        $this->db->where('packages.is_deleted','no');
        $this->db->where('packages.is_active','yes');
        $this->db->where('packages.from_date <=',$today);
        $this->db->where('packages.to_date >=',$today);
        $this->db->where('package_type','7');
        // $this->db->join("package_date", 'packages.id=package_date.package_id','right');
        $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
        // $this->db->group_by('package_date.package_id');
        $exclusive_deal_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        // print_r($exclusive_deal_packages_all); die;
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $department_data = $this->master_model->getRecords('department');
        // print_r($department_data); die;
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $client_reviews = $this->master_model->getRecords('client_reviews');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $tour_guides = $this->master_model->getRecords('tour_guides');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $website_basic_structure = $this->master_model->getRecords('website_basic_structure');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $social_media_link = $this->master_model->getRecords('social_media_link');
        
        $this->db->limit(6);
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','DESC');
        $top_packages = $this->master_model->getRecords('packages');
        
        $this->db->limit(7);
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','RANDOM');
        $random_packages = $this->master_model->getRecords('packages');
		
		$this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','DESC');
        $package_mapping_data = $this->master_model->getRecords('package_mapping');
        
        
        $this->db->where('department.is_deleted','no');
        $this->db->where('department.is_active','yes');
		$search_data_region = $this->master_model->getRecords('department');
        // print_r($search_data_region); die;

        $this->db->where('zone_master.is_deleted','no');
        $this->db->where('zone_master.is_active','yes');
		$search_data_zone_master = $this->master_model->getRecords('zone_master');
        // print_r($search_data_zone_master); die;

        $fields = "packages.*";
        $this->db->where('packages.is_deleted','no');
        $this->db->where('packages.is_active','yes');
        // $this->db->join("zone_master", 'packages.zone_name=zone_master.id','right');
		$search_data_packages = $this->master_model->getRecords('packages');
        // print_r($search_data_packages); die;

        
       
         $data = array('middle_content' => 'index',
						'sliders'       => $sliders,
						'main_packages'       => $main_packages_all,
                        //'main_packages_date'       => $main_packages_date,
						'international_packages'  => $international_packages_all,
                       // 'international_packages_dates'  => $international_packages_dates,
                       'custom_main_packages_all'       => $custom_main_packages_all,
                        'custom_international_packages_all'  => $custom_international_packages_all,
                        'exclusive_deal_packages_all'  => $exclusive_deal_packages_all,
						'top_packages'       => $top_packages,
						'random_packages'       => $random_packages,
						'core_features'       => $core_features,
						'client_reviews'       => $client_reviews,
						'tour_guides'       => $tour_guides,
						'website_basic_structure' => $website_basic_structure,
					    'package_mapping_data' => $package_mapping_data,
						'social_media_link' => $social_media_link,
						'department_data'       => $department_data,
						'search_data_region'       => $search_data_region,
						'search_data_packages'       => $search_data_packages,
						'search_data_zone_master'       => $search_data_zone_master
						);

        $this->arr_view_data['page_title']     =  "Home Page";
        $this->arr_view_data['middle_content'] =  "index";
        $this->load->view('front/common_view_home',$data);
     }

public function all_packages_search()
    {
        $zone_master = $this->input->post('zone_master');
        // print_r($zone_master); die;
        $month_search = $this->input->post('month_search');
        // print_r($month_search); die;
        $tour_name = $this->input->post('tour_name');
        // print_r($tour_name); die;
        $tour_days = $this->input->post('tour_days');
        // print_r($tour_days); die;
        
        $duration = $this->input->post('duration');
        $aData['msg'] = '';

        $tour_days_padded = sprintf('%02d', $tour_days);
        $timestamp = strtotime($month_search);
        $selectedMonth = date('m', $timestamp); // Month in numeric format (01-12)
        $selectedYear = date('Y', $timestamp); // Year in numeric format (e.g., 2024)
        
        // $this->db->where('is_deleted','no');
        // $this->db->where('is_active','yes');
        // // $this->db->where('package_type','Domestic Packages');
        // $this->db->where('tour_title',$destination_name);
        // // $this->db->or_where('tour_number_of_days',$duration);
        // $this->db->order_by('id','DESC');
        // $main_packages = $this->master_model->getRecords('packages');
        // $count= sizeof($main_packages);
        // // print_r($main_packages); die;
        
        // Initialize the variable
        $main_packages_all = [];
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $website_basic_structure = $this->master_model->getRecords('website_basic_structure');
        
        $this->db->where('is_deleted','no');
        $this->db->where('is_active','yes');
        $this->db->order_by('id','ASC');
        $social_media_link = $this->master_model->getRecords('social_media_link');


        if($month_search != '' && $zone_master == '' && $tour_name == '' && $tour_days == ''){
            // print('monthhhhhhhhhhhhhhhhh'); 
            $fields = "packages.*,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost,packages.tour_title,packages.tour_number_of_days";
            $this->db->where('packages.is_deleted','no');
            $this->db->where('MONTH(package_date.journey_date)', $selectedMonth);
            $this->db->where('YEAR(package_date.journey_date)', $selectedYear);
            $this->db->join("package_date", 'packages.id=package_date.package_id','right');
            // $this->db->join("zone_master", 'packages.zone_name=zone_master.id','right');
            $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
            $this->db->group_by('package_date.package_id');
            $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        }else if($zone_master != '' && $month_search == '' && $tour_name == '' && $tour_days == ''){
            // print('Zoneeeeeeeeeeeeeeeee'); 
            $fields = "packages.*,zone_master.zone_name,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost,packages.tour_title,packages.tour_number_of_days";
            $this->db->where('packages.is_deleted','no');
            $this->db->where('zone_master.zone_name',$zone_master);
            $this->db->join("package_date", 'packages.id=package_date.package_id','right');
            $this->db->join("zone_master", 'packages.zone_name=zone_master.id','right');
            $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
            $this->db->group_by('package_date.package_id');
            $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        }else if($tour_name != '' && $zone_master == '' && $month_search == '' && $tour_days == ''){
            // print('tourrrrrrrrrrrrrrrr'); 
            $fields = "packages.*,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost,packages.tour_title,packages.tour_number_of_days";
            $this->db->where('packages.is_deleted','no');
            $this->db->where('packages.tour_title',$tour_name);
            $this->db->join("package_date", 'packages.id=package_date.package_id','right');
            $this->db->join("zone_master", 'packages.zone_name=zone_master.id','right');
            $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
            $this->db->group_by('package_date.package_id');
            $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        }else if($tour_days != '' && $tour_name == '' && $zone_master == '' && $month_search == ''){
            // print('daysssssssssssssssss'); 
            $fields = "packages.*,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost,packages.tour_title,packages.tour_number_of_days";
            $this->db->where('packages.is_deleted','no');
            $this->db->where('packages.tour_number_of_days',$tour_days_padded);
            $this->db->join("package_date", 'packages.id=package_date.package_id','right');
            $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
            $this->db->group_by('package_date.package_id');
            $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        }else if($zone_master != '' && $month_search != '' && $tour_days == '' && $tour_name == ''){
            // print('zone month'); 
            $fields = "packages.*,zone_master.zone_name,package_date.journey_date,package_date.single_seat_cost,package_date.twin_seat_cost,package_date.three_four_sharing_cost,packages.tour_title,packages.tour_number_of_days";
            $this->db->where('packages.is_deleted','no');
            $this->db->where('zone_master.zone_name',$zone_master);
            $this->db->where('MONTH(package_date.journey_date)', $selectedMonth);
            $this->db->where('YEAR(package_date.journey_date)', $selectedYear);
            $this->db->join("package_date", 'packages.id=package_date.package_id','right');
            $this->db->join("zone_master", 'packages.zone_name=zone_master.id','right');
            $this->db->order_by('CAST(tour_number AS DECIMAL(10,6)) ASC');
            $this->db->group_by('package_date.package_id');
            $main_packages_all = $this->master_model->getRecords('packages',array('packages.is_deleted'=>'no'),$fields);
        }

         $data = array('middle_content' => 'search_packages',
						// 'main_packages'       => $main_packages,
						'main_packages_all' => $main_packages_all,
						'website_basic_structure' => $website_basic_structure,
						'social_media_link' => $social_media_link,
                        // 'count'      => $count,
                        'page_title' => 'search packages', 
						'alert_msg'       => $aData,
						);
						
        $this->arr_view_data['page_title']     =  "All Packages";
        $this->load->view('front/common_view',$data);
    }
}