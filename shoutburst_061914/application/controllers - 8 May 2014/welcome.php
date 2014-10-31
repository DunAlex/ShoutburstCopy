<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @author:	Muhammad Sajid
 * @name:	Welcome
 */
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$data['title'] = TITLE.' | Welcome';
		$this->load->vars($data);

		if( !isset($this->session->userdata['user_id']) )
			redirect('login');
	}
	
	/*
	 * @name:	index
	 */
	public function index()
	{
		if ($this->session->userdata['access'] == 1){
			redirect('companies');
		} else {
			redirect('dashboard');
		}				
	}	
}