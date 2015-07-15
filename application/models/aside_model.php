<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//側邊欄專用
class Aside_model extends CI_Model{ 
	function __construct(){
		parent::__construct();
	}

	function select_group(){
		$this->db->select('groupId AS asideValue, groupName AS asideName'); 
		$this->db->from('group');
		$this->db->order_by("groupId","desc");//由大到小排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'member/show_member/'.$value->asideValue;
		}
		return $query->result();
	}

	function select_file(){
		$this->db->select('fileClass AS asideValue, fileClassName AS asideName');
		$this->db->from('file_category');
		$this->db->order_by("fileClass","desc");//由大到小排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'file/download/'.$value->asideValue;
		}
		return $query->result();
	}

	function select_page(){
		$this->db->select('pageClass AS asideValue, pageClassName AS asideName');
		$this->db->from('page_category');
		$this->db->order_by("pageClass","desc");//由大到小排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'page/category/'.$value->asideValue;
		}
		return $query->result();
	}

	function select_page_category($pageClass){
		$this->db->select('pageId AS asideValue, pageName AS asideName');
		$this->db->from('page');
		$this->db->where('pageClass', $pageClass);
		$this->db->order_by("pageId","asc");// 由小到大排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'page/view/'.$value->asideValue;
		}
		return $query->result();
	}

	function select_news(){
		$this->db->select('newsClass AS asideValue, newsClassName AS asideName'); 
		$this->db->from('news_category');
		// $this->db->order_by("groupId","desc");//由大到小排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'news/newslist/'.$value->asideValue;
		}
		return $query->result();
	}

	function select_advertisment(){
		$this->db->select('adId AS asideValue, logoTitle AS asideName');
		$this->db->from('advertisment');
		$this->db->order_by("adId","desc");//由大到小排序
		$query = $this->db->get();
		foreach ($query->result() as $key => $value) {
			$value->asideValue = 'advertisment/edit_advertisment/'.$value->asideValue;
		}
		return $query->result();
	}

}