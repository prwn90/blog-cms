<?php 
class Articles extends MY_Controller{
	public function index() {
		
		//Articles
		$data['articles'] = $this->Article_model->get_articles('id', 'DESC', '10');

		//Menu items
		$data['menu_items'] = $this->Article_model->get_menu_items();

		//View
		$this->load->view('home', $data);
	}

	public function view($id){
		
		$data['menu_items'] = $this->Article_model->get_menu_items();
		$data['article'] = $this->Article_model->get_article($id);
		
		//Load View
		$this->load->view('inner', $data);
	}
}