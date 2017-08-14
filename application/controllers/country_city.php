<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_city extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('country_city_model');
	}
	public function index()
	{
		$data['countries'] = $this->country_city_model->get_country_query();
		$this->load->view('country_city', $data);
	}

	// get city 
	public function get_city()
	{
		$country_id = $this->input->post('country_id');
		$cities = $this->country_city_model->get_city_query($country_id);
		if(count($cities)>0)
		{
			$pro_select_box = '';
			$pro_select_box .= '<option value="">Select City</option>';
			foreach ($cities as $city) {
				$pro_select_box .='<option value="'.$city->id.'">'.$city->city_name.'</option>';
			}
			echo json_encode($pro_select_box);
		}
	}
}
