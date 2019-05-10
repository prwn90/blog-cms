<?php 
class Articles extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
		//Access 
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login');
		}
	}

	public function index(){

		if(!empty($this->input->post('keywords'))){
			//Filtered Articles
			$data['articles'] = $this->Article_model->get_filtered_articles($this->input->post('keywords'),'id','DESC',10);
		} else {
			//Articles
			$data['articles'] = $this->Article_model->get_articles('id','DESC',10);
		}	
		
		// Categories
		$data['categories'] = $this->Article_model->get_categories('id','DESC',5);
		
		//Users
		$data['users'] = $this->User_model->get_users('id','DESC',5);
		
		//View
		$data['main_content'] = 'admin/articles/index';
		$this->load->view('admin/layouts/main',$data);
	}
	
	/*
	 * Add Article
	 */
	public function add(){
		//Validation 
		$this->form_validation->set_rules('title','Title','trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('body','Body','trim|required|xss_clean');
		$this->form_validation->set_rules('is_published','Publish','required');
		$this->form_validation->set_rules('category','Category','required');
		
		$data['categories'] = $this->Article_model->get_categories();
		
		$data['users'] = $this->User_model->get_users();
		
		//$data['groups'] = $this->User_model->get_groups();
		
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/articles/add';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Create Articles Data Array
			$data = array(
					'title'         => $this->input->post('title'),
					'body'          => $this->input->post('body'),
					'category_id'   => $this->input->post('category'),
					'user_id'       => $this->input->post('user'),
					'access'   		=> $this->input->post('access'),
					'is_published'  => $this->input->post('is_published'),
					'in_menu'  		=> $this->input->post('in_menu'),
					'order'  		=> $this->input->post('order')
			);
			
			//Table Insert
			$this->Article_model->insert($data);
			
			//Message
			$this->session->set_flashdata('article_saved', 'Your article has been saved');
			
			redirect('admin/articles');
		}
	}
	
	/*
	 * Edit article
	*/
	public function edit($id){
		//Validation
		$this->form_validation->set_rules('title','Title','trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('body','Body','trim|required|xss_clean');
		$this->form_validation->set_rules('is_published','Publish','required');
		$this->form_validation->set_rules('category','Category','required');
	
		$data['categories'] = $this->Article_model->get_categories();
	
		$data['users'] = $this->User_model->get_users();
		
		$data['article'] = $this->Article_model->get_article($id);
	
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/articles/edit';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Create Articles
			$data = array(
					'title'         => $this->input->post('title'),
					'body'          => $this->input->post('body'),
					'category_id'   => $this->input->post('category'),
					'user_id'       => $this->input->post('user'),
					'access'   		=> $this->input->post('access'),
					'is_published'  => $this->input->post('is_published'),
					'in_menu'  		=> $this->input->post('in_menu'),
					'order'  		=> $this->input->post('order')
			);
				
			//Articles Table Insert
			$this->Article_model->update($data, $id);
				
			//Message
			$this->session->set_flashdata('article_saved', 'Your article has been saved');
				
			redirect('admin/articles');
		}
	}
	
	/*
	 * Publish article
	*/
	public function publish($id){
		//Publish Menu Items in array
		$this->Article_model->publish($id);
		 
		//Create Message
		$this->session->set_flashdata('article_published', 'Your article has been published');
	
		redirect('admin/articles');
	}
	 
	 
	/*
	 * Unpublish article
	*/
	public function unpublish($id){
		//Publish Menu Items in array
		$this->Article_model->unpublish($id);
		 
		//Create Message
		$this->session->set_flashdata('article_unpublished', 'Your article has been unpublished');
	
		redirect('admin/articles');
	}
	
	/*
	 * Delete article
	 */
	public function delete($id){
		$this->Article_model->delete($id);
		 
		//Create Message
		$this->session->set_flashdata('article_deleted', 'Your article has been deleted');
	
		redirect('admin/articles');
	}
}