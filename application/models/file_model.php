<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_data_by_fileClass($fileClass){
		$this->db->select('*');
		$this->db->from('file');
		$this->db->join('file_category', 'file.fileClass = file_category.fileClass');
		$this->db->where('file.fileClass', $fileClass);
		$this->db->order_by("fileId","desc");//由大到小排序
		$query = $this->db->get();
		// $query = $this->db->get_where('file', array('fileClass' => $fileClass));
		return $query->result();
	}

	function select_fileClassName($fileClass){ // 回傳單筆
		$query = $this->db->get_where('file_category', array('fileClass' => $fileClass));
		return $query->row();
	}

	function select_all_fileClassName(){
		$this->db->order_by("fileClass","desc");//由大到小排序
		$query = $this->db->get('file_category');
		return $query->result();
	}

	function select_fileClassName_by_fileClass($fileClass){
		$query = $this->db->get_where('file_category', array('fileClass' => $fileClass));
		return $query->num_rows();
	}

	function select_by_fileId($fileId){
		$query = $this->db->get_where('file', array('fileId' => $fileId));
		return $query->row();
	}

	function insert_data($data){ // 新增檔案
		$this->db->insert('file', $data);
		return true;
	}

	function insert_data_category($data){
		$this->db->insert('file_category', $data);
		return true;
	}

	function delete_data($fileId){
		$this->db->delete('file', array('fileId' => $fileId)); 
		return true;
	}

	function delete_category($fileClass){
		$this->db->delete('file_category', array('fileClass' => $fileClass));
		return true;
	}


}