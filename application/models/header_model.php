<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class header_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_header_data_by_page_category(){
		$this->db->select('*');
		$this->db->from('page');
		$this->db->join('page_category', 'page.pageClass = page_category.pageClass');
		$this->db->order_by("page_category.pageClass","asc");//由小到大排序
		$query = $this->db->get();
		// $query = $this->db->get_where('file', array('fileClass' => $fileClass));
		return $query->result();
	}

}