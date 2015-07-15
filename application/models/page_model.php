<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_data_by_pageId($pageId){
		$this->db->order_by("pageId","desc");//由大到小排序
		$query = $this->db->get_where('page', array('pageId' => $pageId));
		return $query->row();
	}

	function select_all_pageClassName(){
		$this->db->order_by("pageClass","desc");//由大到小排序
		$query = $this->db->get('page_category');
		return $query->result();
	}

	function select_data($pageClass){
		$this->db->order_by("pageId","desc");//由大到小排序
		$query = $this->db->get_where('page', array('pageClass' => $pageClass));
		return $query->result();
	}

	function select_pageClassName_by_pageClass($pageClass){
		$this->db->order_by("pageClass","desc");//由大到小排序
		$query = $this->db->get_where('page_category', array('pageClass' => $pageClass));
		return $query->num_rows();
	}

	function select_pageClassName($pageClass){ // 回傳單筆
		$this->db->order_by("pageClass","desc");//由大到小排序
		$query = $this->db->get_where('page_category', array('pageClass' => $pageClass));
		return $query->row();
	}

	function delete_category($pageClass){ // 刪除掉頁面某分類
		$this->db->delete('page_category', array('pageClass' => $pageClass));
		return true;
	}

	function delete_page($pageId){ // 刪除掉頁面
		$this->db->delete('page', array('pageId' => $pageId));
		return true;
	}

	function insert_data_category($data){ // 新增頁面分類
		$this->db->insert('page_category', $data);
		return true;
	}

	function insert_data($data){
		$this->db->insert('page', $data);
		return true;
	}

	function update_data($data){
		$this->db->where('pageId', $data['pageId']);
		$this->db->update('page', $data); 
		return true;
	}
}