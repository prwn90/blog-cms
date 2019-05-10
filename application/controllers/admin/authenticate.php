<?php 

class Authenticate extends MY_Controller{
	public function login(){
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			//View
			$this->load->view('admin/layouts/login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			//Validate username / password
			$user_id = $this->Authenticate_model->login_user($username, $password);
			
			if($user_id){
				$user_data = array(
						'user_id'   => $user_id,
						'username'  => $username,
						'logged_in' => true
				);
				//Session userdata
				$this->session->set_userdata($user_data);
				
				$this->session->set_flashdata('pass_login', 'You are now logged in!');
				redirect('admin/dashboard');
			}
		}
	}
	
	/*
	 * Logout
	 */
	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
	
		$this->session->set_flashdata('logged_out', 'You have been logged out!');
		redirect('admin/login');
	}
}