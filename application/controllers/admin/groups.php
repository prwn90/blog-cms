<?php 
class Groups extends My_Controller{

	public function __construct(){
		parent::__construct();
		
		//Access 
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login');
		}
	}


	public function index(){
		//Categories
		$data['groups'] = $this->User_model->get_groups();
		
		//Views
        $data['main_content'] = 'admin/groups/index';
        $this->load->view('admin/layouts/main', $data);
	}
	
	/*
	 * Add Group
	*/
	public function add(){
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
	
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/groups/add';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Create Data Array
			$data = array(
					'name'  	=> $this->input->post('name')
			);
	
			//Table Insert
			$this->User_model->insert_group($data);
	
			//Message
			$this->session->set_flashdata('group_saved', 'User group has been saved');
			redirect('admin/groups');
		}
	}
	
	/*
	 * Edit 
	*/
	public function edit($id){
		//Validation 
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
	
		if($this->form_validation->run() == FALSE){
			$data['group'] = $this->User_model->get_group($id);
			
			//Views
			$data['main_content'] = 'admin/groups/edit';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Data Array
			$data = array(
					'name'  	=> $this->input->post('name')
			);
	
			//Table Update
			$this->User_model->update_group($data, $id);
	
			//Create Message
			$this->session->set_flashdata('group_saved', 'User group has been saved');

			redirect('admin/groups');
		}
	}
	
	/*
	 * Delete 
	*/
	public function delete($id){
		$this->User_model->delete_group($id);
			
		//Message
		$this->session->set_flashdata('group_deleted', 'User group has been deleted');
	
		redirect('admin/groups');
	}
	
}