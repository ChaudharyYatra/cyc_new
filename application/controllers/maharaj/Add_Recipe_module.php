<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_recipe_module extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	    $this->arr_view_data = [];
        if($this->session->userdata('supervision_sess_id')=="") 
        { 
                redirect(base_url().'supervision/login'); 
        }
		
        $this->module_url_path    =  base_url().$this->config->item('maharaj_panel_slug')."maharaj/add_recipe_module";
        $this->module_title       = "Add Recipe Module";
        $this->module_url_slug    = "add_recipe_module";
        $this->module_view_folder = "add_recipe_module/";
	}

	public function index()
	{  
        $supervision_sess_name = $this->session->userdata('supervision_name');
        $id = $this->session->userdata('supervision_sess_id');

        $fields = "recipe_data.*,recipe.receipe";
        $this->db->order_by('recipe_data.id','desc');
        $this->db->where('recipe_data.is_deleted','no');
        $this->db->where('recipe_data.maharaj_id',$id);
        $this->db->join("recipe", 'recipe_data.recipe_name=recipe.id','left');
        $arr_data = $this->master_model->getRecords('recipe_data',array('recipe_data.is_deleted'=>'no'),$fields);
        // print_r($arr_data); die;

        // $this->db->order_by('id','desc');
        // $this->db->where('is_deleted','no');
        // $arr_data = $this->master_model->getRecords('citywise_place_master');

        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['listing_page']    = 'yes';
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = $this->module_title." List";
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."index";
        $this->load->view('maharaj/layout/agent_combo',$this->arr_view_data);
	}
    

    public function add()
    {   
        $supervision_sess_name = $this->session->userdata('supervision_name');
        $id = $this->session->userdata('supervision_sess_id');
        // print_r($id); die;

        if($this->input->post('submit'))
        {
            // print_r($_REQUEST); die;
            $this->form_validation->set_rules('recipe_name', 'recipe_name', 'required');
            
            if($this->form_validation->run() == TRUE)
            {
                $recipe_name = $this->input->post('recipe_name');
                $packs_no = $this->input->post('packs_no');
                $per_plate_quantity = $this->input->post('per_plate_quantity');
                $total_weight = $this->input->post('total_weight');

                $ingredients_name = $this->input->post('ingredients_name');
                $ingredient_quantity = $this->input->post('ingredient_quantity');
                $ingredients_weight = $this->input->post('ingredients_weight');

                $Equipment_name = $this->input->post('Equipment_name');
                $equipment_quantity = $this->input->post('equipment_quantity');
                $equipment_weight = $this->input->post('equipment_weight');

                $recipe_steps = $this->input->post('recipe_steps');
                $enter_recipe = $this->input->post('enter_recipe');
                $recipe_quantity = $this->input->post('recipe_quantity');
                $recipe_require_time = $this->input->post('recipe_require_time');

                    $arr_insert = array(
                    'recipe_name'    => $recipe_name,
                    'packs_no'        => $packs_no,
                    'per_plate_qty'        => $per_plate_quantity,
                    'total_weight'         => $total_weight,    
                    'maharaj_id'         => $id  
                    );
                    $inserted_id = $this->master_model->insertRecord('recipe_data',$arr_insert,true);
                    $inserted_id_id = $this->db->insert_id();

                    $ingredients_name_count = count($ingredients_name);
                    // print_r($room_count); die;
                    for($i=0;$i<$ingredients_name_count;$i++)
                    {
                        $arr_insert = array(
                        'ingredients_name'        => $this->input->post('ingredients_name')[$i],
                        'ingredients_quantity'        => $this->input->post('ingredient_quantity')[$i],
                        'ingredients_weight'        => $this->input->post('ingredients_weight')[$i],
                        'recipe_data_id' => $inserted_id_id,
                        'maharaj_id'         => $id  
                        );
                        // print_r($arr_insert); die;
                        $inserted_id = $this->master_model->insertRecord('ingredients_data',$arr_insert,true);
                       
                    }

                    $Equipment_name_count = count($Equipment_name);
                    // print_r($sector_count); die;
                    for($k=0;$k<$Equipment_name_count;$k++)
                    {
                        $arr_insert = array(
                        'equipment_name'=> $Equipment_name[$k],
                        'equipment_quantity'      => $equipment_quantity[$k],
                        'equipment_weight'       => $equipment_weight[$k],
                        'recipe_data_id' => $inserted_id_id,
                        'maharaj_id'         => $id
                        );
                        $inserted_id = $this->master_model->insertRecord('kitchen_equipment_data',$arr_insert,true);
                    }

                    $recipe_steps_count = count($recipe_steps);
                    for($l=0;$l<$recipe_steps_count;$l++)
                    {
                        $arr_insert = array(
                        'recipe_step'      => $recipe_steps[$l],
                        'enter_recipe'     => $enter_recipe[$l],
                        'recipe_quantity'  => $recipe_quantity[$l],
                        'require_time'     => $recipe_require_time[$l],
                        'recipe_data_id'   => $inserted_id_id,
                        'maharaj_id'         => $id
                        );
                        $inserted_id = $this->master_model->insertRecord('recipe_process',$arr_insert,true);
                    
                    }
                
                if($inserted_id > 0)
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

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $kitchen_equipment_data = $this->master_model->getRecords('kitchen_equipment');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $ingredients_data = $this->master_model->getRecords('ingredients');
        // print_r($district_table); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $measuring_unit_data = $this->master_model->getRecords('measuring_unit');
        // print_r($sector); die;

        $this->db->order_by('id','desc');
        $this->db->where('is_deleted','no');
        $recipe_name = $this->master_model->getRecords('recipe');
        // print_r($recipe_name); die;

        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['action']          = 'add';
        $this->arr_view_data['recipe_name'] = $recipe_name;
        $this->arr_view_data['measuring_unit_data'] = $measuring_unit_data;
        $this->arr_view_data['ingredients_data'] = $ingredients_data;
        $this->arr_view_data['kitchen_equipment_data'] = $kitchen_equipment_data;
        $this->arr_view_data['page_title']      = " Add ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."add";
        $this->load->view('maharaj/layout/agent_combo',$this->arr_view_data);
    }
  // Active/Inactive
  
  public function active_inactive($id,$type)
    {
        // print_r($district_id); die;
        // print_r($city_id); die;
        if(is_numeric($id) && ($type == "yes" || $type == "no") )
        {   
            $this->db->where('id',$id);
            $arr_data = $this->master_model->getRecords('recipe_data');
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
            
            if($this->master_model->updateRecord('recipe_data',$arr_update,array('id' => $id)))
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
            $arr_data = $this->master_model->getRecords('recipe_data');

            if(empty($arr_data))
            {
                $this->session->set_flashdata('error_message','Invalid Selection Of Record');
                redirect($this->module_url_path);
            }

            $arr_update = array('is_deleted' => 'yes');
            $arr_where = array("id" => $id);
                 
            if($this->master_model->updateRecord('recipe_data',$arr_update,$arr_where))
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
        $supervision_sess_name = $this->session->userdata('supervision_name');
        $iid = $this->session->userdata('supervision_sess_id');

            if($this->input->post('submit'))
            {
                $this->form_validation->set_rules('recipe_name', 'recipe_name', 'required');
                
                if($this->form_validation->run() == TRUE)
                {
                    $recipe_name = $this->input->post('recipe_name');
                    $packs_no = $this->input->post('packs_no');
                    $per_plate_quantity = $this->input->post('per_plate_quantity');
                    $total_weight = $this->input->post('total_weight');
                    
                    $recipe_data_id = $this->input->post('recipe_data_id');

                    $arr_update = array(
                    'recipe_name'    => $recipe_name,
                    'packs_no'        => $packs_no,
                    'per_plate_qty'        => $per_plate_quantity,
                    'total_weight'         => $total_weight   
                    );
                    // print_r($arr_insert); die;
                    $arr_where     = array("id" => $recipe_data_id);
                    $inserted_id = $this->master_model->updateRecord('recipe_data',$arr_update,$arr_where);

                    // -====================== ingredients  ===========================
                    $ingredients_name = $this->input->post('ingredients_name');
                    $ingredient_quantity = $this->input->post('ingredient_quantity');
                    $ingredient_id = $this->input->post('ingredient_id');

                    $ingredients_name_count = count($ingredients_name);
                    for($i=0;$i<$ingredients_name_count;$i++)
                    {
                        $arr_update = array(
                        'ingredients_name'    => $ingredients_name[$i],
                        'ingredients_quantity'        => $ingredient_quantity[$i]
                        );
                        $arr_where     = array("id" => $ingredient_id[$i]);
                        $inserted_id = $this->master_model->updateRecord('ingredients_data',$arr_update,$arr_where);
                    }

                    $edit_ingredients_name = $this->input->post('edit_ingredients_name');
                    $edit_ingredient_quantity = $this->input->post('edit_ingredient_quantity');

                    if($edit_ingredients_name!=''){
                    $edit_ingredients_name_count = count($edit_ingredients_name);
                        for($i=0;$i<$edit_ingredients_name_count;$i++)
                        {
                            $arr_insert = array(
                            'ingredients_name'        => $edit_ingredients_name[$i],
                            'ingredients_quantity'        => $edit_ingredient_quantity[$i],
                            'recipe_data_id' => $recipe_data_id
                            );
                            $inserted_id = $this->master_model->insertRecord('ingredients_data',$arr_insert,true);
                        }
                    }
                    // -====================== ingredients  ===========================
                    // -====================== Kitchen Equipment's  ===========================
                    $Equipment_name = $this->input->post('Equipment_name');
                    $equipment_quantity = $this->input->post('equipment_quantity');
                    $equipment_weight = $this->input->post('equipment_weight');
                    $equipment_id = $this->input->post('equipment_id');

                    $Equipment_name_count = count($Equipment_name);
                    for($i=0;$i<$Equipment_name_count;$i++)
                    {
                        $arr_update = array(
                        'equipment_name'    => $Equipment_name[$i],
                        'equipment_quantity'    => $equipment_quantity[$i],
                        'equipment_weight'=> $equipment_weight[$i]
                        );
                        $arr_where     = array("id" => $equipment_id[$i]);
                        $inserted_id = $this->master_model->updateRecord('kitchen_equipment_data',$arr_update,$arr_where);
                    }

                    $edit_Equipment_name = $this->input->post('edit_Equipment_name');
                    $edit_equipment_quantity = $this->input->post('edit_equipment_quantity');
                    $edit_equipment_weight = $this->input->post('edit_equipment_weight');

                    if($edit_Equipment_name!=''){
                    $edit_Equipment_name_count = count($edit_Equipment_name);
                        for($i=0;$i<$edit_Equipment_name_count;$i++)
                        {
                            $arr_insert = array(
                            'equipment_name'        => $edit_Equipment_name[$i],
                            'equipment_quantity'        => $edit_equipment_quantity[$i],
                            'equipment_weight'        => $edit_equipment_weight[$i],
                            'recipe_data_id' => $recipe_data_id
                            );
                            $inserted_id = $this->master_model->insertRecord('kitchen_equipment_data',$arr_insert,true);
                        }
                    }
                    // -====================== Kitchen Equipment's  ===========================
                    // -====================== Add Recipe  ===========================
                    $recipe_steps = $this->input->post('recipe_steps');
                    $enter_recipe = $this->input->post('enter_recipe');
                    $recipe_quantity = $this->input->post('recipe_quantity');
                    $recipe_require_time = $this->input->post('recipe_require_time');
                    $recipe_id = $this->input->post('recipe_id');

                    $recipe_steps_count = count($recipe_steps);
                    for($i=0;$i<$recipe_steps_count;$i++)
                    {
                        $arr_update = array(
                        'recipe_step'    => $recipe_steps[$i],
                        'enter_recipe'    => $enter_recipe[$i],
                        'recipe_quantity'    => $recipe_quantity[$i],
                        'require_time'=> $recipe_require_time[$i]
                        );
                        $arr_where     = array("id" => $recipe_id[$i]);
                        $inserted_id = $this->master_model->updateRecord('recipe_process',$arr_update,$arr_where);
                    }

                    $edit_recipe_steps = $this->input->post('edit_recipe_steps');
                    $edit_enter_recipe = $this->input->post('edit_enter_recipe');
                    $edit_recipe_quantity = $this->input->post('edit_recipe_quantity');
                    $edit_recipe_require_time = $this->input->post('edit_recipe_require_time');

                    if($edit_recipe_steps!=''){
                    $edit_recipe_steps_count = count($edit_recipe_steps);
                        for($i=0;$i<$edit_recipe_steps_count;$i++)
                        {
                            $arr_insert = array(
                            'recipe_step'        => $edit_recipe_steps[$i],
                            'enter_recipe'        => $edit_enter_recipe[$i],
                            'recipe_quantity'        => $edit_recipe_quantity[$i],
                            'require_time'        => $edit_recipe_require_time[$i],
                            'recipe_data_id' => $recipe_data_id
                            );
                            $inserted_id = $this->master_model->insertRecord('recipe_process',$arr_insert,true);
                        }
                    }
                    // -====================== Add Recipe  ===========================
                    

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
        
            $fields = "recipe_data.*,recipe.receipe";
            $this->db->order_by('recipe_data.id','ASC');
            $this->db->where('recipe_data.is_deleted','no');
            $this->db->where('recipe_data.id',$id);
            $this->db->join("recipe", 'recipe_data.recipe_name=recipe.id','left');
            $recipe_data = $this->master_model->getRecords('recipe_data',array('recipe_data.is_deleted'=>'no'),$fields);
            // print_r($recipe_data); die;

            $this->db->order_by('id','ASC');
            $this->db->where('is_deleted','no');
            $recipe_name = $this->master_model->getRecords('recipe');
            // print_r($recipe_name); die;

            $fields = "ingredients_data.*,ingredients.ingredients";
            $this->db->order_by('ingredients_data.id','ASC');
            $this->db->where('ingredients_data.is_deleted','no');
            $this->db->where('ingredients_data.recipe_data_id',$id);
            $this->db->join("ingredients", 'ingredients_data.ingredients_name=ingredients.id','left');
            $ingredients = $this->master_model->getRecords('ingredients_data',array('ingredients_data.is_deleted'=>'no'),$fields);
            // print_r($ingredients); die;

            $this->db->order_by('id','ASC');
            $this->db->where('is_deleted','no');
            $ingredients_data = $this->master_model->getRecords('ingredients');
            // print_r($district_table); die;

            $fields = "kitchen_equipment_data.*,kitchen_equipment.kitchen_equipment_name";
            $this->db->order_by('kitchen_equipment_data.id','ASC');
            $this->db->where('kitchen_equipment_data.is_deleted','no');
            $this->db->where('kitchen_equipment_data.recipe_data_id',$id);
            $this->db->join("kitchen_equipment", 'kitchen_equipment_data.equipment_name=kitchen_equipment.id','left');
            $kitchen_equipment = $this->master_model->getRecords('kitchen_equipment_data',array('kitchen_equipment_data.is_deleted'=>'no'),$fields);
            // print_r($kitchen_equipment); die;

            $this->db->order_by('id','ASC');
            $this->db->where('is_deleted','no');
            $kitchen_equipment_data = $this->master_model->getRecords('kitchen_equipment');
            // print_r($kitchen_equipment_data); die;

            $this->db->order_by('id','ASC');
            $this->db->where('is_deleted','no');
            $measuring_unit_data = $this->master_model->getRecords('measuring_unit');
            // print_r($measuring_unit_data); die;

            $this->db->order_by('id','ASC');
            $this->db->where('is_deleted','no');
            $this->db->where('recipe_process.recipe_data_id',$id);
            $recipe_process_data = $this->master_model->getRecords('recipe_process');
            // print_r($measuring_unit_data); die;

        // $fields = "citywise_place_master.*,district_table.district,city.city_name";
        // $this->db->order_by('id','ASC');
        // $this->db->where('citywise_place_master.is_deleted','no');
        // $this->db->where('citywise_place_master.select_district',$select_district);
        // $this->db->where('citywise_place_master.select_city',$select_city);
        // $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        // $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        // $this->db->group_by('citywise_place_master.select_district,citywise_place_master.select_city');
        // $distict_city_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // // print_r($distict_city_data); die;

        // $fields = "citywise_place_master.*,district_table.district,city.city_name,hotel_type.hotel_type_name,room_type.room_name";
        // $this->db->order_by('id','ASC');
        // $this->db->where('citywise_place_master.is_deleted','no');
        // $this->db->where('citywise_place_master.select_district',$select_district);
        // $this->db->where('citywise_place_master.select_city',$select_city);
        // $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        // $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        // $this->db->join("hotel_type", 'citywise_place_master.select_type=hotel_type.id','left');
        // $this->db->join("room_type", 'citywise_place_master.room_select=room_type.id','left');
        // $this->db->group_by('citywise_place_master.select_type');
        // $room_rate_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // // print_r($room_rate_data); die;


        // $fields = "citywise_place_master.*,district_table.district,city.city_name,hotel_type.hotel_type_name,room_type.room_name";
        // $this->db->order_by('id','ASC');
        // $this->db->where('citywise_place_master.is_deleted','no');
        // $this->db->where('citywise_place_master.select_district',$select_district);
        // $this->db->where('citywise_place_master.select_city',$select_city);
        // $this->db->join("district_table", 'citywise_place_master.select_district=district_table.id','left');
        // $this->db->join("city", 'citywise_place_master.select_city=city.id','left');
        // $this->db->join("hotel_type", 'citywise_place_master.select_type=hotel_type.id','left');
        // $this->db->join("room_type", 'citywise_place_master.room_select=room_type.id','left');
        // // $this->db->group_by('citywise_place_master.select_type');
        // $multiple_room_rate_data = $this->master_model->getRecords('citywise_place_master',array('citywise_place_master.is_deleted'=>'no'),$fields);
        // // print_r($multiple_room_rate_data); die;

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

        $this->arr_view_data['supervision_sess_name'] = $supervision_sess_name;
        $this->arr_view_data['recipe_data'] = $recipe_data;
        $this->arr_view_data['recipe_name'] = $recipe_name;
        $this->arr_view_data['ingredients'] = $ingredients;
        $this->arr_view_data['ingredients_data'] = $ingredients_data;
        $this->arr_view_data['kitchen_equipment_data'] = $kitchen_equipment_data;
        $this->arr_view_data['kitchen_equipment'] = $kitchen_equipment;
        $this->arr_view_data['measuring_unit_data'] = $measuring_unit_data;
        $this->arr_view_data['recipe_process_data'] = $recipe_process_data;

        $this->arr_view_data['district_table'] = $district_table;
        $this->arr_view_data['city_data'] = $city_data;
        $this->arr_view_data['room_type'] = $room_type;
        $this->arr_view_data['hotel_type'] = $hotel_type;
        $this->arr_view_data['vehicle_type'] = $vehicle_type;
        $this->arr_view_data['page_title']      = "Edit ".$this->module_title;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['middle_content']  = $this->module_view_folder."edit";
        $this->load->view('maharaj/layout/agent_combo',$this->arr_view_data);
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