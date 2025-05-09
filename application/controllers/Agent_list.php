<?php 
// Controller for: home page
// Controller for: home page
// Author: Nandkishor Wagh
// Start Date: 01-09-2022
// last updated: 01-09-2022
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_list extends CI_Controller {
	 
	function __construct() {
        parent::__construct();
        $this->arr_view_data = [];
        $this->traveler_front_id =  $this->session->userdata('traveler_front_id');
	}

	 
    public function index()
    {
        // Initialize visitor count logic
        $ip = $this->input->ip_address();
        // Check for existing visitor record based on IP
        $this->db->where('ip_address', $ip);
        $visiter_data = $this->master_model->getRecord('agentlist_visiter_data');
        
        // Check website visitor data
        $this->db->where('ip_address', $ip);
        $website_visitor_data = $this->master_model->getRecord('agentlist_website_visitor_data');

        if (!empty($website_visitor_data)) {
            $this->session->set_userdata('details_given', 'yes');
        }

        if (!empty($visiter_data)) {
            $visiter_data_count = $visiter_data['visiter_count'] + 1;
            $visiter_data_id = $visiter_data['id'];

            $visiter_visit_date = $visiter_data['added_date'];
            $added_date = date('Y-m-d');

            if ($added_date > $visiter_visit_date) {
                $arr_update = array(
                    'ip_address'    => $ip,
                    'added_date'    => date('Y-m-d'),
                    'visiter_count' => $visiter_data_count
                );

                $arr_where = array("id" => $visiter_data_id);
                $this->master_model->updateRecord('agentlist_visiter_data', $arr_update, $arr_where);
            }

        } else {
            $visiter_data_count = 1;
            $arr_insert = array(
                'ip_address'    => $ip,
                'added_date'    => date('Y-m-d'),
                'visiter_count' => $visiter_data_count
            );

            $inserted_id = $this->master_model->insertRecord('agentlist_visiter_data', $arr_insert, true);
        }

        // Fetch agent and other data
        $fields = "agent.*, department.department";
        $this->db->where('department.is_deleted', 'no');
        $this->db->where('department.is_active', 'yes');
        $this->db->order_by('agent.arrange_id', 'ASC');
        $this->db->join("department", 'agent.department=department.id', 'left');
        $agents_list = $this->master_model->getRecords('agent', array('agent.is_deleted' => 'no', 'agent.is_active' => 'yes'), $fields);
       
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $website_basic_structure = $this->master_model->getRecords('website_basic_structure');
        
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $social_media_link = $this->master_model->getRecords('social_media_link');
		 
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $this->db->group_by('id', 'ASC');
        $this->db->where('is_deleted', 'no');
        $this->db->where('is_active', 'yes');
        $this->db->order_by('id', 'ASC');
        $this->db->group_by('id', 'ASC');
        $department_list = $this->master_model->getRecords('department');

        $data = array(
            'middle_content'         => 'agents_list',
            'agents_list'            => $agents_list,
            'website_basic_structure' => $website_basic_structure,
            'social_media_link'      => $social_media_link,
            'department_list'        => $department_list,
            'page_title'             => "Agents List",
        );

        $this->arr_view_data['page_title']     = "Agents List";
        $this->arr_view_data['middle_content'] = "agents_list";
        $this->load->view('front/common_view', $data);
    }
}