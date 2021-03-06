<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surveys_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	get_survey
	 */
	public function get_survey($sur_id)
	{
		$result = $this->db->get_where('surveys', array('sur_id'=>$sur_id, 'processed'=>1))->result_array();
		return $result;
	}

	public function get_surveys(){
		$result = $this->db->get('surveys')->result_array();
		return $result;	
	}

	public function insert_survey($sur_id,$comp_id,$user_id){
		$sql_query = "INSERT INTO `surveys`(`sur_id`, `comp_id`, `user_id`, `camp_id`, `dialed_number`, `date_time`, `cli`, `q1`, `q2`, `q3`, `q4`, `q5`, `total_score`, `average_score`,`nps_question`, `http_icon`, `action`, `recording`, `ftp_path`, `comments`, `servicenumber`, `plan`, `downloaded`, `recorded`, `processed`, `max_q1`, `max_q2`, `max_q3`, `max_q4`, `max_q5`) VALUES ($sur_id,$comp_id,$user_id,49,NULL,NOW(),NULL,8,8,8,8,8,40,8,1,NULL,NULL,0,1,0,0,0,0,0,0,0,5,5,5,5)";
		$result = $this->db->query($sql_query);
		return $result;
	}
}
?>