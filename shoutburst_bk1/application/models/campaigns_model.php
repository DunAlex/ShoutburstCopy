<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaigns_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	get_campaigns
	 */
	public function get_campaigns($comp_id)
	{
		$this->db->from('campaigns c');
		$this->db->join('company_campaings cc', 'c.camp_id = cc.camp_id');
		$this->db->where('cc.comp_id', $comp_id);
		$this->db->where('c.status', 1);
		$result = $this->db->get()->result();
		return $result;
	}
	
	/**
	 * Get All Created Campaign List
	 * */
	function getCampaignList($comp_id=null)
	{
		if ( ($comp_id != 'null') && ($comp_id != null) )
		{
			$this->db->from('campaigns c');
			$this->db->join('company_campaings cc', 'c.camp_id = cc.camp_id');
			$this->db->where("cc.comp_id = $comp_id");
		} else {
			$this->db->from('campaigns c');
			$this->db->join('company_campaings cc', 'c.camp_id = cc.camp_id');
		}
		return $query = $this->db->get()->result();
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	load_all_campaigns
	 */
	function load_all_campaigns()
	{		
		return $query = $this->db->query('SELECT * FROM campaigns')->result();
		
	}
}
?>