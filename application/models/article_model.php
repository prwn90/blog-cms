<?php
class Article_model extends CI_Model{
	/*
	 * Get Articles
	 */
	public function get_articles($order_by = null, $sort='DESC', $limit = null, $offset = 0){
		$this->db->select('a.*, b.name as category_name, c.first_name, c.last_name');
		$this->db->from('articles as a');
		$this->db->join('categories AS b', 'b.id = a.category_id','left');
		$this->db->join('users AS c', 'c.id = a.user_id','left');
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();	
		return $query->result();
	}
	
	/*
	 * Searching articles
	*/
	public function get_filtered_articles($keywords, $order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('a.*, b.name as category_name, c.first_name, c.last_name');
		$this->db->from('articles as a');
		$this->db->join('categories AS b', 'b.id = a.category_id','left');
		$this->db->join('users AS c', 'c.id = a.user_id','left');
		$this->db->like('title', $keywords);
		$this->db->or_like('body', $keywords);
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	 * Menu Items
	*/
	public function get_menu_items(){
		$this->db->where('in_menu', 1);
		$this->db->order_by('order');
		$query = $this->db->get('articles');
        return $query->result();
	}
	
	/*
	 * Single Article
	 */
	public function get_article($id){
		$this->db->where('id',$id);
		$query = $this->db->get('articles');
		return $query->row();
	}
	
	/*
	 * Categories
	*/
	public function get_categories($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('categories');	
		if($limit != null){
			$this->db->limit($limit, $offset);
		}
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	 * Get Category
	 */
	public function get_category($id){
		$this->db->where('id',$id);
		$query = $this->db->get('categories');
		return $query->row();
	}
	
	/*
	 * Insert article
	 */
	public function insert($data){
		$this->db->insert('articles', $data);
		return true;
	}
	
	/*
	 * Update article
	*/
	public function update($data, $id){
		$this->db->where('id', $id);
		$this->db->update('articles', $data);
		return true;
	}
	
	/*
	 * Publish article
	*/
	public function publish($id){
		$data = array(
               		'is_published' => 1
            	);

		$this->db->where('id', $id);
		$this->db->update('articles', $data); 
	}
	
	/*
	 * Unpublish article
	*/
	public function unpublish($id){
		$data = array(
               		'is_published' => 0
            	);

		$this->db->where('id', $id);
		$this->db->update('articles', $data); 
	}
	
	/*
	 * Delete article
	*/
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('articles', $data);
		return true;
	}

	/*
	 * Insert category
	 */
	public function insert_category($data){
		$this->db->insert('categories', $data);
		return true;
	}
	
	/*
	 * Update category
	 */
	public function update_category($data, $id){
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		return true;
	}
	
	/*
	 * Delete category
	*/
	public function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('categories', $data);
		return true;
	}
	
}