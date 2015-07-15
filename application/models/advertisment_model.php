<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisment_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function select_ad_data(){ // 撈出所有資料
		$this->db->order_by("adId","desc");//由大到小排序
		$query = $this->db->get('advertisment');
		return $query->result();
	}

	function select_ad_data_by_adId($adId){ // 抓特定資料
		$query = $this->db->get_where('advertisment', array('adId' => $adId));
		return $query->row();
	}

	function insert_ad_data($data){ // 新增檔案
		$this->db->insert('advertisment', $data);
		return true;
	}

	function delete_ad_data($adId){ // 刪除廣告
		$this->db->delete('advertisment', array('adId' => $adId));
		return true;
	}

	function update_ad_data($data){ // 更新廣告內容
		$this->db->where('adId', $data['adId']);
		$this->db->update('advertisment', $data); 
		return $this->db->affected_rows(); // 回傳影響筆數
	}
}