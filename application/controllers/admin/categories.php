<?php 
class Categories extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
		//Access 
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login');
		}
	}


	public function index(){
		//Categories
		$data['categories'] = $this->Article_model->get_categories('id', 'DESC');
		
		//Views
        $data['main_content'] = 'admin/categories/index';
        $this->load->view('admin/layouts/main', $data);
	}
	/*
	 * Add category
	*/
	public function add(){
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
	
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/categories/add';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Data Array
			$data = array(
					'name'         => $this->input->post('name')
			);
				
			//Categories Table Insert
			$this->Article_model->insert_category($data);
				
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
				
			redirect('admin/categories');
		}
	}
	
	/*
	 * Edit category
	*/
	public function edit($id){
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
	
		if($this->form_validation->run() == FALSE){
			$data['category'] = $this->Article_model->get_category($id);
			
			//Views
			$data['main_content'] = 'admin/categories/edit';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name')
			);
	
			//Articles Table Insert
			$this->Article_model->update_category($data, $id);
	
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
	
			redirect('admin/categories');
		}
	}
	
	/*
	 * Delete category
	*/
	public function delete($id){
		$this->Article_model->delete_category($id);
			
		//Create Message
		$this->session->set_flashdata('category_deleted', 'Your category has been deleted');
	
		redirect('admin/categories');
	}
	
}