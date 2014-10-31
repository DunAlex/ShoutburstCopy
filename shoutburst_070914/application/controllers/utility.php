<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @author: Muhammad Sajid
 * @name: Utility
 */
class Utility extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// user validation
		$this->utility_model->check_isvalidated();
		
		$data['message'] = '';
		$this->load->vars($data);
	}

	/*
	 * @name:	quick_save
	 * Add new record
	 * Trigger by AJAX POST form projects view
	 */
	public function quick_save()
	{
		$table = $_POST['table'];
		$column = $_POST['column'];
		$value = $_POST['value'];		
		
		// if already exists?
		$query = $this->utility_model->if_exists($table, $column, $value);
		
		if ( empty($query)) {
			
			// add
			$inserted_id = $this->utility_model->set($table, array($column => $value));
			$data = array('message'=>$inserted_id);
			
		} else {
			$data = array('message'=>0);
		}
		
		echo(json_encode($data));
	}
	
	/*
	 * @name:	reload_element
	 * Trigger after successful AJAX POST form projects view
	 * reload element value
	 */
	public function reload_element($table, $last_inserted_id = '')
	{
		switch($table){
			
			case'durations':
				
				$data = $this->utility_model->get_all($table, 'durationName');
				
				$element="<select id='durationId' name='durationId'>";
				foreach ($data as $key){
					
					if( $key['durationId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['durationId'] . "'>" . $key['durationName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'statuses':
				
				$data = $this->utility_model->get_all($table, 'statusName');
				
				$element="<select id='statusId' name='statusId'>";
				foreach ($data as $key){
					
					if( $key['statusId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['statusId'] . "'>" . $key['statusName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'clients':
				
				$data = $this->utility_model->get_all($table, 'clientName');
				
				$element="<select id='clientId' name='clientId'>";
				foreach ($data as $key){
					
					if( $key['clientId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['clientId'] . "'>" . $key['clientName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'contractors':
				
				$data = $this->utility_model->get_all($table, 'contractorName');
				
				$element="<select id='contractorId' name='contractorId'>";
				foreach ($data as $key){
					
					if( $key['contractorId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['contractorId'] . "'>" . $key['contractorName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'countries':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'countryName');
				
				$element="<select size='10' multiple='multiple' id='countryId' name='countryId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['countryId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['countryId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['countryId'] . "'>" . $key['countryName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'programminglanguages':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'plName');
				
				$element="<select size='10' multiple='multiple' id='plId' name='plId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['plId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['plId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['plId'] . "'>" . $key['plName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'dtbases':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'dbName');
				
				$element="<select size='10' multiple='multiple' id='dbId' name='dbId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['dbId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['dbId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['dbId'] . "'>" . $key['dbName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'appservers':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'apsName');
				
				$element="<select size='10' multiple='multiple' id='apsId' name='apsId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['apsId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['apsId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
					
					$element.="<option $selected value='" . $key['apsId'] . "'>" . $key['apsName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'hosting':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'hostName');
				
				$element="<select size='10' multiple='multiple' id='hostId' name='hostId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['hostId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['hostId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
					
					$element.="<option $selected value='" . $key['hostId'] . "'>" . $key['hostName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'domains':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'domainName');
				
				$element="<select size='10' multiple='multiple' id='domainId' name='domainId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['domainId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['domainId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
					
					$element.="<option $selected value='" . $key['domainId'] . "'>" . $key['domainName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'technologies':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'techName');
				
				$element="<select size='10' multiple='multiple' id='techId' name='techId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['techId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['techId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['techId'] . "'>" . $key['techName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'platforms':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'platformName');
				
				$element="<select size='10' multiple='multiple' id='platformId' name='platformId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['platformId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['platformId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
						
					$element.="<option $selected value='" . $key['platformId'] . "'>" . $key['platformName'] . "</option>";
				}
				$element."</select>";				
			break;
			
			case'roles':
				//$end = end(array_keys($data))+1;
				
				$data = $this->utility_model->get_all($table, 'roleName');
				
				$element="<select size='10' multiple='multiple' id='roleId' name='roleId'>";
				foreach ($data as $key){
					
					/*$selected = "";
					if ($key['roleId'] == $end)
						$selected = "selected='selected'";*/
					
					if( $key['roleId'] == $last_inserted_id )
						$selected = "selected='selected'";
					else
						$selected = "";
					
					$element.="<option $selected value='" . $key['roleId'] . "'>" . $key['roleName'] . "</option>";
				}
				$element."</select>";				
			break;
			
		}
		
		echo $element;
	}
}