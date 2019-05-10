<?php 
class Users extends MY_Controller{

	public function __construct(){
		parent::__construct();
		
		//Access 
		if(!$this->session->userdata('logged_in')){
			redirect('admin/login');
		}
	}

	public function index(){
		//Get Users
		$data['users'] = $this->User_model->get_users();
		
        $data['main_content'] = 'admin/users/index';
        $this->load->view('admin/layouts/main', $data);
	}
	
	/*
	 * Add user
	*/
	public function add(){
		//Validation 
		$this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');	
	
		$data['groups'] = $this->User_model->get_groups();
	
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/users/add';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Data Array
			$data = array(
					'first_name'  	=> $this->input->post('first_name'),
					'last_name'   	=> $this->input->post('last_name'),
					'username' 		=> $this->input->post('username'),
					'password'    	=> md5($this->input->post('password')),
					'group_id'   		=> $this->input->post('group'),
					'email'  	=> $this->input->post('email')
			);
				
			//Table Insert
			$this->User_model->insert($data);
				
			//Message
			$this->session->set_flashdata('user_saved', 'User has been saved!');
		
			redirect('admin/users');
		}
	}
	
	/*
	 * Edit user
	*/
	public function edit($id){
		//Validation 
		$this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[3]|xss_clean');
			
		$data['groups'] = $this->User_model->get_groups();
	
		$data['user'] = $this->User_model->get_user($id);
	
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/users/edit';
			$this->load->view('admin/layouts/main', $data);
		} else {
			//Data Array
			$data = array(
					'first_name'  	=> $this->input->post('first_name'),
					'last_name'   	=> $this->input->post('last_name'),
					'username' 		=> $this->input->post('username'),
					'group_id'   		=> $this->input->post('group'),
					'email'  	=> $this->input->post('email')
			);
	
			//Update
			$this->User_model->update($data, $id);
	
			// Message
			$this->session->set_flashdata('user_saved', 'User has been saved!');
	
			redirect('admin/users');
		}
	}
	
	/*
	 * Delete User
	*/
	public function delete($id){
		$this->User_model->delete($id);
			
		//Message
		$this->session->set_flashdata('user_deleted', 'User has been deleted!');
	
		redirect('admin/users');
	}
}