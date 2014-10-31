<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$data['title'] = TITLE.' | Wallboard';
		$this->load->model('Reports_model', 'reports');
		$this->load->model('Wallboards_model', 'wallboards');
		
		$this->user_id = $this->session->userdata['user_id'];
		$this->comp_id = $this->session->userdata['comp_id'];
		$this->access = $this->session->userdata['access'];
		$this->style = array('slide','dissolve','fade','static');
		sort($this->style);
		
		$this->load->vars($data);
		
		if( ! isset($this->session->userdata['user_id']) )
			redirect('login/index');
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	index
	 */
	public function index()
	{
		$data['wallboards'] = $this->wallboards->get_wallboards();
		$data['wb_reports'] = $this->wallboards->get_wallboard_reports();
		$data['style'] = $this->style;
		$this->load->template('wallboard/index', $data);
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	edit
	 */
	public function edit()
	{
		$data['action'] = 'edit';
		$data['wallboards'] = $this->wallboards->get_wallboards();
		$data['wb_reports'] = $this->wallboards->get_wallboard_reports();
		$data['style'] = $this->style;
		
		$wb_id = $this->uri->segment(3);
		
		# save posted varaibles in array variable
		$post = $this->input->post();		
		
		if (isset($post) && !empty($post))
		{
			# if already exist!
            $return = $this->wallboards->exist($post);
            
			if ( !$return )
			{
				// wallboard logo
				$logo = 'no_image_uploaded.png';
				if( ($_FILES['logo']['error'] == 0) && sizeof($_FILES['logo']) > 0 )
				{						
					$extentions = array('png','jpg','jpeg','gif');
					
					$dir = WB_PHOTO;							
						
					$name = $_FILES['logo']['name'];
					$tmp_name = $_FILES['logo']['tmp_name'];
					$size = $_FILES['logo']['size'];
					
					$explode = explode('.', $name);
					if( in_array($explode[1], $extentions) )
					{								
						$logo = $this->utility_model->upload_file($explode[1], $tmp_name, $dir);							
						//unlink old photo						
						if($old_photo!=''){
							//check old file exsist
							if (file_exists(PUBPATH.$old_photo)){
								unlink(PUBPATH.$old_photo);
							}
						}
					}						
					$update_wb['logo'] = $logo;
				}
				
				$wb_id = $post['wb_id'];
				$update_wb['title'] = $post['title'];
				$update_wb['slug'] = generate_url_slug( $post['title'] );
				$update_wb['type'] = $post['type'];
				$update_wb['screen_delay'] = $post['screen_delay'];
	            $update_wb['effects'] = $post['effects'];
	            $update_wb['ticker_tape'] = $post['ticker_tape'];
	            $update_wb['created_by'] = $this->user_id;
	            if (isset($post['default_logo']) && $post['default_logo']=='on'){
	            	$update_wb['default_logo'] = 1;
	            } else {
	            	$update_wb['default_logo'] = 0;
	            }
				if (isset($post['wb_report']) && ($post['wb_report'] > 0)){
					$update_wb['report_id'] = $post['wb_report'];
				} else {
					$update_wb['report_id'] = 0;
				}
	            
	            $this->db->where('wb_id', $wb_id);
				$this->db->update('wallboards', $update_wb);
						
				$this->session->set_flashdata('message', '<div id="message" class="update">Wallboard saved successfully</div>');
			} else {
				$this->session->set_flashdata('message', '<div id="message" class="error">Wallboard already exists</div>');
			}
			redirect('wallboard');
		}
		
		if ( is_numeric($wb_id) ) {
			
			$wb = $this->db->get_where('wallboards', array('wb_id'=>$wb_id, 'comp_id'=>$this->comp_id))->result();
		
			if (!empty($wb))
			{
				$data['wb_info'] = $wb;				
			} else {
				redirect('wallboard');
			}	
			
			$this->load->template('wallboard/index', $data);
		
		} else {
			redirect('wallboard');
		}
	}

	/*
	 * @author:	Muhammad Sajid
	 * @name:	add
	 */
	public function add()
	{
		# save posted varaibles in array variable
		$post = $this->input->post();
		
		if (isset($post) && !empty($post))
		{
			$title = $post['title'];
			
			if (isset($post['wb_report']) && ($post['wb_report'] > 0)){
				$insert_wb['report_id'] = $post['wb_report'];
			}
			
			# if already exists
			$this->db->where('comp_id', $this->comp_id);
			$this->db->where('title', $title);
			$return = $this->db->get('wallboards')->row_array();
			
			if ( empty($return) )
			{
				// Wallboard logo
				$logo = 'no_image_uploaded.png';
				if( ($_FILES['logo']['error'] == 0) && sizeof($_FILES['logo']) > 0 )
				{					
					$extentions = array('png','jpg','jpeg','gif');
					
					$dir = WB_PHOTO;							
						
					$name = $_FILES['logo']['name'];
					$tmp_name = $_FILES['logo']['tmp_name'];
					$size = $_FILES['logo']['size'];
					
					$explode = explode('.', $name);
					if( in_array($explode[1], $extentions) )
					{
						$logo = $this->utility_model->upload_file($explode[1], $tmp_name, $dir);
					}
				}
				
				$insert_wb['logo'] = $logo;
				$insert_wb['created_on'] = date('Y-m-d');
				$insert_wb['title'] = $post['title'];
				$insert_wb['slug'] = generate_url_slug( $post['title'] );
				$insert_wb['type'] = $post['type'];
				$insert_wb['screen_delay'] = $post['screen_delay'];
	            $insert_wb['effects'] = $post['effects'];
	            $insert_wb['ticker_tape'] = $post['ticker_tape'];
	            $insert_wb['created_by'] = $this->user_id;
	            $insert_wb['comp_id'] = $this->comp_id;
	            if (isset($post['default_logo']) && $post['default_logo']=='on'){
	            	$insert_wb['default_logo'] = 1;
	            } else {
	            	$insert_wb['default_logo'] = 0;
	            }
	            $insert_id = $this->db->insert('wallboards', $insert_wb);
	            								
				$this->session->set_flashdata('message', '<div id="message" class="update">Wallboard added successfully</div>');
			} else {				
				$this->session->set_flashdata('message', '<div id="message" class="error">Wallboard already exists</div>');				
			}
			redirect('wallboard');
		}
	}
	
	/*
	 * @author:	Muhammad Sajid
	 * @name:	delete
	 */
	public function delete()
	{
		$wb_id = $_POST['wb_id'];
		if ($this->wallboards->delete($wb_id) == 1){
			$this->session->set_flashdata('message', '<div id="message" class="update">Wallboard deleted successfully</div>');
		} else {
			$this->session->set_flashdata('message', '<div id="message" class="error">Error occured while deleting Wallboard</div>');
		}
	}

	/*
	 * @author:	Muhammad Sajid
	 * @name:	launch
	 */
	public function launch()
	{
		$slug = trim($this->uri->segment(3));
		$data['wb'] = $this->wallboards->wallboard_by_slug($slug);		
		
		if ($slug == 'new-high-score'){
			$this->load->template('wallboard/congrats', $data);
		} else {
			$this->load->template('wallboard/launch', $data);
		}		
	}

	/*
	 * @author:	Muhammad Sajid
	 * @name:	wb_reports
	 */
	public function wb_reports()
	{
		var_debug($_POST);exit;
	}
}