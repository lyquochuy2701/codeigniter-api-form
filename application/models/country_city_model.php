<?php
class Country_city_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// get data from table country 
	public function get_country_query()
	{
		$query = $this->db->get('country');
		return $query->result();
	}

	// get city by country_id
	public function get_city_query($country_id)
	{
		$query = $this->db->get_where('city', array('country_id' => $country_id));
		return $query->result();
	}
}